@extends('website.layouts.master')
@section('contents')
<!-- Player section -->
<section class="player-section set-bg" data-setbg="{{ asset('') }}uploads/images/{{ $album->image->url }}">
    <div class="player-box">
        <div class="tarck-thumb-warp">
            <div class="tarck-thumb">
                <section class="player-section set-bg" style="background-size: contain" data-setbg="{{ asset('') }}uploads/images/{{ $album->image->url }}">
            </div>
        </div>
        <div class="wave-player-warp">
            <div class="row">
                <div class="col-lg-8">
                    <div class="wave-player-info">
                        <h2>{{ $album->name }}</h2>
                        <p>No Song Found</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    {{-- <div class="songs-links">
                        <a href=""><img src="{{ asset('') }}website/img/icons/p-2.png" alt=""></a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Player section end -->

@endsection