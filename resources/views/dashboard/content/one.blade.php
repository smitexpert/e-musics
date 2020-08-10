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
                <h5 class="card-header">Manage Content One</h5>
    
                <div class="card-body">                    
                    <form action="{{ route('content.one.insert') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label>Content Title</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Content Content</label>
                                    <textarea name="content" class="form-control" required></textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Content Button Text</label>
                                    <input type="text" name="button_text" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-right">
                                    <button class="btn btn-primary">Publish</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection