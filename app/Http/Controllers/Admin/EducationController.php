<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Education;

class EducationController extends Controller
{
    public function index()
    {
        $adminId = Session::get('admin_id');
        $educations = Education::where('admin_id', $adminId)->latest('start_date')->paginate(10);
        return view('admin.educations.index', compact('educations'));
    }

    public function create()
    {
        return view('admin.educations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'nullable|string|max:255',
            'details' => 'nullable|string|max:255',
            'grade' => 'nullable|string|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
        $adminId = Session::get('admin_id');
        Education::create($request->only(['institution','degree','details','grade','start_date','end_date']) + ['admin_id' => $adminId]);
        return redirect()->route('admin.educations.index')->with('status','Education added');
    }

    public function edit(string $id)
    {
        $education = Education::findOrFail($id);
        return view('admin.educations.edit', compact('education'));
    }

    public function update(Request $request, string $id)
    {
        $education = Education::findOrFail($id);
        $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'nullable|string|max:255',
            'details' => 'nullable|string|max:255',
            'grade' => 'nullable|string|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
        $education->update($request->only(['institution','degree','details','grade','start_date','end_date']));
        return redirect()->route('admin.educations.index')->with('status','Education updated');
    }

    public function destroy(string $id)
    {
        $education = Education::findOrFail($id);
        $education->delete();
        return redirect()->route('admin.educations.index')->with('status','Education deleted');
    }
}
