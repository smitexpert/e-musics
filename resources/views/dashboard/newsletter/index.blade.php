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
            <h5 class="card-header">Newsletter</h5>

            <div class="card-body">
                <h3>Select View and Send Newsletter From Below.</h3>
                <a href="{{ route('newsletter.history') }}" class="btn btn-info">View Sent History</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <h5 class="card-header">Weekly Newsletter 01</h5>
            <div class="card-body">
                <a href="{{ route('newsletter.view') }}" target="_blank" class="btn btn-sm btn-success">View</a>
                <a href="{{ route('newsletter.send') }}" class="btn btn-sm btn-primary">Send</a>
            </div>
        </div>
    </div>
</div>
@push('scripts')

@endpush
@endsection