@extends('layouts.app')

@section('content')

<div class="container-fluid py-5" style="background:#e6f0f6">

    {{-- ABOUT INTRO --}}
    <div class="container mb-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="fw-bold mb-3">
                    Learn Skills. Build Confidence. Start Your Journey.
                </h1>

                <p class="text-muted">
                    BTMG Training is specially created for <strong>beginners, students,
                    and new learners</strong> who want to start learning from scratch
                    without confusion or stress.
                </p>

                <p class="text-muted">
                    If you are new to learning or unsure where to begin,
                    our step-by-step courses will guide you clearly
                    and help you grow with confidence.
                </p>
            </div>

            <div class="col-md-6 text-center">
                <img src="{{ asset('images/online-coding-classes.png') }}"
                     class="img-fluid rounded"
                     alt="Learning for Beginners">
            </div>
        </div>
    </div>

    {{-- HOW WE SUPPORT NEW LEARNERS --}}
    <div class="container mb-5">
        <h2 class="text-center fw-bold mb-2">
            Designed Especially for New Learners
        </h2>
        <p class="text-center text-muted mb-5">
            Everything is built to make learning easy, clear, and confidence-boosting.
        </p>

        <div class="row g-4">
            {{-- CARD 1 --}}
            <div class="col-md-4">
                <div class="bg-white h-100 p-4 text-center rounded shadow-sm">
                    <div class="icon-circle mb-3">
                        <i class="bi bi-layers"></i>
                    </div>
                    <h5 class="fw-bold">Start From Scratch</h5>
                    <p class="text-muted mt-2">
                        No prior knowledge required. We begin with the basics
                        and build your understanding step by step.
                    </p>
                </div>
            </div>

            {{-- CARD 2 --}}
            <div class="col-md-4">
                <div class="bg-white h-100 p-4 text-center rounded shadow-sm">
                    <div class="icon-circle mb-3">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <h5 class="fw-bold">Practice While Learning</h5>
                    <p class="text-muted mt-2">
                        Learn by doing with real examples and hands-on
                        exercises that make concepts clear.
                    </p>
                </div>
            </div>

            {{-- CARD 3 --}}
            <div class="col-md-4">
                <div class="bg-white h-100 p-4 text-center rounded shadow-sm">
                    <div class="icon-circle mb-3">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h5 class="fw-bold">Build Real Confidence</h5>
                    <p class="text-muted mt-2">
                        Complete courses feeling confident
                        and ready to move forward.
                    </p>
                </div>
            </div>
        </div>
    </div>
 {{-- SUBSCRIBE BAR --}}
{{-- SUBSCRIBE BAR --}}
<div class="container mb-5">
    <div class="subscribe-wrapper mx-auto">

        <form action="{{ route('subscribe.store') }}" method="POST">
    @csrf
    <div class="subscribe-bar">
        <input type="email" name="email" placeholder="Enter Email Address" class="subscribe-input" required>
        <button type="submit" class="subscribe-btn">Subscribe →</button>
    </div>
</form>

<!-- Success / Error Message -->
@if(session('success'))
    <div class="alert alert-success mt-3 text-center">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger mt-3 text-center">
        {{ $errors->first() }}
    </div>
@endif


    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#subscribeForm').submit(function(e) {
        e.preventDefault(); // prevent page reload

        let email = $('#subscribeEmail').val();
        let token = $('input[name="_token"]').val();

        $.ajax({
            url: "{{ route('subscribe.store') }}",
            type: 'POST',
            data: {
                _token: token,
                email: email
            },
            success: function(response) {
                // Show success message
                $('#subscribeMessage').html('<div class="alert alert-success">' + response.message + '</div>');
                $('#subscribeEmail').val(''); // clear input
            },
            error: function(xhr) {
                if(xhr.responseJSON && xhr.responseJSON.errors && xhr.responseJSON.errors.email) {
                    let err = xhr.responseJSON.errors.email[0];
                    $('#subscribeMessage').html('<div class="alert alert-danger">' + err + '</div>');
                } else {
                    $('#subscribeMessage').html('<div class="alert alert-danger">Something went wrong.</div>');
                }
            }
        });
    });
});
</script>



@endsection
