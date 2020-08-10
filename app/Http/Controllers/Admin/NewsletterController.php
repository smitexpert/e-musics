<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\NewsletterWeekly;
use App\Music;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\SentHistory;

class NewsletterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        return view('dashboard.newsletter.index');
    }
    
    public function view()
    {
        // return Music::where('created_at', '>', \Carbon\Carbon::today()->subDays(7))->get();
        return new NewsletterWeekly();
    }

    public function send()
    {
        $users = User::select('email')->where('type', 'user')->get();
        $moreUser = array();

        foreach($users as $user)
        {
            Mail::to($user->email)->send(new NewsletterWeekly());
        }

        $total = User::select('email')->where('type', 'user')->count();

        SentHistory::create([
            'total' => $total
        ]);

        return back()->with('success', 'Newsletter Successfully Sent');
    }

    public function history()
    {
        $history = SentHistory::orderBy('id', 'desc')->paginate(20);
        return view('dashboard.newsletter.history', compact('history'));
    }
}
