@extends('layouts.app')

@section('content')

<div class="container-fluid testimonials-page py-5">

    {{-- HEADER --}}
    <div class="container text-center mb-5">
        <h1 class="fw-bold mb-3">What Our Learners Say</h1>
        <p class="text-muted">
            Real experiences from students and IT professionals who started their learning journey with BTMG Training.
        </p>
    </div>

    {{-- TESTIMONIALS GRID --}}
    <div class="container">
        <div class="row g-4">

            {{-- CARD 1 --}}
            <div class="col-md-6 col-lg-3">
                <div class="testimonial-card h-100 p-4 rounded shadow-sm text-center">
                    <div class="testimonial-icon mb-4 text-primary fs-3">❝</div>
                    <p class="text-muted mb-5">
                       The courses are extremely beginner-friendly yet highly professional. I could grasp programming concepts quickly and apply them to real projects.
                    </p>
                    <div class="d-flex align-items-center justify-content-center mt-auto">
                        <img src="{{ asset('images/students/henry.png') }}" alt="Henry Wilson" class="student-img me-2">
                        <div>
                            <h6 class="fw-bold mb-1">Henry Wilson</h6>
                            <small class="text-muted">Software Engineer</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CARD 2 --}}
            <div class="col-md-6 col-lg-3">
                <div class="testimonial-card h-100 p-4 rounded shadow-sm text-center">
                    <div class="testimonial-icon mb-4 text-primary fs-3">❝</div>
                    <p class="text-muted mb-5">
                        Even as someone new to IT, I felt supported. The step-by-step lessons made learning web development smooth and stress-free.
                    </p>
                    <div class="d-flex align-items-center justify-content-center mt-auto">
                        <img src="{{ asset('images/students/female1.png') }}" alt="Emily Taylor" class="student-img me-2">
                        <div>
                            <h6 class="fw-bold mb-1">Emily Taylor</h6>
                            <small class="text-muted">Computer Scientist</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CARD 3 --}}
            <div class="col-md-6 col-lg-3">
                <div class="testimonial-card h-100 p-4 rounded shadow-sm text-center">
                    <div class="testimonial-icon mb-4 text-primary fs-3">❝</div>
                    <p class="text-muted mb-5">
The modules were easy to follow and filled with practical examples. Perfect for someone starting their career in tech.
                    </p>
                    <div class="d-flex align-items-center justify-content-center mt-auto">
                        <img src="{{ asset('images/students/female2.png') }}" alt="Olivia Walker" class="student-img me-2">
                        <div>
                            <h6 class="fw-bold mb-1">Olivia Walker</h6>
                            <small class="text-muted">UI/UX Designer</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CARD 4 --}}
            <div class="col-md-6 col-lg-3">
                <div class="testimonial-card h-100 p-4 rounded shadow-sm text-center">
                    <div class="testimonial-icon mb-4 text-primary fs-3">❝</div>
                    <p class="text-muted mb-5">
                        Sophia Thompson’s guidance was amazing. The lessons are structured in a way that even total beginners can start confidently.
                    </p>
                    <div class="d-flex align-items-center justify-content-center mt-auto">
                        <img src="{{ asset('images/students/female3.png') }}" alt="Sophia Thompson" class="student-img me-2">
                        <div>
                            <h6 class="fw-bold mb-1">Sophia Woakes</h6>
                            <small class="text-muted">Data Analyst</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CARD 5 --}}
            <div class="col-md-6 col-lg-3">
                <div class="testimonial-card h-100 p-4 rounded shadow-sm text-center">
                    <div class="testimonial-icon mb-4 text-primary fs-3">❝</div>
                    <p class="text-muted mb-5">
                        The guidance and examples provided are excellent. I feel ready to start my IT career confidently.
                    </p>
                    <div class="d-flex align-items-center justify-content-center mt-auto">
                        <img src="{{ asset('images/students/male2.png') }}" alt="George Davis" class="student-img me-2">
                        <div>
                            <h6 class="fw-bold mb-1">George Davis</h6>
                            <small class="text-muted">Data Analyst</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CARD 6 --}}
            <div class="col-md-6 col-lg-3">
                <div class="testimonial-card h-100 p-4 rounded shadow-sm text-center">
                    <div class="testimonial-icon mb-4 text-primary fs-3">❝</div>
                    <p class="text-muted mb-5">
                        The practice exercises helped me learn faster and retain information more effectively.
                    </p>
                    <div class="d-flex align-items-center justify-content-center mt-auto">
                        <img src="{{ asset('images/students/female4.png') }}" alt="Isabella Lewis" class="student-img me-2">
                        <div>
                            <h6 class="fw-bold mb-1">Isabella Lewis</h6>
                            <small class="text-muted">Software Engineer</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CARD 7 --}}
            <div class="col-md-6 col-lg-3">
                <div class="testimonial-card h-100 p-4 rounded shadow-sm text-center">
                    <div class="testimonial-icon mb-4 text-primary fs-3">❝</div>
                    <p class="text-muted mb-5">
                        I love the way the lessons are structured. Everything is clear and simple to follow.
                    </p>
                    <div class="d-flex align-items-center justify-content-center mt-auto">
                        <img src="{{ asset('images/students/male3.png') }}" alt="James Brown" class="student-img me-2">
                        <div>
                            <h6 class="fw-bold mb-1">James Brown</h6>
                            <small class="text-muted">Data Scientist</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CARD 8 --}}
            <div class="col-md-6 col-lg-3">
                <div class="testimonial-card h-100 p-4 rounded shadow-sm text-center">
                    <div class="testimonial-icon mb-4 text-primary fs-3">❝</div>
                    <p class="text-muted mb-5">
                        Great platform with practical examples. I feel confident applying what I learned.
                    </p>
                    <div class="d-flex align-items-center justify-content-center mt-auto">
                        <img src="{{ asset('images/students/male4.png') }}" alt="Oliver Smith" class="student-img me-2">
                        <div>
                            <h6 class="fw-bold mb-1">Oliver Smith</h6>
                            <small class="text-muted">UI/UX Designer</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
