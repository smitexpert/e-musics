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
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Sliders</h5>
    
                <div class="card-body">                    
                    <a href="{{ route('sliders.add') }}" class="btn btn-sm btn-info"><i class="las la-plus-circle"></i> Add Slider</a>
                    <table class="table table-hover mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Button Text</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                                <tr>
                                    <th>{{ $loop->index+1 }}</th>
                                    <td>{{ $slider->name }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ str_limit($slider->content, 30) }}</td>
                                    <td>{{ $slider->button_text }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('sliders.edit', ['id' => $slider->id]) }}" class="btn btn-primary btn-sm">
                                                <i class="las la-edit"></i>
                                            </a>
                                            <a href="{{ route('sliders.delete', ['id' => $slider->id]) }}" onclick="return confirm('Are You Sure?')" class="btn btn-danger btn-sm">
                                                <i class="las la-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        {{ $sliders->links() }}
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection