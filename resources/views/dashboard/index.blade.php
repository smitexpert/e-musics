@extends('dashboard.layouts.master')
@section('contents')
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Summery </h2>
                
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end pageheader  -->
    <!-- ============================================================== -->
    <div class="ecommerce-widget">

        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-muted">Total Users</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">{{ \App\User::count() }}</h1>
                        </div>
                        {{-- <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                            <span><i class="fa fa-fw fa-arrow-up"></i></span><span>5.86%</span>
                        </div> --}}
                    </div>
                    {{-- <div id="sparkline-revenue"></div> --}}
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-muted">Pending Users</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">{{ \App\User::where('status', 'pending')->count() }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-muted">Unpaid Users</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">{{ \App\User::where('status', 'payment')->count() }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-muted">Active Users</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">{{ \App\User::where('status', 'active')->count() }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <!-- ============================================================== -->
            <!-- sales  -->
            <!-- ============================================================== -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">Today Sale</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">${{ number_format(\App\Payment::whereDate('created_at', \Carbon\Carbon::today())->sum('amount'), 2, '.', ',') }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end sales  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- new customer  -->
            <!-- ============================================================== -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">This Week Sale</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">${{ number_format(\App\Payment::where('created_at', '>', \Carbon\Carbon::today()->subDays(7))->sum('amount'), 2, '.', ',') }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end new customer  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- visitor  -->
            <!-- ============================================================== -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">Last Month Sale</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">${{ number_format(\App\Payment::where('created_at', '>', \Carbon\Carbon::today()->subDays(30))->sum('amount'), 2, '.', ',') }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end visitor  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- total orders  -->
            <!-- ============================================================== -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">Total Sale</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">${{ number_format(\App\Payment::sum('amount'), 2, '.', ',') }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end total orders  -->
            <!-- ============================================================== -->
        </div>


        <div class="row">
            <!-- ============================================================== -->
      
            <!-- ============================================================== -->

                          <!-- recent orders  -->
            <!-- ============================================================== -->
            <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Recent Transections</h5>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-light">
                                    <tr class="border-0">
                                        <th class="border-0">#</th>
                                        <th class="border-0">User</th>
                                        <th class="border-0">Method</th>
                                        <th class="border-0">Amount</th>
                                        <th class="border-0">Transection ID</th>
                                        <th class="border-0">Status</th>
                                        <th class="border-0">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Payment::with('user')->orderBy('id', 'desc')->limit(10)->get() as $item)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->method }}</td>
                                            <td>${{ number_format($item->amount, 2, '.', ',') }}</td>
                                            <td>{{ $item->transection_id }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ $item->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    
                                    {{-- <tr>
                                        <td colspan="9"><a href="#" class="btn btn-outline-light float-right">View Details</a></td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end recent orders  -->
        </div>

    </div>
@endsection