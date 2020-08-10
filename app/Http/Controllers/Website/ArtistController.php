<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Artist;
use App\Music;

class ArtistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('payment');
    }

    public function index()
    {
        $artists = Artist::with('image')->orderBy('id', 'desc')->paginate(16);
        return view('website.artist.index', compact('artists'));
    }

    public function artist($slug)
    {
        $artist = Artist::with('musics')->where('slug', $slug)->firstOrFail();
        
        if($artist->musics->first() != null)
        {
            return redirect()->route('artist.single', ['slug' => $slug, 'music' => $artist->musics->first()->slug]);
        }
        return redirect()->route('artist.single', ['slug' => $slug, 'music' => 'music']);
    }

    public function single($slug, $music)
    {
        $artist = Artist::with('musics', 'image')->where('slug', $slug)->firstOrFail();
        if($music == 'music')
        {
            $music = 'null';
            return view('website.artist.default', compact('artist'));
        }else{
            $music = Music::where('slug', $music)->firstOrFail();
            return view('website.artist.single', compact('artist', 'music'));
        }

        
    }
}
