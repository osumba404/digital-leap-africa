@extends('layouts.app')

@section('title', $user->name . ' - Profile | Digital Leap Africa')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        @if($user->profile_photo)
                            <img src="{{ route('me.photo', ['user_id' => $user->id]) }}" 
                                 alt="{{ $user->name }}" 
                                 class="rounded-circle me-3" 
                                 style="width: 80px; height: 80px; object-fit: cover;">
                        @else
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                                 style="width: 80px; height: 80px; background: linear-gradient(135deg, #00C9FF 0%, #7A5FFF 100%); color: white; font-size: 1.5rem; font-weight: bold;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        
                        <div class="flex-grow-1">
                            <h3 class="mb-1">{{ $user->name }}</h3>
                            @if($user->email_verified_at)
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle"></i> Verified Member
                                </span>
                            @endif
                            <p class="text-muted mb-0">
                                Member since {{ $user->created_at->format('F Y') }}
                            </p>
                        </div>
                        
                        @auth
                            @if(auth()->id() === $user->id)
                                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-edit"></i> Edit Profile
                                </a>
                            @endif
                        @endauth
                    </div>
                    
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="border-end">
                                <h5 class="mb-0">{{ $user->points ?? 0 }}</h5>
                                <small class="text-muted">Points</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="border-end">
                                <h5 class="mb-0">{{ $user->enrollments()->count() }}</h5>
                                <small class="text-muted">Courses</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <h5 class="mb-0">{{ $user->created_at->diffInDays() }}</h5>
                            <small class="text-muted">Days Active</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection