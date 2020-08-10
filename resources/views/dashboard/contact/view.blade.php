@extends('dashboard.layouts.master')
@push('styles')
    <link rel="stylesheet" href="{{ asset('') }}css/nice-select.css">
    
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/vendor/summernote/css/summernote-bs4.css">
@endpush
@section('contents')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">View Contact</h5>
                <div class="card-body">
                    <h3 class="mb-1">Name: {{ $contact->name }}</h3>
                    <p class="mb-1"><b>Email: {{ $contact->email }}</b></p>
                    <p class="mb-1"><b>Subject: {{ $contact->subject }}</b></p>
                    <small>{{ $contact->created_at }}</small>
                    <br>
                    <p class="mb-1 pt-4">
                        <b>Message:</b>
                    </p>
                    <p class="mb-4">
                        {{ $contact->message }}
                    </p>
                    <br>
                    <h3 class="pt-3 mb-2">Write A Reply</h3>
                    <form action="{{ route('admin.contact.reply', ['id' => $contact->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea id="summernote" name="reply" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="float-right">
                            <button class="btn btn-success">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('dashboard') }}/assets/vendor/summernote/js/summernote-bs4.js"></script>
<script>
    
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300

        });
    });
</script>
@endpush