@extends('admin.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Course Launch Dates</h2>
        <a href="{{ route('admin.launch-dates.create') }}" class="btn btn-primary">+ Add Launch Date</a>
    </div>

    <!-- Launch Dates Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body">

            @if(isset($launchDates) && count($launchDates) > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Course</th>
                            <th>Level</th>
                            <th>Launch Date</th>
                            <th style="min-width:380px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($launchDates as $ld)
                        <tr>
                            <td>{{ $ld['course_name'] ?? '-' }}</td>
                            <td>{{ $ld['level'] ?? '-' }}</td>
                            <td>{{ $ld['launch_date'] ?? '-' }}</td>

                            <td class="text-nowrap">
                                <div class="d-flex justify-content-center align-items-center gap-3">
                                    <div>
                                        <small class="text-muted">Enrollments</small><br>
                                        <span class="badge bg-secondary">{{ $ld['enrollments'] ?? 0 }}</span>
                                    </div>

                                    <div>
                                        <small class="text-muted">Inquiries</small><br>
                                        <span class="badge bg-secondary">{{ $ld['inquiries'] ?? 0 }}</span>
                                    </div>

                                    <a href="{{ route('admin.launch-dates.edit', (string)$ld['_id']) }}" class="btn btn-sm btn-warning edit" id="edit">Edit</a>

                                    <form action="{{ route('admin.launch-dates.destroy', (string)$ld['_id']) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" id="delete" class="btn btn-sm btn-danger delete">Delete</button>
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
@endsection
