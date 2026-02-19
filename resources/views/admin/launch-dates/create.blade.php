@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Add Launch Date</h2>
        <a href="{{ route('admin.launch-dates.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.launch-dates.store') }}" method="POST">
                @csrf

                <div class="mb-3">
    <label for="course_id" class="form-label">Course</label>
    <select name="course_id" id="course_id" class="form-select">
        @foreach($allCourses as $course)
            <option value="{{ (string)$course['_id'] }}">
                {{ $course['name'] }} - {{ $course['level'] ?? '-' }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="launch_date" class="form-label">Launch Date</label>
    <input type="date" name="launch_date" id="launch_date" class="form-control" required>
</div>

<button type="submit" class="btn btn-primary">Add Launch Date</button>


            </form>
        </div>
    </div>

</div>
@endsection
