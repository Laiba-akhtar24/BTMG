<footer class="site-footer">
    <div class="container">
        <div class="row gy-4">

            {{-- BRAND --}}
            <div class="col-md-4">
                <img src="{{ asset('images/logo.png') }}" alt="BTMG Training" class="footer-logo mb-3">
                <p class="footer-text">
                    BTMG Training provides beginner-friendly IT courses designed to help learners
                    build real skills with confidence.
                </p>
            </div>

            {{-- QUICK LINKS --}}
            <div class="col-md-2">
                <h6 class="footer-title">Quick Links</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('frontend.courses') }}">Courses</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="{{ route('testimonials') }}">Testimonials</a></li>
                    <li><a href="{{ route('contact.store') }}">Contact</a></li>
                </ul>
            </div>

            {{-- COURSES --}}
            <div class="col-md-3">
                <h6 class="footer-title">Popular Courses</h6>
                <ul class="footer-links">
                    <li>Web Development</li>
                    <li>Frontend Development</li>
                    <li>Backend Development</li>
                    <li>Data Analysis</li>
                    <li>Cloud & DevOps</li>
                </ul>
            </div>

            {{-- CONTACT --}}
            <div class="col-md-3">
                <h6 class="footer-title">Contact Us</h6>
                <p class="footer-text mb-1">📧 info@btmgtraining.com</p>
                <p class="footer-text mb-1">📞 +1 (000) 123-4567</p>
                <p class="footer-text">🌍 Learn from anywhere</p>
            </div>

        </div>

        <hr class="footer-divider">

        <div class="text-center footer-bottom">
            © {{ date('Y') }} BTMG Training. All Rights Reserved.
        </div>
    </div>
</footer>
