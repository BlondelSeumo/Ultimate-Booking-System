<?php
namespace Modules\Tour\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Tour\Models\Tour;
use Modules\Tour\Models\TourCategory;

class BookingController extends AdminController
{
    public function __construct()
    {
        $this->setActiveMenu('admin/module/tour');
        parent::__construct();
    }

    public function index(Request $request){

        $this->checkPermission('tour_create');

        $q = Tour::query();

        if($request->query('s')){
            $q->where('title','like','%'.$request->query('s').'%');
        }

        if ($cat_id = $request->query('cat_id')) {
            $cat = TourCategory::find($cat_id);
            if(!empty($cat)) {
                $q->join('bravo_tour_category', function ($join) use ($cat) {
                    $join->on('bravo_tour_category.id', '=', 'bravo_tours.category_id')
                        ->where('bravo_tour_category._lft','>=',$cat->_lft)
                        ->where('bravo_tour_category._rgt','>=',$cat->_lft);
                });
            }
        }

        if(!$this->hasPermission('tour_manage_others')){
            $q->where('create_user',$this->currentUser()->id);
        }

        $rows = $q->paginate(10);

        $current_month = strtotime(date('Y-m-01',time()));

        if($request->query('month')){
            $date = date_create_from_format('m-Y',$request->query('month'));
            if(!$date){
                $current_month = time();
            }else{
                $current_month = $date->getTimestamp();
            }
        }

        $prev_url = url('admin/module/tour/booking/').'?'.http_build_query(array_merge($request->query(),[
           'month'=> date('m-Y',$current_month - MONTH_IN_SECONDS)
        ]));
        $next_url = url('admin/module/tour/booking/').'?'.http_build_query(array_merge($request->query(),[
           'month'=> date('m-Y',$current_month + MONTH_IN_SECONDS)
        ]));

        $tour_categories = TourCategory::where('status', 'publish')->get()->toTree();
        $breadcrumbs = [
            [
                'name' => __('Tours'),
                'url'  => 'admin/module/tour'
            ],
            [
                'name'  => __('Booking'),
                'class' => 'active'
            ],
        ];
        $page_title = __('Tour Booking History');
        return view('Tour::admin.booking.index',compact('rows','tour_categories','breadcrumbs','current_month','page_title','request','prev_url','next_url'));
    }
    public function test(){
        $d = new \DateTime('2019-07-04 00:00:00');

        $d->modify('+ 4 hours');
        echo $d->format('Y-m-d H:i:s');
    }
}