@extends('website.layouts.master')
@section('contents')
<!-- Category section -->
<section class="category-section spad">
    <div class="container-fluid">
        <div class="section-title">
            <h4>Albums</h4>
        </div>
    </div>
</section>
<!-- Category section end -->
<!-- Songs section  -->
<section class="songs-section">
    <div class="container">
       <div class="row">
            @foreach ($genres as $album)
                <div class="mix col-lg-3 col-md-4 col-sm-6 genres">
                    <a href="{{ route('genre.genre', ['slug' => $album->slug]) }}">
                        <div class="playlist-item">
                            @if ($album->image_id == null)
                                <img src="{{ asset('uploads/images') }}/default.jpg" alt="">
                            @else
                                <img src="{{ asset('uploads/images') }}/{{ $album->image->url }}" alt="">
                            @endif
                            <h5>{{ $album->name }}</h5>
                        </div>
                    </a>
                </div>
            @endforeach
       </div>
       
       {!! $genres->links() !!}
    </div>
</section>
<!-- Songs section end -->
@endsection