@extends('admin.layout')

@section('content')
<h1 class="mb-4 h3">Add Certificate</h1>
<form method="POST" action="{{ route('admin.certificates.store') }}" enctype="multipart/form-data" class="row g-3">
    @csrf
    <div class="col-md-6">
        <label class="form-label">Title</label>
        <input class="form-control" type="text" name="title" value="{{ old('title') }}" required>
        @error('title')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Level</label>
        <input class="form-control" type="text" name="level" value="{{ old('level') }}">
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea class="form-control" name="description">{{ old('description') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">Certificate File (pdf/jpg/png)</label>
        <input class="form-control" type="file" name="file" required>
        @error('file')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-3">
        <label class="form-label">Issue Date</label>
        <input class="form-control" type="date" name="issue_date" value="{{ old('issue_date') }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">Expires At</label>
        <input class="form-control" type="date" name="expires_at" value="{{ old('expires_at') }}">
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Save</button>
        <a class="btn btn-secondary" href="{{ route('admin.certificates.index') }}">Cancel</a>
    </div>
</form>
@endsection
