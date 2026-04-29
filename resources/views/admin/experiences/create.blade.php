@extends('admin.layout')

@section('content')
<h1 class="mb-3 h3">Add Experience</h1>
<form method="POST" action="{{ route('admin.experiences.store') }}" class="row g-3">
    @csrf
    <div class="col-md-6">
        <label class="form-label">Title</label>
        <input class="form-control" type="text" name="title" value="{{ old('title') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Company</label>
        <input class="form-control" type="text" name="company" value="{{ old('company') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Start Date</label>
        <input class="form-control" type="date" name="start_date" value="{{ old('start_date') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">End Date</label>
        <input class="form-control" type="date" name="end_date" value="{{ old('end_date') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Location</label>
        <input class="form-control" type="text" name="location" value="{{ old('location') }}">
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea class="form-control" name="description" rows="4">{{ old('description') }}</textarea>
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Save</button>
        <a class="btn btn-secondary" href="{{ route('admin.experiences.index') }}">Cancel</a>
    </div>
</form>
@endsection
