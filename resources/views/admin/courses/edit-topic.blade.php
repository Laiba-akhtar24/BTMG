@extends('admin.layout')

@section('content')
<div class="container py-4">

    <h2>Manage Topics</h2>
    <p class="text-muted">{{ $course['name'] ?? '' }}</p>

    <form action="{{ route('admin.topics.update', $topic['_id']) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Topic Title -->
        <div class="mb-3">
            <label class="form-label">Topic Title</label>
            <input type="text" name="title" value="{{ $topic['title'] ?? '' }}" class="form-control" placeholder="e.g. Introduction" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Write topic description...">{{ $topic['description'] ?? '' }}</textarea>
        </div>

        <!-- Sort Order -->
        <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort" value="{{ $topic['sort'] ?? 0 }}" class="form-control">
        </div>

        <!-- Status -->
        <div class="mb-3 form-check">
            <input type="checkbox" name="status" value="Active" class="form-check-input" id="status" {{ ($topic['status'] ?? '') == 'Active' ? 'checked' : '' }}>
            <label class="form-check-label" for="status">Active</label>
        </div>

        <button type="submit" class="btn btn-primary">Update Topic</button>
        <a href="{{ route('admin.courses.topics', $course['_id']) }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>

</div>
@endsection
