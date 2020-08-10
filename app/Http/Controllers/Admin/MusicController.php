<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LaravelMP3;
use App\Music;
use Illuminate\Support\Str;
use App\MusicMeta;
use Illuminate\Http\File;

class MusicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function all()
    {
        $musics = Music::orderBy('id', 'desc')->with('album', 'artist', 'genre', 'playlist')->paginate(20);
        // return dd($musics);
        return view('dashboard.musics.all', compact('musics'));
    }

    public function add()
    {
        return view('dashboard.musics.add');
    }

    public function upload(Request $request)
    {
        $file = $request->file('music');
        $temp_path = 'temp_uploads/mp3';
        $file->move($temp_path, $file->getClientOriginalName());
        $music = $file->getClientOriginalName();
        $music_path = $temp_path.'/'.$music;
        if(LaravelMP3::getImage($music_path))
        {
            file_put_contents($temp_path . "/".$music.".jpg", LaravelMP3::getImage($music_path));
        }
        return view('dashboard.musics.new', compact('music', 'music_path'));        
    }

    public function process(Request $request)
    {
        // return $request->all();
        $duration = LaravelMP3::getDurations($request->music_path);

        $file = $request->music_path;
        $file_info = pathinfo($file);
        $file_ext = $file_info['extension'];
        $file_name = $request->music;


        $music = Music::create([
            'name' => $file_name,
            'slug' => Str::slug($file_name),
            'duration' => $duration
        ]);

        $metas = array(
            [
                'music_id' => $music->id,
                'meta_name' => 'album',
                'meta_id' => $request->album
            ],
            [
                'music_id' => $music->id,
                'meta_name' => 'artist',
                'meta_id' => $request->artist
            ],
            [
                'music_id' => $music->id,
                'meta_name' => 'genre',
                'meta_id' => $request->genre
            ]
        );

        MusicMeta::insert($metas);

        if($request->playlist != null)
        {
            MusicMeta::create([
                'music_id' => $music->id,
                'meta_name' => 'playlist',
                'meta_id' => $request->playlist
            ]);
        }
        
        $img_path = "uploads/cover/";
        $file_path = "uploads/mp3/";

        

        \File::move($file, $file_path.$music->id.".".$music->slug.".".$file_ext);

        

        if($request->is_img == 1)
        {
            $cover = $request->cover;
            $img_ext = pathinfo($cover);
            $img_ext = $img_ext['extension'];

            \File::move($cover, $img_path.$music->slug.$music->id.".".$img_ext);
            
            Music::where('id', $music->id)->update([
                'url' => $music->id.".".$music->slug.".".$file_ext,
                'slug' => $music->slug.$music->id,
                'cover' => $music->slug.$music->id.".".$img_ext
            ]);
        }else{
            Music::where('id', $music->id)->update([
                'url' => $music->id.".".$music->slug.".".$file_ext,
                'slug' => $music->slug.$music->id
            ]);
        }

        return redirect()->route('musics.add')->with('success', 'Music Added Successfully');
    }

    public function edit($id)
    {
        $music = Music::where('id', $id)->with('album', 'artist', 'genre', 'playlist')->firstOrFail();
        return view('dashboard.musics.edit', compact('music'));
    }

    public function update(Request $request, $id)
    {
        $music = Music::where('id', $id)->first();

        $slug = Str::slug($request->music);
        $file_path = 'uploads/mp3';
        $file_ext = pathinfo($file_path.'/'.$music->url);
        $file_ext = $file_ext['extension'];


        $file_name = $id.'.'.$slug.'.'.$file_ext;
    
        
        Music::where('id', $id)->update([
            'name' => $request->music,
            'url' => $file_name,
            'slug' => $slug.$id
        ]);
            
        \File::move($file_path.'/'.$music->url, $file_path.'/'.$file_name);

        MusicMeta::where('music_id', $id)->delete();

        $metas = array(
            [
                'music_id' => $id,
                'meta_name' => 'album',
                'meta_id' => $request->album
            ],
            [
                'music_id' => $id,
                'meta_name' => 'artist',
                'meta_id' => $request->artist
            ],
            [
                'music_id' => $id,
                'meta_name' => 'genre',
                'meta_id' => $request->genre
            ]
        );

        MusicMeta::insert($metas);

        if($request->playlist != null)
        {
            MusicMeta::create([
                'music_id' => $id,
                'meta_name' => 'playlist',
                'meta_id' => $request->playlist
            ]);
        }

        if($request->is_img == 1)
        {
            $cover = $request->cover;
            $img_path = 'uploads/cover/';
            $up_img = pathinfo($cover);
            $up_dirname = $up_img['dirname'];
            $up_name = $up_img['basename'];
            $up_ext = $up_img['extension'];
            
            \File::move($request->cover, $img_path.'/'.$slug.$id.'.'.$up_ext);
            
            Music::where('id', $id)->update([
                'cover' => $slug.$id.'.'.$up_ext
            ]);
        }else {
            if($music->cover != null)
            {
                $img_path = 'uploads/cover/';
                $old_file = pathinfo($img_path.$music->cover);
                $old_ext = $old_file['extension'];

                // return $old_file;

                \File::move($img_path.$music->cover, $img_path.'/'.$slug.$id.'.'.$old_ext);

                Music::where('id', $id)->update([
                    'cover' => $slug.$id.'.'.$old_ext
                ]);
            }
        }

        


        return back()->with('success', 'Music Updated Successfully');
    }

    public function delete($id)
    {
        $action = Music::where('id', $id)->delete();
        if($action)
        {
            return back()->with('success', 'Music is Deleted Successfully');
        }else{
            return back()->with('error', 'Music is Delete action Unsuccessfully');
        }
    }

    public function deleteMulti(Request $request)
    {
        if($request->action == 'delete')
        {
            if($request->id)
            {
                $action = Music::whereIn('id', $request->id)->delete();
                if($action)
                {
                    return back()->with('success', 'Selected Musics are Deleted Successfully');
                }else{
                    return back()->with('error', 'Selected Musics are Delete action Unsuccessfully');
                }
            }else {
                return back()->with('error', 'Music Not Selected');
            }
        }else {
            return back();
        }
    }

    public function trash()
    {
        $musics = Music::onlyTrashed()->paginate(20);
        return view('dashboard.musics.trash', compact('musics'));
    }

    public function restore($id)
    {
        $action = Music::onlyTrashed()->where('id', $id)->restore();
        if($action)
        {
            return back()->with('success', 'Music Restored Successfully');
        }else{
            return back()->with('error', 'Music Restore action Unsuccessfully');
        }
    }

    public function trashDelete($id)
    {
        $music = Music::onlyTrashed()->where('id', $id)->firstOrFail();
        $music_path = 'uploads/mp3/';
        $img_path = "uploads/cover/";

        if(\File::exists(public_path($music_path.$music->url)))
        {
            \File::delete(public_path($music_path.$music->url));
        }

        if(\File::exists(public_path($img_path.$music->cover)))
        {
            \File::delete(public_path($img_path.$music->cover));
        }
        
        
        $action = Music::onlyTrashed()->where('id', $id)->forceDelete();
        if($action)
        {
            MusicMeta::where('music_id', $id)->delete();

            

            return back()->with('success', 'Music Deleted Successfully');
        }else{
            return back()->with('error', 'Music Deleted action Unsuccessfully');
        }
    }

    public function restoreAll()
    {
        $action = Music::onlyTrashed()->restore();

        if($action)
        {
            return back()->with('success', 'Musics are Restored Successfully');
        }else{
            return back()->with('error', 'Musics are Restored Unsuccessfully');
        }
    }

    public function empty()
    {
        $musics = Music::onlyTrashed()->get();
        $music_path = 'uploads/mp3/';
        $img_path = "uploads/cover/";

        $music_ids = array();

        foreach($musics as $music)
        {
            if(\File::exists(public_path($music_path.$music->url)))
            {
                \File::delete(public_path($music_path.$music->url));
            }

            if(\File::exists(public_path($img_path.$music->cover)))
            {
                \File::delete(public_path($img_path.$music->cover));
            }

            array_push($music_ids, $music->id);
        }

        $action = Music::onlyTrashed()->forceDelete();
        if($action)
        {
            MusicMeta::whereIn('music_id', $music_ids)->delete();
            return back()->with('success', 'Musics are Deleted Successfully');
        }else{
            return back()->with('error', 'Musics are Deleted Unsuccessfully');
        }
    }

    public function action(Request $request)
    {
        if($request->action == 'restore')
        {
            $action = Music::onlyTrashed()->whereIn('id', $request->id)->restore();

            if($action)
            {
                return back()->with('success', 'Selected Musics are Restored Successfully');
            }else{
                return back()->with('error', 'Selected Musics are Restored Unsuccessfully');
            }
        }else if($request->action == 'delete')
        {
            $musics = Music::onlyTrashed()->whereIn('id', $request->id)->get();
            $music_path = 'uploads/mp3/';
            $img_path = "uploads/cover/";

            foreach($musics as $music)
            {
                if(\File::exists(public_path($music_path.$music->url)))
                {
                    \File::delete(public_path($music_path.$music->url));
                }

                if(\File::exists(public_path($img_path.$music->cover)))
                {
                    \File::delete(public_path($img_path.$music->cover));
                }
            }

            $action = Music::onlyTrashed()->whereIn('id', $request->id)->forceDelete();
            if($action)
            {
                MusicMeta::whereIn('music_id', $request->id)->delete();
                return back()->with('success', 'Selected Musics are Deleted Successfully');
            }else{
                return back()->with('error', 'Selected Musics are Deleted Unsuccessfully');
            }

        }else{
            return back();
        }
        
    }
}
