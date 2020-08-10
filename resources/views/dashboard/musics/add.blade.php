@extends('dashboard.layouts.master')
@section('contents')
<div id="app">
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
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Add New Music</h5>
                <div class="card-body">
                    <form id="music_upload_form" enctype="multipart/form-data" method="POST" action="{{ route('musics.add.upload') }}">
                        @csrf
                        <div class="form-group">
                            <label class="col-form-label">Select Music</label>
                            <div class="input-group mb-3">
                                <input name="music" type="file" accept="audio/mp3,audio/*" class="form-control">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    
@endpush