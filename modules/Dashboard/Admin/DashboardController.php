<?php
namespace Modules\Dashboard\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Booking\Models\Booking;

class DashboardController extends AdminController
{
    public function index()
    {
        $f = strtotime('monday this week');
        $data = [
            'recent_bookings'    => Booking::getRecentBookings(),
            'top_cards'          => Booking::getTopCardsReport(),
            'earning_chart_data' => Booking::getEarningChartData($f, time())
        ];
        return view('Dashboard::index', $data);
    }

    public function reloadChart(Request $request)
    {
        $chart = $request->input('chart');
        switch ($chart) {
            case "earning":
                $from = $request->input('from');
                $to = $request->input('to');
                $this->sendSuccess([
                    'data' => Booking::getEarningChartData(strtotime($from), strtotime($to))
                ]);
                break;
        }
    }
}