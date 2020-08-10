<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Album;
use App\Music;
use App\Comment;

class AlbumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('payment');
    }

    public function index()
    {
        $albums = Album::with('image')->orderBy('id', 'desc')->paginate(16);
        return view('website.album.index', compact('albums'));
    }

    public function album($slug)
    {
        $album = Album::with('musics')->where('slug', $slug)->firstOrFail();
        
        if($album->musics->first() != null)
        {
            return redirect()->route('album.single', ['slug' => $slug, 'music' => $album->musics->first()->slug]);
        }
        return redirect()->route('album.single', ['slug' => $slug, 'music' => 'music']);
    }

    public function single($slug, $music)
    {
        $album = Album::with('musics', 'image')->where('slug', $slug)->firstOrFail();
        if($music == 'music')
        {
            $music = 'null';
            return view('website.album.default', compact('album'));
        }else{
            $music = Music::where('slug', $music)->firstOrFail();
            return view('website.album.single', compact('album', 'music'));
        }

        
    }
}
