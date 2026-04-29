<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.home') }}">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.home') ? 'active fw-bold border-bottom' : '' }}" href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.certificates.*') ? 'active fw-bold border-bottom' : '' }}" href="{{ route('admin.certificates.index') }}">Certificates</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.skills.*') ? 'active fw-bold border-bottom' : '' }}" href="{{ route('admin.skills.index') }}">Skills</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active fw-bold border-bottom' : '' }}" href="{{ route('admin.projects.index') }}">Projects</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active fw-bold border-bottom' : '' }}" href="{{ route('admin.profile.edit') }}">Home/About/Resume</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.educations.*') ? 'active fw-bold border-bottom' : '' }}" href="{{ route('admin.educations.index') }}">Education</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.experiences.*') ? 'active fw-bold border-bottom' : '' }}" href="{{ route('admin.experiences.index') }}">Experience</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.feedback.*') ? 'active fw-bold border-bottom' : '' }}" href="{{ route('admin.feedback.index') }}">Feedback</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active fw-bold border-bottom' : '' }}" href="{{ route('admin.contacts.index') }}">Messages</a></li>
                </ul>
                <form method="POST" action="{{ route('admin.logout') }}" class="d-flex">
                    @csrf
                    <button class="btn btn-outline-light btn-sm" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    <main class="container py-4">
        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
