<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WebController extends Controller
{
    public function index(Request $request){
        session([
            'checkin_date'  => $request->checkin_date,
            'checkout_date' => $request->checkout_date,
            'kamar'         => $request->room_id,
            'dewasa'        => $request->total_adults,
            'anak'          => $request->total_children,
        ]);

        return view('payment/index');

    }
    public function payment(Request $request){
        // dd($request, Session::all());
       // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-WUU9w4mXJmVFF2kwTPsmN4XT';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => (int)Session::get('roomprice'),
            ),
            'item_details' => array(
                [
                    'id'    => 'TR-detail-'.date('YmdHis'),
                    'name' =>  $request->uname,
                    'customer_id' =>  Session::get('customer_id'),
                    'room_id' => Session::get('room_id'),
                    'checkin_date'=> Session::get('checkin_date'),
                    'checkout_date' =>  Session::get('checkout_date'),
                    'total_adults' =>  Session::get('total_adults'),
                    'total_children' => Session::get('total_children'),
                    'price' => (int)Session::get('roomprice'),
                    'kamar' => Session::get('kamar'),
                    'dewasa' => Session::get('dewasa'),
                    'anak' => Session::get('anak'),
                    'quantity'=> 1
                ]
            ),
            'customer_details' => array(
                'first_name' => $request->get('uname'),
                'last_name' => '',
                'email' => $request->get('email'),
                'phone' => $request->get('number'),
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('payment/payment',['snap_token'=>$snapToken]);
    }
    public function payment_post(Request $request){
        $json = json_decode($request->get('json'));
        $order = new Order();
        $order->status =$json->transaction_status;
        $order->uname = $request ->get('uname');
        $order->email = $request ->get('email');
        $order->number = $request ->get('number');
        $order->transaction_id =$json->transaction_id;
        $order->order_id =$json->order_id;
        $order->gross_amount=$json->gross_amount;
        $order->payment_type =$json->payment_type;
        $order->payment_code =$json->payment_code;
        $order->pdf_url = $json->pdf_url;
        return $order->save() ? redirect(url('/'))->with('alert-success', 'Order berhasil dibuat') : redirect(url('/'))->with('alert-failed', 'Terjadi kesalahan');


    }
}

