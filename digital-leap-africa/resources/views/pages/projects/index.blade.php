@extends('layouts.app')

@section('content')
<style>
.projects-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin: 2rem 0;
}

.project-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.project-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.project-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    background: linear-gradient(135deg, var(--primary-blue), var(--deep-blue));
    flex-shrink: 0;
}

.project-content {
    padding: 1.25rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.project-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    color: var(--diamond-white);
    line-height: 1.3;
}

.project-description {
    color: var(--cool-gray);
    line-height: 1.6;
    margin-bottom: 1rem;
    flex-grow: 1;
    font-size: 0.95rem;
}

.project-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
    padding-top: 1rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    gap: 0.75rem;
}

.project-tech {
    display: flex;
    flex-wrap: wrap;
    gap: 0.4rem;
    margin-bottom: 1rem;
}

.tech-tag {
    background: rgba(0, 201, 255, 0.2);
    color: var(--cyan-accent);
    padding: 0.2rem 0.6rem;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 500;
    white-space: nowrap;
}

/* Mobile Responsive Styles */
@media (max-width: 768px) {
    .projects-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
        margin: 1.5rem 0;
    }
    
    .project-content {
        padding: 1rem;
    }
    
    .project-title {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }
    
    .project-description {
        font-size: 0.9rem;
        margin-bottom: 0.75rem;
    }
    
    .project-meta {
        flex-direction: column;
        align-items: stretch;
        gap: 0.75rem;
    }
    
    .project-meta .btn-primary {
        width: 100%;
        text-align: center;
        padding: 0.75rem;
    }
    
    .tech-tag {
        font-size: 0.7rem;
        padding: 0.15rem 0.5rem;
    }
}

@media (max-width: 480px) {
    .project-image {
        height: 180px;
    }
    
    .project-content {
        padding: 0.875rem;
    }
    
    .project-title {
        font-size: 1rem;
    }
    
    .project-description {
        font-size: 0.85rem;
    }
}
</style>

<div class="container">
    <div style="text-align: center; margin-bottom: 3rem;">
        <h1 style="font-size: clamp(1.75rem, 4vw, 2.5rem); font-weight: 700; margin-bottom: 1rem; line-height: 1.2;">Community Projects</h1>
        <p style="color: var(--cool-gray); font-size: clamp(1rem, 2.5vw, 1.1rem); max-width: 600px; margin: 0 auto; padding: 0 1rem;">Explore real-world projects built by our community members</p>
    </div>

    @if($projects->count() > 0)
        <div class="projects-grid">
            @foreach ($projects as $project)
                <div class="project-card">
                    @if($project->image_url)
                        <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="project-image">
                    @else
                        <div class="project-image" style="display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-project-diagram" style="font-size: 3rem; color: var(--diamond-white); opacity: 0.3;"></i>
                        </div>
                    @endif
                    
                    <div class="project-content">
                        <h3 class="project-title">
                            <a href="{{ route('projects.show', $project) }}" style="color: inherit; text-decoration: none;">
                                {{ $project->title }}
                            </a>
                        </h3>
                        
                        <p class="project-description">
                            {{ Str::limit($project->description, 150) }}
                        </p>
                        
                        @if($project->technologies)
                            <div class="project-tech">
                                @foreach(explode(',', $project->technologies) as $tech)
                                    <span class="tech-tag">{{ trim($tech) }}</span>
                                @endforeach
                            </div>
                        @endif
                        
                        <div class="project-meta">
                            @if($project->difficulty_level)
                                <span style="background: rgba(122, 95, 255, 0.2); color: var(--purple-accent); padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.8rem; font-weight: 500;">
                                    {{ ucfirst($project->difficulty_level) }}
                                </span>
                            @endif
                            
                            <a href="{{ route('projects.show', $project) }}" class="btn-primary" style="padding: 0.5rem 1.25rem;">
                                View Project
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div style="text-align: center; padding: 4rem 0;">
            <i class="fas fa-project-diagram" style="font-size: 4rem; color: var(--cool-gray); opacity: 0.5; margin-bottom: 1rem;"></i>
            <h3 style="color: var(--cool-gray); margin-bottom: 1rem;">No Projects Available</h3>
            <p style="color: var(--cool-gray);">Check back soon for exciting community projects!</p>
        </div>
    @endif
</div>
@endsection