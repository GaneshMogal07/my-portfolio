@extends('admin.layout')

@section('content')
<h1 class="mb-4 h3">Edit Certificate</h1>
<form method="POST" action="{{ route('admin.certificates.update',$certificate) }}" enctype="multipart/form-data" class="row g-3">
    @csrf
    @method('PUT')
    <div class="col-md-6">
        <label class="form-label">Title</label>
        <input class="form-control" type="text" name="title" value="{{ old('title',$certificate->title) }}" required>
        @error('title')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Level</label>
        <input class="form-control" type="text" name="level" value="{{ old('level',$certificate->level) }}">
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea class="form-control" name="description">{{ old('description',$certificate->description) }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">Current File</label>
        <div><a class="btn btn-sm btn-outline-secondary" href="{{ asset('storage/'.$certificate->file_path) }}" target="_blank">Open</a></div>
    </div>
    <div class="col-md-6">
        <label class="form-label">Replace File</label>
        <input class="form-control" type="file" name="file">
        @error('file')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-3">
        <label class="form-label">Issue Date</label>
        <input class="form-control" type="date" name="issue_date" value="{{ old('issue_date',optional($certificate->issue_date)->format('Y-m-d')) }}">
    </div>
    <div class="col-md-3">
        <label class="form-label">Expires At</label>
        <input class="form-control" type="date" name="expires_at" value="{{ old('expires_at',optional($certificate->expires_at)->format('Y-m-d')) }}">
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Update</button>
        <a class="btn btn-secondary" href="{{ route('admin.certificates.index') }}">Cancel</a>
    </div>
</form>
@endsection
