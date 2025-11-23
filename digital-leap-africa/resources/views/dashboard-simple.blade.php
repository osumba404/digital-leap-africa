@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem 1rem;">
    <h1 style="color: var(--cyan-accent); margin-bottom: 2rem;">Welcome back, {{ Auth::user()->name }}!</h1>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
        <div style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 8px; padding: 1.5rem; text-align: center;">
            <div style="font-size: 2rem; font-weight: 700; color: var(--cyan-accent);">{{ Auth::user()->courses()->count() }}</div>
            <div style="color: var(--cool-gray); font-size: 0.875rem;">Courses Enrolled</div>
        </div>
        
        <div style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 8px; padding: 1.5rem; text-align: center;">
            <div style="font-size: 2rem; font-weight: 700; color: var(--cyan-accent);">{{ Auth::user()->lessons()->count() }}</div>
            <div style="color: var(--cool-gray); font-size: 0.875rem;">Lessons Completed</div>
        </div>
    </div>
    
    @if(Auth::user()->courses()->count() == 0)
        <div style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 8px; padding: 2rem; text-align: center;">
            <i class="fas fa-rocket" style="font-size: 3rem; color: var(--cyan-accent); margin-bottom: 1rem;"></i>
            <h3 style="color: var(--diamond-white); margin-bottom: 1rem;">Ready to Start Learning?</h3>
            <a href="{{ route('courses.index') }}" style="display: inline-block; background: var(--cyan-accent); color: white; padding: 0.75rem 2rem; border-radius: 8px; text-decoration: none; font-weight: 600;">Browse Courses</a>
        </div>
    @endif
</div>
@endsection
