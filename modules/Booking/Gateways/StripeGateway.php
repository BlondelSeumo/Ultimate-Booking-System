<?php
namespace Modules\Booking\Gateways;

use Illuminate\Http\Request;
use Mockery\Exception;
use Modules\Booking\Models\Booking;
use Modules\Booking\Models\Payment;
use Omnipay\Omnipay;
use Omnipay\Stripe\Gateway;
use PHPUnit\Framework\Error\Warning;
use Validator;
use Omnipay\Common\Exception\InvalidCreditCardException;
use Illuminate\Support\Facades\Log;

class StripeGateway extends BaseGateway
{
    protected $id = 'stripe';

    public $name = 'Stripe Checkout';

    protected $gateway;

    public function getOptionsConfigs()
    {
        return [
            [
                'type'  => 'checkbox',
                'id'    => 'enable',
                'label' => __('Enable Stripe Standard?')
            ],
            [
                'type'  => 'input',
                'id'    => 'name',
                'label' => __('Custom Name'),
                'std'   => __("Stripe")
            ],
            [
                'type'  => 'upload',
                'id'    => 'logo_id',
                'label' => __('Custom Logo'),
            ],
            [
                'type'  => 'editor',
                'id'    => 'html',
                'label' => __('Custom HTML Description')
            ],
            [
                'type'       => 'input',
                'id'        => 'stripe_secret_key',
                'label'     => __('Secret Key'),
            ],
            [
                'type'       => 'checkbox',
                'id'        => 'stripe_enable_sandbox',
                'label'     => __('Enable Sandbox Mode'),
            ],
            [
                'type'       => 'input',
                'id'        => 'stripe_test_secret_key',
                'label'     => __('Test Secret Key'),
            ]
        ];
    }

    public function process(Request $request, $booking, $service)
    {
        if (in_array($booking->status, [
            $booking::PAID,
            $booking::COMPLETED,
            $booking::CANCELLED
        ])) {

            throw new Exception(__("Booking status does need to be paid"));
        }
        if (!$booking->total) {
            throw new Exception(__("Booking total is zero. Can not process payment gateway!"));
        }
        $rules = [
            'card_name'    => ['required'],
            'card_number'  => ['required'],
            'cvv'          => ['required'],
            'expiry_month' => ['required'],
            'expiry_year'  => ['required'],
        ];
        $messages = [
            'card_name.required'    => __('Card Name is required field'),
            'card_number.required'  => __('Card Number is required field'),
            'cvv.required'          => __('CVV Code is required field'),
            'expiry_month.required' => __('Expiry Month is required field'),
            'expiry_year.required'  => __('Expiry Year is required field'),
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['errors'   => $validator->errors() ], 200)->send();
        }
        $this->getGateway();
        $payment = new Payment();
        $payment->booking_id = $booking->id;
        $payment->payment_gateway = $this->id;
        $data = $this->handlePurchaseData([
            'amount'        => (float)$booking->total,
            'transactionId' => $booking->code . '.' . time()
        ], $booking, $request);
        try{
            $response = $this->gateway->purchase($data)->send();
            if ($response->isSuccessful()) {
                $payment->status = 'completed';
                $payment->logs = \GuzzleHttp\json_encode($response->getData());
                $payment->save();
                $booking->payment_id = $payment->id;
                $booking->status = $booking::PAID;
                $booking->save();
                try{
                    $booking->sendNewBookingEmails();
                } catch(\Swift_TransportException $e){
                    Log::warning($e->getMessage());
                }
                response()->json([
                    'url' => $booking->getDetailUrl()
                ])->send();
            } else {
                $payment->status = 'fail';
                $payment->logs = \GuzzleHttp\json_encode($response->getData());
                $payment->save();
                throw new Exception('Stripe Gateway: ' . $response->getMessage());
            }
        }
        catch(Exception | InvalidCreditCardException $e){
            $payment->status = 'fail';
            $payment->save();
            throw new Exception('Stripe Gateway: ' . $e->getMessage());
        }
    }

    public function getGateway()
    {
        $this->gateway = Omnipay::create('Stripe');
        $this->gateway->setApiKey($this->getOption('stripe_secret_key'));
        if ($this->getOption('stripe_enable_sandbox')) {
            $this->gateway->setApiKey($this->getOption('stripe_test_secret_key'));
        }
    }

    public function handlePurchaseData($data, $booking, $request)
    {
        $data['currency'] = setting_item('currency_main');
        $cardData = array(
            'lastName'     => $request->input("card_name"),
            'number'       => $request->input("card_number"),
            'expiryMonth'  => $request->input("expiry_month"),
            'expiryYear'   => $request->input("expiry_year"),
            'cvv'          => $request->input("cvv"),
        );
        $data["card"] = $cardData;
        return $data;
    }

    public function getDisplayHtml()
    {
        $html = $this->getOption('html', '');
        $html .= '<div class="card_stripe">
                    <i class="icofont-ui-v-card bg"></i>
                    <label>
                        <span>'.__("Name on the Card").'</span>
                        <input name="card_name" placeholder="'.__("Card Name").'">
                    </label>
                    <label>
                        <span>'.__("Card Number").'</span>
                        <input name="card_number" placeholder="0000 0000 0000 0000">
                        <i class="icofont-credit-card"></i>
                    </label>
                    <label class="item">
                        <span>'.__("Expiry Month").'</span>
                        <input name="expiry_month" placeholder="MM">
                    </label>
                    <label class="item">
                        <span>'.__("Expiry Year").'</span>
                        <input name="expiry_year" placeholder="YYYY">
                    </label>
                    <label class="item">
                        <span>'.__("CVV").'</span>
                        <input name="cvv" placeholder="CVV">
                    </label>
                </div>
                ';
        return $html;
    }
}