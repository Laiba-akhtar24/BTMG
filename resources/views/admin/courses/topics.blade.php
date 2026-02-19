@extends('admin.layout')

@section('content')
<div class="container py-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Manage Topics</h2>
            <p class="text-muted">{{ $course['name'] ?? '' }}</p>
        </div>
        <div>
            <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">
                &larr; Back to Courses
            </a>
        </div>
    </div>

    <!-- Add Topic Form -->
    <div class="card shadow-sm mb-4 topic-form-card">
        <div class="card-body">
            <h5 class="mb-3">Add Topic</h5>

            <form action="{{ route('admin.topics.store', $courseId) }}" method="POST" id="topicForm" class="topic-form">
                @csrf

                <!-- Hidden field for course id -->
                <input type="hidden" name="course_id" value="{{ $courseId }}">

                <!-- 1. Topic Title -->
                <div class="form-group mb-3">
                    <label class="form-label">Topic Title</label>
                    <input type="text" name="title" placeholder="e.g Introduction" class="form-control" required>
                </div>

                <!-- 2. Description -->
                <div class="form-group mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="3" class="form-control" placeholder="Topic description..."></textarea>
                </div>

                <!-- 3. Sort Order -->
                <div class="form-group mb-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort" class="form-control">
                </div>

                <!-- 4. Active Checkbox -->
                <div class="form-check mb-3">
                    <input type="checkbox" name="status" value="Active" class="form-check-input" id="topicStatus">
                    <label class="form-check-label" for="topicStatus">Active</label>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary">Add Topic</button>
            </form>
        </div>
    </div>

    <!-- Topics Table -->
    <div class="card shadow-sm topics-table-card">
        <div class="card-body">
            <h5 class="mb-3">Topics List</h5>

            @if(isset($topics) && count($topics) > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center topics-table">
                        <thead class="table-dark">
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Sort</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topics as $topic)
                                <tr>
                                    <td>{{ $topic['title'] ?? '-' }}</td>
                                    <td>{{ $topic['description'] ?? '-' }}</td>
                                    <td>{{ $topic['sort'] ?? '-' }}</td>
                                    <td>
                                        @if(($topic['status'] ?? '') == 'Active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column align-items-start gap-1">

                                            <!-- Edit Button -->
                                           <a href="{{ route('admin.topics.edit', (string)$topic['_id']) }}" 
                                              class="btn btn-sm btn-warning mb-1">Edit</a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('admin.topics.destroy', $topic['_id']) }}" 
                                                  method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-delete"
                                                        onclick="return confirm('Are you sure you want to delete this topic?')">
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
                    No topics available.
                </div>
            @endif

        </div>
    </div>

</div>
@endsection

@push('styles')
<!-- Admin CSS -->
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush
