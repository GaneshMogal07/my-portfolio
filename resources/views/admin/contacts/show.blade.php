@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Message from {{ $contact->name }}</h1>
    <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary">Back to Messages</a>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <div class="mb-3">
            <strong>Date:</strong> {{ $contact->created_at->format('Y-m-d H:i') }}
        </div>
        <div class="mb-3">
            <strong>Name:</strong> {{ $contact->name }}
        </div>
        <div class="mb-3">
            <strong>Email:</strong> {{ $contact->email }}
        </div>
        <div class="mb-3">
            <strong>Subject:</strong> {{ $contact->subject }}
        </div>
        <div class="mb-3">
            <strong>Message:</strong>
            <p class="mt-2 p-3 bg-light border rounded">
                {{ $contact->message }}
            </p>
        </div>
        <form action="{{ route('admin.contacts.destroy',$contact) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger" type="submit">Delete Message</button>
        </form>
    </div>
</div>
@endsection
