<?php
namespace Modules\Tour\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Booking\Models\Bookable;
use Modules\Booking\Models\Booking;
use Modules\Location\Models\Location;
use Modules\Review\Models\Review;
use Modules\Tour\Models\TourTerm;
use Modules\Media\Helpers\FileHelper;
use Illuminate\Support\Facades\Cache;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Models\SEO;

class Tour extends Bookable
{
    use SoftDeletes;
    protected $table = 'bravo_tours';
    public $checkout_booking_detail_file       = 'Tour::frontend/booking/detail';
    public $checkout_booking_detail_modal_file = 'Tour::frontend/booking/detail-modal';
    public $email_new_booking_file             = 'Tour::emails.new_booking_detail';
    protected $fillable = [
        //Tour info
        'title',
        'slug',
        'content',
        'image_id',
        'banner_image_id',
        'short_desc',
        'category_id',
        'location_id',
        'address',
        'map_lat',
        'map_lng',
        'map_zoom',
        'is_featured',
        'gallery',
        'video',
        //Price
        'price',
        'sale_price',
        //Tour type
        'duration',
        'max_people',
        'min_people',
        //Extra Info
        'faqs',
        'status',
        'publish_date',
        'create_user',
        'update_user',
    ];
    protected $slugField     = 'slug';
    protected $slugFromField = 'title';
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'faqs'  => 'array',
    ];

    public static function getModelName()
    {
        return __("Tour");
    }

    public static function getTableName()
    {
        return with(new static)->table;
    }

    /**
     * Get Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category_tour()
    {
        return $this->hasOne("Modules\Tour\Models\TourCategory", "id", 'category_id');
    }

    /**
     * Get SEO
     *
     * @return mixed
     */
    public function getSeoMeta()
    {
        $meta = SEO::where('object_id', $this->id)->where('object_model', 'tour')->first();
        if(!empty($meta)){
            $meta = $meta->toArray();
        }
        $meta['slug'] = $this->slug;
        $meta['full_url'] = $this->getDetailUrl();
        $meta['service_title'] = $this->title;
        $meta['service_desc'] = $this->short_desc;
        $meta['service_image'] = $this->image_id;
        return $meta;
    }
    /**
     * Get SEO fop page list
     *
     * @return mixed
     */
    static public function getSeoMetaForPageList()
    {
        $meta['seo_title'] = __("Search for Tours");
        if (!empty($title = setting_item("tour_page_list_seo_title",false))) {
            $meta['seo_title'] = $title;
        }else if(!empty($title = setting_item("tour_page_search_title"))) {
            $meta['seo_title'] = $title;
        }
        $meta['seo_image'] = null;
        if (!empty($title = setting_item("tour_page_list_seo_image"))) {
            $meta['seo_image'] = $title;
        }else if(!empty($title = setting_item("tour_page_search_banner"))) {
            $meta['seo_image'] = $title;
        }
        $meta['seo_desc'] = setting_item("tour_page_list_seo_desc");
        $meta['seo_share'] = setting_item("tour_page_list_seo_share");
        $meta['full_url'] = url(config('tour.tour_route_prefix'));
        return $meta;
    }

    /**
     * Get Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function meta()
    {
        return $this->hasOne("Modules\Tour\Models\TourMeta", "tour_id");
    }

    /**
     * Get Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tour_term()
    {
        return $this->hasMany(TourTerm::class, "tour_id");
    }

    public function getDetailUrl()
    {
        return url(config('tour.tour_route_prefix') . "/" . $this->slug);
    }

    public function getGallery($featuredIncluded = false)
    {
        if (empty($this->gallery))
            return $this->gallery;
        $list_item = [];
        if ($featuredIncluded and $this->image_id) {
            $list_item[] = [
                'large' => FileHelper::url($this->image_id, 'full'),
                'thumb' => FileHelper::url($this->image_id, 'thumb')
            ];
        }
        $items = explode(",", $this->gallery);
        foreach ($items as $k => $item) {
            $large = FileHelper::url($item, 'full');
            $thumb = FileHelper::url($item, 'thumb');
            $list_item[] = [
                'large' => $large,
                'thumb' => $thumb
            ];
        }
        return $list_item;
    }

    public function getEditUrl()
    {
        return url('admin/module/tour/edit/' . $this->id);
    }

    public function getDiscountPercentAttribute()
    {
        if (!empty($this->sale_price) and $this->sale_price > 0 and $this->price != $this->sale_price) {
            $percent = 100 - ceil($this->sale_price / ($this->price / 100));
            return $percent . "%";
        }
    }

    function getDatefomat($value)
    {
        return \Carbon\Carbon::parse($value)->format('j F, Y');
    }

    public function saveMeta(\Illuminate\Http\Request $request)
    {
        $meta = TourMeta::where('tour_id', $this->id)->first();
        if (!$meta) {
            $meta = new TourMeta();
            $meta->tour_id = $this->id;
        }
        $meta->fill($request->input());
        return $meta->save();
    }
    public function saveSEO(\Illuminate\Http\Request $request)
    {
        $meta = SEO::where('object_id', $this->id)->where('object_model', 'tour')->first();
        if (!$meta) {
            $meta = new SEO();
            $meta->object_id = $this->id;
            $meta->object_model = "tour";
        }
        $meta->fill($request->input());
        return $meta->save();
    }

    public function fill(array $attributes)
    {
        if(!empty($attributes)){
            foreach ( $this->fillable as $item ){
                $attributes[$item] = $attributes[$item] ?? null;
            }
        }
        return parent::fill($attributes); // TODO: Change the autogenerated stub
    }

    public function isBookable()
    {
        if ($this->status != 'publish')
            return false;
        return parent::isBookable();
    }

    public function addToCart(Request $request)
    {
        $step = $request->input('step') ?? 1;
        $this->addToCartValidate($request);
        //        if($step == 1){
        //            return $this->calculateCartStep1($request);
        //        }
        // Add Booking
        $total = 0;
        $total_guests = 0;
        $discount = 0;
        $price = $this->sale_price ? $this->sale_price : $this->price;
        $extra_price = [];
        $extra_price_input = $request->input('extra_price');
        $person_types = [];
        $person_types_input = $request->input('person_types');
        $discount_by_people = [];
        $meta = $this->meta;
        if ($meta) {
            if ($meta->enable_person_types and !empty($meta->person_types)) {
                if (!empty($meta->person_types)) {
                    foreach ($meta->person_types as $k => $type) {

                        if (isset($person_types_input[$k]) and $person_types_input[$k]['number']) {
                            $type['number'] = $person_types_input[$k]['number'];
                            $person_types[] = $type;
                            $total += $type['price'] * $type['number'];
                            $total_guests += $type['number'];
                        }
                    }
                }
            } else {

                $total += $price * $request->input('guests');
                $total_guests += $request->input('guests');
            }
            if ($meta->enable_extra_price and !empty($meta->extra_price)) {
                if (!empty($meta->extra_price)) {
                    foreach ($meta->extra_price as $k => $type) {
                        if (isset($extra_price_input[$k]) and $extra_price_input[$k]['enable']) {


                            switch ($type['type']) {
                                case "one_time":
                                    $type_total = $type['price'];
                                    break;
                                case "per_hour":
                                    $type_total = $type['price'] * $this->duration;
                                    break;
                                case "per_day":
                                    $type_total = $type['price'] * ceil($this->duration / 24);
                                    break;
                            }
                            if (!empty($type['per_person'])) {
                                $type_total *= $total_guests;
                            }
                            $type['total'] = $type_total;
                            $total += $type_total;
                            $extra_price[] = $type;
                        }
                    }
                }
            }
            if ($meta->discount_by_people and !empty($meta->discount_by_people)) {
                foreach ($meta->discount_by_people as $type) {
                    if ($type['from'] <= $total_guests and (!$type['to'] or $type['to'] >= $total_guests)) {


                        switch ($type['type']) {
                            case "fixed":
                                $type_total = $type['amount'];
                                break;
                            case "percent":
                                $type_total = $total / 100 * $type['amount'];
                                break;
                        }
                        $total -= $type_total;
                        $discount += $type_total;
                        $type['total'] = $type_total;
                        $discount_by_people[] = $type;
                    }
                }
            }
        } else {
            // Default
            $total += $price * $request->input('guests');
            $total_guests += $request->input('guests');
        }
        $start_date = new \DateTime($request->input('start_date'));
        if (empty($start_date)) {
            $this->sendError(__("Start date is not a valid date"));
        }
        $booking = new Booking();
        $booking->status = 'draft';
        $booking->object_id = $request->input('service_id');
        $booking->object_model = $request->input('service_type');
        $booking->vendor_id = $this->create_user;
        $booking->customer_id = Auth::id();
        $booking->total = $total;
        $booking->total_guests = $total_guests;
        $booking->start_date = $start_date->format('Y-m-d H:i:s');
        $start_date->modify('+ ' . max(1, $this->duration) . ' hours');
        $booking->end_date = $start_date->format('Y-m-d H:i:s');
        $check = $booking->save();
        if ($check) {
            $booking->addMeta('duration', $this->duration);
            $booking->addMeta('base_price', $price);
            $booking->addMeta('guests', max($total_guests, $request->input('guests')));
            $booking->addMeta('extra_price', $extra_price);
            $booking->addMeta('person_types', $person_types);
            $booking->addMeta('discount_by_people', $discount_by_people);
            $this->sendSuccess([
                'url' => $booking->getCheckoutUrl()
            ]);
        }
        $this->sendError(__("Can not check availability"));
    }

    public function calculateCartStep1(Request $request)
    {

        $meta = $this->meta;
        $start_date = $request->input('start_date');
        $html = '';
        $total = 0;
        $total_guests = 0;
        if ($meta) {

            $data = [
                'request'              => $request,
                'row'                  => $this,
                'meta'                 => $meta,
                'guests'               => $request->input('guests'),
                'extra_price'          => $request->input('extra_price'),
                'extra_price_configs'  => $meta->extra_price,
                'person_types'         => $request->input('person_types'),
                'person_types_configs' => $meta->person_types
            ];
            $view = view('Tour::frontend/booking/cart-total', $data);
            $html = $view->render();
        }
        $this->sendSuccess([
            'html' => $html,
            'step' => 2
        ]);
    }

    public function addToCartValidate(Request $request)
    {

        $meta = $this->meta;
        $rules = [
            'guests'     => 'required|integer|min:1',
            'start_date' => 'required|date_format:Y-m-d'
        ];
        $start_date = $request->input('start_date');
        if ($meta) {

            // Percent Types
            if ($meta->enable_person_types) {
                unset($rules['guests']);
                $rules['person_types'] = 'required';
                $person_types_configs = $meta->person_types;
                if (!empty($person_types_configs) and is_array($person_types_configs)) {
                    foreach ($person_types_configs as $k => $person_type) {

                        $ruleStr = 'integer';
                        if ($person_type['min']) {
                            $ruleStr .= '|min:' . $person_type['min'];
                        }
                        if ($person_type['max']) {
                            $ruleStr .= '|max:' . $person_type['max'];
                        }
                        if ($ruleStr) {
                            $rules['person_types.' . $k . '.number'] = $ruleStr;
                        }
                    }
                }
            }
        }
        // Validation
        if (!empty($rules)) {
            $validator = Validator::make($request->all(), $rules);
        }
        if ($validator->fails()) {
            $this->sendError('', ['errors' => $validator->errors()]);
        }
        if ($meta) {
            // Open Hours
            if ($meta->enable_open_hours) {

                $open_hours = $meta->open_hours;
                $nDate = date('N', strtotime($start_date));
                if (!isset($open_hours[$nDate]) or empty($open_hours[$nDate]['enable'])) {
                    $this->sendError(__("This tour is not open on your selected day"));
                }
            }
        }
        return true;
    }

    public function getBookingData()
    {
        $booking_data = [
            'id'           => $this->id,
            'person_types' => [],
            'max'          => 0,
            'open_hours'   => [],
            'extra_price'  => [],
            'minDate'      => date('m/d/Y')
        ];
        $meta = $this->meta ?? false;
        if ($meta) {
            if ($meta->enable_person_types) {
                $booking_data['person_types'] = $meta->person_types;
                foreach ($booking_data['person_types'] as $k => &$type) {

                    $type['min'] = (int)$type['min'];
                    $type['max'] = (int)$type['max'];
                    $type['number'] = $type['min'];
                    $type['display_price'] = format_money($type['price']);
                }
            }
            if ($meta->enable_extra_price) {

                $booking_data['extra_price'] = $meta->extra_price;
                foreach ($booking_data['extra_price'] as $k => &$type) {

                    $type['number'] = 0;
                    $type['enable'] = 0;
                    $type['price_html'] = format_money($type['price']);
                    $type['price_type'] = '';
                    switch ($type['type']) {
                        case "per_day":
                            $type['price_type'] .= '/' . __('day');
                            break;
                        case "per_hour":
                            $type['price_type'] .= '/' . __('hour');
                            break;
                    }
                    if (!empty($type['per_person'])) {
                        $type['price_type'] .= '/' . __('guest');
                    }
                }
            }
            if ($meta->enable_open_hours) {
                $booking_data['open_hours'] = $meta->open_hours;
            }
        }
        return $booking_data;
    }

    public static function searchForMenu($q = false)
    {
        $query = static::select('id', 'title as name');
        if (strlen($q)) {

            $query->where('title', 'like', "%" . $q . "%");
        }
        $a = $query->limit(10)->get();
        return $a;
    }

    public static function getMinMaxPrice()
    {
        $model = parent::selectRaw('MIN( CASE WHEN sale_price > 0 THEN sale_price ELSE ( price ) END ) AS min_price ,
                                    MAX( CASE WHEN sale_price > 0 THEN sale_price ELSE ( price ) END ) AS max_price ')->where("status", "publish")->first();
        if (empty($model->min_price) and empty($model->max_price)) {
            return [
                0,
                100
            ];
        }
        return [
            $model->min_price,
            $model->max_price
        ];
    }

    public function getReviewEnable()
    {
        return setting_item("tour_enable_review", 0);
    }

    public function getReviewApproved()
    {
        return setting_item("tour_review_approved", 0);
    }

    public function check_enable_review_after_booking($service_id)
    {
        $option = setting_item("tour_enable_review_after_booking", 0);
        if ($option) {
            $number_review = Review::countReviewByServiceID($service_id, Auth::id()) ?? 0;
            $number_booking = Booking::countBookingByServiceID($service_id, Auth::id()) ?? 0;
            if ($number_review >= $number_booking) {
                return false;
            }
        }
        return true;
    }

    public static function getReviewStats()
    {
        $reviewStats = [];
        if (!empty($list = setting_item("tour_review_stats", []))) {
            $list = json_decode($list, true);
            foreach ($list as $item) {
                $reviewStats[] = $item['title'];
            }
        }
        return $reviewStats;
    }

    public function getReviewDataAttribute()
    {
        $list_score = [
            'score_total'  => 0,
            'score_text'   => __("Not Rate"),
            'total_review' => 0,
            'rate_score'   => [],
        ];
        $dataTotalReview = Review::selectRaw(" AVG(rate_number) as score_total , COUNT(id) as total_review ")->where('object_id', $this->id)->where('object_model', "tour")->where("status", "approved")->first();
        if (!empty($dataTotalReview->score_total)) {
            $list_score['score_total'] = number_format($dataTotalReview->score_total, 1);
            $list_score['score_text'] = Review::getDisplayTextScoreByLever(round($list_score['score_total']));
        }
        if (!empty($dataTotalReview->total_review)) {
            $list_score['total_review'] = $dataTotalReview->total_review;
        }
        for ($rate = 5; $rate >= 1; $rate--) {
            $number = Review::where('rate_number', $rate)->where('object_id', $this->id)->where('object_model', "tour")->where("status", "approved")->count();
            if (!empty($list_score['total_review'])) {
                $percent = ($number / $list_score['total_review']) * 100;
            } else {
                $percent = 0;
            }
            $list_score['rate_score'][$rate] = [
                'title'   => Review::getDisplayTextScoreByLever($rate),
                'total'   => $number,
                'percent' => round($percent),
            ];
        }
        return $list_score;
    }

    /**
     * Get Score Review
     *
     * Using for loop tour
     */
    public function getScoreReview()
    {
        $tour_id = $this->id;
        $list_score = Cache::rememberForever('review_tour_' . $tour_id, function () use ($tour_id) {
            $dataReview = Review::selectRaw(" AVG(rate_number) as score_total , COUNT(id) as total_review ")->where('object_id', $tour_id)->where('object_model', "tour")->where("status", "approved")->first();
            return [
                'score_total'  => !empty($dataReview->score_total) ? number_format($dataReview->score_total, 1) : 0,
                'total_review' => !empty($dataReview->total_review) ? $dataReview->total_review : 0,
            ];
        });
        return $list_score;
    }

    public function getNumberReviewsInService($status = false)
    {
        return Review::countReviewByServiceID($this->id, false, $status) ?? 0;
    }

    public function getNumberServiceInLocation($location)
    {
        if(!empty($location)) {
            $number = parent::join('bravo_locations', function ($join) use ($location) {
                $join->on('bravo_locations.id', '=', 'bravo_tours.location_id')->where('bravo_locations._lft', '>=', $location->_lft)->where('bravo_locations._rgt', '<=', $location->_rgt);
            })->where("bravo_tours.status", "publish")->count("bravo_tours.id");
        }
        if ($number > 1) {
            return __(":number Tours", ['number' => $number]);
        }
        return __(":number Tour", ['number' => $number]);
    }

    /**
     * @param $from
     * @param $to
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getBookingsInRange($from,$to){

        $query = Booking::query();
        $query->whereNotIn('status',['draft']);
        $query->where('start_date','<=',$to)->where('end_date','>=',$from)->take(50);

        $query->where('object_id',$this->id);
        $query->where('object_model','tour');

        return $query->orderBy('id','asc')->get();

    }
}
