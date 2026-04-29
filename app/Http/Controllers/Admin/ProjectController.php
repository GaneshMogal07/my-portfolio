<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest('created_date')->paginate(12);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'technologies' => 'nullable|string',
            'image' => 'nullable|file|mimes:png,jpg,jpeg,webp|max:5120',
            'project_url' => 'nullable|url',
            'created_date' => 'nullable|date',
        ]);
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('projects','public');
        }
        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'technologies' => $request->technologies,
            'image_path' => $path,
            'project_url' => $request->project_url,
            'created_date' => $request->created_date,
        ]);
        return redirect()->route('admin.projects.index')->with('status','Project created');
    }

    public function show(string $id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.edit', compact('project'));
    }

    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'technologies' => 'nullable|string',
            'image' => 'nullable|file|mimes:png,jpg,jpeg,webp|max:5120',
            'project_url' => 'nullable|url',
            'created_date' => 'nullable|date',
        ]);
        $data = $request->only('title','description','technologies','project_url','created_date');
        if ($request->hasFile('image')) {
            if ($project->image_path) {
                Storage::disk('public')->delete($project->image_path);
            }
            $data['image_path'] = $request->file('image')->store('projects','public');
        }
        $project->update($data);
        return redirect()->route('admin.projects.index')->with('status','Project updated');
    }

    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        if ($project->image_path) {
            Storage::disk('public')->delete($project->image_path);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('status','Project deleted');
    }
}
