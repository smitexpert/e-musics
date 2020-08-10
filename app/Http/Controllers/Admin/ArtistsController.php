<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Artist;
use Illuminate\Support\Str;
use App\Image;

class ArtistsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function all()
    {
        $artists = Artist::orderBy('id', 'desc')->paginate(20);
        return view('dashboard.artists.all', compact('artists'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:artists,name|min:3',
            'artist_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        
        $artist = Artist::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);


        if($request->hasFile('artist_img'))
        {
            $file = $request->file('artist_img');
            $name = $file->getClientOriginalName();

            $image = Image::create([
                'url' => $name
            ]);

            Image::where('id', $image->id)->update([
                'url' => $image->id.'.'.$name
            ]);

            $file->move('uploads/images', $image->id.'.'.$name);

            Artist::where('id', $artist->id)->update([
                'image_id' => $image->id
            ]);
        }


        if($artist)
        {
            return back()->with('success', 'Artist Added Successfully');
        }
        else {
            return back()->with('error', 'Artist Not Added');
        }
    }

    public function singleInfo(Request $request)
    {
        $artist = Artist::with('image')->findOrFail($request->id);
        return $artist;
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:artists,name,'.$request->id
        ]);

        $action = Artist::where('id', $request->id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        if($request->hasFile('artist_img'))
        {
            $file = $request->file('artist_img');
            $name = $file->getClientOriginalName();

            $image = Image::create([
                'url' => $name
            ]);

            Image::where('id', $image->id)->update([
                'url' => $image->id.'.'.$name
            ]);

            $file->move('uploads/images', $image->id.'.'.$name);

            Artist::where('id', $request->id)->update([
                'image_id' => $image->id
            ]);
        }

        if($action)
        {
            return back()->with('success', 'Artist Updated Successfully');
        }
        else {
            return back()->with('error', 'Artist Updated Unsuccessfully');
        }
    }

    public function singleDelete($id, Request $request)
    {
        $action = Artist::where('id', $id)->delete();
        if($action)
        {
            return back()->with('success', 'Artist Deleted Successfully');
        }else{
            return back()->with('error', 'Artist Deleted Unsuccessfully');
        }
    }

    public function multiDelete(Request $request)
    {
        if($request->action == 'delete')
        {
            if($request->id)
            {
                $action = Artist::whereIn('id', $request->id)->delete();
                if($action)
                {
                    return back()->with('success', 'Selected Artists are Deleted Successfully');
                }else{
                    return back()->with('error', 'Selected Artists are Delete action Unsuccessfully');
                }
            }else {
                return back()->with('error', 'Artist Not Selected');
            }
        }else {
            return back();
        }
        
    }

    public function trash()
    {
        $artists = Artist::onlyTrashed()->paginate(20);
        return view('dashboard.artists.trash', compact('artists'));
    }

    public function singleRestore($id)
    {
        $action = Artist::onlyTrashed()->where('id', $id)->restore();
        if($action)
        {
            return back()->with('success', 'Artist Restored Successfully');
        }else{
            return back()->with('error', 'Artist Restore action Unsuccessfully');
        }
    }

    public function trashSingleDelete($id)
    {
        $action = Artist::onlyTrashed()->where('id', $id)->forceDelete();
        if($action)
        {
            return back()->with('success', 'Artist Deleted Successfully');
        }else{
            return back()->with('error', 'Artist Delete Unsuccessfully');
        }
    }

    public function trashEmpty()
    {
        $action = Artist::onlyTrashed()->forceDelete();
        if($action)
        {
            return back()->with('success', 'Artists are Deleted Successfully');
        }else{
            return back()->with('error', 'Artists are Delete action Unsuccessfully');
        }
    }

    public function restore()
    {
        $action = Artist::onlyTrashed()->restore();
        if($action)
        {
            return back()->with('success', 'Artists are Restored Successfully');
        }else{
            return back()->with('error', 'Artists are Restore action Unsuccessfully');
        }
    }

    public function trashAction(Request $request)
    {
        if($request->action == 'restore')
        {
            if($request->id)
            {
                $action = Artist::onlyTrashed()->whereIn('id', $request->id)->restore();
                if($action)
                {
                    return back()->with('success', 'Selected Artists are Restored Successfully');
                }else{
                    return back()->with('error', 'Selected Artists are Restore action Unsuccessfully');
                }
            }else{
                return back()->with('error', 'Artist Not Selected');
            }

        }else if($request->action == 'delete')
        {

            if($request->id)
            {
                $action = Artist::onlyTrashed()->whereIn('id', $request->id)->forceDelete();
                if($action)
                {
                    return back()->with('success', 'Selected Artists are Deleted Successfully');
                }else{
                    return back()->with('error', 'Selected Artists are Delete action Unsuccessfully');
                }
            }else{
                return back()->with('error', 'Artist Not Selected');
            }

        }else {
            return back()->with('error', 'Action Not Selected');
        }
    }
}
