@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 flex-grow-1 text-center">Certificates</h1>
    <a class="btn btn-primary" href="{{ route('admin.certificates.create') }}">Add Certificate</a>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Level</th>
                        <th>File</th>
                        <th>Issue Date</th>
                        <th>Expires</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($certificates as $c)
                    <tr>
                        <td>{{ $c->title }}</td>
                        <td>
                            @if($c->level)
                                <span class="badge bg-primary">{{ $c->level }}</span>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-sm btn-outline-secondary" href="{{ asset('storage/'.$c->file_path) }}" target="_blank">Open</a>
                        </td>
                        <td>{{ $c->issue_date?->format('Y-m-d') }}</td>
                        <td>{{ $c->expires_at?->format('Y-m-d') }}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.certificates.edit',$c) }}">Edit</a>
                            <form action="{{ route('admin.certificates.destroy',$c) }}" method="POST" class="d-inline">
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
            {{ $certificates->links() }}
        </div>
    </div>
</div>
@endsection
