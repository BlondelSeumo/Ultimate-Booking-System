<?php
namespace Modules\Report\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Booking\Emails\NewBookingEmail;
use Modules\Booking\Models\Booking;

class BookingController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu('admin/module/report/booking');
    }

    public function index(Request $request)
    {
        $this->checkPermission('booking_view');
        $query = Booking::where('status', '!=', 'draft');
        if (!empty($request->s)) {
            $query->where(function ($query) use ($request) {
                $query->where('first_name', 'like', '%' . $request->s . '%')->orWhere('last_name', 'like', '%' . $request->s . '%')->orWhere('email', 'like', '%' . $request->s . '%')->orWhere('phone', 'like', '%' . $request->s . '%')->orWhere('address', 'like', '%' . $request->s . '%')->orWhere('address2', 'like', '%' . $request->s . '%');
            });
        }
        if ($this->hasPermission('booking_manage_others')) {
            if (!empty($request->vendor_id)) {
                $query->where('vendor_id', $request->vendor_id);
            }
        } else {
            $query->where('vendor_id', Auth::id());
        }
        $data = [
            'rows'                  => $query->paginate(20),
            'page_title'            => __("All Bookings"),
            'booking_manage_others' => $this->hasPermission('booking_manage_others'),
            'booking_update'        => $this->hasPermission('booking_update'),
            'statues'               => config('booking.statuses')
        ];
        return view('Report::admin.booking.index', $data);
    }

    public function bulkEdit(Request $request)
    {
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('No items selected'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select action'));
        }
        if ($action == "delete") {
            foreach ($ids as $id) {
                $query = Booking::where("id", $id);
                if (!$this->hasPermission('booking_manage_others')) {
                    $query->where("vendor_id", Auth::id());
                    $this->checkPermission('booking_delete');
                }
                $query->first()->delete();
            }
        } else {
            foreach ($ids as $id) {
                $query = Booking::where("id", $id);
                if (!$this->hasPermission('booking_manage_others')) {
                    $query->where("vendor_id", Auth::id());
                    $this->checkPermission('booking_update');
                }
                $query->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Update success'));
    }

    public function email_preview($id)
    {
        $booking = Booking::find($id);
        return (new NewBookingEmail($booking))->render();
    }
}