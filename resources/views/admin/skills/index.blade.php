@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="flex-grow-1 text-center">Skills</h1>
    <a class="btn btn-primary" href="{{ route('admin.skills.create') }}">Add Skill</a>
</div>
<div class="card shadow-sm">
    <div class="card-body">
<div class="table-responsive">
<table class="table table-striped align-middle">
    <thead>
        <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Level</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($skills as $s)
        <tr>
            <td>{{ $s->name }}</td>
            <td>{{ $s->category }}</td>
            <td>{{ $s->level }}</td>
            <td>
                <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.skills.edit',$s) }}">Edit</a>
                <form action="{{ route('admin.skills.destroy',$s) }}" method="POST" class="d-inline">
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
{{ $skills->links() }}
</div>
    </div>
</div>
@endsection
