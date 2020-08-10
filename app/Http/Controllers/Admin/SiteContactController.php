<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReply;

class SiteContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $contacts = Contact::orderBy('id', 'desc')->paginate(20);
        return view('dashboard.contact.index', compact('contacts'));
    }

    public function delete($id)
    {
        $action = Contact::where('id', $id)->delete();

        if($action)
        {
            return back()->with('success', 'Contact Has Successfully Deleted');
        }else{
            return back()->with('error', 'Contact Not Successfully Deleted');
        }
    }

    public function view($id)
    {
        $contact = Contact::where('id', $id)->firstOrFail();
        
        Contact::where('id', $id)->update([
            'status' => 1
        ]);

        return view('dashboard.contact.view', compact('contact'));
    }

    public function reply(Request $request, $id)
    {



        $contact = Contact::where('id', $id)->firstOrFail();

        $data = [
            'message' => $request->reply,
            'subject' => $contact->subject
        ];

        Mail::to($contact->email)->send(new ContactReply($data));

        return back()->with('success', 'Reply Has sent to contact email');
        


    }

    public function multi(Request $request)
    {
        if($request->has('id'))
        {
            if($request->action == 'read')
            {
                $action = Contact::whereIn('id', $request->id)->update([
                    'status' => 1
                ]);
                if($action)
                {
                    return back()->with('success', 'Action Successfully Completed');
                }
            }else if($request->action == 'delete')
            {
                $action = Contact::whereIn('id', $request->id)->delete();
                if($action)
                {
                    return back()->with('success', 'Action Successfully Completed');
                }
            }else{
                return back();
            }
        }

        return back();
    }


}
