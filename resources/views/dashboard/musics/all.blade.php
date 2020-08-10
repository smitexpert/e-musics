@extends('dashboard.layouts.master')
@section('contents')
<div class="row">
    <div class="col-12">
        
        @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Opps!</strong> {{ Session::get('error') }}
            </div>
        @endif
        
        @error('name')
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Opps!</strong> {{ $message }}
            </div>
        @enderror
        
        
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Great!</strong> {{ Session::get('success') }}
            </div>
        @endif
    </div>
</div>
<div class="row">
    
    <div class="col-sm-12">
        <div class="card">
            <h5 class="card-header">Musics</h5>

            <div class="card-body">
                <form action="{{ route('musics.delete.multi') }}" method="POST">
                    @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="input-group mb-3">
                            <select name="action" id="" class="form-control">
                                <option value="">Select</option>
                                <option value="delete">Delete</option>
                            </select>
                            <div class="input-group-append">
                              <button class="btn btn-info btn-sm">GO</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <a href="{{ route('musics.add') }}" class="btn btn-info btn-sm"><i class="las la-plus-circle"></i> Add</a>
                        <a href="{{ route('musics.trash') }}" class="btn btn-primary btn-sm"><i class="las la-trash"></i> Trash</a>
                    </div>
                </div>
                <br>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <input type="checkbox" name="" id="" class="check_all">
                                </th>
                                <th scope="col">Title</th>
                                <th scope="col">Album</th>
                                <th scope="col">Artist</th>
                                <th scope="col">Genre</th>
                                <th scope="col">Playlist</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($musics as $music)
                                <tr>
                                    <th scope="row">
                                        <input type="checkbox" name="id[]" value="{{ $music->id }}" class="check_box">
                                        <input type="hidden" id="play_id_{{ $music->id }}" value="{{ url('') }}/uploads/mp3/{{ $music->url }}">
                                    </th>
                                    <td>{{ $music->name }}</td>
                                    <td>@if($music->album != null){{ $music->album->name }}@endif</td>
                                    <td>@if($music->artist != null){{ $music->artist->name }}@endif</td>
                                    <td>@if($music->genre != null){{ $music->genre->name }}@endif</td>
                                    <td>@if($music->playlist != null){{ $music->playlist->name }}@endif</td>
                                    
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-default play_btn" data-id="{{ $music->id }}" data-role="play"><i class="las la-play-circle"></i></button>
                                            <a href="{{ route('musics.edit', ['id' => $music->id]) }}" class="btn btn-sm btn-primary"><i class="las la-edit"></i></a>
                                            <a href="{{ route('musics.delete', ['id' => $music->id]) }}" onclick="return confirm('Are You Sure?')" class="btn btn-sm btn-danger"><i class="las la-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
                <br>
                {{ $musics->links() }}
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        // var status = 'play';
        var audio = new Audio();

       $(".play_btn").click(function(){
            var id = $(this).data('id');
            var song = $("#play_id_"+id).val();
            var status = $(this).data('role');

            if(status == 'play')
            {
                audio.pause();
                audio.src = song;
                audio.play();
                $(".play_btn").data('role', 'play');
                $(".play_btn").find('*').remove();
                $(".play_btn").append('<i class="las la-play-circle"></i>');
                $(this).data('role', 'pause');
                $(this).find("*").remove();
                $(this).append('<i class="las la-pause-circle"></i>');
            }else{
                audio.pause();
                audio.currentTime = 0;
                $(".play_btn").data('role', 'play');
                $(".play_btn").find('*').remove();
                $(".play_btn").append('<i class="las la-play-circle"></i>');
                $(this).data('role', 'play');
            }
       })

        $(".check_all").change(function(){
            if($(this).is(':checked'))
            {
                $(".check_box").prop("checked", true);
            }else{
                $(".check_box").prop("checked", false);
            }
        })

        $(".check_box").change(function(){
            var all = true;
            $(".check_box").each(function(){
                if($(this).is(":checked") === false)
                {
                    all = false;
                }
            })

            if(all)
            {
                $(".check_all").prop("checked", true);
            }
            else {
                $(".check_all").prop("checked", false);
            }
        })
    </script>
@endpush
@endsection