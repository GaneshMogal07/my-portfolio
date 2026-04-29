<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Feedback;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedbacks = Feedback::all();
        return view('admin.feedback.index', compact('feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.feedback.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'feedback' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        Feedback::create($validated);

        return redirect()->route('admin.feedback.index')->with('status', 'Feedback added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        return view('admin.feedback.show', compact('feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        return view('admin.feedback.edit', compact('feedback'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feedback $feedback)
    {
        $validated = $request->validate([
            'employee_name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'feedback' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        $feedback->update($validated);

        return redirect()->route('admin.feedback.index')->with('status', 'Feedback updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()->route('admin.feedback.index')->with('status', 'Feedback deleted successfully!');
    }
}
