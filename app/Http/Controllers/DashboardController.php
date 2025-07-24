<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Event::query();

        // Filter pencarian
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Filter kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter tanggal
        if ($request->filled('date')) {
            $query->whereDate('event_date', $request->date);
        }

        $events = $query->with('usersWhoLiked') // eager load
            ->orderBy('event_date', 'asc')
            ->paginate(8)
            ->through(function ($event) {
                $event->is_registered = $event->orders()
                    ->where('user_id', auth()->id())
                    ->exists();

                // inject proper info: apakah user like event ini
                $event->is_liked = $event->usersWhoLiked
                    ->contains(fn($user) => $user->id === auth()->id());

                return $event;
            });


        return view('dashboard', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
