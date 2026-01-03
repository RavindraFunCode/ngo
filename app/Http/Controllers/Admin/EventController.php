<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::with('translations')->latest()->paginate(10);
        
        if ($request->ajax()) {
            return view('admin.events.partials.table', compact('events'))->render();
        }

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $languages = Language::where('is_active', true)->get();
        return view('admin.events.create', compact('languages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|unique:events,slug',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
        }

        $event = Event::create([
            'slug' => Str::slug($request->slug),
            'status' => $request->status ?? 'draft',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time' => $request->start_time,
            'location' => $request->location,
            'organizer' => $request->organizer,
            'image' => $imagePath,
            'created_by' => auth()->id(),
        ]);

        $languages = Language::all()->keyBy('code');

        foreach ($request->translations as $locale => $data) {
            if (empty($data['title'])) continue;
            if (isset($languages[$locale])) {
                $event->translations()->create([
                    'language_id' => $languages[$locale]->id,
                    'title' => $data['title'],
                    'description' => $data['description'] ?? null,
                    'meta_title' => $data['meta_title'] ?? null,
                    'meta_description' => $data['meta_description'] ?? null,
                    'meta_keywords' => $data['meta_keywords'] ?? null,
                ]);
            }
        }

        return response()->json(['success' => true, 'redirect' => route('admin.events.index')]);
    }

    public function edit(Event $event)
    {
        $languages = Language::where('is_active', true)->get();
        return view('admin.events.edit', compact('event', 'languages'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'slug' => 'required|unique:events,slug,' . $event->id,
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $event->image = $request->file('image')->store('events', 'public');
        }

        $event->update([
            'slug' => Str::slug($request->slug),
            'status' => $request->status ?? 'draft',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time' => $request->start_time,
            'location' => $request->location,
            'organizer' => $request->organizer,
            'updated_by' => auth()->id(),
        ]);

        $languages = Language::all()->keyBy('code');

        foreach ($request->translations as $locale => $data) {
            if (empty($data['title'])) continue;
            if (isset($languages[$locale])) {
                $event->translations()->updateOrCreate(
                    ['language_id' => $languages[$locale]->id],
                    [
                        'title' => $data['title'],
                        'description' => $data['description'] ?? null,
                        'meta_title' => $data['meta_title'] ?? null,
                        'meta_description' => $data['meta_description'] ?? null,
                        'meta_keywords' => $data['meta_keywords'] ?? null,
                    ]
                );
            }
        }

        return response()->json(['success' => true, 'redirect' => route('admin.events.index')]);
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['success' => true]);
    }
}
