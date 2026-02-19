<div class="sidebar">
    {{-- Logo --}}
    <a href="{{ route('home') }}">
        <img src="{{ asset('images/logo.png') }}" alt="BTMG Logo" class="sidebar-logo">
    </a>

    {{-- Sidebar Links --}}
    <x-sidebar-link route="home" label="Home" />
   <x-sidebar-link route="frontend.courses" label="Courses" />

    <x-sidebar-link route="about" label="About Platform" />
    <x-sidebar-link route="why-us" label="Why Choose Us" />
    <x-sidebar-link route="testimonials" label="Testimonials" />
    <x-sidebar-link route="contact.store" label="Contact Us" />
</div>
