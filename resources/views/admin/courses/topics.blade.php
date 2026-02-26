@extends('admin.layout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/manage-topics.css') }}">

<style>
/* --- Container & Header --- */
.container {
    max-width: 1100px;
}
h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #0d6efd; /* Bootstrap primary */
    letter-spacing: 0.5px;
}
h5 {
    font-weight: 600;
    color: #343a40;
}

/* --- Card Styles --- */
.card {
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

/* --- Form Controls --- */
.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13,110,253,.25);
}
label {
    font-weight: 600;
}

/* --- Buttons --- */
.btn-primary {
    background-color: #0d6efd;
    border-color: #0d6efd;
    transition: background-color 0.3s ease, transform 0.2s ease;
}
.btn-primary:hover {
    background-color: #0b5ed7;
    transform: translateY(-2px);
}
.btn-warning {
    transition: transform 0.2s ease;
}
.btn-warning:hover {
    transform: translateY(-2px);
}
.btn-delete {
    background-color: #dc3545;
    color: #fff;
    transition: transform 0.2s ease, background-color 0.3s ease;
}
.btn-delete:hover {
    background-color: #bb2d3b;
    transform: translateY(-2px);
}

/* --- Topics Table --- */
.topics-table tbody tr:hover {
    background-color: #f1f5f9;
    transition: background-color 0.2s ease;
}
.status-badge {
    cursor: pointer;
    transition: transform 0.2s ease, opacity 0.2s ease;
}
.status-badge:hover {
    transform: scale(1.1);
    opacity: 0.9;
}

/* --- CKEditor Description --- */
.ck-editor__editable_inline {
    min-height: 150px;
    border-radius: 8px;
}

/* --- Responsive tweaks --- */
@media(max-width: 768px) {
    .container {
        padding: 0 15px;
    }
}
</style>

<div class="container py-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <div>
            <h2>Manage Topics</h2>
            <p class="text-muted">{{ $course['name'] ?? '' }}</p>
        </div>
        <div class="mt-2">
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
                <input type="hidden" name="course_id" value="{{ $courseId }}">

                <div class="form-group mb-3">
                    <label class="form-label">Topic Title</label>
                    <input type="text" name="title" placeholder="e.g Introduction" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="descriptionEditor" class="form-control" placeholder="Topic description..."></textarea>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort" class="form-control">
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="status" value="Active" class="form-check-input" id="topicStatus">
                    <label class="form-check-label" for="topicStatus">Active</label>
                </div>

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
                                <tr data-topic-id="{{ $topic['_id'] }}">
                                    <td>{{ $topic['title'] ?? '-' }}</td>
                                    <td>{!! $topic['description'] ?? '-' !!}</td>
                                    <td>{{ $topic['sort'] ?? '-' }}</td>
                                    <td>
                                        @if(($topic['status'] ?? '') == 'Active')
                                            <span class="badge bg-success status-badge">Active</span>
                                        @else
                                            <span class="badge bg-secondary status-badge">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column align-items-start gap-1">
                                            <a href="{{ route('admin.topics.edit', (string)$topic['_id']) }}" class="btn btn-sm btn-warning mb-1">Edit</a>

                                            <form action="{{ route('admin.topics.destroy', $topic['_id']) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-delete"
                                                        onclick="return confirm('Are you sure you want to delete this topic?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center text-muted py-4">No topics available.</div>
            @endif

        </div>
    </div>

</div>

<!-- CKEditor 5 Classic -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // CKEditor Initialization
    ClassicEditor.create(document.querySelector('#descriptionEditor'), {
        toolbar: ['bold','italic','underline','numberedList','bulletedList','undo','redo','copy']
    }).catch(error => console.error(error));

    // Status badge toggle
    document.querySelectorAll('.status-badge').forEach(function(badge){
        badge.addEventListener('click', function() {
            if(badge.textContent.trim() === 'Active'){
                badge.textContent = 'Inactive';
                badge.classList.replace('bg-success', 'bg-secondary');
            } else {
                badge.textContent = 'Active';
                badge.classList.replace('bg-secondary', 'bg-success');
            }
        });
    });
});
</script>

@endsection