<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Certificate;
use App\Models\Admin;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adminId = Session::get('admin_id');
        $certificates = Certificate::where('admin_id', $adminId)->latest()->paginate(10);
        return view('admin.certificates.index', compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.certificates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level' => 'nullable|string|max:255',
            'file' => 'required|file|mimes:pdf,png,jpg,jpeg,webp|max:5120',
            'issue_date' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:issue_date',
        ]);

        $path = $request->file('file')->store('certificates', 'public');
        $adminId = Session::get('admin_id');

        Certificate::create([
            'title' => $request->title,
            'description' => $request->description,
            'level' => $request->level,
            'file_path' => $path,
            'issue_date' => $request->issue_date,
            'expires_at' => $request->expires_at,
            'admin_id' => $adminId,
        ]);

        return redirect()->route('admin.certificates.index')->with('status', 'Certificate uploaded');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('admin.certificates.show', compact('certificate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('admin.certificates.edit', compact('certificate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $certificate = Certificate::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:pdf,png,jpg,jpeg,webp|max:5120',
            'issue_date' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:issue_date',
        ]);

        $data = $request->only(['title','description','level','issue_date','expires_at']);
        if ($request->hasFile('file')) {
            if ($certificate->file_path) {
                Storage::disk('public')->delete($certificate->file_path);
            }
            $data['file_path'] = $request->file('file')->store('certificates', 'public');
        }

        $certificate->update($data);
        return redirect()->route('admin.certificates.index')->with('status', 'Certificate updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $certificate = Certificate::findOrFail($id);
        if ($certificate->file_path) {
            Storage::disk('public')->delete($certificate->file_path);
        }
        $certificate->delete();
        return redirect()->route('admin.certificates.index')->with('status', 'Certificate deleted');
    }
}
