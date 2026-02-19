@extends('admin.layout')

@section('content')

<div class="container-fluid">

    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Subscribers</h2>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#sendMessageModal">
            Send Message
        </button>
    </div>

    <!-- MESSAGE MODAL -->
    <div class="modal fade" id="sendMessageModal" tabindex="-1" aria-labelledby="sendMessageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark text-white rounded-3 p-3">

                <!-- MODAL HEADER -->
                <div class="modal-header border-0 flex-column align-items-start position-relative">
                    <div class="d-flex align-items-center mb-1 w-100">
                        <!-- Envelope Icon -->
                        <span style="font-size: 1.3rem; margin-right: 0.5rem;">✉️</span>
                        <h5 class="modal-title mb-0" id="sendMessageModalLabel">Send Message</h5>
                    </div>
                    <!-- Subtitle -->
                    <small class="text-secondary">Send to selected subscribers</small>
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 mt-3 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- MODAL BODY -->
                <div class="modal-body mt-3">
                    <form action="{{ route('admin.subscribers.message') }}" method="POST">
                        @csrf
                        <label for="messageTextarea" class="form-label fw-bold">Message</label>
                        <div class="mb-3">
                            <textarea id="messageTextarea" name="message" class="form-control" rows="8" placeholder="Write your message here..." required></textarea>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-warning">Send Message</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- SUBSCRIBERS TABLE -->
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Select</th>
                        <th>
                            <div class="d-flex align-items-center">
                                <!-- Select All Checkbox -->
                                <input type="checkbox" id="selectAllCheckbox" class="me-2">
                                Select All
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($subscribers))
                        @foreach($subscribers as $subscriber)
                        <tr>
                            <td>{{ $subscriber['email'] ?? '' }}</td>
                            <td>
                                @if(($subscriber['status'] ?? '') == 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <!-- Select Checkbox -->
                            <td>
                                <input type="checkbox" class="subscriber-checkbox" value="{{ $subscriber['email'] ?? '' }}">
                            </td>
                            <td>---</td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No subscribers found.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- JAVASCRIPT -->
<script>
// Handle form submission for sending messages
document.querySelector('#sendMessageModal form').addEventListener('submit', function(e) {
    const selectedCheckboxes = document.querySelectorAll('.subscriber-checkbox:checked');
    if(selectedCheckboxes.length === 0) {
        e.preventDefault();
        alert('Please select at least one subscriber.');
        return;
    }

    document.querySelectorAll('input[name="selected_emails[]"]').forEach(el => el.remove());

    selectedCheckboxes.forEach(cb => {
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'selected_emails[]';
        hiddenInput.value = cb.value;
        e.target.appendChild(hiddenInput);
    });
});

// Select All checkbox functionality
document.getElementById('selectAllCheckbox').addEventListener('change', function() {
    const allCheckboxes = document.querySelectorAll('.subscriber-checkbox');
    allCheckboxes.forEach(cb => cb.checked = this.checked);
});
</script>

@endsection
