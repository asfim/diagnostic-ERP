@extends('layouts.admin')
@section('title', 'Contact Messages')
@section('content')
<div class="page-header-premium"><div><h4><i class="fa-solid fa-inbox me-2"></i>Contact Messages</h4><p>Messages submitted from the public Contact page</p></div></div>
@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
<div class="card card-premium"><div class="table-responsive"><table class="table table-premium mb-0"><thead><tr><th>Name</th><th>Email</th><th>Subject</th><th>Received</th><th>Status</th><th>View</th></tr></thead><tbody>@forelse($messages as $message)<tr><td class="fw-semibold">{{ $message->name }}<br><small class="text-muted">{{ $message->phone ?: 'No phone' }}</small></td><td>{{ $message->email }}</td><td>{{ $message->subject }}</td><td>{{ $message->created_at->format('M d, Y h:i A') }}</td><td><span class="status-pill {{ $message->status === 'unread' ? 'pill-warning' : 'pill-success' }}">{{ ucfirst($message->status) }}</span></td><td><a href="{{ route('contact-messages.show', $message) }}" class="action-btn action-btn-view"><i class="fa-solid fa-eye"></i></a></td></tr>@empty<tr><td colspan="6" class="text-center py-5 text-muted">No contact messages yet.</td></tr>@endforelse</tbody></table></div><div class="px-4 py-3">{{ $messages->links() }}</div></div>
@endsection
