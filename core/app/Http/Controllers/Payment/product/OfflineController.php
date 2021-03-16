<?php

namespace App\Http\Controllers\Payment\product;

use App\Events\OrderPlaced;
use Illuminate\Http\Request;
use App\Http\Controllers\Payment\product\PaymentController;
use App\Models\ShippingCharge;
use Session;
use Str;


class OfflineController extends PaymentController
{

    public function store(Request $request)
    {
        if($this->orderValidation($request)) {
            return $this->orderValidation($request);
        }

        if ($request->has('shipping_charge')) {
            $shipping = ShippingCharge::findOrFail($request->shipping_charge);
            $shippig_charge = $shipping->id;
        } else {
            $shipping = NULL;
            $shippig_charge = 0;
        }
        $total = $this->orderTotal($shippig_charge);

        // save order
        $txnId = 'txn_' . Str::random(8) . time();
        $chargeId = 'ch_' . Str::random(9) . time();
        $order = $this->saveOrder($request, $shipping, $total, $txnId, $chargeId);
        $order_id = $order->id;

        // save ordered items
        $this->saveOrderItem($order_id);

        // send mail to buyer
        $this->mailFromAdmin($order);
        // send mail to admin
        $this->mailToAdmin($order);

        Session::forget('coupon');
        Session::forget('cart');
        event(new OrderPlaced());

        if ($request->ordered_from == 'website') {
            $success_url = route('product.payment.return', $order->order_number);
        } elseif ($request->ordered_from == 'qr') {
            $success_url = route('qr.payment.return', $order->order_number);
        }
        return redirect($success_url);

    }
}
