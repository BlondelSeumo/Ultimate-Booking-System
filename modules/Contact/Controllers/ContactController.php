<?php
namespace Modules\Contact\Controllers;

use App\Helpers\ReCaptchaEngine;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Matrix\Exception;
use Modules\Contact\Emails\NotificationToAdmin;
use Modules\Contact\Models\Contact;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [
            'page_title' => __("Contact Page")
        ];
        return view('Contact::index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'   => [
                'required',
                'max:255',
                'email'
            ],
            'name'    => ['required'],
            'message' => ['required']
        ]);
        /**
         * Google ReCapcha
         */
        if(ReCaptchaEngine::isEnable()){
            $codeCapcha = $request->input('g-recaptcha-response');
            if(!$codeCapcha or !ReCaptchaEngine::verify($codeCapcha)){
                return redirect()->back()->with('error',__('Please verify the captcha'));
            }
        }
        $row = new Contact($request->input());
        $row->status = 'sent';
        if ($row->save()) {
            $this->sendEmail($row);
            return redirect()->back()->with('success', __('Thank you for contacting us! We will get back to you soon'));
        }
    }

    protected function sendEmail($contact){
        if($admin_email = setting_item('admin_email')){
            try {
                Mail::to($admin_email)->send(new NotificationToAdmin($contact));
            }catch (Exception $exception){
                Log::warning("Contact Send Mail: ".$exception->getMessage());
            }
        }
    }

    public function t(){
        return new NotificationToAdmin(Contact::find(1));
    }
}
