<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganesh Mogal - Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark shadow-sm">
        <div class="container-fluid px-4">
            <a class="navbar-brand d-flex align-items-center mb-0" href="{{ url('/') }}">
                <span class="d-none d-sm-inline">Ganesh Mogal</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link small" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link small" href="#experience">Experience</a></li>
                    <li class="nav-item"><a class="nav-link small" href="#skills">Skills</a></li>
                    <li class="nav-item"><a class="nav-link small" href="#certifications">Certifications</a></li>
                    <li class="nav-item"><a class="nav-link small" href="#projects">Projects</a></li>
                    <li class="nav-item"><a class="nav-link small" href="#feedback">Feedback</a></li>
                    <li class="nav-item"><a class="nav-link small" href="#contact">Contact Me</a></li>
                </ul>
                <div class="d-flex gap-2 align-items-center ms-lg-3">
                    <a href="{{ route('download_resume_pdf') }}" class="btn btn-outline-light btn-sm"><i class="fas fa-file-pdf me-1"></i>PDF</a>
                    <a href="{{ route('download_resume_word') }}" class="btn btn-outline-light btn-sm"><i class="fas fa-file-word me-1"></i>Word</a>
                    @if(Session::has('admin_id'))
                        <form method="POST" action="{{ route('admin.logout') }}" class="m-0">
                            @csrf
                            <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-sign-out-alt me-1"></i>Logout</button>
                        </form>
                    @else
                        <a class="btn btn-info btn-sm" href="{{ route('admin.home') }}"><i class="fas fa-user-shield me-1"></i>Admin Login</a>
                    @endif
                    <a class="navbar-brand d-flex align-items-center mb-0" href="{{ url('/') }}">
                        @if(isset($profile) && $profile->image_path && file_exists(storage_path('app/public/'.$profile->image_path)))
                            <img src="{{ asset('storage/'.$profile->image_path) }}" alt="GM" class="rounded-circle ms-2" style="width: 35px; height: 35px; object-fit: cover;">
                        @else
                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center ms-2" style="width: 35px; height: 35px;">
                                <span class="text-white fw-bold small">GM</span>
                            </div>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="pt-5 mt-5"></div>

    @include('portfolio_sections')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openBtn = document.getElementById('chat-open');
            if (openBtn) {
                openBtn.addEventListener('click', function () {
                    const btn = document.querySelector('.chat-button');
                    if (btn) btn.click();
                });
            }
        });
    </script>
</body>
</html>
