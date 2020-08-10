<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('website.contact');
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Contact Has successfully submited');
    }
}
