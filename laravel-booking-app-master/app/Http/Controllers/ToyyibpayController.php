<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToyyibpayController extends Controller
{
    public function createBill()
    {
        $option = array(
            'userSecretKey' => config('toyyibpay.key'),
            'categoryCode' => config('toyyibpay.category'),
            'billName' => 'Car Rental WXX123',
            'billDescription' => 'Car Rental WXX123 On Sunday',
            'billPriceSetting' => 1,
            'billPayorInfo' => 1,
            'billAmount' => 100,
            'billReturnUrl' => route('toyyibpay-status'),
            'billCallbackUrl' => route('toyyibpay-callback'),
            'billExternalReferenceNo' => 'Bill-0001',
            'billTo' => 'SIEW SHENG XIANG',
            'billEmail' => 'shengxiang9920@gmail.com',
            'billPhone' => '0129020916',
            'billSplitPayment' => 0,
            'billSplitPaymentArgs' => '',
            'billPaymentChannel' => '0',
            'billContentEmail' => 'Thank you for purchasing our product!',
            'billChargeToCustomer' => 2
            //'billExpiryDate' => '17-12-2020 17:00:00',
            //'billExpiryDays' => 3
          );  

          $url = 'https://toyyibpay.com/index.php/api/createBill';
          $response = Http::asForm()->post($url, $option);
          $billCode = $response[0]['BillCodee'];

          return redirect('https://dev.toyyibpaycom/' . $billCode);
    }

    public function paymentStatus()
    {
        $response = request()->all(['status_id', 'billcode', 'order_id']);
        return $response;
    }

    public function callback()
    {
        $reponse = request()->all(['refno', 'status', 'reason', 'billcode', 'order_id', 'amount']);
        Log::info($response);
    }
}
