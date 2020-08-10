<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->type == 'admin')
        {
            return redirect()->route('admin');
        }else{
            return redirect('/');
        }
    }
}
