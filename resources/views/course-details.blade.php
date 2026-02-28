<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

@php
    $noSidebar = true;
    $noFooter = true;
@endphp

@extends('layouts.app')

@section('content')

<style>

/* ===============================
GEN-Z PROFESSIONAL UI (SAFE)
=============================== */
/* ===============================
GEN-Z PROFESSIONAL UI (SAFE)
=============================== */

body {
    background: linear-gradient(180deg, #f8fafc, #eef3f9);
}

.course-detail-page {
    max-width: 1300px;
    margin: auto;
    padding: 40px 20px;
}

.course-detail-wrapper {
    background: transparent;
}

/* header */
.course-header {
    margin-bottom: 30px;
}

/* Update Badge Style */
.badge {
    background: #EBF4F6;  /* Light soft blue background to match the theme */
    color: #09637E;  /* Deep teal text */
    padding: 6px 16px;
    border-radius: 999px;
    font-weight: 700;
    font-size: 13px;
}

.course-title {
    font-size: 50px;
    font-weight: 800;
    margin-top: 12px;
    color: #0f172a;
}

/* grid */
.course-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 30px;
}

@media (max-width: 900px) {
    .course-grid {
        grid-template-columns: 1fr;
    }
}

/* cards */
.course-left,
.snapshot-card,
.learn-card,
.upcoming-card {
    background: white;
    border-radius: 18px;
    padding: 28px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
    transition: .25s;
}

.course-left:hover,
.snapshot-card:hover,
.learn-card:hover,
.upcoming-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.10);
}

/* snapshot */
.snapshot-card {
    background: #f8fafc; /* Soft light background for the snapshot */
}

.snapshot-price {
    font-size: 36px;
    font-weight: 800;
    color: #09637E; /* Deep teal for price */
    margin-bottom: 10px;
}

.snapshot-detail {
    margin-top: 8px;
    display: flex;
    gap: 6px;
    align-items: center;
    color: #1f2933; /* Dark charcoal for text */
}

/* buttons */
.btn-primary {
    background: linear-gradient(135deg, #09637E, #088395); /* Deep teal to aqua blue */
    color: white !important;
    padding: 12px 22px;
    border-radius: 999px;
    font-weight: 700;
    border: none;
    transition: .25s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-primary:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 25px rgba(0, 0, 0, .1);
}

.btn-outline {
    border: 2px solid #088395; /* Aqua blue outline */
    color: #088395;
    padding: 10px 20px;
    border-radius: 999px;
    font-weight: 700;
    background: white;
    transition: .25s;
}

.btn-outline:hover {
    background: #088395; /* Aqua blue background on hover */
    color: white;
}

/* action bar */
.top-action-bar {
    margin-top: 30px;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
}

.action-link {
    background: white;
    padding: 10px 18px;
    border-radius: 999px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, .05);
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-weight: 600;
}

.action-link:hover {
    box-shadow: 0 12px 30px rgba(0, 0, 0, .1);
}

/* modal button color adjustments */
.submit-registration {
    background: linear-gradient(135deg, #09637E, #088395); /* Same deep teal to aqua blue */
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 10px;
    font-weight: 700;
    cursor: pointer;
}

.submit-registration:hover {
    opacity: .9;
}

/* icon styles */
/* Update icon colors to Deep Teal */
.meta-item svg {
    stroke: #09637E;  /* Deep teal for icons */
}
.snapshot-detail svg{
    stroke: #09637E; 
}
/* ===============================
What You Will Learn Section Styling
=============================== */

.learn-card {
    background: #EBF4F6; /* Soft light blue background */
    padding: 30px;  /* Padding for better spacing */
    border-radius: 18px;  /* Rounded corners */
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.05); /* Soft shadow for prominence */
    transition: box-shadow .3s ease, transform .3s ease;
}

.learn-card:hover {
    transform: translateY(-5px); /* Lift effect on hover */
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1); /* Enhanced shadow on hover */
}

.learn-heading {
    font-size: 35px;  /* Larger font size for the heading */
    font-weight: 800;  /* Strong weight for emphasis */
    color: #09637E;  /* Deep teal for the heading */
    margin-bottom: 20px;  /* Space below the heading */
    text-align: left;  /* Centered heading */
    text-transform: uppercase;  /* Uppercase for formal tone */
    letter-spacing: 1px;  /* Slight letter spacing for elegance */
}

.learn-list {
    font-size: 30px;  /* Font size for list items */
    color: #1f2933;  /* Dark charcoal text color */
    line-height: 1.8;  /* Increased line-height for better readability */
    margin-top: 20px;
}

.learn-list li {
    margin-bottom: 15px;  /* Space between list items */
    padding-left: 25px;  /* Indentation for clean list look */
    position: relative;  /* Position for icon */
    background-color: #ffffff;  /* White background for each list item */
    border-radius: 12px;  /* Rounded corners for the list item */
    padding: 12px 20px;  /* Padding for better spacing */
    transition: background-color 0.3s ease, transform 0.3s ease;  /* Smooth transition effects */
}



.learn-list li::before {
     /* Bullet point */
    color: #088395;  /* Aqua blue bullet for consistency */
    font-size: 24px;  /* Larger bullet */
    position: absolute;
    left: 0;  /* Position bullet to the left */
    top: 50%;
    transform: translateY(-50%);  /* Vertically center the bullet */
}

.learn-list li strong {
    font-weight: 700;  /* Bold the topic title */
}

.learn-list li span {
    color: #475569;  /* Light gray color for the description text */
}

/* Action buttons (in the topic section) */
.learn-list a {
    color: #09637E;  /* Deep teal for links */
    text-decoration: none;
    font-weight: 600;
    padding-left: 10px;  /* Space between text and the link */
    transition: color 0.3s ease;
}

.learn-list a:hover {
    color: #088395;  /* Aqua blue for links on hover */
}

/* ================================
INQUIRY AND REGISTER MODAL STYLING
=============================== */

.modal {
    display: none; /* Initially hidden */
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
    padding-top: 60px; /* Center modal vertically */
    
}

.modal-content {
    background-color: #fff;
    margin: 5% auto;
    padding: 20px;
    border-radius: 15px;
    width: 80%;
    max-width: 600px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Modal Close Button */
.modal-close {
    color: #09637E; /* Deep teal close icon */
    font-size: 36px;
    font-weight: bold;
    position: absolute;
    right: 20px;
    top: 20px;
    cursor: pointer;
}

.modal-close:hover {
    color: #088395; /* Aqua blue on hover */
}

/* Header Styling */
h3 {
    color: #09637E; /* Deep teal color for headings */
    font-size: 24px;
    font-weight: 800;
    margin-bottom: 20px;
}

h4 {
    font-weight: 600;
    margin-top: 20px;
    margin-bottom: 10px;
    color: #1f2933; /* Dark charcoal for the sub-heading */
}

footer {
    margin-top: 20px;
    font-size: 12px;
    color: #1f2933; /* Dark charcoal */
}

/* Course meta section (icons and details) */
.modal-content div {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin: 10px 0 20px;
}

.modal-content span {
    display: flex;
    align-items: center;
    gap: 5px;
}

.modal-content svg {
    stroke: #088395; /* Aqua blue color for icons */
}

.modal-content svg:hover {
    stroke: #09637E; /* Deep teal on hover */
}

/* Form Styling */
input, textarea, select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
}

input[type="checkbox"] {
    margin-top: 5px;
}

label {
    color: #1f2933; /* Dark charcoal for labels */
    font-weight: 600;
    margin-bottom: 5px;
    display: block;
}

button[type="submit"] {
    background: linear-gradient(135deg, #09637E, #088395); /* Gradient from deep teal to aqua blue */
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 6px;
    font-weight: 700;
    cursor: pointer;
    width: 100%;
}

button[type="submit"]:hover {
    background: linear-gradient(135deg, #088395, #09637E); /* Reverse gradient on hover */
}

/* Consent & Disclaimer Section */
.consent-box {
    background: #EBF4F6; /* Soft light blue background */
    padding: 15px;
    border-radius: 10px;
    margin-top: 15px;
    border: 1px solid #09637E; /* Deep teal border */
}

.consent-text {
    color: #1f2933; /* Dark charcoal for text */
}

.consent-check input[type="checkbox"] {
    margin-right: 10px;
}

/* Footer Section */
.submit-note {
    color: #555;
    margin-top: 15px;
    font-size: 14px;
}

.submit-note a {
    color: #088395; /* Aqua blue for clickable links */
}

.submit-note a:hover {
    color: #09637E; /* Deep teal on hover */
}

/* Alert for success */
.alert-success {
    background-color: #d4edda; /* Light green for success */
    color: #155724; /* Dark green text */
    border-color: #c3e6cb; /* Light green border */
    padding: 15px;
    border-radius: 5px;
    margin-top: 10px;
}
</style>

<div class="course-detail-page" id="pdf-content">
    <div class="course-detail-wrapper">
        <!-- HEADER -->
        <div class="course-header">
            <span class="badge">BTMG USA Professional Trainings</span>
            <h1 class="course-title">{{ $course['name'] ?? 'Microsoft Excel Intro' }}</h1>
        </div>

        <!-- GRID -->
        <div class="course-grid">
            <!-- LEFT COLUMN -->
            <div class="course-left">
                <!-- DESCRIPTION -->
                <div class="course-description">
                    {!! $course['description'] ?? 'Create charts and graphs to visualize data, apply formatting, sort data, and perform basic data analysis.' !!}
                </div>

                <!-- META INFO BELOW DESCRIPTION -->
                <div class="course-meta">
                    <div class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="orange" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v18M5 3l14 0-4 6 4 6H5"/>
                        </svg>
                        <span>Level: {{ $course['level'] ?? 'Beginner' }}</span>
                    </div>

                    <div class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="orange" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 6v6l4 2"/>
                        </svg>
                        <span>Duration: {{ $course['duration'] ?? '6 Weeks' }}</span>
                    </div>

                    <div class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="orange" stroke-width="2">
                            <rect x="3" y="4" width="18" height="14" rx="2"/>
                            <path d="M2 20h20"/>
                        </svg>
                        <span>Mode: {{ $course['mode'] ?? 'Online' }}</span>
                    </div>
                </div>

                <!-- ACTION BUTTONS -->
            </div>

            <!-- RIGHT COLUMN -->
            <div class="course-right">
                <div class="snapshot-card">

                    <h4>Course Snapshot</h4>

                    <div class="snapshot-price">
                        ${{ $course['price'] ?? '299' }}
                    </div>

                    <div class="snapshot-detail">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="orange" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v18M5 3l14 0-4 6 4 6H5"/>
                        </svg>
                        Level: {{ $course['level'] ?? 'Beginner' }}
                    </div>

                    <div class="snapshot-detail">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="orange" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 6v6l4 2"/>
                        </svg>
                        Duration: {{ $course['duration'] ?? '6 Weeks' }}
                    </div>

                    <div class="snapshot-detail">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="orange" stroke-width="2">
                            <rect x="3" y="4" width="18" height="14" rx="2"/>
                            <path d="M2 20h20"/>
                        </svg>
                        Mode: {{ $course['mode'] ?? 'Online' }}
                    </div>
                    <div class="training-buttons">

                        <a href="#" class="btn-outline">Inquiry</a>

                        <a href="#" class="btn-primary register-btn">
                            Register Now
                        </a>

                    </div>
                </div>
            </div>
        </div>

        <!-- topics -->
        <div class="learn-card">
            <h2 class="learn-heading">What You Will Learn?</h2>

            <ul class="learn-list">
                @forelse($topics as $topic)

                <li>
                    <strong>{{ $topic['title'] ?? 'Untitled' }}</strong>
                    –
                   {!! $topic['description'] ?? '' !!}
                </li>

                @empty

                <li>Introduction and basic overview of the course topics.</li>

                @endforelse
            </ul>

        </div>

        <!-- UPCOMING -->
        

        <!-- ACTION BAR -->
        <div class="top-action-bar">

            <div class="action-left">

                <a href="#" class="action-link" id="downloadPdf">

                    <button onclick="downloadPDF()" class="pdf-btn">
                        Download PDF
                    </button>

                </a>

                <a href="#" class="action-link" onclick="window.print(); return false;">
                    Print
                </a>

            </div>

            <div class="action-right">

                <a href="{{ route('frontend.courses') }}" class="back-link">
                    Back to Courses
                </a>

            </div>

        </div>

    </div>
</div>



<!-- INQUIRY MODAL (matches the image exactly) -->
<!-- INQUIRY MODAL (matches the image exactly) -->
<div id="inquiryModal" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h3>Inquiry about {{ $course['name'] ?? '' }}</h3>


        <!-- Course meta as in the image -->
        <div style="display: flex; justify-content: center; gap: 20px; margin: 10px 0 20px;">
            <span style="display: flex; align-items: center; gap: 5px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="orange" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                </svg>
                20 Hours
            </span>
            <span style="display: flex; align-items: center; gap: 5px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="orange" stroke-width="2">
                    <path d="M5 3v18M5 3l14 0-4 6 4 6H5"/>
                </svg>
                Advanced
            </span>
        </div>

        <h4 style="font-weight: 600; margin: 20px 0 5px;">Course Inquiry</h4>
        <p style="color: #555; margin-bottom: 20px;">Share your questions and our BTMG USA team will get back to you.</p>

        <form action="{{ route('admin.course-inquiry.store') }}" method="POST">
    @csrf

    <input type="hidden" name="course_name" value="{{ $course['name'] ?? '' }}">

    <!-- Full Name -->
    <div style="text-align: left; margin-bottom: 15px;">
        <label>Full Name</label>
        <input type="text" name="name" placeholder="Your full name" style="width:100%;" required>
    </div>

    <!-- Email -->
    <div style="text-align: left; margin-bottom: 15px;">
        <label>Email</label>
        <input type="email" name="email" placeholder="your.email@example.com" style="width:100%;" required>
    </div>

    <!-- Phone -->
    <div style="text-align: left; margin-bottom: 15px;">
        <label>Phone (Optional)</label>
        <input type="tel" name="phone" placeholder="+1 (123) 456-7890" style="width:100%;">
    </div>

    <!-- Message -->
    <div style="text-align: left; margin-bottom: 20px;">
        <label>Message</label>
        <textarea name="message" rows="4" style="width:100%;" required></textarea>
    </div>

    <div style="margin:20px 0;">
        <input type="checkbox" required>
        <label>I confirm that all information provided is accurate.</label>
    </div>

    <button type="submit"
        style="background-color: orange; color: white; padding: 10px 25px; border: none; border-radius: 6px; cursor: pointer;">
        Submit Inquiry
    </button>
</form>

    </div>
</div>
<!-- REGISTER MODAL -->
<!-- REGISTER MODAL -->
<div id="registerModal" class="register-modal">
    <div class="register-content">

        <span class="register-close">&times;</span>

        <!-- HEADER -->
        <div class="register-header">
            <h2>Enroll in {{ $course['name'] ?? 'Microsoft Excel Intro' }}</h2>

            <div class="register-badges">
                <span class="badge-pill">15 Days</span>
                <span class="badge-pill">Beginner</span>
                <span class="badge-pill">Starts: 2026-02-25</span>
            </div>
        </div>

        <div class="register-divider"></div>

        <!-- BODY -->
        <div class="register-body">

            <h3>Student Registration</h3>
            <p class="register-sub">
                Fill the form below. A BTMG USA coordinator will confirm schedule and payment details.
            </p>

            <form class="register-form" action="{{ route('frontend.course.register') }}" method="POST">
    @csrf
    <input type="hidden" name="course_id" value="{{ $course['_id'] }}">

    <input type="hidden" name="course_name" value="{{ $course['name'] ?? '' }}">


                <div class="form-row">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" placeholder="Your full name" required>

                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="name@email.com" required>

                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Phone (Optional)</label>
                        <input type="tel" name="phone" placeholder="+1 (___) ___-____">

                    </div>

                    <div class="form-group">
                        <label>Registration Type</label>
                        <select name="registration_type">

                            <option>Individual</option>
                            <option>Corporate</option>
                        </select>
                    </div>
                </div>

                <div class="form-group full">
                    <label>Message (Optional)</label>
                   <textarea name="message" rows="4"></textarea>

                </div>

                <!-- CONSENT & DISCLAIMER -->
<div class="consent-box">
    <div class="consent-check">
        <input type="checkbox" id="consentCheck" required>
    </div>
    <div class="consent-text">
        <h4>Consent & Disclaimer</h4>
        <p>
            I confirm that all information provided is accurate.<br>
            I agree that my information will be used by 
            <span class="btmg-text">BTMG</span> solely for educational and enrollment purposes.<br>
            I understand that my data will not be shared with any third-party organizations.
        </p>
    </div>
</div>

<button type="submit" class="submit-registration">
    Submit Registration
</button>

<p class="submit-note">
    By submitting, you agree to be contacted by BTMG USA for scheduling and payment coordination.
</p>


            </form>
        </div>

    </div>
</div>

@if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif

</div>

<script>
function downloadPDF() {
    const element = document.getElementById('pdf-content');
    const actionBar = document.querySelector('.top-action-bar');
    
    // Store original buttons and their replacements
    const buttonReplacements = [];
    
    // Find all button links
    const buttons = element.querySelectorAll('a.btn-primary, a.btn-outline, .action-buttons a, .training-buttons a');
    
    // Replace each anchor with a plain text span (no link, no icon)
    buttons.forEach(btn => {
        // Get the text content (e.g., "Inquiry", "Register Now", "Check Availability")
        const text = btn.textContent.trim();
        const span = document.createElement('span');
        span.textContent = text;
        // Add a class to match any styling (optional)
        span.style.fontWeight = 'inherit';
        span.style.color = 'inherit';
        span.style.textDecoration = 'none';
        
        // Store original and replacement
        buttonReplacements.push({
            original: btn,
            replacement: span
        });
    });
    
    // Replace each anchor with its plain text span
    buttonReplacements.forEach(item => {
        item.original.parentNode.replaceChild(item.replacement, item.original);
    });
    
    // Hide action bar
    if (actionBar) {
        actionBar.dataset.originalDisplay = actionBar.style.display;
        actionBar.style.display = 'none';
    }
    
    // Add PDF layout class for stacking
    element.classList.add('pdf-layout');
    
    const opt = {
        margin:       0.5,
        filename:     'course-details.pdf',
        image:        { type: 'jpeg', quality: 1 },
        html2canvas:  { scale: 2, scrollY: 0 },
        jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
    };
    
    html2pdf().set(opt).from(element).save().then(() => {
        // Restore original buttons
        buttonReplacements.forEach(item => {
            item.replacement.parentNode.replaceChild(item.original, item.replacement);
        });
        
        // Restore action bar
        if (actionBar) {
            actionBar.style.display = actionBar.dataset.originalDisplay || '';
            delete actionBar.dataset.originalDisplay;
        }
        
        // Remove PDF layout class
        element.classList.remove('pdf-layout');
    });
}
</script>
<script>
// Get the modal
var modal = document.getElementById('inquiryModal');
var closeBtn = document.querySelector('.modal-close');

// Open modal when any "Inquiry" button/link is clicked
document.querySelectorAll('a, button').forEach(function(el) {
    if (el.textContent.trim() === 'Inquiry') {
        el.addEventListener('click', function(e) {
            e.preventDefault();
            modal.style.display = 'flex';
        });
    }
});

// Close modal when × is clicked
closeBtn.onclick = function() {
    modal.style.display = 'none';
}

// Close modal when clicking outside of it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>
<script>
var registerModal = document.getElementById("registerModal");
var registerClose = document.querySelector(".register-close");

document.querySelectorAll(".register-btn").forEach(btn => {
    btn.addEventListener("click", function(e) {
        e.preventDefault();
        registerModal.style.display = "flex";
    });
});

registerClose.onclick = function() {
    registerModal.style.display = "none";
};

window.onclick = function(e) {
    if (e.target === registerModal) {
        registerModal.style.display = "none";
    }
};
</script>


@endsection 