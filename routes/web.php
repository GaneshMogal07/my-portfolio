<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ExperienceController;
use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;

Route::get('/', function () {
    $profile = Profile::first();
    $skills = Skill::orderBy('category')->orderBy('name')->get();
    $projects = Project::latest('created_date')->get();
    $educations = \App\Models\Education::orderBy('start_date','desc')->get();
    $experiences = \App\Models\Experience::orderBy('start_date','desc')->get();
    $certs = Certificate::latest()->get();
    $feedbacks = \App\Models\Feedback::where('is_featured', true)->latest()->take(5)->get();
    return view('index', compact('profile','skills','projects','educations','experiences','certs', 'feedbacks'));
});

use App\Http\Controllers\Admin\DashboardController;

Route::get('/admin', [DashboardController::class, 'index'])->middleware('admin.auth')->name('admin.home');

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware('admin.auth')->group(function () {
    Route::resource('/admin/certificates', CertificateController::class)->names('admin.certificates');
    Route::resource('/admin/skills', SkillController::class)->names('admin.skills');
    Route::resource('/admin/projects', ProjectController::class)->names('admin.projects');
    Route::resource('/admin/educations', EducationController::class)->names('admin.educations');
    Route::resource('/admin/experiences', ExperienceController::class)->names('admin.experiences');
    Route::resource('/admin/feedback', \App\Http\Controllers\Admin\FeedbackController::class)->names('admin.feedback');
    Route::resource('/admin/contacts', \App\Http\Controllers\Admin\ContactController::class)->names('admin.contacts');
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::post('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
});

Route::get('/static/{path}', function ($path) {
    $full = base_path('..\static\\' . $path);
    if (!file_exists($full)) {
        abort(404);
    }
    return response()->file($full);
})->where('path', '.*');

Route::get('/download_resume_pdf', function () {
    $profile = \App\Models\Profile::first();
    if ($profile && $profile->resume_pdf_path && file_exists(storage_path('app/public/'.$profile->resume_pdf_path))) {
        return response()->download(storage_path('app/public/'.$profile->resume_pdf_path), 'Ganesh_Mogal_Resume.pdf');
    }
    return response()->json(['error' => 'Resume not found'], 404);
})->name('download_resume_pdf');

Route::get('/download_resume_word', function () {
    $profile = \App\Models\Profile::first();
    if ($profile && $profile->resume_doc_path && file_exists(storage_path('app/public/'.$profile->resume_doc_path))) {
        return response()->download(storage_path('app/public/'.$profile->resume_doc_path), 'Ganesh_Mogal_Resume.docx');
    }
    return response()->json(['error' => 'Resume not found'], 404);
})->name('download_resume_word');

use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;
use App\Models\Feedback;

Route::post('/contact', function (Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    Contact::create($validated);

    Mail::to('mogalg71@gmail.com')->send(new ContactFormMail($validated));

    return response()->json(['status' => 'success', 'message' => 'Message sent successfully!']);
});

Route::post('/feedback', function (Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'employee_name' => 'required|string|max:255',
        'company' => 'nullable|string|max:255',
        'feedback' => 'required|string',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    $validated['is_featured'] = false;

    Feedback::create($validated);

    return response()->json(['status' => 'success', 'message' => 'Thank you for your feedback!']);
});

Route::get('/api/certifications', function () {
    return Certificate::latest()->get()->map(function ($c) {
        return [
            'id' => $c->id,
            'name' => $c->title,
            'level' => $c->level,
            'image_url' => $c->file_path ? asset('storage/'.$c->file_path) : null,
            'created_date' => optional($c->created_at)->toIso8601String(),
        ];
    });
});

Route::get('/api/projects', function () {
    return Project::latest('created_date')->get()->map(function ($p) {
        return [
            'id' => $p->id,
            'title' => $p->title,
            'description' => $p->description,
            'technologies' => $p->technologies ? explode(',', $p->technologies) : [],
            'image_url' => $p->image_path ? asset('storage/'.$p->image_path) : null,
            'project_url' => $p->project_url,
            'created_date' => optional($p->created_date)->format('Y-m-d'),
        ];
    });
});

Route::get('/api/profile', function () {
    $profile = \App\Models\Profile::first();
    if (!$profile) {
        return [];
    }
    return [
        'summary' => $profile->summary,
        'image_url' => $profile->image_path ? asset('storage/'.$profile->image_path) : null,
    ];
});
