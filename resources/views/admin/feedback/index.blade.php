@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 flex-grow-1 text-center">Feedback</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.feedback.create') }}" class="btn btn-sm btn-outline-secondary">
                Add Feedback
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Employee Name</th>
                    <th>Company</th>
                    <th>Rating</th>
                    <th>Featured</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($feedbacks as $feedback)
                    <tr>
                        <td>{{ $feedback->id }}</td>
                        <td>{{ $feedback->employee_name }}</td>
                        <td>{{ $feedback->company }}</td>
                        <td>{{ $feedback->rating }}</td>
                        <td>{{ $feedback->is_featured ? 'Yes' : 'No' }}</td>
                        <td>
                            <a href="{{ route('admin.feedback.edit', $feedback) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <form action="{{ route('admin.feedback.destroy', $feedback) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
