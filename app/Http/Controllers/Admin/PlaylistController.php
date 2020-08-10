<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Playlist;
use Illuminate\Support\Str;

class PlaylistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function all()
    {
        $playlists = Playlist::orderBy('id', 'desc')->paginate(20);
        return view('dashboard.playlists.all', compact('playlists'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:playlists,name|min:3'
        ]);

        
        $playlist = Playlist::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);


        if($playlist)
        {
            return back()->with('success', 'Playlist Added Successfully');
        }
        else {
            return back()->with('error', 'Playlist Not Added');
        }
    }

    public function singleInfo(Request $request)
    {
        $playlist = Playlist::findOrFail($request->id);
        return $playlist;
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:artists,name,'.$request->id
        ]);

        $action = Playlist::where('id', $request->id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        if($action)
        {
            return back()->with('success', 'Playlist Updated Successfully');
        }
        else {
            return back()->with('error', 'Playlist Updated Unsuccessfully');
        }
    }

    public function singleDelete($id, Request $request)
    {
        $action = Playlist::where('id', $id)->delete();
        if($action)
        {
            return back()->with('success', 'Playlist Deleted Successfully');
        }else{
            return back()->with('error', 'Playlist Deleted Unsuccessfully');
        }
    }

    public function multiDelete(Request $request)
    {
        if($request->action == 'delete')
        {
            if($request->id)
            {
                $action = Playlist::whereIn('id', $request->id)->delete();
                if($action)
                {
                    return back()->with('success', 'Selected Playlists are Deleted Successfully');
                }else{
                    return back()->with('error', 'Selected Playlists are Delete action Unsuccessfully');
                }
            }else {
                return back()->with('error', 'Playlist Not Selected');
            }
        }else {
            return back();
        }
        
    }

    public function trash()
    {
        $playlists = Playlist::onlyTrashed()->paginate(20);
        return view('dashboard.playlists.trash', compact('playlists'));
    }

    public function singleRestore($id)
    {
        $action = Playlist::onlyTrashed()->where('id', $id)->restore();
        if($action)
        {
            return back()->with('success', 'Playlist Restored Successfully');
        }else{
            return back()->with('error', 'Playlist Restore action Unsuccessfully');
        }
    }

    public function trashSingleDelete($id)
    {
        $action = Playlist::onlyTrashed()->where('id', $id)->forceDelete();
        if($action)
        {
            return back()->with('success', 'Playlist Deleted Successfully');
        }else{
            return back()->with('error', 'Playlist Delete Unsuccessfully');
        }
    }

    public function trashEmpty()
    {
        $action = Playlist::onlyTrashed()->forceDelete();
        if($action)
        {
            return back()->with('success', 'Playlists are Deleted Successfully');
        }else{
            return back()->with('error', 'Playlists are Delete action Unsuccessfully');
        }
    }

    public function restore()
    {
        $action = Playlist::onlyTrashed()->restore();
        if($action)
        {
            return back()->with('success', 'Playlists are Restored Successfully');
        }else{
            return back()->with('error', 'Playlists are Restore action Unsuccessfully');
        }
    }

    public function trashAction(Request $request)
    {
        if($request->action == 'restore')
        {
            if($request->id)
            {
                $action = Playlist::onlyTrashed()->whereIn('id', $request->id)->restore();
                if($action)
                {
                    return back()->with('success', 'Selected Playlists are Restored Successfully');
                }else{
                    return back()->with('error', 'Selected Playlists are Restore action Unsuccessfully');
                }
            }else{
                return back()->with('error', 'Playlist Not Selected');
            }

        }else if($request->action == 'delete')
        {

            if($request->id)
            {
                $action = Playlist::onlyTrashed()->whereIn('id', $request->id)->forceDelete();
                if($action)
                {
                    return back()->with('success', 'Selected Playlists are Deleted Successfully');
                }else{
                    return back()->with('error', 'Selected Playlists are Delete action Unsuccessfully');
                }
            }else{
                return back()->with('error', 'Playlist Not Selected');
            }

        }else {
            return back()->with('error', 'Action Not Selected');
        }
    }

}
