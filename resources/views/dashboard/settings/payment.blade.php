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
                    <div class="row">
                        <div class="col-12">
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{  $error }}</div>
                            @endforeach
                        </div>
                    </div>               
                    <form action="{{ route('settings.payment.action') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label>Paypal Payment Client ID</label>
                                    @if (\App\SiteSetting::where('name', 'client_id')->first())
                                        <input type="text" name="client_id" value="{{ \App\SiteSetting::where('name', 'client_id')->first()->value }}"  class="form-control">
                                    @else
                                        <input type="text" name="client_id"   class="form-control">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label>Membership Fee Amount</label>
                                    @if (\App\SiteSetting::where('name', 'amount')->first())
                                        <input type="text" name="amount" value="{{ \App\SiteSetting::where('name', 'amount')->first()->value }}"  class="form-control">
                                    @else
                                        <input type="text" name="amount"   class="form-control">
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="col-md-12">
                                <div class="form-group mb-4 float-left text-left">
                                    @if (\App\SiteSetting::where('name', 'sandbox')->first())
                                        <div class="input-group-prepend">
                                            <label>Sandbox Account</label>
                                        </div>
                                        <input type="checkbox" name="sandbox" checked>
                                    @else
                                        <div class="input-group-prepend">
                                            <label>Sandbox Account</label>
                                        </div>
                                        <input type="checkbox" name="sandbox">
                                    @endif
                                </div>
                            </div> --}}
                            <div class="col-md-12">
                                <div class="text-left">
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