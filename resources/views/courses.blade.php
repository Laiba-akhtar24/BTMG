@extends('layouts.app')

@section('content')
<div class="courses-page">

    <h1 class="courses-title">Explore Our Courses</h1>
    <p class="courses-subtitle">Master practical skills that help you grow personally and professionally.</p>

    <div class="filters-and-courses">
        <!-- Filters Section (Left Side) -->
        <div class="filters-bar">
            <!-- Search Bar -->
            <div class="search-box">
                <label>Search Course</label>
                <input type="text" id="searchInput" placeholder="Search by course name">
            </div>

            <!-- Categories Checkbox -->
            <div class="filter-group">
                <label>Categories</label>
                <div class="checkbox-group" id="categoryFilter">
                    <label class="category-checkbox">
                        <input type="checkbox" value="All" class="category-option" checked> All Categories
                    </label>
                    @foreach($categories as $cat)
                        <label class="category-checkbox">
                            <input type="checkbox" class="category-option" value="{{ $cat['name'] }}"> {{ $cat['name'] }}
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Levels Checkbox -->
            <div class="filter-group">
                <label>Levels</label>
                <div class="checkbox-group" id="levelFilter">
                    <label class="level-checkbox">
                        <input type="checkbox" value="All Levels" class="level-option" checked> All Levels
                    </label>
                    <label class="level-checkbox">
                        <input type="checkbox" class="level-option" value="Beginner"> Beginner
                    </label>
                    <label class="level-checkbox">
                        <input type="checkbox" class="level-option" value="Intermediate"> Intermediate
                    </label>
                    <label class="level-checkbox">
                        <input type="checkbox" class="level-option" value="Advanced"> Advanced
                    </label>
                </div>
            </div>
        </div>

        <!-- Courses Section (Right Side) -->
        <div class="courses-grid" id="coursesGrid">
            @foreach($courses as $course)
            @php
                $image = $course['image'] ?? '/images/default-course.png';
                $name = $course['name'] ?? 'Unnamed Course';
                $category = $course['category'] ?? 'Uncategorized';
                $level = $course['level'] ?? 'Unknown';
                $duration = $course['duration'] ?? 'N/A';
            @endphp
            <div class="course-card" data-category="{{ $category }}" data-level="{{ $level }}">
                <div class="course-info">
                    <h4 class="course-name">{{ $name }}</h4>
                    <img src="{{ asset($image) }}" alt="{{ $name }}" class="course-image">
                    <p class="course-duration">Duration: {{ $duration }} Hours</p>
                    <p class="course-level">{{ $level }}</p>
                    <a href="{{ route('frontend.course.details', (string)$course['_id']) }}" class="btn-details">Details</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>

<script>
// Handle the category and level checkbox filtering with single selection
const categoryCheckboxes = document.querySelectorAll('.category-option');
const levelCheckboxes = document.querySelectorAll('.level-option');
const searchInput = document.getElementById('searchInput');
const courseCards = document.querySelectorAll('.course-card');

// Function to filter courses based on the selected checkboxes and search input
function filterCourses() {
    const categories = Array.from(categoryCheckboxes).filter(c => c.checked).map(c => c.value);
    const levels = Array.from(levelCheckboxes).filter(c => c.checked).map(c => c.value);
    const search = searchInput.value.toLowerCase();

    courseCards.forEach(card => {
        const cardCategory = card.dataset.category;
        const cardLevel = card.dataset.level;
        const courseName = card.querySelector('.course-name').innerText.toLowerCase();

        const categoryMatch = categories.includes('All') || categories.includes(cardCategory);
        const levelMatch = levels.includes('All Levels') || levels.includes(cardLevel);
        const searchMatch = courseName.includes(search);

        card.style.display = categoryMatch && levelMatch && searchMatch ? '' : 'none';
    });
}

// Function to ensure only one checkbox is selected in each group
function handleSingleSelection(group) {
    group.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                group.forEach(other => {
                    if (other !== checkbox) {
                        other.checked = false;
                    }
                });
            }
            filterCourses(); // Re-apply filter after selection
        });
    });
}

// Apply single checkbox selection for Categories and Levels
handleSingleSelection(categoryCheckboxes);
handleSingleSelection(levelCheckboxes);

searchInput.addEventListener('keyup', filterCourses);
</script>

<style>
/* Flex layout for filters and courses */
.filters-and-courses {
    display: flex;
    gap: 20px;
    justify-content: space-between;
}

.filters-bar {
    flex: 1;
    min-width: 250px;
    padding: 20px;
    background-color: #f7f7f7;
    border-radius: 12px;
}

/* Search Box */
.search-box input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 15px;
}

/* Course Cards Grid */
.courses-grid {
    flex: 3;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    height: 370px;
}

/* Course Card Styles */
.course-card {
    background-color: #EBF4F6;/* light green background */
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.course-card:hover {
    transform: translateY(-10px);
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
    
}

/* Course Image */
.course-image {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 8px;
    margin-top: 10px; /* Added space between name and image */
}

/* Course Info */
.course-info {
    text-align: center;
    margin-top: 10px;
}

.course-name {
    font-size: 24px;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
    text-align: left;
    margin-left: 6px;
}

.course-level {
    font-size: 18px;
    color: black;
    margin-bottom: 15px;
}

.btn-details {
    display: inline-block;
    background-color: #0d6efd; /* darker green */
    color: white;
    padding: 8px 15px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
}

.btn-details:hover {
    background-color: #088395;
}

/* Filters (Categories & Levels) */
.checkbox-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}

.checkbox-group label {
    font-size: 16px;
    margin-bottom: 10px;
}

.category-checkbox input,
.level-checkbox input {
    margin-right: 10px;
}

.category-checkbox,
.level-checkbox {
    font-size: 14px;
    margin-bottom: 10px;
}

.category-checkbox input:checked + span,
.level-checkbox input:checked + span {
    color: #4caf50; /* Green color for checked items */
}

</style>

@endsection