<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Volunteer;

class VolunteerController extends Controller
{
    public function index()
    {
        $volunteers = Volunteer::latest()->paginate(20);
        return view('admin.volunteers.index', compact('volunteers'));
    }

    public function show(Volunteer $volunteer)
    {
        return view('admin.volunteers.show', compact('volunteer'));
    }

    public function update(Request $request, Volunteer $volunteer)
    {
        $request->validate([
            'status' => 'required|in:new,in_review,approved,rejected',
        ]);

        $volunteer->update(['status' => $request->status]);

        return redirect()->route('admin.volunteers.show', $volunteer)->with('success', 'Volunteer status updated.');
    }

    public function destroy(Volunteer $volunteer)
    {
        $volunteer->delete();
        return redirect()->route('admin.volunteers.index')->with('success', 'Volunteer deleted successfully.');
    }
}
