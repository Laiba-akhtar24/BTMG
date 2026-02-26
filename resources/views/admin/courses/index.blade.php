@extends('admin.layout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/manage-courses.css') }}">

<div class="container-fluid py-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Manage Courses</h2>
        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
            + Add New Course
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Courses Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body">

            @if(isset($courses) && count($courses) > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Level</th>
                                <th>Category</th>
                                <th>Duration</th>
                                <th>Price</th>
                                <th>Sort</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach(collect($courses)->sortBy('sort', SORT_NUMERIC) as $course)
                                @php
                                    $image = $course['image'] ?? 'https://via.placeholder.com/80x50';
                                    $name = $course['name'] ?? '-';
                                    $skills = $course['skills'] ?? '';
                                    $level = $course['level'] ?? '-';
                                    $category = $course['category'] ?? '-';
                                    $duration = $course['duration'] ?? '-';
                                    $price = $course['price'] ?? 0;
                                    $sort = $course['sort'] ?? '-';
                                    $status = $course['status'] ?? 'Inactive';
                                @endphp
                                <tr data-course-id="{{ $course['_id'] }}">
                                    <!-- Course Image -->
                                    <td>
                                        <img src="{{ $image }}" 
                                             alt="{{ $name }}" 
                                             class="rounded" 
                                             width="80" height="50" 
                                             style="object-fit:cover;">
                                    </td>

                                    <!-- Course Name + Skills -->
                                    <td class="text-start">
                                        <div class="fw-semibold">
                                            {{ $name }}
                                        </div>

                                        @if(!empty($skills))
                                            <div style="font-size:0.8rem; color:#6c757d; margin-top:3px;">
                                                {{ $skills }}
                                            </div>
                                        @endif
                                    </td>

                                    <td>{{ $level }}</td>
                                    <td>{{ $category }}</td>
                                    <td>{{ $duration }}</td>
                                    <td>Rs {{ number_format((float)$price) }}</td>
                                    <td>{{ $sort }}</td>

                                    <!-- Status -->
                                    <td>
                                        @if($status == 'Active')
                                            <span class="badge bg-success status-badge" data-status="Active">Active</span>
                                        @else
                                            <span class="badge bg-secondary status-badge" data-status="Inactive">Inactive</span>
                                        @endif
                                    </td>

                                    <!-- Actions -->
                                    <td>
                                        <div class="d-flex flex-column align-items-start gap-1">

                                            <!-- Edit -->
                                            <a href="{{ route('admin.courses.edit', $course['_id']) }}" 
                                               class="btn btn-sm" 
                                               style="background-color:#fef3c7; color:#92400e; font-size:0.75rem; padding:0.25rem 0.5rem;">
                                                Edit
                                            </a>

                                            <!-- Topics -->
                                            @php
                                                $topicsRouteExists = \Route::has('admin.courses.topics');
                                            @endphp
                                            <a href="{{ $topicsRouteExists ? route('admin.courses.topics', $course['_id']) : '#' }}" 
                                               class="btn btn-sm" 
                                               style="background-color:#dbeafe; color:#1e40af; font-size:0.75rem; padding:0.25rem 0.5rem;">
                                                Topics
                                            </a>

                                            <!-- Delete -->
                                            <form action="{{ route('admin.courses.destroy', $course['_id']) }}" 
                                                  method="POST" 
                                                  style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm"
                                                        style="background-color:#fee2e2; color:#991b1b; font-size:0.75rem; padding:0.25rem 0.5rem;"
                                                        onclick="return confirm('Are you sure you want to delete this course?')">
                                                        Delete
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center text-muted py-4">
                    No courses available.
                </div>
            @endif

        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Status badge toggle (simulate instant toggle)
    document.querySelectorAll('.status-badge').forEach(function(badge) {
        badge.addEventListener('click', function() {
            if (badge.dataset.status === 'Active') {
                badge.dataset.status = 'Inactive';
                badge.classList.remove('bg-success');
                badge.classList.add('bg-secondary');
                badge.textContent = 'Inactive';
            } else {
                badge.dataset.status = 'Active';
                badge.classList.remove('bg-secondary');
                badge.classList.add('bg-success');
                badge.textContent = 'Active';
            }
        });
    });
});
</script>

@endsection