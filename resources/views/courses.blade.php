@extends('layouts.app')

@section('content')
<div class="courses-page">

    <h1 class="courses-title">Skill Up Fast</h1>
    <p class="courses-subtitle">Master practical skills that help you grow personally and professionally.</p>

    <!-- FILTERS -->
    <div class="filters-bar">
        <div class="filter-group">
            <label>Categories</label>
            <select id="categoryFilter">
                <option value="All">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat['name'] }}">{{ $cat['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <label>Levels</label>
            <select id="levelFilter">
                <option value="All">All Levels</option>
                <option value="Beginner">Beginner</option>
                <option value="Intermediate">Intermediate</option>
                <option value="Advanced">Advanced</option>
            </select>
        </div>

        <div class="search-box">
            <label>Search Course</label>
            <input type="text" id="searchInput" placeholder="Search by course name">
        </div>
    </div>

    <!-- COURSES TABLE -->
    <table class="courses-table" id="coursesTable">
        <thead>
            <tr>
                <th>Course</th>
                <th>Category</th>
                <th>Level</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            @php
                $image = $course['image'] ?? '/images/default-course.png';
                $name = $course['name'] ?? 'Unnamed Course';
                $category = $course['category'] ?? 'Uncategorized';
                $level = $course['level'] ?? 'Unknown';
            @endphp
            <tr data-category="{{ $category }}" data-level="{{ $level }}">
                <td>
                    <div class="course-box">
                        <img src="{{ asset($image) }}" alt="{{ $name }}">
                    </div>
                    <div class="course-name">{{ $name }}</div>
                </td>
                <td>{{ $category }}</td>
                <td>{{ $level }}</td>
                <td>
                   <a href="{{ route('frontend.course.details', (string)$course['_id']) }}" class="course-link btn-view">
                       View Course Details
                   </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<script>
const categoryFilter = document.getElementById('categoryFilter');
const levelFilter = document.getElementById('levelFilter');
const searchInput = document.getElementById('searchInput');
const rows = document.querySelectorAll('#coursesTable tbody tr');

function filterCourses() {
    const category = categoryFilter.value;
    const level = levelFilter.value;
    const search = searchInput.value.toLowerCase();

    rows.forEach(row => {
        const rowCategory = row.dataset.category;
        const rowLevel = row.dataset.level;
        const courseName = row.children[0].querySelector('.course-name').innerText.toLowerCase();

        const categoryMatch = category === 'All' || rowCategory === category;
        const levelMatch = level === 'All' || rowLevel === level;
        const searchMatch = courseName.includes(search);

        row.style.display =
            categoryMatch && levelMatch && searchMatch ? '' : 'none';
    });
}

categoryFilter.addEventListener('change', filterCourses);
levelFilter.addEventListener('change', filterCourses);
searchInput.addEventListener('keyup', filterCourses);
</script>
@endsection
