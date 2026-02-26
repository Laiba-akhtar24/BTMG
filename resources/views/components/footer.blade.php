<footer class="site-footer">
    <style>
        /* ================================
FOOTER STYLING
=============================== */

.site-footer {
    background-color: #09637E; /* Deep teal background for the footer */
    color: white; /* White text for contrast */
    padding: 40px 0; /* Padding for spacing */
    font-size: 14px; /* Smaller font size for footer text */
}

.site-footer .footer-logo {
    max-width: 150px; /* Limit logo size */
}

.site-footer .footer-text {
    color: #EBF4F6; /* Soft light blue for paragraph text */
    line-height: 1.6; /* Improved line spacing */
}

.site-footer .footer-title {
    font-size: 18px; /* Larger font size for titles */
    font-weight: 700; /* Bold titles */
    color: #fff; /* White color for section titles */
    margin-bottom: 15px; /* Margin below the titles */
}

.site-footer .footer-links {
    list-style: none;
    padding: 0;
}

.site-footer .footer-links li {
    margin-bottom: 10px;
}

.site-footer .footer-links a {
    color: #EBF4F6; /* Soft light blue color for links */
    text-decoration: none; /* Remove underline from links */
    transition: color 0.3s ease; /* Smooth transition on hover */
}

.site-footer .footer-links a:hover {
    color: #088395; /* Aqua blue for links on hover */
}

.site-footer .footer-divider {
    border-top: 1px solid #1f2933; /* Dark charcoal divider between sections */
    margin: 30px 0;
}

.site-footer .footer-bottom {
    color: #1f2933; /* Dark charcoal color for footer bottom text */
    font-size: 12px; /* Smaller text for copyright */
    margin-top: 20px;
}

.site-footer .footer-bottom a {
    color: #088395; /* Aqua blue for links in the bottom section */
    text-decoration: none; /* Remove underline from links */
}

.site-footer .footer-bottom a:hover {
    color: #09637E; /* Deep teal for links on hover */
}

@media (max-width: 767px) {
    .site-footer .container {
        padding: 0 20px; /* Add padding for small screens */
    }
    .site-footer .footer-title {
        text-align: center; /* Center-align the titles on smaller screens */
    }
    .site-footer .footer-links {
        text-align: center; /* Center-align the links */
    }
}
    </style>
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
