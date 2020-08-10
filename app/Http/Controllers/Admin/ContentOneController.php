<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ContentOne;

class ContentOneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $contents = ContentOne::get();
        
        if(count($contents) > 0)
        {
            $content = ContentOne::first();
            return view('dashboard.content.oneedit', compact('content'));
        }else{
            return view('dashboard.content.one');
        }

    }

    public function insert(Request $request)
    {
        $contents = ContentOne::get();

        if(count($contents) > 0)
        {
            $content = ContentOne::first();

            $action = ContentOne::where('id', $content->id)->update([
                'title' => $request->title,
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
            $action = ContentOne::create([
                'title' => $request->title,
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
