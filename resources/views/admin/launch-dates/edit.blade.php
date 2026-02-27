@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary" style="color: #343a40;">Edit Launch Date</h2>
        <a href="{{ route('admin.launch-dates.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            @php
                // Safely convert launch _id to string for route
                $launchId = '';
                if (isset($launchArray['_id'])) {
                    if (is_object($launchArray['_id'])) {
                        $launchId = (string) $launchArray['_id'];
                    } elseif (is_array($launchArray['_id']) && isset($launchArray['_id']['$oid'])) {
                        $launchId = $launchArray['_id']['$oid'];
                    } else {
                        $launchId = (string) $launchArray['_id'];
                    }
                }

                // Safely convert saved course_id to string
                $savedCourseId = '';
                if (isset($launchArray['course_id'])) {
                    if (is_object($launchArray['course_id'])) {
                        $savedCourseId = (string) $launchArray['course_id'];
                    } elseif (is_array($launchArray['course_id']) && isset($launchArray['course_id']['$oid'])) {
                        $savedCourseId = $launchArray['course_id']['$oid'];
                    } else {
                        $savedCourseId = (string) $launchArray['course_id'];
                    }
                }
            @endphp

            <form action="{{ route('admin.launch-dates.update', $launchId) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
    <label for="course_id" class="form-label">Course</label>
    <select name="course_id" id="course_id" class="form-select">
        @foreach($allCourses as $course)
            <option value="{{ (string)$course['_id'] }}"
                {{ $launchArray['course_id'] == (string)$course['_id'] ? 'selected' : '' }}>
                {{ $course['name'] }} - {{ $course['level'] ?? '-' }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="launch_date" class="form-label">Launch Date</label>
    <input type="date" name="launch_date" id="launch_date" class="form-control"
           value="{{ $launchArray['launch_date'] }}" required>
</div>

<button type="submit" class="btn btn-warning">Update Launch Date</button>

            </form>

        </div>
    </div>

</div>
@endsection
