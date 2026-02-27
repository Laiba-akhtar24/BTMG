@extends('admin.layout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/contact-submissions.css') }}">

<div class="container-fluid">
    <h2 class="mb-4">Contact Submissions</h2>

    @if(count($leads) > 0)
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Date</th>
                <th>Replied</th>
                <th>Viewed</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leads as $lead)
            <tr>
                <td>{{ $lead['name'] ?? '' }}</td>
                <td>{{ $lead['email'] ?? '' }}</td>
                <td>
                    {{ isset($lead['_id']) ? date('d M Y', $lead['_id']->getTimestamp()) : '' }}
                </td>
                <td>{{ $lead['replied'] ?? 'Pending' }}</td>
                <td>{{ $lead['viewed'] ?? 'Not Viewed' }}</td>
                <!-- Trigger Button -->
                <td>
                    <button class="btn btn-sm btn-primary edit" data-bs-toggle="modal" data-bs-target="#contactModal{{ $lead['_id'] }}">
                        View Details
                    </button>
                </td>

                <!-- Modal -->
                <div class="modal fade" id="contactModal{{ $lead['_id'] }}" tabindex="-1" aria-labelledby="contactModalLabel{{ $lead['_id'] }}" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="contactModalLabel{{ $lead['_id'] }}">
                            <i class="fas fa-envelope me-2"></i> Contact Details
                            <small class="d-block text-white-50" style="font-size: 12px;">View & Reply</small>
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <!-- Modal Body -->
                      <div class="modal-body">
                        <div class="row mb-3">
                          <div class="col-md-6">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" class="form-control" value="{{ $lead['name'] ?? '' }}" readonly>
                          </div>
                          <div class="col-md-6">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" value="{{ $lead['email'] ?? '' }}" readonly>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label class="form-label fw-bold">Message</label>
                          <textarea class="form-control" rows="4" readonly>{{ $lead['message'] ?? '' }}</textarea>
                        </div>

                        <hr>

                        <form method="POST" action="{{ route('admin.contact.reply', $lead['_id']) }}">
                          @csrf
                          <div class="mb-3">
                            <label class="form-label fw-bold">Reply Message</label>
                            <textarea class="form-control" name="reply_message" rows="4" placeholder="Write your reply..." required></textarea>
                          </div>
                          <button type="submit" class="btn btn-warning">Send Reply</button>
                        </form>
                      </div>

                    </div>
                  </div>
                </div>

            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p class="text-muted">No contact submissions yet.</p>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mark as viewed when modal opens
    const viewButtons = document.querySelectorAll('button[data-bs-toggle="modal"]');

    viewButtons.forEach(button => {
        const leadId = button.getAttribute('data-bs-target').replace('#contactModal', '');
        const modal = document.querySelector('#contactModal' + leadId);

        modal.addEventListener('shown.bs.modal', function () {
            fetch("{{ url('admin/contact/viewed') }}/" + leadId, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const row = button.closest('tr');
                    row.querySelector('td:nth-child(5)').textContent = 'Viewed';
                }
            });
        });
    });
});
</script>

@endsection