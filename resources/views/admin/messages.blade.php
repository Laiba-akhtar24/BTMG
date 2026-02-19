@extends('admin.layouts.admin')

@section('content')
<h1>Contact Messages</h1>

@if(session('success'))
<p style="color:#00ff9c">{{ session('success') }}</p>
@endif

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Status</th>
            <th>Reply</th>
        </tr>
    </thead>
    <tbody>
        @foreach($messages as $msg)
        <tr>
            <td>{{ $msg['name'] }}</td>
            <td>{{ $msg['email'] }}</td>
            <td>{{ $msg['message'] }}</td>
            <td>{{ $msg['status'] ?? 'pending' }}</td>
            <td>
                <form method="POST"
                      action="{{ route('admin.messages.reply', (string)$msg['_id']) }}">
                    @csrf
                    <textarea name="reply" required></textarea><br>
                    <button type="submit">Send Reply</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
