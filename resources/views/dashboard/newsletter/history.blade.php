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
            <h5 class="card-header">Newsletter Sent History</h5>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-light">
                            <tr class="border-0">
                                <th class="border-0">#</th>
                                <th class="border-0">Total</th>
                                <th class="border-0">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($history as $item)
                                <tr>
                                    <th>{{ $item->id }}</th>
                                    <td>{{ $item->total }}</td>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')

@endpush
@endsection