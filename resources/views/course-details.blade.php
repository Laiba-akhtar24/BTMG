<style>
   :root {
    --theme-color: #007BFF;       /* primary blue */
    --theme-color-light: #87CEFA; /* sky blue */
    --theme-color-dark: #0056b3;  /* darker blue for hover */
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Hide sidebar and footer on this page */
.sidebar,
.footer,
aside,
footer,
[class*="sidebar"],
[class*="footer"] {
    display: none !important;
}

/* PDF layout */
.pdf-layout .course-grid {
    display: block !important;
}
.pdf-layout .course-left,
.pdf-layout .course-right {
    width: 100% !important;
    margin-bottom: 20px !important;
}

/* Print styles */
@media print {
    .sidebar,
    .footer,
    header,
    nav,
    aside,
    [class*="sidebar"],
    [class*="footer"],
    [class*="header"],
    [class*="nav"],
    .top-action-bar {
        display: none !important;
    }

    a[class*="btn"],
    a.btn-primary,
    a.btn-outline,
    .action-buttons a,
    .training-buttons a {
        text-decoration: none !important;
        border: none !important;
        background: none !important;
        color: inherit !important;
        padding: 0 !important;
        margin: 0 !important;
        font-weight: inherit !important;
        display: inline !important;
        cursor: default !important;
        pointer-events: none !important;
    }

    a[class*="btn"] svg,
    .btn-primary svg,
    .btn-outline svg,
    .action-buttons svg,
    .training-buttons svg {
        display: none !important;
    }

    #pdf-content,
    #pdf-content * {
        visibility: visible !important;
    }

    .course-grid {
        display: block !important;
    }
    .course-left,
    .course-right {
        width: 100% !important;
        margin-bottom: 20px !important;
    }

    a {
        text-decoration: none !important;
    }

    *:hover, *:focus {
        outline: none !important;
    }
}

/* Prevent page breaks inside main sections */
.course-grid, .learn-card, .upcoming-card {
    page-break-inside: avoid;
}
.course-header, .learn-heading, .upcoming-heading {
    page-break-after: avoid;
}

/* Style for the date container in upcoming trainings */
.training-date {
    background-color: #ffffff;
}

/* Buttons */
a.btn-primary,
.training-buttons a.btn-primary,
.action-buttons a.btn-primary {
    background-color: var(--theme-color);
    border-color: var(--theme-color);
    color: #fff;
    cursor: pointer;
    border-radius: 6px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

a.btn-outline,
.training-buttons a.btn-outline,
.action-buttons a.btn-outline {
    background-color: transparent;
    border: 2px solid var(--theme-color);
    color: var(--theme-color);
    cursor: pointer;
    border-radius: 6px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

a.btn-primary:hover,
a.btn-outline:hover {
    background-color: var(--theme-color-dark);
    border-color: var(--theme-color-dark);
    color: #fff;
}

/* Badges */
.badge,
.badge-pill {
    background-color: var(--theme-color);
    color: #fff;
    font-weight: 500;
}

/* SVG icons */
svg {
    stroke: var(--theme-color);
}

/* Consent & disclaimer highlights */
.consent-box .btmg-text {
    color: var(--theme-color);
}

/* Top action bar icons */
.top-action-bar a.action-link svg {
    stroke: var(--theme-color);
}

/* PDF download button */
.pdf-btn {
    background-color: var(--theme-color);
    color: #fff;
}

/* Hover/focus for links */
a:hover,
a:focus {
    color: var(--theme-color-dark);
}

/* Meta info icons in course description */
.course-meta svg {
    stroke: var(--theme-color);
}

/* Snapshot card highlights */
.snapshot-card .snapshot-detail svg {
    stroke: var(--theme-color);
}

/* Training meta tags */
.training-meta svg {
    stroke: var(--theme-color);
}
.meta-tag {
    color: var(--theme-color);
}

/* Inquiry & register modals buttons */
.register-form button,
#inquiryModal button,
.register-btn {
    background-color: var(--theme-color);
    color: #fff;
    border-radius: 6px;
    border: none;
    cursor: pointer;
}

.register-form button:hover,
#inquiryModal button:hover {
    background-color: var(--theme-color-dark);
}

/* Optional light accent for card highlights */
.learn-card,
.upcoming-card {
    border-left: 4px solid var(--theme-color-light);
    padding: 15px 20px;
    margin-bottom: 20px;
}
/* PDF download button */
.pdf-btn {
    background-color: var(--theme-color); /* full blue */
    color: #fff;
    padding: 10px 25px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    text-decoration: none;
}

.pdf-btn:hover {
    background-color: var(--theme-color-dark); /* darker blue on hover */
    color: #fff;
}




</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

@php
    $noSidebar = true;
    $noFooter = true;
@endphp

@extends('layouts.app')

@section('content')
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
                    {!! nl2br(e($course['description'] ?? 'Create charts and graphs to visualize data, apply formatting, sort data, and perform basic data analysis.')) !!}
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
                            <circle cx="12" cy="12" r="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"/>
                        </svg>
                        <span>Duration: {{ $course['duration'] ?? '6 Weeks' }}</span>
                    </div>

                    <div class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="orange" stroke-width="2">
                            <rect x="3" y="4" width="18" height="14" rx="2" ry="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2 20h20"/>
                        </svg>
                        <span>Mode: {{ $course['mode'] ?? 'Online' }}</span>
                    </div>
                </div>

                <!-- ACTION BUTTONS -->
                <div class="action-buttons">
                    <a href="#upcoming" class="btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="orange" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 2v4M8 2v4M3 10h18"/>
                        </svg>
                        Check Availability
                    </a>
                    <a class="btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="orange" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        Inquiry
                    </a>
                </div>
            </div>

            <!-- RIGHT COLUMN (SNAPSHOT) -->
            <div class="course-right">
                <div class="snapshot-card">
                    <h4 class="snapshot-heading">
                        <i class="fas fa-book-open"></i> Course Snapshot
                    </h4>

                    <div class="snapshot-price">
                        ${{ $course['price'] ?? '299' }}
                    </div>

                    <div class="snapshot-detail">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="orange" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v18M5 3l14 0-4 6 4 6H5"/>
                        </svg>
                        <span>Level: <span class="font-medium">{{ $course['level'] ?? 'Beginner' }}</span></span>
                    </div>

                    <div class="snapshot-detail">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="orange" stroke-width="2">
                            <circle cx="12" cy="12" r="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"/>
                        </svg>
                        <span>Duration: <span class="font-medium">{{ $course['duration'] ?? '6 Weeks' }}</span></span>
                    </div>

                    <div class="snapshot-detail">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="orange" stroke-width="2">
                            <rect x="3" y="4" width="18" height="14" rx="2" ry="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2 20h20"/>
                        </svg>
                        <span>Mode: <span class="font-medium">{{ $course['mode'] ?? 'Online' }}</span></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Show topics -->
<div class="learn-card">
    <h2 class="learn-heading">What you will learn?</h2>
    <ul class="learn-list">
        @forelse($topics as $topic)
            <li>
                <strong>{{ $topic['title'] ?? 'Untitled' }}</strong> – 
                {!! nl2br(e($topic['description'] ?? '')) !!}
            </li>
        @empty
            <li>Introduction and basic overview of the course topics.</li>
        @endforelse
    </ul>
</div>

        <!-- UPCOMING TRAININGS SECTION (WHITE CARD) -->
        <div class="upcoming-card" id="upcoming">
            <h2 class="upcoming-heading">Upcoming Trainings</h2>

            @forelse($upcomingTrainings as $launch)
    @php
        $date = \Carbon\Carbon::parse($launch['launch_date']);
    @endphp
    <div class="training-item">
        <div class="training-date">
            <div class="date-day">{{ $date->format('d') }}</div>
            <div class="date-month-year">{{ $date->format('M Y') }}</div>
        </div>
        <div class="training-details">
            <div class="training-title">{{ $launch['course_name'] }}</div>
            <div class="training-meta">
                <span class="meta-tag">Virtual</span>
                <span class="meta-tag">Duration: {{ $course['duration'] ?? '6 Weeks' }}</span>
                <span class="meta-tag">Level: {{ $launch['level'] ?? 'Beginner' }}</span>
                <div class="training-buttons">
                    <a href="#" class="btn-outline">Inquiry</a>
                    <a href="#" class="btn-primary register-btn">Register Now</a>
                </div>
            </div>
        </div>
    </div>
@empty
    <p>No upcoming trainings scheduled.</p>
@endforelse

        </div>
        <!-- TOP ACTION BAR: Download PDF, Print, Back to Courses -->
        <div class="top-action-bar">
            <div class="action-left">
                <a href="#" class="action-link" id="downloadPdf">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17v2a2 2 0 002 2h14a2 2 0 002-2v-2" />
                        <rect x="3" y="4" width="18" height="12" rx="2" ry="2" stroke="currentColor or blue" />
                    </svg>
                    <button onclick="downloadPDF()" class="pdf-btn">Download PDF</button>
                </a>
                <a href="#" class="action-link" onclick="window.print(); return false;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Print
                </a>
            </div>
            <div class="action-right">
               <a href="{{ route('frontend.courses') }}" class="back-link">

                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Courses
                </a>
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