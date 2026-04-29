<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Experience;

class ExperienceController extends Controller
{
    public function index()
    {
        $adminId = Session::get('admin_id');
        $experiences = Experience::where('admin_id', $adminId)->latest('start_date')->paginate(10);
        return view('admin.experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experiences.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);
        $adminId = Session::get('admin_id');
        Experience::create($request->only(['title','company','location','start_date','end_date','description']) + ['admin_id' => $adminId]);
        return redirect()->route('admin.experiences.index')->with('status','Experience added');
    }

    public function edit(string $id)
    {
        $experience = Experience::findOrFail($id);
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, string $id)
    {
        $experience = Experience::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);
        $experience->update($request->only(['title','company','location','start_date','end_date','description']));
        return redirect()->route('admin.experiences.index')->with('status','Experience updated');
    }

    public function destroy(string $id)
    {
        $experience = Experience::findOrFail($id);
        $experience->delete();
        return redirect()->route('admin.experiences.index')->with('status','Experience deleted');
    }
}
