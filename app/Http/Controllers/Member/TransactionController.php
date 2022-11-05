<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $package = Package::find($request->package_id);

        $auth = auth()->user();

        $transaction = Transaction::create([
            'package_id' => $package->id,
            'user_id' => $auth->id,
            'amount' => $package->price,
            'transaction_code' => strtoupper(Str::random(10)),
            'status' => 'pending'
        ]);
        
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = (bool) env('MIDTRANS_IS_PRODUCTION');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = (bool) env('MIDTRANS_IS_SANITIZED');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = (bool) env('MIDTRANS_3DS');

        
        $params = array(
            'transaction_details' => array(
                // 'order_id' => rand(),
                'order_id' => $transaction->transaction_code,
                'gross_amount' => $transaction->amount,
            ),
            'customer_details' => array(
                'first_name' => $auth->name,
                'last_name' => $auth->name,
                'email' => $auth->email,
                'phone' => $auth->phone_number,
            ),
        );
        
        $createdMistransTransaction = \Midtrans\Snap::createTransaction($params);
        $midtransUrl = $createdMistransTransaction->redirect_url;
        // $snapToken = \Midtrans\Snap::getSnapToken($params);

        return redirect($midtransUrl);
    }
}
