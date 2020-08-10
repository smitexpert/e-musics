<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SiteSetting;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        return view('dashboard.settings.index');
    }

    public function update(Request $request)
    {
        if($request->hasFile('logo'))
        {
            if(SiteSetting::where('name', 'logo')->first())
            {
                SiteSetting::where('name', 'logo')->first()->delete();
            }

            $path = 'uploads/logo/';
            $file = $request->file('logo');
            $file->move($path, 'logo.'.$file->getClientOriginalExtension());

            SiteSetting::create([
                'name' => 'logo',
                'value' => 'logo.'.$file->getClientOriginalExtension()
            ]);
        }

        if($request->title != null)
        {
            if(SiteSetting::where('name', 'title')->first())
            {
                SiteSetting::where('name', 'title')->first()->delete();
            }

            SiteSetting::create([
                'name' => 'title',
                'value' => $request->title
            ]);
        }

        if($request->copyright != null)
        {
            if(SiteSetting::where('name', 'copyright')->first())
            {
                SiteSetting::where('name', 'copyright')->first()->delete();
            }

            SiteSetting::create([
                'name' => 'copyright',
                'value' => $request->copyright
            ]);
        }

        return back()->with('success', 'Updated Successfully');
    }

    public function payment()
    {
        return view('dashboard.settings.payment');
    }

    public function paymentAction(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'amount' => 'required'
        ]);

        if(SiteSetting::where('name', 'client_id')->first())
        {
            SiteSetting::where('name', 'client_id')->first()->delete();
            SiteSetting::where('name', 'amount')->first()->delete();
        }
        
        SiteSetting::create([
            'name' => 'client_id',
            'value' => $request->client_id
        ]);
        
        SiteSetting::create([
            'name' => 'amount',
            'value' => $request->amount
        ]);

        if($request->has('sandbox'))
        {
            SiteSetting::create([
                'name' => 'sandbox',
                'value' => 'true'
            ]);
        }else{
            SiteSetting::where('name', 'sandbox')->delete();
        }

        return back()->with('success', 'Payment settings updated successfully');
    }

    public function contact(Request $request)
    {
        if($request->contacttext != null)
        {
            if(SiteSetting::where('name', 'contacttext')->first())
            {
                SiteSetting::where('name', 'contacttext')->first()->delete();
            }

            SiteSetting::create([
                'name' => 'contacttext',
                'value' => $request->contacttext
            ]);
        }
        
        if($request->address != null)
        {
            if(SiteSetting::where('name', 'address')->first())
            {
                SiteSetting::where('name', 'address')->first()->delete();
            }

            SiteSetting::create([
                'name' => 'address',
                'value' => $request->address
            ]);
        }

        if($request->contact != null)
        {
            if(SiteSetting::where('name', 'contact')->first())
            {
                SiteSetting::where('name', 'contact')->first()->delete();
            }

            SiteSetting::create([
                'name' => 'contact',
                'value' => $request->contact
            ]);
        }

        
        if($request->email != null)
        {
            if(SiteSetting::where('name', 'email')->first())
            {
                SiteSetting::where('name', 'email')->first()->delete();
            }

            SiteSetting::create([
                'name' => 'email',
                'value' => $request->email
            ]);
        }

        
        return back()->with('success', 'Payment settings updated successfully');
    }
}
