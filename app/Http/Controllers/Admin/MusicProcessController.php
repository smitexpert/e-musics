<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Album;
use Illuminate\Support\Str;
use App\Artist;
use App\Genre;
use App\Playlist;

class MusicProcessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function addAlbum(Request $request)
    {
        $name = $request->name;
        if(Album::where('name', $name)->count() > 0)
        {
            $response = [
                'data' => Album::where('name', $name)->first(),
                'status' => 206
            ];
            return response()->json($response, 206);
        }
        $action = Album::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        $response = [
            'data' => $action,
            'status' => 201
        ];

        return response()->json($response, 201);
    }

    public function addArtist(Request $request)
    {
        $name = $request->name;
        if(Artist::where('name', $name)->count() > 0)
        {
            $response = [
                'data' => Artist::where('name', $name)->first(),
                'status' => 206
            ];
            return response()->json($response, 206);
        }
        $action = Artist::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        $response = [
            'data' => $action,
            'status' => 201
        ];

        return response()->json($response, 201);
    }

    public function addPlaylist(Request $request)
    {
        $name = $request->name;
        if(Playlist::where('name', $name)->count() > 0)
        {
            $response = [
                'data' => Playlist::where('name', $name)->first(),
                'status' => 206
            ];
            return response()->json($response, 206);
        }
        $action = Playlist::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        $response = [
            'data' => $action,
            'status' => 201
        ];

        return response()->json($response, 201);
    }

    public function addGenre(Request $request)
    {
        $name = $request->name;
        if(Genre::where('name', $name)->count() > 0)
        {
            $response = [
                'data' => Genre::where('name', $name)->first(),
                'status' => 206
            ];
            return response()->json($response, 206);
        }
        $action = Genre::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        $response = [
            'data' => $action,
            'status' => 201
        ];

        return response()->json($response, 201);
    }

    public function addImage(Request $request)
    {
        $file = $request->file('image');
        $temp_path = 'temp_uploads/mp3';
        $file->move($temp_path, $request->music.'.'.$file->getClientOriginalExtension());
        return $temp_path.'/'.$request->music.'.'.$file->getClientOriginalExtension();
    }
}
