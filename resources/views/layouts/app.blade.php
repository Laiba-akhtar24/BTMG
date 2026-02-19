<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BTMG Training</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-KyZXEAg3QhqLMpG8r+Knujsl5+5hb7MFmYf6T8l6u8o9kz3nI4aE0u+Vf7o1+8e3f0+3uB+0yMNdFZ88bZew2Mw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="d-flex">
    {{-- Sidebar Component --}}
    @if (!Request::routeIs('course.details'))
        <x-sidebar />
    @endif

    {{-- Page Content --}}
    <div class="content flex-grow-1">
        @yield('content')

        {{-- GLOBAL FOOTER --}}
        @if (!Request::routeIs('course.details'))
            <x-footer />
        @endif
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
