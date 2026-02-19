@extends('layouts.app')

@section('content')
<div class="main-content contact-page">

    <!-- Hero / Header -->
    <div class="contact-hero">
        <h1>Contact Us</h1>
        <p class="contact-subtitle">
            Have questions or need help? Leave us a message and our team will get back to you within one business day.
        </p>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Contact Form -->
    <div class="contact-form-wrapper">
        <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
            @csrf
            <div class="form-group">
                <label for="name">Full Name *</label>
                <input type="text" id="name" name="name" placeholder="Your full name" required>
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone (Optional)</label>
                <input type="tel" id="phone" name="phone" placeholder="123-456-7890">
            </div>

            <div class="form-group">
                <label for="message">Message *</label>
                <textarea id="message" name="message" rows="5" placeholder="Your message..." required></textarea>
            </div>

            <div class="form-group consent">
                <input type="checkbox" id="consent" name="consent" required>
                <label for="consent">
                    I confirm that all information provided is accurate and may be used by BTMG solely for educational and enrollment purposes. My data will not be shared with any third-party organizations.
                </label>
            </div>

            <button type="submit" class="btn-submit">Send Message</button>
        </form>
    </div>

    <!-- Note -->
    <p class="response-time">
        We usually respond within one business day.
    </p>

</div>
@endsection
