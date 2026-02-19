<!-- resources/views/admin/courses/edit.blade.php -->
@extends('admin.layout')

@section('content')
<div class="flex justify-center mt-10">
    <div style="width: 100%; max-width: 36rem; background: white; padding: 1.5rem;">

        <h2 style="font-size: 1.5rem; font-weight: bold; text-align: center; color: #2563eb; margin-bottom: 1.5rem;">
            Edit Course
        </h2>

        @if(session('success'))
            <div style="background: #d1fae5; color: #065f46; padding: 0.75rem 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.courses.update', $course->_id) }}" method="POST" enctype="multipart/form-data" id="courseForm">
            @csrf
            @method('PUT')

            <!-- Hidden field for combined duration -->
            <input type="hidden" name="duration" id="durationHidden" value="{{ $course->duration ?? '' }}">

            <!-- Hidden field for comma‑separated skills -->
            <input type="hidden" name="skills" id="skillsHidden" value="{{ $course->skills ?? '' }}">

            <!-- 1. Course Title -->
            <div style="margin-bottom: 1.25rem;">
                <label for="name" style="display: block; font-weight: 600; margin-bottom: 0.25rem;">Course Title</label>
                <input type="text" name="name" id="name" value="{{ $course->name ?? '' }}" placeholder="Enter course title"
                       style="width: 100%; border: 1px solid #d1d5db; padding: 0.5rem 0.75rem; box-sizing: border-box;" required>
            </div>

            <!-- 2. Course Category -->
            <div style="margin-bottom: 1.25rem;">
                <label for="category" style="display: block; font-weight: 600; margin-bottom: 0.25rem;">Course Category</label>
                <select name="category" id="category"
                        style="width: 100%; border: 1px solid #d1d5db; padding: 0.5rem 0.75rem; box-sizing: border-box;" required>
                    <option value="" disabled>Select Category</option>
                    <option value="Web Development" {{ ($course->category ?? '')=='Web Development' ? 'selected' : '' }}>Web Development</option>
                    <option value="Design" {{ ($course->category ?? '')=='Design' ? 'selected' : '' }}>Design</option>
                    <option value="Marketing" {{ ($course->category ?? '')=='Marketing' ? 'selected' : '' }}>Marketing</option>
                    <option value="Business" {{ ($course->category ?? '')=='Business' ? 'selected' : '' }}>Business</option>
                    <option value="IT & Software" {{ ($course->category ?? '')=='IT & Software' ? 'selected' : '' }}>IT & Software</option>
                </select>
            </div>

            <!-- 3. Description -->
            <div style="margin-bottom: 1.25rem;">
                <label for="description" style="display: block; font-weight: 600; margin-bottom: 0.25rem;">Course Description</label>
                <textarea name="description" id="description" rows="4" placeholder="Write course description here..."
                          style="width: 100%; border: 1px solid #d1d5db; border-top: none; padding: 0.5rem 0.75rem; box-sizing: border-box;">{{ $course->description ?? '' }}</textarea>
            </div>

            <!-- 4. Course Level -->
            <div style="margin-bottom: 1.25rem;">
                <label for="level" style="display: block; font-weight: 600; margin-bottom: 0.25rem;">Course Level</label>
                <select name="level" id="level"
                        style="width: 100%; border: 1px solid #d1d5db; padding: 0.5rem 0.75rem; box-sizing: border-box;" required>
                    <option value="" disabled>Select Level</option>
                    <option value="Beginner" {{ ($course->level ?? '')=='Beginner' ? 'selected' : '' }}>Beginner</option>
                    <option value="Intermediate" {{ ($course->level ?? '')=='Intermediate' ? 'selected' : '' }}>Intermediate</option>
                    <option value="Advanced" {{ ($course->level ?? '')=='Advanced' ? 'selected' : '' }}>Advanced</option>
                </select>
            </div>

            <!-- 5. Duration -->
            <div style="margin-bottom: 1.25rem;">
                <label style="display: block; font-weight: 600; margin-bottom: 0.25rem;">Duration</label>
                <div style="display: flex; gap: 0.75rem;">
                    @php
                        $duration_parts = isset($course->duration) ? explode(' ', $course->duration) : [];
                    @endphp
                    <input type="number" id="duration_value" placeholder="e.g. 6"
                           value="{{ $duration_parts[0] ?? '' }}"
                           style="width: 50%; border: 1px solid #d1d5db; padding: 0.5rem 0.75rem; box-sizing: border-box;" required>
                    <select id="duration_unit"
                            style="width: 50%; border: 1px solid #d1d5db; padding: 0.5rem 0.75rem; box-sizing: border-box;" required>
                        <option value="" disabled>Select Unit</option>
                        <option value="Days" {{ isset($duration_parts[1]) && $duration_parts[1]=='Days' ? 'selected' : '' }}>Days</option>
                        <option value="Weeks" {{ isset($duration_parts[1]) && $duration_parts[1]=='Weeks' ? 'selected' : '' }}>Weeks</option>
                        <option value="Months" {{ isset($duration_parts[1]) && $duration_parts[1]=='Months' ? 'selected' : '' }}>Months</option>
                        <option value="Hours" {{ isset($duration_parts[1]) && $duration_parts[1]=='Hours' ? 'selected' : '' }}>Hours</option>
                    </select>
                </div>
            </div>

            <!-- 6. Price -->
            <div style="margin-bottom: 1.25rem;">
                <label for="price" style="display: block; font-weight: 600; margin-bottom: 0.25rem;">Price ($)</label>
                <input type="number" name="price" id="price" step="0.01" min="0" value="{{ $course->price ?? '' }}"
                       style="width: 100%; border: 1px solid #d1d5db; padding: 0.5rem 0.75rem; box-sizing: border-box;" required>
                <p style="font-size: 0.75rem; color: #6b7280; margin-top: 0.25rem; margin-bottom: 0;">set 0 if you offer a free course</p>
            </div>

            <!-- 7. Skills -->
            <div style="margin-bottom: 1.25rem;">
                <label style="display: block; font-weight: 600; margin-bottom: 0.25rem;">Skills / Prerequisites</label>
                <div style="display: flex; gap: 0.5rem;">
                    <input type="text" id="skillInput" placeholder="Type a skill and press Add"
                           style="flex: 1; border: 1px solid #d1d5db; padding: 0.5rem 0.75rem; box-sizing: border-box;">
                    <button type="button" id="addSkillBtn"
                            style="background: #2563eb; color: white; padding: 0.5rem 1.25rem; border: none; cursor: pointer;">
                        Add
                    </button>
                </div>
                <div id="skillsContainer" style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-top: 0.75rem;">
                    @php
                        $skillsArray = isset($course->skills) ? explode(',', $course->skills) : [];
                    @endphp
                    @foreach($skillsArray as $index => $skill)
                        <span style="display: inline-flex; align-items: center; gap: 0.25rem; background: #dbeafe; color: #1e40af; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.875rem;">
                            {{ $skill }}
                            <button type="button" style="background: none; border: none; color: #1e40af; font-weight: bold; cursor: pointer; margin-left: 0.25rem;" data-index="{{ $index }}">&times;</button>
                        </span>
                    @endforeach
                </div>
            </div>

            <!-- 8. Sort Order -->
            <div style="margin-bottom: 1.25rem;">
                <label for="sort" style="display: block; font-weight: 600; margin-bottom: 0.25rem;">Sort Order</label>
                <input type="number" name="sort" id="sort" value="{{ $course->sort ?? '' }}"
                       style="width: 100%; border: 1px solid #d1d5db; padding: 0.5rem 0.75rem; box-sizing: border-box;">
            </div>

            <!-- 9. Course Image -->
            <div style="margin-bottom: 1.25rem;">
                <label for="image" style="display: block; font-weight: 600; margin-bottom: 0.25rem;">Course Image</label>
                <input type="file" name="image" id="image" style="border: none; padding: 0; margin: 0; width: auto;">
                @if(!empty($course->image))
                    <img src="{{ $course->image }}" alt="Course Image" width="120" class="mt-2">
                @endif
            </div>

            <!-- 10. Active Checkbox -->
            <div style="display: flex; align-items: center; gap: 0.5rem; margin: 1.5rem 0 1rem 0;">
                <input type="checkbox" name="status" id="status" value="Active" {{ ($course->status ?? 0)==1 ? 'checked' : '' }} style="width: 1.25rem; height: 1.25rem;">
                <label for="status" style="font-weight: 600;">Active</label>
            </div>

            <!-- 11. Buttons -->
            <div style="display: flex; justify-content: flex-end; gap: 0.75rem;">
                <button type="submit" style="background: #2563eb; color: white; padding: 0.5rem 1.5rem; border: none; cursor: pointer;">
                    Update Course
                </button>
                <a href="{{ route('admin.courses.index') }}" style="background: #6b7280; color: white; padding: 0.5rem 1.5rem; text-decoration: none; display: inline-block; text-align: center;">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // SKILLS HANDLING
    const skillInput = document.getElementById('skillInput');
    const addBtn = document.getElementById('addSkillBtn');
    const skillsContainer = document.getElementById('skillsContainer');
    const skillsHidden = document.getElementById('skillsHidden');

    let skillsArray = skillsHidden.value ? skillsHidden.value.split(',') : [];

    function renderSkills() {
        skillsHidden.value = skillsArray.join(',');
        skillsContainer.innerHTML = '';
        skillsArray.forEach((skill, index) => {
            const tag = document.createElement('span');
            tag.style.cssText = 'display: inline-flex; align-items: center; gap: 0.25rem; background: #dbeafe; color: #1e40af; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.875rem;';
            tag.innerHTML = `${skill} <button type="button" style="background: none; border: none; color: #1e40af; font-weight: bold; cursor: pointer; margin-left: 0.25rem;" data-index="${index}">&times;</button>`;
            skillsContainer.appendChild(tag);
        });
    }

    renderSkills();

    addBtn.addEventListener('click', function() {
        const skill = skillInput.value.trim();
        if(skill && !skillsArray.includes(skill)) {
            skillsArray.push(skill);
            renderSkills();
            skillInput.value = '';
        }
    });

    skillInput.addEventListener('keypress', function(e){
        if(e.key==='Enter'){ e.preventDefault(); addBtn.click(); }
    });

    skillsContainer.addEventListener('click', function(e){
        if(e.target.tagName==='BUTTON' && e.target.hasAttribute('data-index')){
            const index = e.target.getAttribute('data-index');
            skillsArray.splice(index,1);
            renderSkills();
        }
    });

    // DURATION HANDLING
    const durationValue = document.getElementById('duration_value');
    const durationUnit = document.getElementById('duration_unit');
    const durationHidden = document.getElementById('durationHidden');

    document.getElementById('courseForm').addEventListener('submit', function(e){
        if(!durationValue.value || !durationUnit.value){
            e.preventDefault();
            alert('Please enter both duration value and unit.');
            return;
        }
        durationHidden.value = durationValue.value + ' ' + durationUnit.value;
    });
});
</script>
@endsection
