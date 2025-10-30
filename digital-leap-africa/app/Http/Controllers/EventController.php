<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    // Public listing (optional; adjust to your routing/views)
    public function index()
    {
        $now = now();
        $startOfToday = $now->copy()->startOfDay();
        $endOfToday = $now->copy()->endOfDay();

        $upcoming = Event::where('date', '>', $endOfToday)
            ->orderBy('date', 'asc')
            ->get();

        $ongoing = Event::whereBetween('date', [$startOfToday, $endOfToday])
            ->orderBy('date', 'asc')
            ->get();

        $past = Event::where('date', '<', $startOfToday)
            ->orderBy('date', 'desc')
            ->paginate(12);

        // $lessons = $topic->lessons()->latest()->paginate(20);
        // return view('admin.lessons.index', compact('topic','lessons'));

        return view('pages.events.index', compact('upcoming', 'ongoing', 'past'));
    }

    public function show(Event $event)
    {
        return view('pages.events.show', compact('event'));
    }

   
       
    
}