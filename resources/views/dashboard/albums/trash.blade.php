@extends('dashboard.layouts.master')
@push('styles')
    <link rel="stylesheet" href="{{ asset('') }}css/nice-select.css">
@endpush
@section('contents')
<div class="row">
    <div class="col-12">
        
        @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Opps!</strong> {{ Session::get('error') }}
            </div>
        @endif
        
        @error('album')
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
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <h5 class="card-header">Albums</h5>

                <div class="card-body">
                    <form action="{{ route('albums.trash.action') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="input-group mb-3">
                                    <select name="action" id="" class="form-control">
                                        <option value="">Select</option>
                                        <option value="restore">Restore</option>
                                        <option value="delete">Permanently Delete</option>
                                    </select>
                                    <div class="input-group-append">
                                      <button class="btn btn-info btn-sm">GO</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
    
                                <a href="{{ route('albums.all') }}" class="btn btn-info btn-sm"><i class="las la-chevron-left"></i> All Albums</a>
                                <a href="{{ route('albums.trash.empty') }}" class="btn btn-danger btn-sm"><i class="las la-trash"></i> Empty Trash</a>
                                <a href="{{ route('albums.trash.restore') }}" class="btn btn-primary btn-sm"><i class="las la-undo-alt"></i> Restore All</a>
                            </div>
                        </div>
                        <br>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <input type="checkbox" name="" id="" class="check_all">
                                    </th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($albums as $album)
                                    <tr>
                                        <th scope="row">
                                            <input type="checkbox" name="album_id[]" value="{{ $album->id }}" class="check_box">
                                        </th>
                                        <td>{{ $album->name }}</td>
                                        <td>{{ $album->slug }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('albums.trash.restore.id', ['id' => $album->id]) }}" class="btn btn-sm btn-primary"><i class="las la-undo-alt"></i></a>
                                                <a href="{{ route('albums.trash.delete', ['id' => $album->id]) }}" onclick="return confirm('Are You Sure?')" class="btn btn-sm btn-danger"><i class="las la-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                    <br>
                    {{ $albums->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
  <div class="modal fade" id="album_edit_modal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form action="{{ route('albums.update') }}" method="POST">
              @csrf
              <input type="hidden" id="modal_album_id" name="id">
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="album" id="modal_album_name">
            </div>
            <button class="btn btn-block btn-primary">Update</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@push('scripts')
    <script>

        $(".edit_modal").click(function(){
            var id = $(this).attr('data-id');

            $.ajax({
                url: '{{ route("albums.info") }}',
                method: 'POST',
                data: {
                    id: id
                },
                success: function(data)
                {
                    $("#modal_album_id").val(data.id)
                    $("#modal_album_name").val(data.name)
                    $("#album_edit_modal").modal();
                }
            })
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