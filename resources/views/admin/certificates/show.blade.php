@extends('admin.layout')

@section('content')
<h1 class="mb-4">{{ $certificate->title }}</h1>
<p>{{ $certificate->description }}</p>
<p>Issue: {{ $certificate->issue_date?->format('Y-m-d') }}</p>
<p>Expires: {{ $certificate->expires_at?->format('Y-m-d') }}</p>
<p>
    <a href="{{ asset('storage/'.$certificate->file_path) }}" target="_blank">Open File</a>
</p>
@endsection
