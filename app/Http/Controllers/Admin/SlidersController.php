<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slider;

class SlidersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $sliders = Slider::orderBy('id', 'desc')->paginate(20);
        return view('dashboard.sliders.index', compact('sliders'));
    }

    public function add()
    {
        return view('dashboard.sliders.add');
    }

    public function insert(Request $request)
    {
        $action = Slider::create([
            'name' => $request->name,
            'title' => $request->title,
            'content' => $request->content,
            'button_text' => $request->button_text
        ]);

        if($action)
        {
            if($request->hasFile('image'))
            {
                $image = $request->file('image');
                $img_path = 'uploads/sliders/';
                $image_name = $action->id.'.'.$image->getClientOriginalExtension();
                $image->move($img_path, $image_name);

                Slider::where('id', $action->id)->update([
                    'image' => $image_name
                ]);

                return redirect()->route('sliders.edit', ['id' => $action->id])->with('success', 'Slider Added Successfully');
            }
        }

        return back()->with('error', 'Slider Added Unsuccessfully');
    }

    public function edit($id)
    {
        $slider = Slider::where('id', $id)->firstOrFail();
        return view('dashboard.sliders.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $action = Slider::where('id', $id)->update([
            'name' => $request->name,
            'title' => $request->title,
            'content' => $request->content,
            'button_text' => $request->button_text
        ]);

        if($action)
        {
            if($request->hasFile('image'))
            {
                $image = $request->file('image');
                $img_path = 'uploads/sliders/';
                $image_name = $id.'.'.$image->getClientOriginalExtension();
                $image->move($img_path, $image_name);

                Slider::where('id', $id)->update([
                    'image' => $image_name
                ]);

                return back()->with('success', 'Slider Updated Successfully');
            }

            return back()->with('success', 'Slider Updated Successfully');
        }
        
        return back()->with('error', 'Slider Updated Unsuccessfully');
    }

    public function delete($id)
    {
        $slider = Slider::where('id', $id)->firstOrFail();

        $action = Slider::where('id', $id)->delete();
        $img_path = 'uploads/sliders/';
        $img = $img_path.$slider->image;
        if($action)
        {
            \File::delete(public_path($img));
            return back()->with('success', 'Slider Deleted Successfully');
        }else{
            return back()->with('error', 'Slider Deleted Unsuccessfully');
        }
    }
}
