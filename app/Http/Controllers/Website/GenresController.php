<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Genre;
use App\Music;

class GenresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('payment');
    }

    public function index()
    {
        $genres = Genre::with('image')->orderBy('id', 'desc')->paginate(16);
        return view('website.genre.index', compact('genres'));
    }

    public function genre($slug)
    {
        $genre = Genre::with('musics')->where('slug', $slug)->firstOrFail();
        
        if($genre->musics->first() != null)
        {
            return redirect()->route('genre.single', ['slug' => $slug, 'music' => $genre->musics->first()->slug]);
        }
        return redirect()->route('genre.single', ['slug' => $slug, 'music' => 'music']);
    }

    public function single($slug, $music)
    {
        $genre = Genre::with('musics', 'image')->where('slug', $slug)->firstOrFail();
        if($music == 'music')
        {
            $music = 'null';
            return view('website.genre.default', compact('genre'));
        }else{
            $music = Music::where('slug', $music)->firstOrFail();
            return view('website.genre.single', compact('genre', 'music'));
        }

        
    }
}
