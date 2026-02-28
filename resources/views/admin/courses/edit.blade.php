@extends('admin.layout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/edit-course.css') }}">

<div class="edit-course-wrapper">
    <div class="edit-course-card">

        <h2 class="edit-course-title" style="text-align: left;"
        >
            Edit Course
        </h2>

        @if(session('success'))
            <div class="success-alert">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.courses.update', $course->_id) }}" method="POST" enctype="multipart/form-data" id="courseForm">
            @csrf
            @method('PUT')

            <input type="hidden" name="duration" id="durationHidden" value="{{ $course->duration ?? '' }}">
            <input type="hidden" name="skills" id="skillsHidden" value="{{ $course->skills ?? '' }}">

            <div class="form-group">
                <label class="form-label">Course Title</label>
                <input type="text" name="name" class="form-control" value="{{ $course->name ?? '' }}" required>
            </div>

            <div class="form-group">
                 <div>
                <label for="category">Course Category</label>
                <select name="category" id="category" required>
    <option value="" disabled>Select Category</option>
    @foreach($categories as $cat)
        <option value="{{ $cat['name'] }}"
            {{ (isset($course->category) && $course->category == $cat['name']) ? 'selected' : '' }}>
            {{ $cat['name'] }}
        </option>
    @endforeach
</select>
            </div>
            </div>

            <div class="form-group">
                <label class="form-label">Course Description</label>
                <textarea name="description" rows="4" class="form-control">{{ $course->description ?? '' }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Course Level</label>
                <select name="level" class="form-control" required>
                    <option value="" disabled>Select Level</option>
                    <option value="Beginner" {{ ($course->level ?? '')=='Beginner' ? 'selected' : '' }}>Beginner</option>
                    <option value="Intermediate" {{ ($course->level ?? '')=='Intermediate' ? 'selected' : '' }}>Intermediate</option>
                    <option value="Advanced" {{ ($course->level ?? '')=='Advanced' ? 'selected' : '' }}>Advanced</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Duration</label>
                <div class="flex-row">
                    @php
                        $duration_parts = isset($course->duration) ? explode(' ', $course->duration) : [];
                    @endphp
                    <input type="number" id="duration_value" class="form-control flex-half" value="{{ $duration_parts[0] ?? '' }}" required>
                    <select id="duration_unit" class="form-control flex-half" required>
                        <option value="" disabled>Select Unit</option>
                        <option value="Days" {{ isset($duration_parts[1]) && $duration_parts[1]=='Days' ? 'selected' : '' }}>Days</option>
                        <option value="Weeks" {{ isset($duration_parts[1]) && $duration_parts[1]=='Weeks' ? 'selected' : '' }}>Weeks</option>
                        <option value="Months" {{ isset($duration_parts[1]) && $duration_parts[1]=='Months' ? 'selected' : '' }}>Months</option>
                        <option value="Hours" {{ isset($duration_parts[1]) && $duration_parts[1]=='Hours' ? 'selected' : '' }}>Hours</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Price ($)</label>
                <input type="number" name="price" step="0.01" min="0" class="form-control" value="{{ $course->price ?? '' }}" required>
                <p class="small-text">set 0 if you offer a free course</p>
            </div>

            <div class="form-group">
                <label class="form-label">Skills / Prerequisites</label>
                <div class="skill-input-wrapper">
                    <input type="text" id="skillInput" class="form-control">
                    <button type="button" id="addSkillBtn" class="add-btn">Add</button>
                </div>

                <div id="skillsContainer" class="skills-container">
                    @php
                        $skillsArray = isset($course->skills) ? explode(',', $course->skills) : [];
                    @endphp
                    @foreach($skillsArray as $skill)
                        <span class="skill-tag">
                            <span>{{ $skill }}</span>
                            <button type="button" class="skill-remove">&times;</button>
                        </span>
                    @endforeach
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort" class="form-control" value="{{ $course->sort ?? '' }}">
            </div>

            <div class="form-group">
                <label class="form-label">Course Image</label>
                <input type="file" name="image">
                @if(!empty($course->image))
                    <img src="{{ $course->image }}" width="120" class="mt-2">
                @endif
            </div>

            <div class="checkbox-wrapper">
                <input type="checkbox" name="status" id="status" value="Active" {{ ($course->status ?? 0)==1 ? 'checked' : '' }}>
                <label for="status">Active</label>
            </div>

            <div class="button-group">
                <button type="submit" class="primary-btn">Update Course</button>
                <a href="{{ route('admin.courses.index') }}" class="secondary-btn">Cancel</a>
            </div>

        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const durationValue = document.getElementById("duration_value");
    const durationUnit = document.getElementById("duration_unit");
    const durationHidden = document.getElementById("durationHidden");

    function updateDuration() {
        if (durationValue.value && durationUnit.value) {
            durationHidden.value = durationValue.value + " " + durationUnit.value;
        }
    }

    durationValue.addEventListener("input", updateDuration);
    durationUnit.addEventListener("change", updateDuration);

    const skillInput = document.getElementById("skillInput");
    const addSkillBtn = document.getElementById("addSkillBtn");
    const skillsContainer = document.getElementById("skillsContainer");
    const skillsHidden = document.getElementById("skillsHidden");

    function updateSkillsHidden() {
        const skills = [];
        document.querySelectorAll(".skill-tag span").forEach(function (el) {
            skills.push(el.innerText);
        });
        skillsHidden.value = skills.join(",");
    }

    addSkillBtn.addEventListener("click", function () {
        const skill = skillInput.value.trim();
        if (!skill) return;

        const span = document.createElement("span");
        span.className = "skill-tag";

        span.innerHTML = `
            <span>${skill}</span>
            <button type="button" class="skill-remove">&times;</button>
        `;

        span.querySelector(".skill-remove").addEventListener("click", function () {
            span.remove();
            updateSkillsHidden();
        });

        skillsContainer.appendChild(span);
        skillInput.value = "";
        updateSkillsHidden();
    });

    document.querySelectorAll(".skill-remove").forEach(function (btn) {
        btn.addEventListener("click", function () {
            btn.parentElement.remove();
            updateSkillsHidden();
        });
    });

    updateSkillsHidden();
});
</script>

@endsection