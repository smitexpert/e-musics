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
    <div class="col-md-12 col-sm-12">
        <div class="card">
            <h5 class="card-header">Contacts</h5>

            <div class="card-body">
                <form action="{{ route('admin.contact.multi') }}" method="POST">
                    @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="input-group mb-3">
                            <select name="action" id="" class="form-control">
                                <option value="">Select</option>
                                <option value="read">Mark as read</option>
                                <option value="delete">Delete</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-info btn-sm">GO</button>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <div class="d-flex justify-content-between">
                    <p>Unread: {{ \App\Contact::where('status', 0)->count() }}</p>
                    <p>Total: {{ \App\Contact::count() }}</p>
                </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <input type="checkbox" name="" id="" class="check_all">
                                </th>
                                <th scope="col">Name</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $item)
                                <tr @if ($item->status == 0) class="bg-dark text-light" @endif>
                                    <th scope="row">
                                        <input type="checkbox" name="id[]" value="{{ $item->id }}" class="check_box">
                                    </th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->subject }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.contact.view', ['id' => $item->id]) }}" class="btn btn-sm btn-primary"><i class="las la-eye"></i></a>
                                            <a href="{{ route('admin.contact.delete', ['id' => $item->id]) }}" onclick="return confirm('Are You Sure?')" class="btn btn-sm btn-danger"><i class="las la-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
                <br>
                <div class="float-right">
                    {{ $contacts->links('paginate') }}
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
                url: '{{ route("artists.info") }}',
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

                    console.log(data);
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