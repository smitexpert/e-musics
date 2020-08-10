@extends('website.layouts.master')
@section('contents')

<div class="d-md-flex">
<div class="col-md-9">
        <!-- Player section -->
@if ($music->cover == null)
<section class="player-section set-bg" data-setbg="{{ asset('') }}uploads/cover/default.jpg">
@else
<section class="player-section set-bg" data-setbg="{{ asset('') }}uploads/cover/{{ $music->cover }}">
@endif
    <div class="player-box wide">
        <div class="tarck-thumb-warp">
            <div class="tarck-thumb">
                @if ($music->cover == null)
                    <img src="{{ asset('') }}uploads/cover/default.jpg" alt="">
                @else
                    <img src="{{ asset('') }}uploads/cover/{{ $music->cover }}" alt="">
                @endif
                <button onclick="wavesurfer.playPause();" class="wp-play"></button>
            </div>
        </div>
        <div class="wave-player-warp">
            <div class="row">
                <div class="col-lg-8">
                    <div class="wave-player-info">
                        <h2 class="album-song-title">{{ $music->name }}</h2>
                        <p>By {{ $music->artist->name }}</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="songs-links">
                        <a href="{{ route('download', ['slug' => $music->slug]) }}"><img src="{{ asset('') }}website/img/icons/p-2.png" alt=""></a>
                    </div>
                </div>
            </div>
            <div id="wavePlayer" class="clierfix">
                <div id="audiowave" data-waveurl="{{ asset('') }}uploads/mp3/{{ $music->url }}"></div>
                <div id="currentTime"></div>
                <div id="clipTime"></div>
                <!-- Player Controls -->
                <div class="wavePlayer_controls">
                    <button class="jp-prev player_button" onclick="wavesurfer.skipBackward();"></button>
                    <button class="jp-play player_button" onclick="wavesurfer.playPause();"></button>
                    <button class="jp-next player_button" onclick="wavesurfer.skipForward();"></button>
                    <button class="jp-stop player_button" onclick="wavesurfer.stop();"></button>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="player-section">
    <div class="row">
        <div class="col-md-12">
            <div class="contact-warp wide">
                <h4>Comments</h4>
                
                <div class="mt-3 pb-4 mb-4">
                    @forelse (\App\Comment::where('music_id', $music->id)->get() as $comment)
                        <div class="pb-4">
                            <p class="mb-1 pt-0" style="font-size: 18px"><b>{{ $comment->user->name }}</b></p>
                            <p class="pt-0 mb-1">{{ $comment->comment }}</p>
                        </div>
                    @empty
                        <small>No Comments</small>
                    @endforelse
                </div>

                <div class="section-title mb-0">
                    <h4>Send Us Your Comment</h4>
                    <br>
                </div>
                <form class="contact-from" method="POST" action="{{ route('song.comment', ['slug' => $music->slug]) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <textarea placeholder="Message" name="message"></textarea>
                            <button class="site-btn">Post Comment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Player section end -->
    </div>
    <div class="col-md-3">
        <!-- Songs section  -->
	<section class="songs-section mt-4 pb-4">
        <h4 class="pb-3">{{ $artist->name }} Music List</h4>
		<div class="container">
			@foreach ($artist->musics as $item)
                <!-- song -->
			<div class="song-item mt-3">
				<div class="row">
					<div class="col-lg-12">
						<a href="{{ $item->slug }}">
                            <div class="song-info-box">
                                @if ($item->cover == null)
                                    <img src="{{ asset('uploads/cover') }}/default.jpg" alt="">
                                @else
                                    <img src="{{ asset('uploads/cover') }}/{{ $item->cover }}" alt="">
                                @endif
                                <div class="song-info pt-0">
                                    <h4 style="font-size: 16px">{{ $item->name }}</h4>
                                    <p>By {{ $item->artist->name }}</p>
                                </div>
                            </div>
                        </a>
					</div>
				</div>
			</div>
            @endforeach
		</div>
	</section>
	<!-- Songs section end -->
    </div>
</div>

@endsection