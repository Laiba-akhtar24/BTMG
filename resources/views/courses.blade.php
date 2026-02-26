@extends('layouts.app')

@section('content')
<div class="courses-page">

    <div class="courses-layout">

        <!-- SIDEBAR -->
        <div class="courses-sidebar">

            <h3>Categories</h3>
<div class="filter-check">
    <input type="checkbox" name="category" value="All" checked>
    <label>All Categories</label>
</div>

@foreach($categories as $cat)
<div class="filter-check">
    <input type="checkbox" name="category" value="{{ $cat['name'] }}">
    <label>{{ $cat['name'] }}</label>
</div>
@endforeach

            <h3 class="mt-4">Levels</h3>

           <div class="filter-check">
    <input type="checkbox" name="level" value="All" checked>
    <label>All Levels</label>
</div>

<div class="filter-check">
    <input type="checkbox" name="level" value="Beginner">
    <label>Beginner</label>
</div>

<div class="filter-check">
    <input type="checkbox" name="level" value="Intermediate">
    <label>Intermediate</label>
</div>

<div class="filter-check">
    <input type="checkbox" name="level" value="Advanced">
    <label>Advanced</label>
</div>

        </div>


        <!-- COURSES GRID -->
        <div class="courses-grid" id="coursesTable">

            @foreach($courses as $course)
@php
    $image = $course['image'] ?? 'images/default-course.png';
    $name = $course['name'] ?? 'Unnamed Course';
    $category = $course['category'] ?? 'Uncategorized';
    $level = $course['level'] ?? 'Unknown';
    $duration = $course['duration'] ?? '10 Hours';
@endphp

<div class="course-card"
     data-category="{{ $category }}"
     data-level="{{ $level }}">

    <!-- IMAGE -->
    <div class="card-image">
        <img src="{{ asset($image) }}" alt="{{ $name }}">
    </div>
 <div class="card-middle">
        <h2>{{ $name }}</h2>
    </div>
    <!-- TOP STRIP -->
    <div class="card-top">
        Duration: {{ $duration }}
    </div>

    <!-- MIDDLE -->
   

    <!-- BOTTOM -->
    <div class="card-bottom">
        <span class="course-level">{{ $level }}</span>

        <a href="{{ route('frontend.course.details', (string)$course['_id']) }}"
           class="details-btn">
            Details
        </a>
    </div>

</div>
@endforeach

        </div>

    </div>

</div>
<script>
const categoryCheckboxes = document.querySelectorAll('input[name="category"]');
const levelCheckboxes = document.querySelectorAll('input[name="level"]');
const rows = document.querySelectorAll('.course-card');

/* Allow only one checkbox checked at a time */
function singleSelect(checkboxes) {
    checkboxes.forEach(box => {
        box.addEventListener('change', function() {
            checkboxes.forEach(cb => {
                if (cb !== this) cb.checked = false;
            });
            filterCourses();
        });
    });
}

/* Get selected value */
function getSelectedValue(checkboxes) {
    let selected = 'All';
    checkboxes.forEach(box => {
        if (box.checked) selected = box.value;
    });
    return selected;
}

function filterCourses() {
    const category = getSelectedValue(categoryCheckboxes);
    const level = getSelectedValue(levelCheckboxes);

    rows.forEach(row => {
        const rowCategory = row.dataset.category;
        const rowLevel = row.dataset.level;

        const categoryMatch = category === 'All' || rowCategory === category;
        const levelMatch = level === 'All' || rowLevel === level;

        row.style.display = categoryMatch && levelMatch ? '' : 'none';
    });
}

/* Initialize */
singleSelect(categoryCheckboxes);
singleSelect(levelCheckboxes);
</script>
@endsection