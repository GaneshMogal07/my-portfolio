<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Certificate;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Feedback;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'certificates' => Certificate::count(),
            'skills' => Skill::count(),
            'projects' => Project::count(),
            'education' => Education::count(),
            'experience' => Experience::count(),
            'feedback' => Feedback::count(),
            'messages' => Contact::count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }
}
