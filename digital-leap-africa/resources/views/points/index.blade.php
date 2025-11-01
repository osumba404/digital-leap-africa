@extends('layouts.app')

@section('content')
<div class="container">
    <div class="admin-header">
        <h1>Point Redemption Store</h1>
        <p>Use your points to unlock exclusive features and rewards</p>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h3>Your Points</h3>
                    <div style="font-size: 2rem; color: var(--cyan-accent); font-weight: bold;">
                        {{ number_format($userPoints) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h3>Your Level</h3>
                    <div style="font-size: 1.5rem; color: var(--purple-accent); font-weight: bold;">
                        {{ $userLevel }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($rewards as $key => $reward)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5>{{ $reward['name'] }}</h5>
                        <p class="text-muted">{{ $reward['description'] }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge" style="background: var(--cyan-accent); color: var(--navy-bg);">
                                {{ number_format($reward['cost']) }} Points
                            </span>
                            @if($userPoints >= $reward['cost'])
                                <form method="POST" action="{{ route('points.redeem') }}" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="reward_type" value="{{ $key }}">
                                    <button type="submit" class="btn btn-primary btn-sm" 
                                            onclick="return confirm('Redeem this reward for {{ $reward['cost'] }} points?')">
                                        Redeem
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-outline btn-sm" disabled>
                                    Need {{ number_format($reward['cost'] - $userPoints) }} more
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5>How to Earn More Points</h5>
            <ul>
                <li><strong>Complete Lessons:</strong> 50 points each</li>
                <li><strong>Complete Courses:</strong> 200 points each</li>
                <li><strong>Enroll in Courses:</strong> 20 points each</li>
                <li><strong>Forum Posts:</strong> 10 points each</li>
                <li><strong>Forum Replies:</strong> 5 points each</li>
                <li><strong>Share Testimonials:</strong> 25 points each</li>
                <li><strong>Daily Login:</strong> 5 points per day</li>
            </ul>
        </div>
    </div>
</div>
@endsection