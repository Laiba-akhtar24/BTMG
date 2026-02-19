@extends('layouts.app')

@section('content')
    <x-hero />
    
   <section class="home-intro">
    <div class="container">
        <h2>Designed for Beginners in IT</h2>
        <p>
            BTMG Training is built for learners who want to start their IT journey
            without confusion. Our courses focus on clarity, practice, and real-world skills.
        </p>
    </div>
</section>
<section class="home-steps">
    <div class="container">
        <h2>How You Learn With Us</h2>

        <div class="steps-grid">
            <div class="step-card">
                <span>01</span>
                <h4>Start From Basics</h4>
                <p>We assume no prior knowledge and build strong foundations.</p>
            </div>

            <div class="step-card">
                <span>02</span>
                <h4>Practice Along</h4>
                <p>Hands-on examples help you understand concepts faster.</p>
            </div>

            <div class="step-card">
                <span>03</span>
                <h4>Build Confidence</h4>
                <p>Finish courses ready to apply skills in real projects.</p>
            </div>
        </div>
    </div>
</section>
<section class="home-categories" id="courses">
    <div class="container">
        <h2>Popular Learning Paths</h2>

        <div class="category-grid">
            <div class="category-card">Web Development</div>
            <div class="category-card">Frontend Development</div>
            <div class="category-card">Backend Development</div>
            <div class="category-card">Data Analysis</div>
        </div>
    </div>
</section>
<section class="home-cta">
    <div class="container">
        <h2>Ready to Start Learning?</h2>
        <p>
            Begin your IT journey with beginner-friendly courses
            designed to help you grow step by step.
        </p>
        <!-- ✅ Updated Route -->
       <a href="{{ route('frontend.courses') }}" class="hero-btn">Explore Courses</a>

    </div>
</section>

@endsection
