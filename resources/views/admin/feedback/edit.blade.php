@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Feedback</h1>
    </div>

    <form action="{{ route('admin.feedback.update', $feedback) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="employee_name" class="form-label">Employee Name</label>
            <input type="text" class="form-control" id="employee_name" name="employee_name" value="{{ $feedback->employee_name }}" required>
        </div>
        <div class="mb-3">
            <label for="company" class="form-label">Company</label>
            <input type="text" class="form-control" id="company" name="company" value="{{ $feedback->company }}">
        </div>
        <div class="mb-3">
            <label for="feedback" class="form-label">Feedback</label>
            <textarea class="form-control" id="feedback" name="feedback" rows="3" required>{{ $feedback->feedback }}</textarea>
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" value="{{ $feedback->rating }}" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1" {{ $feedback->is_featured ? 'checked' : '' }}>
            <label class="form-check-label" for="is_featured">Featured</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
