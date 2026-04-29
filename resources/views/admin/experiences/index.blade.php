@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="flex-grow-1 text-center"></h1>
    <a class="btn btn-primary" href="{{ route('admin.experiences.create') }}">Add Experience</a>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Company</th>
                        <th>Period</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($experiences as $e)
                    <tr>
                        <td>{{ $e->title }}</td>
                        <td>{{ $e->company }}</td>
                        <td>{{ $e->start_date?->format('M Y') }} - {{ $e->end_date?->format('M Y') ?? 'Present' }}</td>
                        <td>{{ $e->location }}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.experiences.edit',$e) }}">Edit</a>
                            <form action="{{ route('admin.experiences.destroy',$e) }}" method="POST" class="d-inline">
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
            {{ $experiences->links() }}
        </div>
    </div>
</div>
@endsection
