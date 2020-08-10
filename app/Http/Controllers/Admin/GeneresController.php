<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Genre;
use Illuminate\Support\Str;
use App\Image;

class GeneresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function all()
    {
        $genres = Genre::orderBy('id', 'desc')->paginate(20);
        return view('dashboard.genres.all', compact('genres'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:genres,name|min:3',
            'artist_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        
        $genre = Genre::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        if($request->hasFile('genre_img'))
        {
            $file = $request->file('genre_img');
            $name = $file->getClientOriginalName();

            $image = Image::create([
                'url' => $name
            ]);

            Image::where('id', $image->id)->update([
                'url' => $image->id.'.'.$name
            ]);

            $file->move('uploads/images', $image->id.'.'.$name);

            Genre::where('id', $genre->id)->update([
                'image_id' => $image->id
            ]);
        }


        if($genre)
        {
            return back()->with('success', 'Genre Added Successfully');
        }
        else {
            return back()->with('error', 'Genre Not Added');
        }
    }

    public function singleInfo(Request $request)
    {
        $genre = Genre::with('image')->findOrFail($request->id);
        return $genre;
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:genres,name,'.$request->id,
            'artist_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $action = Genre::where('id', $request->id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        if($request->hasFile('genre_img'))
        {
            $file = $request->file('genre_img');
            $name = $file->getClientOriginalName();

            $image = Image::create([
                'url' => $name
            ]);

            Image::where('id', $image->id)->update([
                'url' => $image->id.'.'.$name
            ]);

            $file->move('uploads/images', $image->id.'.'.$name);

            Genre::where('id', $request->id)->update([
                'image_id' => $image->id
            ]);
        }

        if($action)
        {
            return back()->with('success', 'Genre Updated Successfully');
        }
        else {
            return back()->with('error', 'Genre Updated Unsuccessfully');
        }
    }

    public function singleDelete($id, Request $request)
    {
        $action = Genre::where('id', $id)->delete();
        if($action)
        {
            return back()->with('success', 'Genre Deleted Successfully');
        }else{
            return back()->with('error', 'Genre Deleted Unsuccessfully');
        }
    }

    public function multiDelete(Request $request)
    {
        if($request->action == 'delete')
        {
            if($request->id)
            {
                $action = Genre::whereIn('id', $request->id)->delete();
                if($action)
                {
                    return back()->with('success', 'Selected Genres are Deleted Successfully');
                }else{
                    return back()->with('error', 'Selected Genres are Delete action Unsuccessfully');
                }
            }else {
                return back()->with('error', 'Genre Not Selected');
            }
        }else {
            return back();
        }
        
    }

    public function trash()
    {
        $genres = Genre::onlyTrashed()->paginate(20);
        return view('dashboard.genres.trash', compact('genres'));
    }

    public function singleRestore($id)
    {
        $action = Genre::onlyTrashed()->where('id', $id)->restore();
        if($action)
        {
            return back()->with('success', 'Genre Restored Successfully');
        }else{
            return back()->with('error', 'Genre Restore action Unsuccessfully');
        }
    }

    public function trashSingleDelete($id)
    {
        $action = Genre::onlyTrashed()->where('id', $id)->forceDelete();
        if($action)
        {
            return back()->with('success', 'Genre Deleted Successfully');
        }else{
            return back()->with('error', 'Genre Delete Unsuccessfully');
        }
    }

    public function trashEmpty()
    {
        $action = Genre::onlyTrashed()->forceDelete();
        if($action)
        {
            return back()->with('success', 'Genres are Deleted Successfully');
        }else{
            return back()->with('error', 'Genres are Delete action Unsuccessfully');
        }
    }

    public function restore()
    {
        $action = Genre::onlyTrashed()->restore();
        if($action)
        {
            return back()->with('success', 'Genres are Restored Successfully');
        }else{
            return back()->with('error', 'Genres are Restore action Unsuccessfully');
        }
    }

    public function trashAction(Request $request)
    {
        if($request->action == 'restore')
        {
            if($request->id)
            {
                $action = Genre::onlyTrashed()->whereIn('id', $request->id)->restore();
                if($action)
                {
                    return back()->with('success', 'Selected Genres are Restored Successfully');
                }else{
                    return back()->with('error', 'Selected Genres are Restore action Unsuccessfully');
                }
            }else{
                return back()->with('error', 'Genre Not Selected');
            }

        }else if($request->action == 'delete')
        {

            if($request->id)
            {
                $action = Genre::onlyTrashed()->whereIn('id', $request->id)->forceDelete();
                if($action)
                {
                    return back()->with('success', 'Selected Genres are Deleted Successfully');
                }else{
                    return back()->with('error', 'Selected Genres are Delete action Unsuccessfully');
                }
            }else{
                return back()->with('error', 'Genre Not Selected');
            }

        }else {
            return back()->with('error', 'Action Not Selected');
        }
    }
}
