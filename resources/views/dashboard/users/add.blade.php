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

        @foreach ($errors->all() as $message)
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Opps!</strong> {{ $message }}
            </div>
        @endforeach
        
        
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
            <h5 class="card-header">New Admin</h5>

            <div class="card-body">
                
                <br>
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('users.admin.insert') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-success">Create</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <br>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    
@endpush
@endsection