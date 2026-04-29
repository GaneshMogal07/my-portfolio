@extends('admin.layout')

@section('content')
<h1 class="mb-3 h3">Add Education</h1>
<form method="POST" action="{{ route('admin.educations.store') }}" class="row g-3">
    @csrf
    <div class="col-md-6">
        <label class="form-label">Institution</label>
        <input class="form-control" type="text" name="institution" value="{{ old('institution') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Degree</label>
        <input class="form-control" type="text" name="degree" value="{{ old('degree') }}">
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
        <label class="form-label">Grade</label>
        <input class="form-control" type="text" name="grade" value="{{ old('grade') }}">
    </div>
    <div class="col-12">
        <label class="form-label">Details</label>
        <input class="form-control" type="text" name="details" value="{{ old('details') }}">
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Save</button>
        <a class="btn btn-secondary" href="{{ route('admin.educations.index') }}">Cancel</a>
    </div>
</form>
@endsection
