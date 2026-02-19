@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Manage Categories</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            + Add New Category
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Categories Table -->
    <div class="card shadow-sm border-0">
        <div class="card-body">

            @if(!empty($categories) && count($categories) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th style="width:30%">Name</th>
                                <th style="width:15%">Order</th>
                                <th style="width:30%">Slug</th>
                                <th style="width:25%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td class="text-start fw-semibold">
                                        {{ $category['name'] ?? '-' }}
                                    </td>

                                    <td>
                                        {{ isset($category['order']) ? $category['order'] : 0 }}
                                    </td>

                                    <td>
                                        {{ $category['slug'] ?? '-' }}
                                    </td>

                                    <td>
                                        <div class="d-flex justify-content-center gap-2">

                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.categories.edit', $category['_id']) }}"
                                               class="btn btn-sm"
                                               style="background-color:#fef3c7; color:#92400e;">
                                                Edit
                                            </a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('admin.categories.destroy', $category['_id']) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm"
                                                        style="background-color:#fee2e2; color:#991b1b;">
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
                    No categories found.
                </div>
            @endif

        </div>
    </div>

</div>
@endsection
