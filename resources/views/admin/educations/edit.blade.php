@extends('admin.layout')

@section('content')
<h1 class="mb-3 h3">Edit Education</h1>
<form method="POST" action="{{ route('admin.educations.update',$education) }}" class="row g-3">
    @csrf
    @method('PUT')
    <div class="col-md-6">
        <label class="form-label">Institution</label>
        <input class="form-control" type="text" name="institution" value="{{ old('institution',$education->institution) }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Degree</label>
        <input class="form-control" type="text" name="degree" value="{{ old('degree',$education->degree) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Start Date</label>
        <input class="form-control" type="date" name="start_date" value="{{ old('start_date',optional($education->start_date)->format('Y-m-d')) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">End Date</label>
        <input class="form-control" type="date" name="end_date" value="{{ old('end_date',optional($education->end_date)->format('Y-m-d')) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Grade</label>
        <input class="form-control" type="text" name="grade" value="{{ old('grade',$education->grade) }}">
    </div>
    <div class="col-12">
        <label class="form-label">Details</label>
        <input class="form-control" type="text" name="details" value="{{ old('details',$education->details) }}">
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Update</button>
        <a class="btn btn-secondary" href="{{ route('admin.educations.index') }}">Cancel</a>
    </div>
</form>
@endsection
