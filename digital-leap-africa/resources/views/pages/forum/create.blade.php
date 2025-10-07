@extends('layouts.app')

@section('content')
<div class="container">
    <div style="max-width: 800px; margin: 0 auto;">
        <div style="margin-bottom: 2rem;">
            <a href="{{ route('forum.index') }}" class="btn-outline" style="padding: 0.5rem 1rem;">
                <i class="fas fa-arrow-left me-2"></i>Back to Forum
            </a>
        </div>

        <div style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: var(--radius); padding: 2rem;">
            <h1 style="font-size: 2rem; font-weight: 700; color: var(--diamond-white); margin-bottom: 1rem;">
                <i class="fas fa-plus-circle me-2"></i>Start New Discussion
            </h1>
            <p style="color: var(--cool-gray); margin-bottom: 2rem;">Share your thoughts, ask questions, or start a conversation with the community.</p>

            <form method="POST" action="{{ route('forum.store') }}">
                @csrf
                
                <div class="form-group">
                    <label for="title" class="form-label">Discussion Title</label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           class="form-control" 
                           placeholder="Enter a descriptive title for your discussion"
                           value="{{ old('title') }}"
                           required>
                </div>

                <div class="form-group">
                    <label for="content" class="form-label">Your Message</label>
                    <textarea id="content" 
                              name="content" 
                              class="form-control" 
                              rows="8" 
                              placeholder="Share your thoughts, ask questions, or provide details about your topic..."
                              required>{{ old('content') }}</textarea>
                </div>

                <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                    <a href="{{ route('forum.index') }}" class="btn-outline" style="padding: 0.75rem 1.5rem;">
                        Cancel
                    </a>
                    <button type="submit" class="btn-primary" style="padding: 0.75rem 2rem;">
                        <i class="fas fa-paper-plane me-2"></i>Start Discussion
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection