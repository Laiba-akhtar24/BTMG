@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">

    <h2 class="fw-bold text-primary mb-4" >Edit Category</h2>

    {{-- SHOW VALIDATION ERRORS --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form action="{{ route('admin.categories.update', $category['_id']) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Name</label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ $category['name'] ?? '' }}"
                           required>
                </div>

                <!-- Order -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Order</label>
                    <input type="number"
                           name="order"
                           class="form-control"
                           value="{{ $category['order'] ?? 1 }}"
                           min="1"
                           required>
                </div>

                <!-- Slug -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Slug</label>
                    <input type="text"
                           name="slug"
                           class="form-control"
                           value="{{ $category['slug'] ?? '' }}"
                           required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4">
                        Update Category
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
