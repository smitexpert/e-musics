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
                <h5 class="card-header">Site Settings</h5>
    
                <div class="card-body">                    
                    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group mb-4">
                                    <label>Select Logo</label>
                                    <input type="file" name="logo"  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                @if (\App\SiteSetting::where('name', 'logo')->first())
                                    <img style="width: 100%" src="{{ url('') }}/uploads/logo/{{ \App\SiteSetting::where('name', 'logo')->first()->value }}" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <label>Site Name</label>
                                    @if (\App\SiteSetting::where('name', 'title')->first())
                                        <input type="text" name="title" value="{{ \App\SiteSetting::where('name', 'title')->first()->value }}"  class="form-control">
                                    @else
                                        <input type="text" name="title"  class="form-control">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <label>Footer Copyright Text</label>
                                    @if (\App\SiteSetting::where('name', 'copyright')->first())
                                        <textarea name="copyright" class="form-control">{{ \App\SiteSetting::where('name', 'copyright')->first()->value }}</textarea>
                                    @else
                                        <textarea name="copyright" class="form-control"></textarea>
                                    @endif
                                    
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-right">
                                    <button class="btn btn-info">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Contact Settings</h5>
    
                <div class="card-body">                    
                    <form action="{{ route('settings.contact') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <label>Contact Text</label>
                                    @if (\App\SiteSetting::where('name', 'contacttext')->first())
                                        <textarea name="contacttext" class="form-control">{{ \App\SiteSetting::where('name', 'contacttext')->first()->value }}</textarea>
                                        @else
                                        <textarea name="contacttext" class="form-control"></textarea>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <label>Address</label>
                                    @if (\App\SiteSetting::where('name', 'address')->first())
                                        <input type="text" name="address" value="{{ \App\SiteSetting::where('name', 'address')->first()->value }}"  class="form-control">
                                    @else
                                        <input type="text" name="address"  class="form-control">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <label>Contact Number</label>
                                    @if (\App\SiteSetting::where('name', 'contact')->first())
                                        <input type="text" name="contact" value="{{ \App\SiteSetting::where('name', 'contact')->first()->value }}"  class="form-control">
                                    @else
                                        <input type="text" name="contact"  class="form-control">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-4">
                                    <label>Email</label>
                                    @if (\App\SiteSetting::where('name', 'email')->first())
                                        <input type="email" name="email" value="{{ \App\SiteSetting::where('name', 'email')->first()->value }}"  class="form-control">
                                    @else
                                        <input type="email" name="email"  class="form-control">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-right">
                                    <button class="btn btn-info">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection