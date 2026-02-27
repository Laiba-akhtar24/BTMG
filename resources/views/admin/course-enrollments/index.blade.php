@extends('admin.layout')

@section('content')
<div class="container-fluid" id="course-inquiries-page">
    <h1 class="mb-4">Course Enrollments</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(count($enrollments) === 0)
        <div class="alert alert-info text-center">
            No enrollments yet.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Course Name</th>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($enrollments as $index => $enrollment)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $enrollment['course_name'] ?? '-' }}</td>
                            <td>{{ $enrollment['course_type'] ?? '-' }}</td>
                            <td>{{ $enrollment['name'] ?? '-' }}</td>
                            <td>{{ $enrollment['email'] ?? '-' }}</td>
                            <td>{{ $enrollment['phone'] ?? '-' }}</td>
                            <td>{{ $enrollment['status'] ?? '-' }}</td>
                            <td>
@if(isset($enrollment['created_at']))
    {{ \Carbon\Carbon::createFromTimestamp(
        $enrollment['created_at']->toDateTime()->getTimestamp()
    )->format('d M Y') }}
@else
    -
@endif
</td>

                            <td>
                                <!-- View Details Modal Trigger -->
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $enrollment['_id'] }}" style="background-color: #16a34a;
    color: #fef3c7;">
                                    
                                View
                                </button>

                                <!-- Delete Form -->
                                <form action="{{ route('admin.course-enrollments.destroy', $enrollment['_id']) }}" method="POST" class="d-inline" style="background-color: #dc3545;
    color: #fef3c7;" onsubmit="return confirm('Are you sure you want to delete this enrollment?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>

                                <!-- Details & Action Modal -->
<div class="modal fade" id="detailsModal{{ $enrollment['_id'] }}" tabindex="-1" aria-labelledby="detailsModalLabel{{ $enrollment['_id'] }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title">📋 Enrollment Details</h5>
                    <small class="text-muted">Review & take action</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                    <!-- 1st Row -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label"><strong>Name</strong></label>
                            <input type="text" class="form-control" value="{{ $enrollment['name'] ?? '-' }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><strong>Email</strong></label>
                            <input type="email" class="form-control" value="{{ $enrollment['email'] ?? '-' }}" readonly>
                        </div>
                    </div>

                    <!-- 2nd Row -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label"><strong>Phone</strong></label>
                            <input type="text" class="form-control" value="{{ $enrollment['phone'] ?? '-' }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><strong>Course</strong></label>
                            <input type="text" class="form-control" value="{{ $enrollment['course_name'] ?? '-' }}" readonly>
                        </div>
                    </div>

                    <!-- 3rd Row -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label"><strong>Level</strong></label>
                            <input type="text" class="form-control" value="{{ $enrollment['course_level'] ?? '-' }}
"
 readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><strong>Launch Date</strong></label>
                            <input type="text" class="form-control" value="{{ isset($enrollment['created_at']) ? \Carbon\Carbon::createFromTimestamp($enrollment['created_at']->toDateTime()->getTimestamp())->format('d M Y') : '-' }}" readonly>
                        </div>
                    </div>

                    <!-- 4th Row -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label"><strong>Message</strong></label>
                            <textarea class="form-control" rows="2" readonly>{{ $enrollment['message'] ?? '-' }}</textarea>
                        </div>
                    </div>

                    <!-- 5th Row -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label"><strong>Status</strong></label>
                            <input type="text" class="form-control" value="{{ $enrollment['status'] ?? '-' }}" readonly>
                        </div>
                    </div>

                    <hr>

                   <form action="{{ route('admin.course-enrollments.sendReply', (string) $enrollment['_id']) }}" method="POST" class="w-100">
    @csrf

    <!-- Reply Form -->
<form action="{{ route('admin.course-enrollments.sendReply', (string) $enrollment['_id']) }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label"><strong>Reply Message</strong></label>
        <textarea name="reply_message" class="form-control" rows="4" required></textarea>
    </div>

    <div class="text-start">
        <button type="submit" class="btn btn-primary">
            Send Reply
        </button>
    </div>
</form>

<hr>

<!-- Approve & Reject Buttons -->
<div class="d-flex justify-content-end gap-2">

    <!-- Approve Form -->
    <form action="{{ route('admin.course-enrollments.updateStatus', (string) $enrollment['_id']) }}" method="POST">
        @csrf
        <input type="hidden" name="status" value="approved">
        <button type="submit" class="btn btn-success">
            Approve
        </button>
    </form>

    <!-- Reject Form -->
    <form action="{{ route('admin.course-enrollments.updateStatus', (string) $enrollment['_id']) }}" method="POST">
        @csrf
        <input type="hidden" name="status" value="rejected">
        <button type="submit" class="btn btn-danger">
            Reject
        </button>
    </form>

</div>



            </div>
        </div>
    </div>
</div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
