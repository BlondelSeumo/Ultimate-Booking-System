<?php
namespace Modules\Booking\Models;

use App\BaseModel;
use Illuminate\Http\Request;
use Modules\Media\Helpers\FileHelper;

class Bookable extends BaseModel
{
    public $email_new_booking_file             = '';
    public $checkout_booking_detail_modal_file = '';

    public function sendError($message, $data = [])
    {
        $data['status'] = 0;
        $this->sendSuccess($data, $message);
    }

    public function sendSuccess($data = [], $message = '')
    {
        if (!isset($data['status']))
            $data['status'] = 1;
        $data['message'] = $message;
        response()->json($data)->send();
        die;
    }

    public function addToCart(Request $request)
    {

    }

    public function createDraftBooking()
    {

    }

    public function getSubTotal(Booking $booking)
    {
        return 0;
    }

    /**
     * Get Total Array Data
     */
    public function getTotalArray(Booking $booking)
    {

        $sub_total = $this->getSubTotal($booking);
        if (!$sub_total or $sub_total < 0)
            return 0;
        $discountBeforeTax = $this->calDiscountFromTotal($this->getDiscountBeforeTax($booking), $sub_total);
        $sub_total -= $discountBeforeTax;
        $tax = $this->calTaxFromTotal($this->getTaxArray($booking), $sub_total);
        if (!$this->isTaxIncluded()) {
            $sub_total += $tax;
        }
        $discountAfterTax = $this->calDiscountFromTotal($this->getDiscountAfterTax($booking), $sub_total);
        $sub_total -= $discountAfterTax;
        if (!$sub_total or $sub_total < 0)
            return 0;
        return [
            'total'             => $sub_total,
            'tax'               => $tax,
            'discountBeforeTax' => $discountBeforeTax,
            'discountAfterTax'  => $discountAfterTax,
        ];
    }

    /**
     * Get total money
     *
     * @return float
     */
    public function getTotal(Booking $booking)
    {

        $sub_total = $this->getSubTotal($booking);
        if (!$sub_total or $sub_total < 0)
            return 0;
        $sub_total -= $this->calDiscountFromTotal($this->getDiscountBeforeTax($booking), $sub_total);
        if (!$this->isTaxIncluded()) {
            $sub_total += $this->calTaxFromTotal($this->getTaxArray($booking), $sub_total);
        }
        $sub_total -= $this->calDiscountFromTotal($this->getDiscountAfterTax($booking), $sub_total);
        if (!$sub_total or $sub_total < 0)
            return 0;
        return $sub_total;
    }

    /**
     * Get Tax Array
     * Example: ['type'=>'percent','amount'=>10,'order'=>1,'name'=>'VAT']
     *
     * @return array
     */
    public function getTaxArray(Booking $booking)
    {
        return [];
    }

    /**
     * Is Tax included in Pricing
     */
    public function isTaxIncluded()
    {
        return true;
    }

    /**
     * Get Discount included coupon
     * Example: ['type'=>'percent','amount'=>10,'order'=>1,'name'=>'New year coupon']
     */
    public function getDiscountBeforeTax(Booking $booking, $sub_total = 0)
    {
        return [];
    }

    /**
     * Get Discount after tax array
     *
     * Example: ['type'=>'percent','amount'=>10,'order'=>1,'name'=>'after tax coupon']
     */
    public function getDiscountAfterTax(Booking $booking, $sub_total = 0)
    {
        return [];
    }

    public function calDiscountFromTotal($discounts, $sub_total)
    {
        $t = 0;
        $remainTotal = $sub_total;
        // Sort by Priority
        usort($discounts, function ($a, $b) {
            if ($a['order'] == $b['order'])
                return 0;
            return $a['order'] < $b['order'] ? -1 : 1;
        });
        if (!empty($discounts)) {
            foreach ($discounts as $item) {
                if (!isset($item['on_total']))
                    $item['on_total'] = false;
                if (!isset($item['type']))
                    $item['type'] = 'percent';
                if (!isset($item['amount']))
                    $item['amount'] = 0;
                if (!is_array($item) or empty($item['type']) or !isset($item['on_total']))
                    continue;
                switch ($item['type']) {
                    case "percent":
                        $item['amount'] = max(0, $item['amount']);
                        $item['amount'] = min(100, $item['amount']);
                        if ($item['on_total']) {
                            $t_tmp = ($sub_total / 100) * $item['amount'];
                        } else {
                            $t_tmp = ($remainTotal / 100) * $item['amount'];
                            $remainTotal -= $t_tmp;
                        }
                        $t += $t_tmp;
                        break;
                    case "amount":
                    default:
                        $remainTotal -= $item['amount'];
                        $t += $item['amount'];
                        break;
                }
            }
        }
        return $t;
    }

    public function calTaxFromTotal($discounts, $sub_total)
    {
        $t = 0;
        $remainTotal = $sub_total;
        // Sort by Priority
        usort($discounts, function ($a, $b) {
            if ($a['order'] == $b['order'])
                return 0;
            return $a['order'] < $b['order'] ? -1 : 1;
        });
        if (!empty($discounts)) {
            foreach ($discounts as $item) {
                if (!isset($item['on_total']))
                    $item['on_total'] = false;
                if (!isset($item['type']))
                    $item['type'] = 'percent';
                if (!isset($item['amount']))
                    $item['amount'] = 0;
                if (!is_array($item) or empty($item['type']) or !isset($item['on_total']))
                    continue;
                switch ($item['type']) {
                    case "percent":
                        $item['amount'] = max(0, $item['amount']);
                        $item['amount'] = min(100, $item['amount']);
                        if ($item['on_total']) {
                            $t_tmp = ($sub_total / 100) * $item['amount'];
                        } else {
                            $t_tmp = ($remainTotal / 100) * $item['amount'];
                            $remainTotal += $t_tmp;
                        }
                        $t += $t_tmp;
                        break;
                    case "amount":
                    default:
                        $remainTotal += $item['amount'];
                        $t += $item['amount'];
                        break;
                }
            }
        }
        return $t;
    }

    public function getImageUrlAttribute($size = "medium")
    {
        $url = FileHelper::url($this->image_id, $size);
        return $url ? $url : '';
    }

    public function getBannerImageUrlAttribute($size = "medium")
    {
        $url = FileHelper::url($this->banner_image_id, $size);
        return $url ? $url : '';
    }

    public function getImageUrl($size = "medium")
    {

        $url = FileHelper::url($this->image_id, $size);
        return $url ? $url : '';
    }

    /**
     * Get Location
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function location()
    {
        return $this->hasOne("Modules\Location\Models\Location", "id", 'location_id');
    }

    /**
     * @todo Simple check before booking for status, etc
     */
    public function isBookable()
    {
        return true;
    }

    public function getBookingDetailHtml(Booking $booking)
    {
        return '';
    }

    public function filterCheckoutValidate(Request $request, $rules = [])
    {
        return $rules;
    }

    public function beforeCheckout(Request $request, $booking)
    {

    }

    public function afterCheckout(Request $request, $booking)
    {

    }

    public function beforePaymentProcess($booking, $payment)
    {

    }

    public function afterPaymentProcess($booking, $payment)
    {

    }

    /**
     * Get Location
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vendor()
    {
        return $this->hasOne("App\User", "id", 'create_user');
    }

    public function getDisplayPriceAttribute()
    {
        if (!empty($this->sale_price) and $this->sale_price > 0) {
            return format_money($this->sale_price);
        }
        return format_money($this->price);
    }

    public function getDisplaySalePriceAttribute()
    {
        if (!empty($this->sale_price) and $this->sale_price > 0) {
            return format_money($this->price);
        }
        return false;
    }

    public function getBookingsInRange($from,$to){

    }
}
