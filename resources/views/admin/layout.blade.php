<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BTMG Admin Panel</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Admin Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<div class="d-flex">

    <!-- Sidebar -->
   <div class="sidebar bg-dark text-white  p-3" style="width:280px;">
        <h3 class="mb-4">BTMG Trainings</h3>
        <nav class="nav flex-column">

            <a class="nav-link text-white fw-bold" href="{{ route('admin.dashboard') }}">Dashboard</a>

            <a class="nav-link text-white" href="{{ route('admin.courses.index') }}">Your Courses</a>
            <a class="nav-link text-white" href="{{ route('admin.courses.index') }}">Manage Courses</a>
            <a class="nav-link text-white" href="{{ route('admin.launch-dates.index') }}">
    Course Launch Dates
</a>

            
<li class="nav-item">
    <a class="nav-link text-white" href="{{ route('admin.categories.index') }}">
        <i class="fas fa-tags"></i> Categories
    </a>
</li>



            <div class="mt-3">
                <span class="text-muted small">Enrollments & Inquiries</span>
               <a class="nav-link text-white ms-2" href="{{ route('admin.course-enrollments.index') }}">
    Course Enrollments <span class="badge bg-primary">6</span>
</a>

                <a class="nav-link text-white ms-2" href="{{ route('admin.course-inquiries.index') }}">
    Course Inquiries <span class="badge bg-primary">4</span>
</a>


            </div>

            <div class="mt-3">
                <span class="text-muted small">Contact Us</span>
                <a class="nav-link text-white ms-2" href="{{ route('admin.contact-leads.index') }}">
    Contact Leads <span class="badge bg-primary">1</span>
</a>

            </div>

           <div class="mt-4">
    
    <!-- Main Heading (Not Clickable) -->
    <span class="text-white small text-uppercase">New Settlers</span>

    <!-- Sub Link -->
   <a class="nav-link text-white" href="{{ route('admin.subscribers.index') }}">
    Subscribers
</a>

</div>


        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1 p-4 bg-light">
        @yield('content')
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>