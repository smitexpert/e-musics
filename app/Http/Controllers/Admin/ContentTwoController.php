<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ContentTwo;

class ContentTwoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $contents = ContentTwo::get();
        
        if(count($contents) > 0)
        {
            $content = ContentTwo::first();
            return view('dashboard.content.twoedit', compact('content'));
        }else{
            return view('dashboard.content.two');
        }

    }

    public function insert(Request $request)
    {
        $contents = ContentTwo::get();

        if(count($contents) > 0)
        {
            $content = ContentTwo::first();

            $action = ContentTwo::where('id', $content->id)->update([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'content' => $request->content,
                'button_text' => $request->button_text
            ]);

            if($action)
            {
                return back()->with('success', 'Content Added Successfully');
            }else{
                return back()->with('success', 'Content Added Unsuccessfully');
            }
        }else{
            $action = ContentTwo::create([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'content' => $request->content,
                'button_text' => $request->button_text
            ]);

            if($action)
            {
                return back()->with('success', 'Content Added Successfully');
            }else{
                return back()->with('success', 'Content Added Unsuccessfully');
            }
        }
    }
}
