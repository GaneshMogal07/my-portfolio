<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::first();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'summary' => 'nullable|string',
            'image' => 'nullable|file|mimes:png,jpg,jpeg,webp|max:5120',
            'resume_pdf' => 'nullable|file|mimes:pdf|max:5120',
            'resume_doc' => 'nullable|file|max:5120',
            'current_job_title' => 'nullable|string|max:255',
            'current_job_company' => 'nullable|string|max:255',
            'current_job_start_date' => 'nullable|date',
        ]);
        $profile = Profile::firstOrCreate([], []);
        $data = [
            'summary' => $request->summary,
            'current_job_title' => $request->current_job_title,
            'current_job_company' => $request->current_job_company,
            'current_job_start_date' => $request->current_job_start_date,
        ];
        if ($request->hasFile('image')) {
            if ($profile->image_path) {
                Storage::disk('public')->delete($profile->image_path);
            }
            $data['image_path'] = $request->file('image')->store('profile','public');
        }
        if ($request->hasFile('resume_pdf')) {
            if ($profile->resume_pdf_path) {
                Storage::disk('public')->delete($profile->resume_pdf_path);
            }
            $data['resume_pdf_path'] = $request->file('resume_pdf')->store('resume','public');
        }
        if ($request->hasFile('resume_doc')) {
            $file = $request->file('resume_doc');
            $ext = strtolower($file->getClientOriginalExtension());
            if (!in_array($ext, ['doc', 'docx'])) {
                return redirect()->back()
                    ->withErrors(['resume_doc' => 'The resume word document must be a file of type: doc, docx.'])
                    ->withInput();
            }
            if ($profile->resume_doc_path) {
                Storage::disk('public')->delete($profile->resume_doc_path);
            }
            $data['resume_doc_path'] = $file->store('resume','public');
        }
        $profile->update($data);
        return redirect()->route('admin.profile.edit')->with('status','Profile updated');
    }
}
