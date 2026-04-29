<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('category')->orderBy('name')->paginate(20);
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'level' => 'nullable|string|max:255',
        ]);
        Skill::create($request->only('name','category','level'));
        return redirect()->route('admin.skills.index')->with('status','Skill added');
    }

    public function show(string $id)
    {
        $skill = Skill::findOrFail($id);
        return view('admin.skills.edit', compact('skill'));
    }

    public function edit(string $id)
    {
        $skill = Skill::findOrFail($id);
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, string $id)
    {
        $skill = Skill::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'level' => 'nullable|string|max:255',
        ]);
        $skill->update($request->only('name','category','level'));
        return redirect()->route('admin.skills.index')->with('status','Skill updated');
    }

    public function destroy(string $id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('status','Skill deleted');
    }
}
