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
        <div class="col-md-4 col-sm-12">
            <div class="card">
                <h5 class="card-header">Add Genre</h5>

                <div class="card-body">                    
                    <form action="{{ route("genres.add") }}" id="add_form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="col-form-label">Genre Cover Image</label>
                            <input type="file" name="genre_img" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Genre Name</label>
                            <div class="input-group mb-3">
                                <input type="text" name="name" class="form-control">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            <div class="card">
                <h5 class="card-header">Genres</h5>

                <div class="card-body">
                    <form action="{{ route('genres.delete.multi') }}" method="POST">
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
                            <a href="{{ route('genres.trash') }}" class="btn btn-primary btn-sm"><i class="las la-trash"></i> Trash</a>
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
                                @foreach ($genres as $genre)
                                    <tr>
                                        <th scope="row">
                                            <input type="checkbox" name="id[]" value="{{ $genre->id }}" class="check_box">
                                        </th>
                                        <td>{{ $genre->name }}</td>
                                        <td>{{ $genre->slug }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" data-id="{{ $genre->id }}" class="btn btn-sm btn-primary edit_modal"><i class="las la-edit"></i></button>
                                                <a href="{{ route('genres.delete.single', ['id' => $genre->id]) }}" onclick="return confirm('Are You Sure?')" class="btn btn-sm btn-danger"><i class="las la-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                    <br>
                    {{ $genres->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
  <div class="modal fade" id="edit_modal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form action="{{ route('genres.update') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden" id="modal_id" name="id">
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="name" id="modal_name">
            </div>
            <div class="form-group mb-3 image_show">
                <img style="width: 100%; height: auto;" src="" alt="">
            </div>
            <div class="form-group mb-3">
                <input type="file" class="form-control" name="genre_img">
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
                url: '{{ route("genres.info") }}',
                method: 'POST',
                data: {
                    id: id
                },
                success: function(data)
                {
                    $("#modal_id").val(data.id)
                    $("#modal_name").val(data.name)
                    $("#edit_modal").modal();

                    $(".image_show").find("*").remove();

                    if(data.image != null)
                    {
                        $(".image_show").append('<img style="width: 100%; height: auto;" src="{{ asset("") }}uploads/images/'+data.image.url+'" alt="">');
                    }
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