@extends('admin.layout')

@section('content')
<h1 class="mb-3 text-center">Home/About/Resume</h1>
<form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="row g-3">
    @csrf
    <div class="col-12">
        <label class="form-label">Summary</label>
        <textarea class="form-control" name="summary" rows="6">{{ old('summary', optional($profile)->summary) }}</textarea>
    </div>
    <div class="col-md-4">
        <label class="form-label">Profile Image</label>
        <input class="form-control" type="file" name="image">
        @if(optional($profile)->image_path)
            <div class="mt-2">
                <a href="{{ asset('storage/'.optional($profile)->image_path) }}" target="_blank">Current Image</a>
            </div>
        @endif
    </div>
    <div class="col-md-4">
        <label class="form-label">Resume PDF</label>
        <input class="form-control" type="file" name="resume_pdf">
        @if(optional($profile)->resume_pdf_path)
            <div class="mt-2">
                <a href="{{ asset('storage/'.optional($profile)->resume_pdf_path) }}" target="_blank">Current PDF</a>
            </div>
        @endif
    </div>
    <div class="col-md-4">
        <label class="form-label">Resume Word</label>
        <input class="form-control" type="file" name="resume_doc">
        @if(optional($profile)->resume_doc_path)
            <div class="mt-2">
                <a href="{{ asset('storage/'.optional($profile)->resume_doc_path) }}" target="_blank">Current Word</a>
            </div>
        @endif
    </div>
    <div class="col-md-4">
        <label class="form-label">Current Job Title</label>
        <input class="form-control" type="text" name="current_job_title" value="{{ old('current_job_title', optional($profile)->current_job_title) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Current Job Company</label>
        <input class="form-control" type="text" name="current_job_company" value="{{ old('current_job_company', optional($profile)->current_job_company) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Current Job Start Date</label>
        <input class="form-control" type="date" name="current_job_start_date" value="{{ old('current_job_start_date', optional(optional($profile)->current_job_start_date)->format('Y-m-d')) }}">
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Save</button>
    </div>
</form>
@endsection
