@extends('website.layouts.master')
@section('contents')
<section class="contact-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 p-0">
                <div class="contact-warp">
                    
                    <form class="contact-from" method="POST" action="{{ route('account.info') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <h4 class="pb-4">Update Your Account Details</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Name</label>
                                        <input type="text" name="name" placeholder="Your name" value="{{ Auth::user()->name }}" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Email</label>
                                        <input type="email" name="email" value="{{ Auth::user()->email }}" placeholder="Your e-mail" readonly>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="site-btn">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    <br>
                    <br>
                    <form class="contact-from" method="POST" action="{{ route('account.update') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <h4 class="pb-4">Update Your Account Password</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Current Password</label>
                                        <input type="password" name="current_password" placeholder="Your Current Password" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label>New Password</label>
                                        <input type="password" name="password" placeholder="Your Current Password" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Confirm Password</label>
                                        <input type="password" name="confirm_password" placeholder="Your Current Password" required>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="site-btn">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection