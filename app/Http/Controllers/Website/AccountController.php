<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('payment');
    }

    public function index()
    {
        return view('website.account.index');
    }

    public function info(Request $request)
    {
        User::where('id', Auth::user()->id)->update([
            'name' => $request->name
        ]);
        
        return back()->with('success', 'Information Updated');
    }

    public function update(Request $request)
    {

        if($request->password != $request->confirm_password)
        {
            return back()->with('error', 'Confirm Password Not Mathced');
        }

        if(Hash::check($request->current_password, Auth::user()->password))
        {
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->password)
            ]);
            return back()->with('success', 'Information Updated');
        }else{
            return back()->with('error', 'Current Password is Not Valid');
        }
    }
}
