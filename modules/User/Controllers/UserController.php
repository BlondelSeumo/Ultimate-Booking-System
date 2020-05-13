<?php
namespace Modules\User\Controllers;

use Illuminate\Support\Facades\Log;
use Matrix\Exception;
use Modules\FrontendController;
use Modules\User\Events\SendMailUserRegistered;
use Modules\User\Models\Newsletter;
use Modules\User\Models\Subscriber;
use Modules\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Validator;
use Modules\Booking\Models\Booking;
use App\Helpers\ReCaptchaEngine;

class UserController extends FrontendController
{
    public function dashboard(Request $request)
    {
        $this->checkPermission('tour_view');
        $user_id = Auth::id();
        $data = [
            'cards_report'       => Booking::getTopCardsReportForVendor($user_id),
            'earning_chart_data' => Booking::getEarningChartDataForVendor(strtotime('monday this week'), time(), $user_id)
        ];
        return view('User::frontend.dashboard', $data);
    }

    public function reloadChart(Request $request)
    {
        $chart = $request->input('chart');
        $user_id = Auth::id();
        switch ($chart) {
            case "earning":
                $from = $request->input('from');
                $to = $request->input('to');
                $this->sendSuccess([
                    'data' => Booking::getEarningChartDataForVendor(strtotime($from), strtotime($to), $user_id)
                ]);
                break;
        }
    }

    public function profile(Request $request)
    {
        $user = Auth::user();
        if (!empty($request->input())) {
            $request->request->remove('email');
            $user->fill($request->input());
            $user->birthday = date("Y-m-d", strtotime($user->birthday));
            $user->save();
            return redirect('user/profile')->with('success', __('Update successfully'));
        }
        return view('User::frontend.profile', ['dataUser' => $user]);
    }

    public function changePassword(Request $request)
    {
        if (!empty($request->input())) {
            if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
                // The passwords matches
                return redirect()->back()->with("error", __("Your current password does not matches with the password you provided. Please try again."));
            }
            if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
                //Current password and new password are same
                return redirect()->back()->with("error", __("New Password cannot be same as your current password. Please choose a different password."));
            }
            $request->validate([
                'current-password' => 'required',
                'new-password'     => 'required|string|min:6|confirmed',
            ]);
            //Change Password
            $user = Auth::user();
            $user->password = bcrypt($request->get('new-password'));
            $user->save();
            return redirect('user/profile')->with('success', __('Password changed successfully !'));
        }
        return view('User::frontend.changePassword');
    }

    public function bookingHistory(Request $request)
    {
        $user_id = Auth::id();
        $data = [
            'bookings' => Booking::getBookingHistory($request->input('status'), $user_id),
            'statues'  => config('booking.statuses')
        ];
        return view('User::frontend.bookingHistory', $data);
    }

    public function userLogin(Request $request)
    {
        $rules = [
            'email'    => 'required|email',
            'password' => 'required'
        ];
        $messages = [
            'email.required'    => __('Email is required field'),
            'email.email'       => __('Email invalidate'),
            'password.required' => __('Password is required field'),
        ];
        if(ReCaptchaEngine::isEnable() and setting_item("user_enable_login_recaptcha")){
            $codeCapcha = $request->input('g-recaptcha-response');
            if(!$codeCapcha or !ReCaptchaEngine::verify($codeCapcha)){
                $errors = new MessageBag(['message_error' => __('Please verify the captcha') ]);
                return response()->json(['error'   => true,
                                         'messages' => $errors
                ], 200);
            }
        }
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['error'   => true,
                                     'messages' => $validator->errors()
            ], 200);
        } else {
            $email = $request->input('email');
            $password = $request->input('password');
            if (Auth::attempt(['email'    => $email,
                               'password' => $password
            ], $request->has('remember'))) {
                return response()->json([
                    'error'    => false,
                    'messages'  => false,
                    'redirect' => $request->headers->get('referer') ?? url('/')
                ], 200);
            } else {
                $errors = new MessageBag(['message_error' => __('Username or password incorrect')]);
                return response()->json([
                    'error'    => true,
                    'messages'  => $errors,
                    'redirect' => false
                ], 200);
            }
        }
    }

    public function userRegister(Request $request)
    {
        $rules = [
            'first_name' => [
                'required',
                'string',
                'max:255'
            ],
            'last_name'  => [
                'required',
                'string',
                'max:255'
            ],
            'email'      => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users'
            ],
            'password'   => [
                'required',
                'string'
            ],
            'term'       => ['required'],
        ];
        $messages = [
            'email.required'    => __('Email is required field'),
            'email.email'       => __('Email invalidate'),
            'password.required' => __('Password is required field'),
            'first_name.required'     => __('The first name is required field'),
            'last_name.required'     => __('The last name is required field'),
            'term.required'     => __('The terms and conditions field is required'),
        ];

        if(ReCaptchaEngine::isEnable() and setting_item("user_enable_register_recaptcha")){
            $codeCapcha = $request->input('g-recaptcha-response');
            if(!$codeCapcha or !ReCaptchaEngine::verify($codeCapcha)){
                $errors = new MessageBag(['message_error' => __('Please verify the captcha') ]);
                return response()->json(['error'   => true,
                                         'messages' => $errors
                ], 200);
            }
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['error'   => true,
                                     'messages' => $validator->errors()
            ], 200);
        } else {
            $user = \App\User::create([
                'first_name'     => $request->input('first_name'),
                'last_name'     => $request->input('last_name'),
                'email'    => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'status'   => 'publish'
            ]);
            Auth::loginUsingId($user->id);
            try {

                event(new SendMailUserRegistered($user));

            }catch (Exception $exception){

                Log::warning("SendMailUserRegistered: ".$exception->getMessage());

            }
            $user->assignRole('customer');
            return response()->json([
                'error'    => false,
                'messages'  => false,
                'redirect' => $request->headers->get('referer') ?? url('/')
            ], 200);
        }
    }

    public function subscribe(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email|max:255'
        ]);
        $check = Subscriber::withTrashed()->where('email', $request->input('email'))->first();
        if ($check) {
            if ($check->trashed()) {
                $check->restore();
                $this->sendSuccess([], __('Thank you for subscribing'));
            }
            $this->sendError(__('You are already subscribed'));
        } else {
            $a = new Subscriber();
            $a->email = $request->input('email');
            $a->first_name = $request->input('first_name');
            $a->last_name = $request->input('last_name');
            $a->save();
            $this->sendSuccess([], __('Thank you for subscribing'));
        }
    }
}
