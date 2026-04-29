@extends('admin.layout')

@section('content')
<h1 class="mb-3">Edit Skill</h1>
<form method="POST" action="{{ route('admin.skills.update',$skill) }}" class="row g-3">
    @csrf
    @method('PUT')
    <div class="col-md-4">
        <label class="form-label">Name</label>
        <input class="form-control" type="text" name="name" value="{{ old('name',$skill->name) }}" required>
        @error('name')<div class="text-danger">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Category</label>
        <input class="form-control" type="text" name="category" value="{{ old('category',$skill->category) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Level</label>
        <input class="form-control" type="text" name="level" value="{{ old('level',$skill->level) }}">
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Update</button>
        <a class="btn btn-secondary" href="{{ route('admin.skills.index') }}">Cancel</a>
    </div>
</form>
@endsection
