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
            <h5 class="card-header">Users</h5>

            <div class="card-body">
                
                <br>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">
                                    Sl
                                </th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                                <th scope="col">Joined</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <th>
                                        {{ $loop->index+1 }}
                                    </th>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        @if ($item->id != Auth::user()->id)
                                            <div class="btn-group">
                                                <a href="{{ route('users.delete', ['id' => $item->id]) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                <br>
                {{ $users->links('paginate') }}
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