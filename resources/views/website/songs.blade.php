@extends('website.layouts.master')
@section('contents')
<section class="category-section spad">
    <div class="container">
        <div class="section-title">
            <h2>New Songs</h2>
        </div>
        <div class="row">
            @foreach (\App\Music::orderBy('id', 'desc')->limit(6)->get() as $music)
                
                    {{-- <div class="category-item">
                        @if ($music->cover == null)
                            <img src="{{ asset('') }}uploads/cover/default.jpg" alt="">
                        @else
                            <img src="{{ asset('') }}uploads/cover/{{ $music->cover }}" alt="">
                        @endif
                        <div class="ci-text">
                            <h4>{{ $music->name }}</h4>
                            <p>By {{ $music->artist->name }}</p>
                        </div>
                        <a href="artist.html" class="ci-link"><i class="fa fa-play"></i></a>
                    </div> --}}
                    <div class="col-xl-4 col-sm-6">
                        <div class="similar-song">
                            @if ($music->cover == null)
                                <img src="{{ asset('') }}uploads/cover/default.jpg" alt="">
                            @else
                                <img src="{{ asset('') }}uploads/cover/{{ $music->cover }}" alt="">
                            @endif
                            <h4 class="mt-2"><a href="{{ route('song', ['slug' => $music->slug]) }}">{{ $music->name }}</a></h4>
                            <p>By {{ $music->artist->name }}</p>
                            <div class="single_player">
                                <div class="jp-jplayer jplayer" data-ancestor=".jp_container_{{ $loop->index+1 }}" data-url="{{ asset("") }}uploads/mp3/{{ $music->url }}"></div>
                                <div class="jp-audio jp_container_{{ $loop->index+1 }}" role="application" aria-label="media player">
                                    <div class="jp-gui jp-interface">
                                        <!-- Player Controls -->
                                        <div class="ss-controls">
                                            {{-- <div class="songs-links">
                                                <a href=""><img src="{{ asset("") }}website/img/icons/p-1.png" alt=""></a>
                                                <a href=""><img src="{{ asset("") }}website/img/icons/p-2.png" alt=""></a>
                                                <a href=""><img src="{{ asset("") }}website/img/icons/p-3.png" alt=""></a>
                                            </div> --}}
                                            <div class="player_controls_box">
                                                <button class="jp-prev player_button" tabindex="0"></button>
                                                <button class="jp-play player_button" tabindex="0"></button>
                                                <button class="jp-next player_button" tabindex="0"></button>
                                                <button class="jp-stop player_button" tabindex="0"></button>
                                            </div>
                                        </div>
                                        <!-- Progress Bar -->
                                        <div class="player_bars">
                                            <div class="jp-progress">
                                                <div class="jp-seek-bar">
                                                    <div>
                                                        <div class="jp-play-bar"><div class="jp-current-time" role="timer" aria-label="time">0:00</div></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="jp-duration ml-auto" role="timer" aria-label="duration">00:00</div>
                                        </div>
                                    </div>
                                    <div class="jp-no-solution">
                                        <span>Update Required</span>
                                        To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
</section>
<section class="category-section spad">
    <div class="container-fluid">
        <div class="section-title">
            <h2>New Album</h2>
        </div>
        <div class="category-items">
            <div class="row">
                @foreach (\App\Album::orderBy('id', 'desc')->limit(6)->get() as $album)
                    
                    <div class="col-md-4">
                        <div class="category-item">
                            @if ($album->image_id == null)
                                <img src="{{ asset('') }}uploads/cover/default.jpg" alt="">
                            @else
                                <img src="{{ asset('') }}uploads/images/{{ $album->image->url }}" alt="">
                            @endif
                            <div class="ci-text">
                                <h4>{{ $album->name }}</h4>
                            </div>
                            <a href="{{ route('album.album', ['slug' => $album->slug]) }}" class="ci-link"><i class="fa fa-play"></i></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<section class="category-section spad">
    <div class="container-fluid">
        <div class="section-title">
            <h2>New Artists</h2>
        </div>
        <div class="category-items">
            <div class="row playlist-area">
                @foreach (\App\Artist::orderBy('id', 'desc')->limit(8)->get() as $artist)
                    <div class="mix col-lg-3 col-md-4 col-sm-6 genres">
                        <div class="playlist-item">
                            <a href="{{ route('artist.artist', ['slug' => $artist->slug]) }}">
                                @if ($artist->image_id == null)
                                    <img src="{{ asset('') }}uploads/cover/default.jpg" alt="">
                                @else
                                    <img src="{{ asset('') }}uploads/images/{{ $artist->image->url }}" alt="">
                                @endif
                                <h5>{{ $artist->name }}</h5>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection