@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="flex-grow-1 text-center">Projects</h1>
    <a class="btn btn-primary" href="{{ route('admin.projects.create') }}">Add Project</a>
</div>
<div class="card shadow-sm">
    <div class="card-body">
<div class="table-responsive">
<table class="table table-striped align-middle">
    <thead>
        <tr>
            <th>Title</th>
            <th>Technologies</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projects as $p)
        <tr>
            <td>{{ $p->title }}</td>
            <td>{{ $p->technologies }}</td>
            <td>{{ $p->created_date?->format('Y-m-d') }}</td>
            <td>
                <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.projects.edit',$p) }}">Edit</a>
                <form action="{{ route('admin.projects.destroy',$p) }}" method="POST" class="d-inline">
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
{{ $projects->links() }}
</div>
    </div>
</div>
@endsection
