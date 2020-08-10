<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Album;
use Illuminate\Support\Str;
use App\Image;

class AlbumsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function all()
    {
        $albums = Album::orderBy('id', 'desc')->paginate(20);
        return view('dashboard.albums.all', compact('albums'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'album' => 'required|unique:albums,name|min:3',
            'album_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        
        $album = Album::create([
            'name' => $request->album,
            'slug' => Str::slug($request->album)
        ]);

        if($request->hasFile('album_img'))
        {
            $file = $request->file('album_img');
            $name = $file->getClientOriginalName();

            $image = Image::create([
                'url' => $name
            ]);

            Image::where('id', $image->id)->update([
                'url' => $image->id.'.'.$name
            ]);

            $file->move('uploads/images', $image->id.'.'.$name);

            Album::where('id', $album->id)->update([
                'image_id' => $image->id
            ]);
        }


        if($album)
        {
            return back()->with('success', 'Album Added Successfully');
        }
        else {
            return back()->with('errors', 'Album Not Added');
        }
    }

    public function getAlbumInfo(Request $request)
    {
        $album = Album::with('image')->findOrFail($request->id);
        return $album;
    }

    public function update(Request $request)
    {
        $request->validate([
            'album' => 'required|unique:albums,name,'.$request->id,
            'album_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $action = Album::where('id', $request->id)->update([
            'name' => $request->album,
            'slug' => Str::slug($request->album)
        ]);

        if($request->hasFile('album_img'))
        {
            $file = $request->file('album_img');
            $name = $file->getClientOriginalName();

            $image = Image::create([
                'url' => $name
            ]);

            Image::where('id', $image->id)->update([
                'url' => $image->id.'.'.$name
            ]);

            $file->move('uploads/images', $image->id.'.'.$name);

            Album::where('id', $request->id)->update([
                'image_id' => $image->id
            ]);
        }

        if($action)
        {
            return back()->with('update', 'Album Successfully Updated!');
        }
        else {
            return back()->with('error', 'Album not updated');
        }
    }

    public function delete($id, Request $request)
    {
        $action = Album::where('id', $id)->delete();
        if($action)
        {
            return back()->with('success', 'Album Deleted Successfully');
        }else{
            return back()->with('error', 'Album Deleted Unsuccessfully');
        }
    }

    public function deleteMulti(Request $request)
    {
        if($request->action == 'delete')
        {
            if($request->album_id)
            {
                $action = Album::whereIn('id', $request->album_id)->delete();
                if($action)
                {
                    return back()->with('success', 'Selected Albums are Deleted Successfully');
                }else{
                    return back()->with('error', 'Selected Albums are Delete action Unsuccessfully');
                }
            }else {
                return back()->with('error', 'Album Not Selected');
            }
        }else {
            return back();
        }
        
    }

    public function trash()
    {
        $albums = Album::onlyTrashed()->paginate(20);
        return view('dashboard.albums.trash', compact('albums'));
    }

    public function trashAction(Request $request)
    {
        if($request->action == 'restore')
        {
            if($request->album_id)
            {
                $action = Album::onlyTrashed()->whereIn('id', $request->album_id)->restore();
                if($action)
                {
                    return back()->with('success', 'Selected Albums are Restored Successfully');
                }else{
                    return back()->with('error', 'Selected Albums are Restore action Unsuccessfully');
                }
            }else{
                return back()->with('error', 'Album Not Selected');
            }

        }else if($request->action == 'delete')
        {

            if($request->album_id)
            {
                $action = Album::onlyTrashed()->whereIn('id', $request->album_id)->forceDelete();
                if($action)
                {
                    return back()->with('success', 'Selected Albums are Deleted Successfully');
                }else{
                    return back()->with('error', 'Selected Albums are Delete action Unsuccessfully');
                }
            }else{
                return back()->with('error', 'Album Not Selected');
            }

        }else {
            return back()->with('error', 'Action Not Selected');
        }
    }

    public function trashEmpty()
    {
        $action = Album::onlyTrashed()->forceDelete();
        if($action)
        {
            return back()->with('success', 'Albums are Deleted Successfully');
        }else{
            return back()->with('error', 'Albums are Delete action Unsuccessfully');
        }
    }

    public function restore()
    {
        $action = Album::onlyTrashed()->restore();
        if($action)
        {
            return back()->with('success', 'Albums are Restored Successfully');
        }else{
            return back()->with('error', 'Albums are Restore action Unsuccessfully');
        }
    }

    public function restoreId($id)
    {
        $action = Album::onlyTrashed()->where('id', $id)->restore();
        if($action)
        {
            return back()->with('success', 'Albums are Restored Successfully');
        }else{
            return back()->with('error', 'Albums are Restore action Unsuccessfully');
        }
    }

    public function trashDelete($id)
    {
        $action = Album::onlyTrashed()->where('id', $id)->forceDelete();
        if($action)
        {
            return back()->with('success', 'Albums are Deleted Successfully');
        }else{
            return back()->with('error', 'Albums are Delete Unsuccessfully');
        }
    }
}
