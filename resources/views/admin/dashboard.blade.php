@extends('admin.layout')

@section('content')
<div class="row mb-4">
    <div class="col-12 text-center">
        <h1 class="h2">Admin Dashboard</h1>
        <p class="text-muted">Manage all your portfolio content from here.</p>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button class="btn btn-outline-danger btn-sm" type="submit">Logout</button>
        </form>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm text-center">
            <div class="card-body">
                <i class="fas fa-user-circle fa-3x text-primary mb-3"></i>
                <h5 class="card-title">Home & About</h5>
                <p class="card-text text-muted">Manage your profile, job title, company, and summary.</p>
                <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary btn-sm">Manage Home/About</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm text-center">
            <div class="card-body">
                <i class="fas fa-certificate fa-3x text-success mb-3"></i>
                <h5 class="card-title">Certifications</h5>
                <p class="card-text text-muted">You have {{ $stats['certificates'] }} certifications.</p>
                <a href="{{ route('admin.certificates.index') }}" class="btn btn-success btn-sm">Manage Certificates</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm text-center">
            <div class="card-body">
                <i class="fas fa-tools fa-3x text-info mb-3"></i>
                <h5 class="card-title">Skills</h5>
                <p class="card-text text-muted">You have {{ $stats['skills'] }} skills added.</p>
                <a href="{{ route('admin.skills.index') }}" class="btn btn-info btn-sm">Manage Skills</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm text-center">
            <div class="card-body">
                <i class="fas fa-project-diagram fa-3x text-warning mb-3"></i>
                <h5 class="card-title">Projects</h5>
                <p class="card-text text-muted">You have {{ $stats['projects'] }} projects showcased.</p>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-warning btn-sm">Manage Projects</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm text-center">
            <div class="card-body">
                <i class="fas fa-graduation-cap fa-3x text-danger mb-3"></i>
                <h5 class="card-title">Education</h5>
                <p class="card-text text-muted">You have {{ $stats['education'] }} education entries.</p>
                <a href="{{ route('admin.educations.index') }}" class="btn btn-danger btn-sm">Manage Education</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm text-center">
            <div class="card-body">
                <i class="fas fa-briefcase fa-3x text-secondary mb-3"></i>
                <h5 class="card-title">Experience</h5>
                <p class="card-text text-muted">You have {{ $stats['experience'] }} work experiences.</p>
                <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary btn-sm">Manage Experience</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm text-center">
            <div class="card-body">
                <i class="fas fa-comments fa-3x text-dark mb-3"></i>
                <h5 class="card-title">Feedback</h5>
                <p class="card-text text-muted">You have {{ $stats['feedback'] }} testimonials.</p>
                <a href="{{ route('admin.feedback.index') }}" class="btn btn-dark btn-sm">Manage Feedback</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm text-center">
            <div class="card-body">
                <i class="fas fa-envelope fa-3x text-primary mb-3"></i>
                <h5 class="card-title">Messages</h5>
                <p class="card-text text-muted">You have {{ $stats['messages'] }} incoming messages.</p>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-primary btn-sm">View Messages</a>
            </div>
        </div>
    </div>
</div>
@endsection
