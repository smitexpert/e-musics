<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Music;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class SongsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('payment');
    }
    public function index($slug)
    {
        $music = Music::where('slug', $slug)->firstOrFail();
        $comments = Comment::with('user')->where('music_id', $music->id)->get();
        return view('website.song', compact('music', 'comments'));
    }

    public function comment(Request $request, $slug)
    {
        $music = Music::where('slug', $slug)->first();
        Comment::create([
            'user_id' => Auth::user()->id,
            'music_id' => $music->id,
            'comment' => $request->message
        ]);

        return back();
    }

    public function download($slug)
    {
        $music = Music::where('slug', $slug)->firstOrFail();
        $path = public_path('uploads/mp3/'.$music->url);
        return response()->download($path);
    }

    public function browse()
    {
        $musics = Music::orderBy('id', 'desc')->paginate(12);
        return view('website.browse', compact('musics'));
    }

    public function new()
    {
        $musics = Music::where('created_at', '>', \Carbon\Carbon::today()->subDays(7))->paginate(12);
        return view('website.browse', compact('musics'));
    }
}
