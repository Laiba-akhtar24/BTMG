@extends('admin.layout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/course-form.css') }}">

<div class="flex justify-center mt-10">
    <div class="container">

        <h2>Add New Course</h2>

        <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data" id="courseForm">
            @csrf
            <input type="hidden" name="duration" id="durationHidden">
            <input type="hidden" name="skills" id="skillsHidden">

            <!-- 1. Course Title -->
            <div>
                <label for="name">Course Title</label>
                <input type="text" name="name" id="name" placeholder="Enter course title" required>
            </div>

            <!-- 2. Category -->
            <div>
                <label for="category">Course Category</label>
                <select name="category" id="category" required>
                    <option value="" disabled selected>Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat['name'] }}">{{ $cat['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <!-- 3. Description -->
            <div>
                <label for="description">Course Description</label>
                <textarea name="description" id="description" rows="4" placeholder="Write course description here..."></textarea>
            </div>

            <!-- 4. Level -->
            <div>
                <label for="level">Course Level</label>
                <select name="level" id="level" required>
                    <option value="" disabled selected>Select Level</option>
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                </select>
            </div>

            <!-- 5. Duration -->
            <div>
                <label>Duration</label>
                <div class="duration-wrapper">
                    <input type="number" id="duration_value" placeholder="e.g. 6" required>
                    <select id="duration_unit" required>
                        <option value="" disabled selected>Select Unit</option>
                        <option value="Days">Days</option>
                        <option value="Weeks">Weeks</option>
                        <option value="Months">Months</option>
                        <option value="Hours">Hours</option>
                    </select>
                </div>
            </div>

            <!-- 6. Price -->
            <div>
                <label for="price">Price ($)</label>
                <input type="number" name="price" id="price" step="0.01" min="0" placeholder="e.g. 199.99" required>
                <p style="font-size: 0.75rem; color: #6b7280;">set O if you offer a free course</p>
            </div>

            <!-- 7. Skills -->
            <div>
                <label>Skills / Prerequisites</label>
                <div style="display:flex; gap:0.5rem;">
                    <input type="text" id="skillInput" placeholder="Type a skill and press Add">
                    <button type="button" id="addSkillBtn">Add</button>
                </div>
                <div id="skillsContainer"></div>
            </div>

            <!-- 8. Sort Order -->
            <div>
                <label for="sort">Sort Order</label>
                <input type="number" name="sort" id="sort" placeholder="Sort Order">
            </div>

            <!-- 9. Image -->
            <div>
                <label for="image">Course Image</label>
                <input type="file" name="image" id="image">
            </div>

            <!-- 10. Active -->
            <div style="display:flex; align-items:center; gap:0.5rem; margin:1.5rem 0 1rem 0;">
                <input type="checkbox" name="status" id="status" value="Active">
                <label for="status">Active</label>
            </div>

            <!-- 11. Buttons -->
            <div style="display:flex; justify-content:flex-end; gap:0.75rem;">
                <button type="submit">Save Course</button>
                <a href="{{ route('admin.courses.index') }}">Cancel</a>
            </div>
        </form>
    </div>
</div>

<!-- JS: Skills & Duration -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const skillInput = document.getElementById('skillInput');
    const addBtn = document.getElementById('addSkillBtn');
    const skillsContainer = document.getElementById('skillsContainer');
    const skillsHidden = document.getElementById('skillsHidden');
    const skillsArray = [];

    function renderSkills() {
        skillsHidden.value = skillsArray.join(',');
        skillsContainer.innerHTML = '';
        skillsArray.forEach((skill, index) => {
            const tag = document.createElement('span');
            tag.textContent = skill + ' ';
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.textContent = '×';
            btn.dataset.index = index;
            btn.addEventListener('click', () => {
                skillsArray.splice(index, 1);
                renderSkills();
            });
            tag.appendChild(btn);
            skillsContainer.appendChild(tag);
        });
    }

    addBtn.addEventListener('click', function() {
        const skill = skillInput.value.trim();
        if (skill && !skillsArray.includes(skill)) {
            skillsArray.push(skill);
            renderSkills();
            skillInput.value = '';
        } else if (!skill) {
            alert('Please enter a skill.');
        } else {
            alert('Skill already added.');
        }
    });

    skillInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addBtn.click();
        }
    });

    const durationValue = document.getElementById('duration_value');
    const durationUnit = document.getElementById('duration_unit');
    const durationHidden = document.getElementById('durationHidden');

    document.getElementById('courseForm').addEventListener('submit', function(e) {
        if (!durationValue.value || !durationUnit.value) {
            e.preventDefault();
            alert('Please enter both duration value and unit.');
            return;
        }
        durationHidden.value = durationValue.value + ' ' + durationUnit.value;
    });
});
</script>

@endsection