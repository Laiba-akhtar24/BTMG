@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Add New Category</h2>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
            Back
        </a>
    </div>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Category Name</label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           placeholder="Enter category name"
                           value="{{ old('name') }}"
                           required>
                </div>

                <!-- Order -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Order</label>
                    <input type="number"
                           name="order"
                           class="form-control"
                           placeholder="Enter display order (e.g. 1)"
                           value="{{ old('order') }}"
                           min="1"
                           required>
                </div>

                <!-- Slug -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Slug</label>
                    <input type="text"
                           name="slug"
                           class="form-control"
                           placeholder="Enter slug"
                           value="{{ old('slug') }}"
                           required>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4">
                        Save Category
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
