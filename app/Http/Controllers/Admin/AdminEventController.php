<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'event_date' => 'required|date|after_or_equal:today',
            'quota' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'category' => 'required|in:music,theater,seminar,exhibition',
            'banner_url' => 'required|url',
            'ticket_price' => 'required|numeric|min:0',

        ]);

        Event::create($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event created.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|max:150|unique:events,title,' . $event->id,
            'event_date' => 'required|date|after_or_equal:today',
            'quota' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'category' => 'required|in:music,theater,seminar,exhibition',
            'banner_url' => 'required|url',
            'ticket_price' => 'required|numeric|min:0',
        ]);

        $event->update($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event updated.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted.');
    }
}
