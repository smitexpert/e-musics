@extends('dashboard.layouts.master')
@section('contents')
@push('styles')
    <link rel="stylesheet" href="{{ asset('') }}css/bootstrap-select.min.css">
@endpush

<form id="music_upload_form" enctype="multipart/form-data" method="POST" action="{{ route('musics.add.process') }}">
@csrf
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Music</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-form-label">Selected Music</label>
                                <div class="input-group mb-3">
                                    <input class="form-control" name="music" id="music" type="text" value="{{ $music }}">
                                    <input type="hidden" name="music_path" id="music_path" value="{{ $music_path }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label class="col-form-label">Album*</label>
                                <select name="album" id="album" class="form-control" data-live-search="true" required>
                                    <option value=""></option>
                                    @php
                                      $is_album = false;  
                                    @endphp
                                    @foreach (\App\Album::all() as $album)
                                        @if ($album->name == LaravelMP3::getAlbum($music_path))
                                            <option value="{{ $album->id }}" selected>{{ $album->name }}</option>
                                            @php
                                                $is_album = true;
                                            @endphp
                                        @else
                                            <option value="{{ $album->id }}">{{ $album->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Add New</span>
                                </div>
                                <input type="text" class="form-control" id="new_album" value="@if(!$is_album){{ LaravelMP3::getAlbum($music_path) }}@endif">
                                <div class="input-group-append">
                                    <button type="button" id="new_album_btn" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label class="col-form-label">Artists*</label>
                                <select name="artist" id="artist" class="form-control" data-live-search="true" required>
                                    <option value=""></option>
                                    @php
                                      $is_artist = false;  
                                    @endphp
                                    @foreach (\App\Artist::all() as $artist)
                                        @if ($artist->name == LaravelMP3::getArtist($music_path))
                                            <option value="{{ $artist->id }}" selected>{{ $artist->name }}</option>
                                            @php
                                                $is_artist = true;
                                            @endphp
                                        @else
                                            <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Add New</span>
                                </div>
                                <input type="text" class="form-control" id="new_artist" value="@if(!$is_artist){{ LaravelMP3::getArtist($music_path) }}@endif">
                                <div class="input-group-append">
                                    <button type="button" id="new_artist_btn" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label class="col-form-label">Genres*</label>
                                <select name="genre" id="genre" class="form-control" data-live-search="true" required>
                                    <option value=""></option>
                                    @php
                                      $is_genre = false;  
                                    @endphp
                                    @foreach (\App\Genre::all() as $genre)
                                        @if ($genre->name == LaravelMP3::getGenre($music_path))
                                            <option value="{{ $genre->id }}" selected>{{ $genre->name }}</option>
                                            @php
                                                $is_genre = true;
                                            @endphp
                                        @else
                                            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Add New</span>
                                </div>
                                <input type="text" class="form-control" id="new_genre" value="@if(!$is_genre){{ LaravelMP3::getGenre($music_path) }}@endif">
                                <div class="input-group-append">
                                    <button type="button" id="new_genre_btn" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label class="col-form-label">Playlist</label>
                                <select name="playlist" id="playlist" class="form-control" data-live-search="true">
                                    <option value=""></option>
                                    @foreach (\App\Playlist::all() as $playlist)
                                        <option value="{{ $playlist->id }}">{{ $playlist->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Add New</span>
                                </div>
                                <input type="text" class="form-control" id="new_playlist" value="">
                                <div class="input-group-append">
                                    <button type="button" id="new_playlist_btn" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div id="img_prev">
                                @php
                                    $is_img = 0;
                                @endphp
                                @if (LaravelMP3::getImage($music_path) != null)
                                    <img src="{{ asset('') }}{{ $music_path }}.jpg" style="width:100%; height:auto;" alt="" class="responsive">
                                    <input type="hidden" name="cover" value="{{ $music_path }}.jpg">
                                    @php
                                        $is_img = 1;
                                    @endphp
                                @endif
                            </div>
                            <input type="hidden" value="{{ $is_img }}" name="is_img" id="is_img">
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label">Playlist</label>
                            <div class="input-group mb-3">
                                <input type="file" id="image" name="image" class="form-control">
                                <div class="input-group-append">
                                    <button id="image_btn" type="button" class="btn btn-success">Upload</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="text-right">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@push('scripts')
    <script src="{{ asset('') }}js/bootstrap-select.min.js"></script>
    <script>
        $("#album").selectpicker();
        $("#artist").selectpicker();
        $("#genre").selectpicker();
        $("#playlist").selectpicker();

        $("#image_btn").click(function(){
            var formData = new FormData();
            formData.append('image', $('input[type=file]')[0].files[0]);
            formData.append('music', $('#music').val());

            $.ajax({
                url: '{{ route("musics.process.image") }}',
                data: formData,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function(data)
                {
                    var path = "{{ asset('') }}";
                    var img = '<img src="'+path+data+'" style="width:100%; height:auto;" alt="" class="responsive">';
                    var cover = '<input type="hidden" name="cover" value="'+data+'">';

                    // console.log(data);
                    $("#img_prev").find("*").remove();
                    $("#is_img").val("1");
                    $("#img_prev").append(img);
                    $("#img_prev").append(cover);
                }
            });
        })

        $("#new_album_btn").click(function(){
            var val = $("#new_album").val();
            $.ajax({
                url: '{{ route("musics.process.album") }}',
                method: 'POST',
                data: {
                    name: val
                },
                success: function(data)
                {
                    if(data.status == 201)
                    {
                        var id = data.data.id;
                        var name = data.data.name;
                        $("#album").append('<option value="'+id+'" selected>'+name+'</option>');
                        $("#album").selectpicker('val', id);
                        $("#album").selectpicker('render');
                        $("#album").selectpicker('refresh');
                        $("#album").selectpicker('refresh');

                    }else{
                        var id = data.data.id;
                        var name = data.data.name;
                        $("#album").val(id);
                        $("#album").selectpicker('refresh');
                    }
                }
            })
            $("#new_album").val("");
        });

        $("#new_artist_btn").click(function(){
            var val = $("#new_artist").val();
            $.ajax({
                url: '{{ route("musics.process.artist") }}',
                method: 'POST',
                data: {
                    name: val
                },
                success: function(data)
                {
                    if(data.status == 201)
                    {
                        var id = data.data.id;
                        var name = data.data.name;
                        $("#artist").append('<option value="'+id+'" selected>'+name+'</option>');
                        $("#artist").selectpicker('val', id);
                        $("#artist").selectpicker('render');
                        $("#artist").selectpicker('refresh');
                        $("#artist").selectpicker('refresh');

                    }else{
                        var id = data.data.id;
                        var name = data.data.name;
                        $("#artist").val(id);
                        $("#artist").selectpicker('refresh');
                    }
                }
            })
            $("#new_artist").val("");
        });

        $("#new_genre_btn").click(function(){
            var val = $("#new_genre").val();
            $.ajax({
                url: '{{ route("musics.process.genre") }}',
                method: 'POST',
                data: {
                    name: val
                },
                success: function(data)
                {
                    if(data.status == 201)
                    {
                        var id = data.data.id;
                        var name = data.data.name;
                        $("#genre").append('<option value="'+id+'" selected>'+name+'</option>');
                        $("#genre").selectpicker('val', id);
                        $("#genre").selectpicker('render');
                        $("#genre").selectpicker('refresh');
                        $("#genre").selectpicker('refresh');

                    }else{
                        var id = data.data.id;
                        var name = data.data.name;
                        $("#genre").val(id);
                        $("#genre").selectpicker('refresh');
                    }
                }
            })
            $("#new_genre").val("");
        });

        $("#new_playlist_btn").click(function(){
            var val = $("#new_playlist").val();
            $.ajax({
                url: '{{ route("musics.process.playlist") }}',
                method: 'POST',
                data: {
                    name: val
                },
                success: function(data)
                {
                    if(data.status == 201)
                    {
                        var id = data.data.id;
                        var name = data.data.name;
                        $("#playlist").append('<option value="'+id+'" selected>'+name+'</option>');
                        $("#playlist").selectpicker('val', id);
                        $("#playlist").selectpicker('render');
                        $("#playlist").selectpicker('refresh');
                        $("#playlist").selectpicker('refresh');

                    }else{
                        var id = data.data.id;
                        var name = data.data.name;
                        $("#playlist").val(id);
                        $("#playlist").selectpicker('refresh');
                    }
                }
            })
            $("#new_playlist").val("");
        });
    </script>
@endpush
@endsection