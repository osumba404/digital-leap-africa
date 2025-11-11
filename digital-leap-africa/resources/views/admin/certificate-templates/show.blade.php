@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1>{{ $certificateTemplate->name }}</h1>
        <p class="text-muted">Certificate template preview</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.certificate-templates.edit', $certificateTemplate) }}" class="btn btn-edit">
            <i class="fas fa-edit me-2"></i>Edit
        </a>
        <a href="{{ route('admin.certificate-templates.index') }}" class="btn btn-outline">Back</a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Certificate Preview</h5>
            </div>
            <div class="card-body">
                <div class="certificate-preview" style="
                    background-color: {{ $certificateTemplate->background_color }};
                    color: {{ $certificateTemplate->text_color }};
                    padding: 2rem;
                    border-radius: 8px;
                    min-height: 400px;
                    border: 1px solid rgba(255,255,255,0.2);
                    position: relative;
                ">
                    @if($certificateTemplate->logo_image)
                        <div class="text-center mb-3">
                            <img src="{{ Storage::url($certificateTemplate->logo_image) }}" alt="Logo" style="max-height: 80px;">
                        </div>
                    @endif
                    
                    <div class="certificate-content">
                        {!! str_replace([
                            '{{student_name}}',
                            '{{course_title}}',
                            '{{completion_date}}',
                            '{{certificate_number}}',
                            '{{instructor_name}}'
                        ], [
                            'John Doe',
                            'Advanced Laravel Development',
                            now()->format('F d, Y'),
                            'CERT-2024-001',
                            'Digital Leap Africa'
                        ], $certificateTemplate->content) !!}
                    </div>
                    
                    @if($certificateTemplate->signature_image)
                        <div class="text-end mt-4">
                            <img src="{{ Storage::url($certificateTemplate->signature_image) }}" alt="Signature" style="max-height: 60px;">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Template Info</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Status:</strong>
                    @if($certificateTemplate->active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-warning">Inactive</span>
                    @endif
                </div>
                <div class="mb-3">
                    <strong>Background Color:</strong>
                    <div class="d-flex align-items-center gap-2">
                        <div class="color-preview" style="background-color: {{ $certificateTemplate->background_color }}"></div>
                        <code>{{ $certificateTemplate->background_color }}</code>
                    </div>
                </div>
                <div class="mb-3">
                    <strong>Text Color:</strong>
                    <div class="d-flex align-items-center gap-2">
                        <div class="color-preview" style="background-color: {{ $certificateTemplate->text_color }}"></div>
                        <code>{{ $certificateTemplate->text_color }}</code>
                    </div>
                </div>
                <div class="mb-3">
                    <strong>Created:</strong> {{ $certificateTemplate->created_at->format('M d, Y H:i') }}
                </div>
                <div class="mb-3">
                    <strong>Updated:</strong> {{ $certificateTemplate->updated_at->format('M d, Y H:i') }}
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5>Available Placeholders</h5>
            </div>
            <div class="card-body">
                <div class="small text-muted">
                    <div><code>{{student_name}}</code> - Student's name</div>
                    <div><code>{{course_title}}</code> - Course title</div>
                    <div><code>{{completion_date}}</code> - Completion date</div>
                    <div><code>{{certificate_number}}</code> - Certificate ID</div>
                    <div><code>{{instructor_name}}</code> - Instructor name</div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.color-preview {
    width: 20px;
    height: 20px;
    border-radius: 4px;
    border: 1px solid rgba(255, 255, 255, 0.3);
}
.badge {
    padding: 0.35em 0.65em;
    font-size: 0.75em;
    border-radius: 0.375rem;
}
.bg-success { background-color: #198754 !important; }
.bg-warning { background-color: #ffc107 !important; color: #000; }
.card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.1);
}
.card-header {
    background: rgba(255, 255, 255, 0.05);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    color: var(--diamond-white);
}
code {
    background: rgba(255, 255, 255, 0.1);
    padding: 0.2rem 0.4rem;
    border-radius: 0.25rem;
    font-size: 0.875em;
}
</style>
@endsection