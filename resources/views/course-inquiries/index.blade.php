@extends('admin.layout')

@section('content')
<div class="container-fluid" id="course-inquiries-page">
    <h1 class="my-4">Course Inquiries</h1>

    @if(count($inquiries) === 0)
        <div class="alert alert-info text-center">
            No inquiries yet.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Course</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Submitted Date</th>
                        <th>Replied</th>
                        <th>Viewed</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inquiries as $inquiry)
                        <tr>
                            <td>{{ $inquiry->course_name ?? '-' }}</td>
                            <td>{{ $inquiry->name ?? '-' }}</td>
                            <td>{{ $inquiry->email ?? '-' }}</td>
                            <td>{{ $inquiry->created_at ?? '-' }}</td>
                            <td>{{ !empty($inquiry->replied) ? 'Replied' : 'Pending' }}</td>
                            <td>{{ !empty($inquiry->viewed) ? 'Viewed' : '-' }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary view-btn"
                                        data-id="{{ (string)$inquiry->_id }}">
                                    View
                                </button>

                                <form action="{{ route('admin.course-inquiries.delete', (string)$inquiry->_id) }}"
      method="POST"
      style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit"
            class="btn btn-sm btn-danger"
            onclick="return confirm('Are you sure to delete?')">
        Delete
    </button>
</form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<!-- ================= MODAL ================= -->
<div id="inquiryModal" class="custom-modal">
    <div class="modal-content-box">
        <span class="close-btn">&times;</span>

        <h3>Inquiry Details</h3>
        <hr>

    <form method="POST" action="" id="replyForm">
    @csrf
    <input type="hidden" name="launch_date" id="formLaunchDate">

    <div class="modal-grid">
        <div class="grid-row">
            <div class="grid-field">
                <label>Course</label>
                <input type="text" id="modalCourse" readonly>
            </div>
            <div class="grid-field">
                <label>Level</label>
                <input type="text" id="modalLevel" readonly>
            </div>
        </div>

        <div class="grid-row">
            <div class="grid-field">
                <label>Launch Date</label>
                <input type="text" id="modalLaunchDate" readonly>
            </div>
            <div class="grid-field">
                <label>Name</label>
                <input type="text" id="modalName" readonly>
            </div>
        </div>

        <div class="grid-row">
            <div class="grid-field">
                <label>Email</label>
                <input type="text" id="modalEmail" readonly>
            </div>
            <div class="grid-field">
                <label>Phone</label>
                <input type="text" id="modalPhone" readonly>
            </div>
        </div>

        <div class="grid-row-full">
            <label>Message</label>
            <textarea id="modalMessage" rows="4" readonly></textarea>
        </div>

        <hr>

        <div class="grid-row-full">
            <label>Reply Message</label>
            <textarea id="replyMessage" name="replyMessage" rows="3" required></textarea>
        </div>

        <div style="text-align:left; margin-top:15px;">
            <button type="submit" class="btn btn-success">Send Reply</button>
        </div>
    </div>
</form>



    </div>
</div>

<style>
.custom-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.modal-content-box {
    background: #fff;
    width: 650px;
    padding: 25px 30px;
    border-radius: 8px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    max-height: 90%;
    overflow-y: auto;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 22px;
    cursor: pointer;
}

/* Modal grid */
.modal-grid {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.grid-row {
    display: flex;
    gap: 10px;
}

.grid-field {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.grid-field input,
.grid-row-full textarea {
    padding: 6px 8px;
    border-radius: 4px;
    border: 1px solid #ccc;
    width: 100%;
    font-size: 14px;
    background: #f8f9fa;
}

.grid-row-full textarea {
    width: 100%;
}

#replyMessage {
    background: #fff;
    border: 1px solid #aaa;
}

.btn-success {
    padding: 6px 18px;
    background: green;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("inquiryModal");
    const closeBtn = document.querySelector(".close-btn");

    // Close modal when × is clicked
    closeBtn.addEventListener("click", function() {
        modal.style.display = "none";
    });

    // Close modal when clicking outside the modal box
    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });

    // --- Your existing view button logic ---
    document.querySelectorAll(".view-btn").forEach(button => {
        button.addEventListener("click", function() {
            const id = this.dataset.id;
            document.getElementById("replyForm").action = `/admin/course-inquiries/reply/${id}`;

            fetch(`/admin/course-inquiries/view/${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById("modalCourse").value = data.course_name;
                    document.getElementById("modalLevel").value = data.level;
                    document.getElementById("modalLaunchDate").value = data.launch_date;
                    document.getElementById("formLaunchDate").value = data.launch_date;
                    document.getElementById("modalName").value = data.name;
                    document.getElementById("modalEmail").value = data.email;
                    document.getElementById("modalPhone").value = data.phone;
                    document.getElementById("modalMessage").value = data.message;

                    modal.style.display = "block";
                });

            // Mark as viewed
            fetch(`/admin/course-inquiries/mark-viewed/${id}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                }
            })
            .then(res => res.json())
            .then(result => {
                if(result.success){
                    const row = button.closest("tr");
                    row.children[5].innerText = "Viewed";
                }
            });
        });
    });
});

document.querySelectorAll(".view-btn").forEach(button => {
    button.addEventListener("click", function() {
        const id = this.dataset.id;

        // Populate modal
        fetch(`/admin/course-inquiries/view/${id}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById("modalCourse").value = data.course_name;
                document.getElementById("modalLevel").value = data.level;
                document.getElementById("modalLaunchDate").value = data.launch_date;
                document.getElementById("formLaunchDate").value = data.launch_date;
                document.getElementById("modalName").value = data.name;
                document.getElementById("modalEmail").value = data.email;
                document.getElementById("modalPhone").value = data.phone;
                document.getElementById("modalMessage").value = data.message;

                // Show modal
                document.getElementById("inquiryModal").style.display = "block";
            });

        // Mark as viewed
        fetch(`/admin/course-inquiries/mark-viewed/${id}`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            }
        })
        .then(res => res.json())
        .then(result => {
            if(result.success){
                // Update the viewed column in table row
                const row = button.closest("tr");
                row.children[5].innerText = "Viewed"; // 6th column (0-indexed)
            }
        });
    });
});



</script>


@endsection
