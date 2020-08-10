<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\SiteSetting;
use App\Payment;
use App\User;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function payment()
    {
       
        if(SiteSetting::where('name', 'client_id')->first())
        {
            $client_id =  SiteSetting::where('name', 'client_id')->first()->value;
            $amount =  SiteSetting::where('name', 'amount')->first()->value;

            $user_id = Auth::user()->id;
            if(Payment::where('user_id', $user_id)->first())
            {
                return view('payment.paid', compact('amount'));
            }
            
            return view('payment.index', compact('client_id', 'amount'));
        }

        return "The Payment Method is not configured";
    }

    public function paymentExe(Request $request)
    {
        $user_id = Auth::user()->id;

        $payment = Payment::create([
            'user_id' => $user_id,
            'method' => 'paypal',
            'amount' => $request->amount,
            'transection_id' => $request->transection_id,
            'status' => $request->status
        ]);

        User::where('id', $user_id)->update([
            'status' => 'active'
        ]);

        if($payment)
        {
            return 'success';
        }
        else {
            return 'failed';
        }
    }
}
