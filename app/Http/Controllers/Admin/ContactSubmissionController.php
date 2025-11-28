<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactSubmission;

class ContactSubmissionController extends Controller
{
    public function index()
    {
        $submissions = ContactSubmission::latest()->paginate(20);
        return view('admin.contact_submissions.index', compact('submissions'));
    }

    public function show(ContactSubmission $contactSubmission)
    {
        return view('admin.contact_submissions.show', compact('contactSubmission'));
    }

    public function update(Request $request, ContactSubmission $contactSubmission)
    {
        $request->validate([
            'status' => 'required|in:new,in_progress,closed',
        ]);

        $contactSubmission->update([
            'status' => $request->status,
            'handled_by' => auth()->id(),
            'handled_at' => now(),
        ]);

        return redirect()->route('admin.contact-submissions.show', $contactSubmission)->with('success', 'Submission status updated.');
    }

    public function destroy(ContactSubmission $contactSubmission)
    {
        $contactSubmission->delete();
        return redirect()->route('admin.contact-submissions.index')->with('success', 'Submission deleted successfully.');
    }
}
