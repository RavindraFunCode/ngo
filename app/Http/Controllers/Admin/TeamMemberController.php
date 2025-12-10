<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('order')->get();
        return view('admin.team.index', compact('members'));
    }

    public function store(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|max:255',
            'role' => 'required|max:255',
            'image' => 'required|image',
            'order' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('team', 'public');
        }
        $data['is_active'] = $request->has('is_active');
        
        TeamMember::create($data);
        return response()->json(['success' => 'Team member created successfully.']);
    }

    public function edit(TeamMember $team)
    {
        return response()->json($team);
    }

    public function update(Request $request, TeamMember $team)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|max:255',
            'role' => 'required|max:255',
            'image' => 'nullable|image',
            'order' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('team', 'public');
        }
        $data['is_active'] = $request->has('is_active');

        $team->update($data);
        return response()->json(['success' => 'Team member updated successfully.']);
    }

    public function destroy(TeamMember $team)
    {
        $team->delete();
        return response()->json(['success' => 'Team member deleted successfully.']);
    }
}
