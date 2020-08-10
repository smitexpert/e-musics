@extends('website.layouts.master')
@section('contents')
<!-- Category section -->
<section class="category-section spad">
    <div class="container-fluid">
        <div class="section-title">
            <h4>Play And Enjoy The Musics</h4>
        </div>
    </div>
</section>
<!-- Category section end -->
<!-- Songs section  -->
<section class="songs-section">
    <div class="container">
       <div class="row">
           @foreach ($musics as $music)
           <div class="col-xl-4 col-sm-6">
               <div class="similar-song pb-4">
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
       
       {!! $musics->links() !!}

        {{-- <div class="site-pagination pt-5 mt-5">
            <a href="#" class="active">01.</a>
            <a href="#">02.</a>
            <a href="#">03.</a>
            <a href="#">04.</a>
        </div> --}}
    </div>
</section>
<!-- Songs section end -->
@endsection