<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use View;
use Session;
use Redirect;

class PaymentController extends Controller
{
    public function __construct()
    {   
    }
    public function index(Request $request)
    { 
        return view('payment');
    }
    public function payment(Request $request)
    { 
        $this->validate($request, [
            'amount' => 'required',
            'purpose' => 'required',
            'buyer_name' => 'required',
            'phone' => 'required',
        ]);
        
        $ch = curl_init();

        // For Live Payment change CURLOPT_URL to https://www.instamojo.com/api/1.1/payment-requests/

        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:test_ba7110d4436b456238fc630d248",
                "X-Auth-Token:test_8ee7a19348456600fdf9169c9c7"));
        $payload = Array(
            'purpose' => $request->get('purpose'),
            'amount' => $request->get('amount'),
            'phone' => $request->get('phone'),
            'buyer_name' => $request->get('buyer_name'),
            'redirect_url' => url('/returnurl'),
            'send_email' => false,
            'webhook' => 'http://instamojo.com/webhook/',
            'send_sms' => true,
            'email' => 'laracode101@gmail.com',
            'allow_repeated_payments' => false
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch); 

        if ($err) {
            \Session::put('error','Payment Failed, Try Again!!');
            return redirect()->back();
        } else {
            $data = json_decode($response);
        }


        if($data->success == true) {
            return redirect($data->payment_request->longurl);
        } else { 
            \Session::put('error','Payment Failed, Try Again!!');
            return redirect()->back();
        }

    }

    public function returnurl(Request $request)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payments/'.$request->get('payment_id'));
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:test_db0a410a56987ea05606074061b",
                "X-Auth-Token:test_3c74aba44420e52746ff056e276"));

        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch); 

        if ($err) {
            \Session::put('error','Payment Failed, Try Again!!');
            return redirect()->route('payment');
        } else {
            $data = json_decode($response);
        }
        
        if($data->success == true) {
            if($data->payment->status == 'Credit') {
                
               // From here you can save respose data in database from $data

                \Session::put('success','Your payment has been pay successfully, Enjoy!!');
                return redirect()->route('payment');

            } else {
                \Session::put('error','Payment Failed, Try Again!!');
                return redirect()->route('payment');
            }
        } else {
            \Session::put('error','Payment Failed, Try Again!!');
            return redirect()->route('payment');
        }
    }

}	
