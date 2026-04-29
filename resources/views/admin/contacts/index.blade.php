@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 flex-grow-1 text-center">Contact Messages</h1>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $c)
                    <tr>
                        <td>{{ $c->created_at->format('Y-m-d H:i') }}</td>
                        <td>{{ $c->name }}</td>
                        <td>{{ $c->email }}</td>
                        <td>{{ $c->subject }}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.contacts.show',$c) }}">View</a>
                            <form action="{{ route('admin.contacts.destroy',$c) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            {{ $contacts->links() }}
        </div>
    </div>
</div>
@endsection
