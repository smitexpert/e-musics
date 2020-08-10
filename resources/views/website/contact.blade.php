@extends('website.layouts.master')
@section('contents')
<section class="contact-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 p-0">
                <div class="contact-warp">
                    <div class="section-title mb-0">
                        <h2>Get in touch</h2>
                    </div>
                    
                    
                    @if (\App\SiteSetting::where('name', 'contacttext')->first())
                        <p>{{ \App\SiteSetting::where('name', 'contacttext')->first()->value }}</p>
                        @else
                        <p>Add Text From Site Settings</p>
                    @endif
                    <ul>
                        @if (\App\SiteSetting::where('name', 'address')->first())
                            <li>{{ \App\SiteSetting::where('name', 'address')->first()->value }}</li>
                            @else
                            <li>Add Address From Site Settings</li>
                        @endif
                        @if (\App\SiteSetting::where('name', 'contact')->first())
                            <li>{{ \App\SiteSetting::where('name', 'contact')->first()->value }}</li>
                            @else
                            <li>Add Contact Number From Site Settings</li>
                        @endif
                        @if (\App\SiteSetting::where('name', 'email')->first())
                            <li>{{ \App\SiteSetting::where('name', 'email')->first()->value }}</li>
                            @else
                            <li>Add Email From Site Settings</li>
                        @endif
                    </ul>
                    <form class="contact-from" method="POST" action="{{ route('contact.insert') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>        
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="name" placeholder="Your name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" placeholder="Your e-mail" required>
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="subject" placeholder="Subject" required>
                                <textarea name="message" placeholder="Message" required></textarea>
                                <button class="site-btn">send message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection