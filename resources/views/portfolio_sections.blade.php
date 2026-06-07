<section id="home" class="hero-section">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-md-4 text-center">
                <img src="{{ isset($profile) && $profile->image_path ? asset('storage/'.$profile->image_path) : url('/static/images/profile.jpg') }}" alt="Ganesh Mogal" class="img-fluid rounded-circle mb-4" style="width: 250px; height: 250px; object-fit: cover;">
            </div>
            <div class="col-md-8">
                <h1 class="display-4 text-center">Hi, I'm Ganesh Mogal</h1>
                <p class="lead text-center">B.E in Computer Engineering</p>
                <div class="text-center my-3">
                    <p class="lead mb-1">
                        <i class="fas fa-briefcase text-primary me-2"></i>
                        <strong>{{ optional($profile)->current_job_title ?? 'Junior Software Developer' }}</strong>
                    </p>
                   <p class="text-muted mb-0">
                    {{ optional($profile)->current_job_company ?? 'TH Systems Pvt. Ltd.' }} |
                    <i class="far fa-calendar-alt me-1"></i>
                    {{ optional(optional($profile)->current_job_start_date)->format('d-M-Y') }}
                    – {{ now()->format('d-M-Y') }} – Present
                </p>
                </div>
                <p class="lead text-center">
                    {{ optional($profile)->summary ?? 'Looking for Full-Time opportunities in the software engineering field. With 5+ years of learning experience, I have gained extensive knowledge and skills in building software.' }}
                </p>
                <div class="d-flex justify-content-center flex-wrap align-items-center gap-3 mt-3">
                    <div class="social-links">
                        <a href="https://linkedin.com/in/ganesh-mogal-1412232a4" target="_blank" class="text-decoration-none">
                            <i class="fab fa-linkedin fa-lg"></i>
                        </a>
                        <a href="https://github.com/Ganeshmogal" target="_blank" class="text-decoration-none ms-3">
                            <i class="fab fa-github fa-lg"></i>
                        </a>
                    </div>
                    <a href="#contact" class="btn btn-primary ms-3">
                        <i class="fas fa-envelope me-2"></i>Contact Me
                    </a>
                    {{-- Chat button removed from hero; floating button is available --}}
                </div>
            </div>
        </div>
    </div>
</section>

<section id="about" class="py-5">
    <div class="container">
        <h2 class="section-title text-center">About Me</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="card-header-lite">
                            <h3 class="h5 mb-0"><i class="fas fa-user-circle me-2 text-primary"></i>About Me</h3>
                            @if(optional($profile)->current_job_title)
                            <span class="badge badge-soft-primary">{{ $profile->current_job_title }}</span>
                            @endif
                        </div>
                        <div id="profile-view">
                            <p id="profile-summary">{{ optional($profile)->summary }}</p>
                            <div class="meta-row mt-2">
                                @if(optional($profile)->current_job_company)
                                <span class="meta-item"><i class="fas fa-building"></i>{{ $profile->current_job_company }}</span>
                                @endif
                                @if(optional($profile)->current_job_start_date)
                                <span class="meta-item"><i class="far fa-calendar-alt"></i>{{ optional($profile->current_job_start_date)->format('d-M-Y') }} – Present</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6" id="education">
                <h3>Education</h3>
                <div class="education-section">
                    @if(isset($educations))
                        @foreach($educations as $ed)
                        <div class="education-card">
                            <div class="card-header-lite">
                                <h4 class="mb-0">{{ $ed->institution }}</h4>
                                <div class="d-flex gap-2">
                                    @if($ed->degree)<span class="badge badge-soft-primary">{{ $ed->degree }}</span>@endif
                                    @if($ed->grade)<span class="badge badge-soft-secondary">{{ $ed->grade }}</span>@endif
                                </div>
                            </div>
                            <div class="meta-row mb-2">
                                <span class="meta-item"><i class="far fa-calendar-alt"></i>{{ $ed->start_date?->format('Y') }} - {{ $ed->end_date?->format('Y') }}</span>
                            </div>
                            @if($ed->details)<p class="education-courses">{{ $ed->details }}</p>@endif
                        </div>
                        @endforeach
                        @if($educations->isEmpty())
                            <p class="text-muted">No education entries added yet.</p>
                        @endif
                    @endif
                </div>
                <div class="mt-4">
                    <h3>Resume</h3>
                    <div class="resume-update">
                        <div class="d-flex flex-column flex-sm-row gap-2 mb-3">
                            <a href="{{ route('download_resume_pdf') }}" class="btn btn-primary w-100 w-sm-auto"><i class="fas fa-file-pdf me-2"></i>PDF Version</a>
                            <a href="{{ route('download_resume_word') }}" class="btn btn-secondary w-100 w-sm-auto"><i class="fas fa-file-word me-2"></i>Word Version</a>
                        </div>
                        <div class="resume-status">
                            <p class="text-muted"><i class="fas fa-clock me-2"></i>Last updated: <span id="resume-update-date">January 2026</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="experience" class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center mb-5">Professional Experience</h2>

        <div class="row">
            @if(isset($experiences) && $experiences->count())

                @foreach($experiences as $ex)
                <div class="col-md-4 mb-4"> <!-- ✅ 3 cards per row -->

                    <div class="education-card h-100 shadow-sm p-3">

                        <!-- Title + Date -->
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="mb-0 fw-bold">{{ $ex->title }}</h5>
                            <span class="badge badge-soft-primary small">
                                {{ $ex->start_date?->format('M Y') }} -
                                {{ $ex->end_date?->format('M Y') ?? 'Present' }}
                            </span>
                        </div>

                        <!-- Company -->
                        <p class="text-muted mb-1">
                            <i class="fas fa-building me-1"></i>
                            {{ $ex->company }}
                        </p>

                        <!-- Location -->
                        @if($ex->location)
                        <p class="text-muted mb-2">
                            <i class="fas fa-map-marker-alt me-1"></i>
                            {{ $ex->location }}
                        </p>
                        @endif

                        <!-- Description -->
                        @if($ex->description)
                        <p class="text-secondary small mb-0">
                            {{ $ex->description }}
                        </p>
                        @endif

                    </div>

                </div>
                @endforeach

            @else
                <div class="col-12">
                    <p class="text-muted text-center">No experience entries added yet.</p>
                </div>
            @endif
        </div>
    </div>
</section>

<section id="skills" class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center">Skills</h2>
        <div class="row">
            @php
                $grouped = isset($skills) ? $skills->groupBy('category') : collect();
            @endphp
            @foreach($grouped as $category => $items)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title">{{ $category ?? 'Skills' }}</h3>
                        <ul class="list-unstyled card-text">
                            @foreach($items as $s)
                                <li>{{ $s->name }} @if($s->level) - {{ $s->level }} @endif</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
            @if(isset($skills) && $skills->isEmpty())
            <div class="col-12">
                <p class="text-muted">No skills added yet.</p>
            </div>
            @endif
        </div>
    </div>
</section>

<section id="certifications" class="py-5 bg-light">
    <div class="container">
      <h2 class="section-title text-center mb-4">Certifications</h2>
      <div class="row" id="certifications-list">
        @if(isset($certs))
            @foreach($certs as $c)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm education-card">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">{{ $c->title }}</h5>
                            @if($c->level)
                            <span class="badge bg-primary">{{ $c->level }}</span>
                            @endif
                        </div>
                        @php
                            $isImage = $c->file_path ? \Illuminate\Support\Str::endsWith(strtolower($c->file_path), ['.png','.jpg','.jpeg','.webp']) : false;
                        @endphp
                        @if($isImage)
                        <div class="mt-3">
                            <img src="{{ asset('storage/'.$c->file_path) }}" alt="{{ $c->title }}" class="img-fluid rounded">
                        </div>
                        @else
                        <div class="mt-3">
                            <a href="{{ asset('storage/'.$c->file_path) }}" target="_blank" class="btn btn-outline-secondary btn-sm">Open File</a>
                        </div>
                        @endif
                        <div class="mt-3 text-muted">
                            @if($c->issue_date)<div>Issue: {{ $c->issue_date->format('Y-m-d') }}</div>@endif
                            @if($c->expires_at)<div>Expires: {{ $c->expires_at->format('Y-m-d') }}</div>@endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @if($certs->isEmpty())
            <div class="col-12"><p class="text-muted">No certifications added yet.</p></div>
            @endif
        @endif
      </div>
    </div>
  </section>

<section id="projects" class="py-5">
    <div class="container">
        <h2 class="section-title text-center">Personal Projects</h2>
        <div class="row g-4">
            @if(isset($projects))
                @foreach($projects as $p)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        @if($p->image_path)
                        <img src="{{ asset('storage/'.$p->image_path) }}" class="card-img-top" alt="{{ $p->title }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $p->title }}</h5>
                            @if($p->created_date)
                            <p class="card-subtitle mb-2 text-muted">{{ $p->created_date->format('Y') }}</p>
                            @endif
                            @if($p->description)
                            <p class="card-text">{{ $p->description }}</p>
                            @endif
                            @if($p->technologies)
                            <div class="mb-3">
                                <h6 class="fw-bold">Technologies Used:</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach(explode(',', $p->technologies) as $t)
                                    <span class="badge bg-primary">{{ trim($t) }}</span>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            @if($p->project_url)
                            <a href="{{ $p->project_url }}" target="_blank" class="btn btn-outline-primary">View Project</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                @if($projects->isEmpty())
                <div class="col-12"><p class="text-muted">No projects added yet.</p></div>
                @endif
            @endif
        </div>
    </div>
</section>

<section id="feedback" class="py-5">
    <div class="container">
        <h2 class="section-title text-center">Employee Feedback</h2>
        <div class="row">
            @if(isset($feedbacks))
                @foreach($feedbacks as $f)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0 bg-light">
                        <div class="card-body">
                            <div class="d-flex mb-3">
                                @for($i = 0; $i < $f->rating; $i++)
                                    <i class="fas fa-star text-warning"></i>
                                @endfor
                            </div>
                            <p class="card-text italic">"{{ $f->feedback }}"</p>
                            <div class="mt-3">
                                <h6 class="mb-0 fw-bold">{{ $f->employee_name }}</h6>
                                @if($f->company)
                                <small class="text-muted">{{ $f->company }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @if($feedbacks->isEmpty())
                <div class="col-12"><p class="text-muted">No feedback shared yet.</p></div>
                @endif
            @endif
        </div>
    </div>
</section>

<section id="feedback-form-section" class="py-5 bg-light">
    <div class="container">
        <div class="contact-form shadow-lg mx-auto" style="max-width: 600px;">
            <h2 class="section-title text-center h4 mb-4">Share Your Feedback</h2>
            <form id="user-feedback-form" action="/feedback" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" name="employee_name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="company" class="form-control" placeholder="Your Company (Optional)">
                </div>
                <div class="mb-3">
                    <label class="form-label">Rating</label>
                    <div class="d-flex flex-wrap gap-2">
                        @for($i = 1; $i <= 5; $i++)
                            <input type="radio" name="rating" value="{{ $i }}" id="rating-{{ $i }}" class="btn-check" required>
                            <label class="btn btn-outline-primary" for="rating-{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</label>
                        @endfor
                    </div>
                </div>
                <div class="mb-3">
                    <textarea name="feedback" class="form-control" rows="4" placeholder="Your Feedback" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit Feedback</button>
                <div id="feedback-form-message" class="mt-3"></div>
            </form>
        </div>
    </div>
</section>

<section id="contact" class="py-5">
    <div class="container">
        <div class="contact-form shadow-lg mx-auto" style="max-width: 600px;">
            <h2 class="section-title text-center h4 mb-4">Contact Me</h2>
            <form id="contact-form" action="/contact" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                </div>
                <div class="mb-3">
                    <textarea name="message" class="form-control" rows="4" placeholder="Your Message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Send Message</button>
                <div id="form-message" class="mt-3"></div>
            </form>
        </div>
    </div>
</section>

<footer class="bg-dark text-white py-4">
    <div class="container text-center">
        <p>&copy; 2025 Ganesh Mogal. All rights reserved.</p>
    </div>
 </footer>
