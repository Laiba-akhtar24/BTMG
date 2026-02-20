<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
    <div class="container">

        {{-- Logo (Left Side) --}}
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="BTMG Logo" height="50">
        </a>

        {{-- Mobile Toggle --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">

            {{-- Center Navigation Links --}}
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}" 
                       href="{{ route('home') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('frontend.courses') ? 'active' : '' }}" 
                       href="{{ route('frontend.courses') }}">Courses</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('about') ? 'active' : '' }}" 
                       href="{{ route('about') }}">About Platform</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('why-us') ? 'active' : '' }}" 
                       href="{{ route('why-us') }}">Why Choose Us</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('testimonials') ? 'active' : '' }}" 
                       href="{{ route('testimonials') }}">Testimonials</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('contact.store') ? 'active' : '' }}" 
                       href="{{ route('contact.store') }}">Contact Us</a>
                </li>

            </ul>

           {{-- Right Side Join Us Button --}}
<div class="d-flex">
    <a href="{{ route('frontend.courses') }}" class="btn btn-primary px-4">Join Us</a>
</div>
        </div>
    </div>
</nav>