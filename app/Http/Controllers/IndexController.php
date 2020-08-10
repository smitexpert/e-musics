<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Payment;

class IndexController extends Controller
{
    public function index()
    {
        if(Auth::user())
        {
            if(Auth::user()->type == 'user')
            {
                if(Payment::where('user_id', Auth::user()->id)->first())
                {
                    return view('website.songs');
                }else{
                    return redirect()->route('user.payment');
                }
            }

            return view('website.songs');
        }
        else{
            return view('website.index');
        }
    }
}
