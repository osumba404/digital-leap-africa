<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class EventController extends Controller
{
    // Public listing (optional; adjust to your routing/views)
    public function index()
    {
        $cacheKey = 'events_index_' . request()->get('page', 1);
        
        $data = Cache::remember($cacheKey, 600, function() {
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
                
            // Append query parameters to pagination links
            $past->appends(request()->query());

            return compact('upcoming', 'ongoing', 'past');
        });

        return view('pages.events.index', $data);
    }

    public function show(Event $event)
    {
        $cacheKey = 'event_' . $event->id . '_' . $event->updated_at->timestamp;
        
        $eventData = Cache::remember($cacheKey, 1800, function() use ($event) {
            return $event;
        });

        return view('pages.events.show', ['event' => $eventData]);
    }

   
       
    
}