@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="flex-grow-1 text-center">Education</h1>
    <a class="btn btn-primary" href="{{ route('admin.educations.create') }}">Add Education</a>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Institution</th>
                        <th>Degree</th>
                        <th>Period</th>
                        <th>Grade</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($educations as $e)
                    <tr>
                        <td>{{ $e->institution }}</td>
                        <td>{{ $e->degree }}</td>
                        <td>{{ $e->start_date?->format('Y') }} - {{ $e->end_date?->format('Y') }}</td>
                        <td>{{ $e->grade }}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.educations.edit',$e) }}">Edit</a>
                            <form action="{{ route('admin.educations.destroy',$e) }}" method="POST" class="d-inline">
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
            {{ $educations->links() }}
        </div>
    </div>
</div>
@endsection
