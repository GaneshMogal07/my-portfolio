@extends('admin.layout')

@section('content')
<h1 class="mb-3">Add Project</h1>
<form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" class="row g-3">
    @csrf
    <div class="col-md-6">
        <label class="form-label">Title</label>
        <input class="form-control" type="text" name="title" value="{{ old('title') }}" required>
        @error('title')<div class="text-danger">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea class="form-control" name="description">{{ old('description') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">Technologies (comma separated)</label>
        <input class="form-control" type="text" name="technologies" value="{{ old('technologies') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Image</label>
        <input class="form-control" type="file" name="image">
        @error('image')<div class="text-danger">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Project URL</label>
        <input class="form-control" type="url" name="project_url" value="{{ old('project_url') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Created Date</label>
        <input class="form-control" type="date" name="created_date" value="{{ old('created_date') }}">
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Save</button>
        <a class="btn btn-secondary" href="{{ route('admin.projects.index') }}">Cancel</a>
    </div>
</form>
@endsection
