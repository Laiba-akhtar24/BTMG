@props(['route', 'label'])

<!-- ✅ Updated to handle frontend course route -->
<a href="{{ route($route) }}" class="{{ Request::routeIs($route) ? 'active' : '' }}">
    {{ $label }}
</a>
