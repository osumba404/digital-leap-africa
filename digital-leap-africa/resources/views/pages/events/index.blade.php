@extends('layouts.app')

@section('title', 'Events')

@section('content')
<section class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="m-0">Events</h1>
    </div>

    {{-- Ongoing Today --}}
    @if(isset($ongoing) && $ongoing->count())
        <div class="mb-4">
            <h2 class="h4 mb-2">Ongoing Today</h2>
            <div class="row g-3">
                @foreach($ongoing as $event)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100">
                            @if(!empty($event->image_path))
                                <img src="{{ $event->image_path }}" alt="{{ $event->title }}" style="width:100%;height:180px;object-fit:cover;border-radius:8px;">
                            @endif
                            <div class="mt-3">
                                <h3 class="h5 m-0">
                                    <a class="link-info text-decoration-none" href="{{ route('events.show', $event->id) }}">
                                        {{ $event->title }}
                                    </a>
                                </h3>
                                <div class="text-muted small mt-1">
                                    {{ optional($event->date)->format('M j, Y g:ia') }} • {{ $event->location }}
                                </div>
                                @if(!empty($event->description))
                                    <p class="mt-2" style="color:var(--cool-gray)">{{ \Illuminate\Support\Str::limit(strip_tags($event->description), 120) }}</p>
                                @endif
                                <a class="btn-outline btn-sm mt-1" href="{{ route('events.show', $event->id) }}">View details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Upcoming --}}
    @if(isset($upcoming) && $upcoming->count())
        <div class="mb-4">
            <h2 class="h4 mb-2">Upcoming</h2>
            <div class="row g-3">
                @foreach($upcoming as $event)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100">
                            @if(!empty($event->image_path))
                                <img src="{{ $event->image_path }}" alt="{{ $event->title }}" style="width:100%;height:180px;object-fit:cover;border-radius:8px;">
                            @endif
                            <div class="mt-3">
                                <h3 class="h5 m-0">
                                    <a class="link-info text-decoration-none" href="{{ route('events.show', $event->id) }}">
                                        {{ $event->title }}
                                    </a>
                                </h3>
                                <div class="text-muted small mt-1">
                                    {{ optional($event->date)->format('M j, Y g:ia') }} • {{ $event->location }}
                                </div>
                                @if(!empty($event->description))
                                    <p class="mt-2" style="color:var(--cool-gray)">{{ \Illuminate\Support\Str::limit(strip_tags($event->description), 120) }}</p>
                                @endif
                                <a class="btn-outline btn-sm mt-1" href="{{ route('events.show', $event->id) }}">View details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Past (paginated) --}}
    <div class="mb-2 d-flex align-items-center justify-content-between">
        <h2 class="h4 m-0">Past Events</h2>
    </div>
    @if(isset($past) && $past->count())
        <div class="row g-3">
            @foreach($past as $event)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100">
                        @if(!empty($event->image_path))
                            <img src="{{ $event->image_path }}" alt="{{ $event->title }}" style="width:100%;height:180px;object-fit:cover;border-radius:8px;">
                        @endif
                        <div class="mt-3">
                            <h3 class="h5 m-0">
                                <a class="link-info text-decoration-none" href="{{ route('events.show', $event->id) }}">
                                    {{ $event->title }}
                                </a>
                            </h3>
                            <div class="text-muted small mt-1">
                                {{ optional($event->date)->format('M j, Y g:ia') }} • {{ $event->location }}
                            </div>
                            @if(!empty($event->description))
                                <p class="mt-2" style="color:var(--cool-gray)">{{ \Illuminate\Support\Str::limit(strip_tags($event->description), 120) }}</p>
                            @endif
                            <a class="btn-outline btn-sm mt-1" href="{{ route('events.show', $event->id) }}">View details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            {{ $past->links() }}
        </div>
    @else
        <div class="text-muted">No past events.</div>
    @endif
</section>
@endsection