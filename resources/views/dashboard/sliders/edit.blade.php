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
                <h5 class="card-header">Edit Slider</h5>
    
                <div class="card-body">                    
                    <form action="{{ route('sliders.update', ['id' => $slider->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label>Slider Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $slider->name }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Slider Title</label>
                                    <input type="text" name="title" class="form-control"value="{{ $slider->title }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Slider Content</label>
                                    <textarea name="content" class="form-control" required>{{ $slider->name }}</textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Slider Button Text</label>
                                    <input type="text" name="button_text" class="form-control" value="{{ $slider->button_text }}"required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Slider Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-right">
                                    <button class="btn btn-primary">Update</button>
                                </div>
                                <div class="mt-4">
                                    <label>Image</label>
                                    <img style="width:100%; height: auto;" src="{{ url('') }}/uploads/sliders/{{ $slider->image }}" alt="">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection