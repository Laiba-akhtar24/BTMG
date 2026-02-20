@extends('admin.layout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/launch-dates.css') }}">

<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Course Launch Dates</h2>
        <a href="{{ route('admin.launch-dates.create') }}" class="btn btn-primary">
            + Add
        </a>
    </div>

    <!-- Courses Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body">

            @if(isset($courses) && count($courses) > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Course</th>
                            <th>Level</th>
                            <th>Launch Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                        <tr data-course-id="{{ $course['_id'] }}">
                            <td>{{ $course['name'] ?? '-' }}</td>
                            <td>{{ $course['level'] ?? '-' }}</td>
                            <td>
                                {{ isset($course['launch_date']) ? date('d M Y', strtotime($course['launch_date'])) : '-' }}
                            </td>

                            <!-- ✅ Action Column -->
                            <td>
                                <div class="d-flex align-items-center justify-content-center gap-2 flex-nowrap">

                                    <!-- Enrollments -->
                                    <span class="badge bg-secondary">
                                        Enroll: {{ $course['enrollments'] ?? 0 }}
                                    </span>

                                    <!-- Inquiries -->
                                    <span class="badge bg-info text-dark">
                                        Inq: {{ $course['inquiries'] ?? 0 }}
                                    </span>

                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.launch-dates.edit', $course['_id']) }}" 
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.launch-dates.destroy', $course['_id']) }}" 
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this record?')"
                                          style="margin:0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
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
                No launch dates available.
            </div>
            @endif

        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Just an example JS placeholder
    // You can add future JS here without changing any routes or functionality
    console.log("Launch Dates page loaded. JS ready.");
});
</script>

@endsection