@extends('admin.layout')

@section('content')
<div class="flex justify-center mt-10">
    <!-- Plain container – no shadow, no rounded corners, exactly like the image -->
    <div style="width: 100%; max-width: 36rem; background: white; padding: 1.5rem;">

        <h2 style="font-size: 1.5rem; font-weight: bold; text-align: center; color: #2563eb; margin-bottom: 1.5rem;">
            Add New Course
        </h2>

        <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data" id="courseForm">
            @csrf

            <!-- Hidden field for combined duration -->
            <input type="hidden" name="duration" id="durationHidden">

            <!-- Hidden field for comma‑separated skills -->
            <input type="hidden" name="skills" id="skillsHidden">

            <!-- ========== FIELDS – EXACT ORDER AND TEXT FROM IMAGE ========== -->

            <!-- 1. Course Title -->
            <div style="margin-bottom: 1.25rem;">
                <label for="name" style="display: block; font-weight: 600; margin-bottom: 0.25rem;">Course Title</label>
                <input type="text" name="name" id="name" placeholder="Enter course title"
                       style="width: 100%; border: 1px solid #d1d5db; padding: 0.5rem 0.75rem; box-sizing: border-box;" required>
            </div>

            <!-- 2. Course Category (dropdown) -->
          <!-- 2. Course Category (Dynamic from DB) -->
<div style="margin-bottom: 1.25rem;">
    <label for="category" style="display: block; font-weight: 600; margin-bottom: 0.25rem;">
        Course Category
    </label>

    <select name="category" id="category"
            style="width: 100%; border: 1px solid #d1d5db; padding: 0.5rem 0.75rem; box-sizing: border-box;"
            required>

        <option value="" disabled selected>Select Category</option>

        @foreach($categories as $cat)
            <option value="{{ $cat['name'] }}">
                {{ $cat['name'] }}
            </option>
        @endforeach

    </select>
</div>


            <!-- 3. Course Description + Toolbar (exact characters & spacing) -->
            <div style="margin-bottom: 1.25rem;">
                <label for="description" style="display: block; font-weight: 600; margin-bottom: 0.25rem;">Course Description</label>
                <!-- Toolbar – plain text with spaces as in the image -->
                <!-- <div style="background: #f3f4f6; border: 1px solid #d1d5db; border-bottom: none; padding: 0.5rem 0.75rem; font-size: 0.9rem; display: flex; gap: 0.75rem; align-items: center;">
                    <span style="font-weight: bold; cursor: default;">B</span>
                    <span style="font-style: italic; cursor: default;">I</span>
                    <span style="text-decoration: underline; cursor: default;">U</span>
                    <span style="color: #9ca3af;">|</span>
                    <span style="cursor: default;">Normal</span>
                    <span style="font-size: 1.25rem; line-height: 1;">⬇⬇⬇</span>
                    <span style="font-size: 1.25rem; line-height: 1;">⏩⏩⏩</span>
                    <span style="font-family: serif;">Iₓ</span>
                </div> -->
                <!-- Textarea -->
                <textarea name="description" id="description" rows="4" placeholder="Write course description here..."
                          style="width: 100%; border: 1px solid #d1d5db; border-top: none; padding: 0.5rem 0.75rem; box-sizing: border-box;"></textarea>
            </div>

            <!-- 4. Course Level -->
            <div style="margin-bottom: 1.25rem;">
                <label for="level" style="display: block; font-weight: 600; margin-bottom: 0.25rem;">Course Level</label>
                <select name="level" id="level"
                        style="width: 100%; border: 1px solid #d1d5db; padding: 0.5rem 0.75rem; box-sizing: border-box;" required>
                    <option value="" disabled selected>Select Level</option>
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                </select>
            </div>

            <!-- 5. Duration (Number + Unit) -->
            <div style="margin-bottom: 1.25rem;">
                <label style="display: block; font-weight: 600; margin-bottom: 0.25rem;">Duration</label>
                <div style="display: flex; gap: 0.75rem;">
                    <input type="number" id="duration_value" placeholder="e.g. 6"
                           style="width: 50%; border: 1px solid #d1d5db; padding: 0.5rem 0.75rem; box-sizing: border-box;" required>
                    <select id="duration_unit"
                            style="width: 50%; border: 1px solid #d1d5db; padding: 0.5rem 0.75rem; box-sizing: border-box;" required>
                        <option value="" disabled selected>Select Unit</option>
                        <option value="Days">Days</option>
                        <option value="Weeks">Weeks</option>
                        <option value="Months">Months</option>
                        <option value="Hours">Hours</option>
                    </select>
                </div>
            </div>

            <!-- 6. Price ($) with exact note "set O if you offer a free course" -->
            <div style="margin-bottom: 1.25rem;">
                <label for="price" style="display: block; font-weight: 600; margin-bottom: 0.25rem;">Price ($)</label>
                <input type="number" name="price" id="price" step="0.01" min="0" placeholder="e.g. 199.99"
                       style="width: 100%; border: 1px solid #d1d5db; padding: 0.5rem 0.75rem; box-sizing: border-box;" required>
                <p style="font-size: 0.75rem; color: #6b7280; margin-top: 0.25rem; margin-bottom: 0;">set O if you offer a free course</p>
            </div>

            <!-- 7. Skills / Prerequisites (Dynamic Add) -->
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
                <!-- Container for skill tags -->
                <div id="skillsContainer" style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-top: 0.75rem;"></div>
            </div>

            <!-- 8. Sort Order -->
            <div style="margin-bottom: 1.25rem;">
                <label for="sort" style="display: block; font-weight: 600; margin-bottom: 0.25rem;">Sort Order</label>
                <input type="number" name="sort" id="sort" placeholder="Sort Order"
                       style="width: 100%; border: 1px solid #d1d5db; padding: 0.5rem 0.75rem; box-sizing: border-box;">
            </div>

            <!-- 9. Course Image – NATIVE file input (Choose File / No file chosen) -->
            <div style="margin-bottom: 1.25rem;">
                <label for="image" style="display: block; font-weight: 600; margin-bottom: 0.25rem;">Course Image</label>
                <input type="file" name="image" id="image" style="border: none; padding: 0; margin: 0; width: auto;">
                <!-- Note: Native file input automatically shows "Choose File" and "No file chosen" -->
            </div>

            <!-- 10. Active – Checkbox with label on the right, ABOVE buttons -->
            <div style="display: flex; align-items: center; gap: 0.5rem; margin: 1.5rem 0 1rem 0;">
                <input type="checkbox" name="status" id="status" value="Active" style="width: 1.25rem; height: 1.25rem;">
                <label for="status" style="font-weight: 600;">Active</label>
            </div>

            <!-- 11. Buttons: Save Course & Cancel (default browser styling) -->
            <div style="display: flex; justify-content: flex-end; gap: 0.75rem;">
                <button type="submit" style="background: #2563eb; color: white; padding: 0.5rem 1.5rem; border: none; cursor: pointer;">
                    Save Course
                </button>
                <a href="{{ route('admin.courses.index') }}" style="background: #6b7280; color: white; padding: 0.5rem 1.5rem; text-decoration: none; display: inline-block; text-align: center;">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>

<!-- JavaScript: Dynamic Skills + Duration Combination -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ----- SKILLS HANDLING -----
        const skillInput = document.getElementById('skillInput');
        const addBtn = document.getElementById('addSkillBtn');
        const skillsContainer = document.getElementById('skillsContainer');
        const skillsHidden = document.getElementById('skillsHidden');
        let skillsArray = [];

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

        addBtn.addEventListener('click', function() {
            const skill = skillInput.value.trim();
            if (skill === '') {
                alert('Please enter a skill.');
                return;
            }
            if (!skillsArray.includes(skill)) {
                skillsArray.push(skill);
                renderSkills();
                skillInput.value = '';
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

        skillsContainer.addEventListener('click', function(e) {
            if (e.target.tagName === 'BUTTON' && e.target.hasAttribute('data-index')) {
                const index = e.target.getAttribute('data-index');
                skillsArray.splice(index, 1);
                renderSkills();
            }
        });

        // ----- DURATION COMBINATION -----
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