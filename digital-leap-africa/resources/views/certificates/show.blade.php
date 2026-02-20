@extends('layouts.app')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,600;1,700&family=Libre+Baskerville:wght@400;700&family=Dancing+Script:wght@500;600&display=swap');

/* Platform-aligned dark blue theme: navy-bg, deep-blue, primary-blue, cyan-accent */
:root {
    --cert-navy: #0C121C;
    --cert-deep-blue: #1E4C7C;
    --cert-primary-blue: #2E78C5;
    --cert-cyan: #00C9FF;
    --cert-diamond-white: #F5F7FA;
    --cert-charcoal: #252A32;
    --cert-cool-gray: #AEB8C2;
}

.certificate-page-wrap {
    padding: 2rem 1rem 4rem;
}

.download-section {
    text-align: center;
    margin-bottom: 2rem;
}

.download-section h2 {
    color: var(--cert-diamond-white);
    margin-bottom: 1rem;
    font-size: 1.35rem;
}

.download-section .btn-primary,
.download-section .btn-outline {
    padding: 0.65rem 1.25rem;
    font-size: 0.95rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    border-radius: 8px;
    font-weight: 600;
}

.certificate-container {
    max-width: 900px;
    margin: 0 auto;
    background: var(--cert-navy);
    border-radius: 12px;
    padding: 14px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
    border: 1px solid rgba(0, 201, 255, 0.2);
}

.certificate-inner {
    background: var(--cert-charcoal);
    border-radius: 8px;
    padding: 3rem 3.5rem;
    position: relative;
    border: 2px solid var(--cert-deep-blue);
}

.certificate-inner::before {
    content: '';
    position: absolute;
    top: 12px;
    left: 12px;
    right: 12px;
    bottom: 12px;
    border: 1px solid var(--cert-primary-blue);
    border-radius: 4px;
    pointer-events: none;
    opacity: 0.5;
}

.certificate-header {
    text-align: center;
    margin-bottom: 2.25rem;
}

.certificate-logo-wrap {
    margin-bottom: 1.25rem;
}

.certificate-logo-wrap img {
    height: 72px;
    width: auto;
    max-width: 180px;
    object-fit: contain;
    display: block;
    margin: 0 auto;
}

.certificate-title {
    font-family: 'Libre Baskerville', Georgia, serif;
    font-size: 2.25rem;
    font-weight: 700;
    color: var(--cert-diamond-white);
    margin-bottom: 0.35rem;
    letter-spacing: 2px;
    text-transform: uppercase;
}

.certificate-subtitle {
    font-size: 1.15rem;
    color: var(--cert-cyan);
    font-weight: 600;
    letter-spacing: 1px;
}

.certificate-body {
    text-align: center;
    margin: 2rem 0 2.5rem;
}

.certificate-text {
    font-size: 1.1rem;
    color: var(--cert-cool-gray);
    line-height: 1.85;
    margin-bottom: 0.75rem;
    font-family: 'Libre Baskerville', Georgia, serif;
}

.recipient-name {
    font-size: 2.25rem;
    font-weight: 700;
    font-style: italic;
    color: var(--cert-diamond-white);
    margin: 1.5rem 0;
    font-family: 'Cormorant Garamond', Georgia, serif;
    border-bottom: 2px solid var(--cert-cyan);
    display: inline-block;
    padding-bottom: 4px;
}

.course-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--cert-cyan);
    margin: 1.25rem 0;
    font-style: italic;
    font-family: 'Libre Baskerville', Georgia, serif;
}

.certificate-footer {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    margin-top: 2.5rem;
    padding-top: 2rem;
    border-top: 2px solid var(--cert-deep-blue);
}

.signature-section {
    text-align: center;
}

.signature-line {
    border-bottom: 2px solid var(--cert-primary-blue);
    width: 200px;
    margin: 0 auto 0.6rem;
    height: 38px;
}

.signature-text {
    font-family: 'Dancing Script', cursive;
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--cert-cyan);
    margin-bottom: 0.25rem;
}

.signature-label {
    font-size: 0.8rem;
    color: var(--cert-cool-gray);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.5px;
}

.signature-role-name {
    font-size: 0.9rem;
    color: var(--cert-diamond-white);
    font-weight: 600;
    margin-top: 0.25rem;
}

.certificate-meta {
    margin-top: 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.certificate-date,
.certificate-number {
    font-size: 0.85rem;
    color: var(--cert-cool-gray);
    font-weight: 600;
    font-family: 'Libre Baskerville', Georgia, serif;
}

.certificate-number {
    font-family: 'Courier New', monospace;
    letter-spacing: 0.5px;
}

@media print {
    @page { size: A4; margin: 12mm; }
    /* Force backgrounds and colors to print (match webpage) */
    body,
    .certificate-container,
    .certificate-inner,
    .certificate-inner::before {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    /* Hide entire page chrome – only the certificate should print */
    body .site-header,
    body .site-footer,
    body .sidebar-overlay,
    body .off-canvas-sidebar,
    body .download-section {
        display: none !important;
    }
    body main.container > .alert {
        display: none !important;
    }
    body {
        background: #0C121C !important;
        padding: 0;
        margin: 0;
    }
    body main.container {
        padding: 0;
        max-width: none;
        margin: 0;
        background: transparent !important;
    }
    .certificate-page-wrap {
        padding: 0;
        margin: 0;
        min-height: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    /* Fit certificate on one page: same layout and colours as screen */
    .certificate-container {
        margin: 0 auto;
        max-width: 900px;
        width: 100%;
    }
    /* Slightly tighter spacing in print so content fits one A4 page */
    .certificate-inner {
        padding: 2.25rem 3rem;
    }
    .certificate-header { margin-bottom: 1.75rem; }
    .certificate-body { margin: 1.5rem 0 2rem; }
    .certificate-footer {
        margin-top: 2rem;
        padding-top: 1.5rem;
        display: grid !important;
        grid-template-columns: 1fr 1fr !important;
        gap: 3rem;
    }
    .certificate-meta { margin-top: 1.5rem; }
}

@media (max-width: 768px) {
    .certificate-inner { padding: 2rem 1.5rem; }
    .certificate-title { font-size: 1.75rem; }
    .recipient-name { font-size: 1.75rem; }
    .course-title { font-size: 1.25rem; }
    .certificate-footer { grid-template-columns: 1fr; gap: 2rem; }
}
</style>

@php
    $instructorName = $certificate->course->instructor ?? '';
    $directorName = 'Florence Ndinda'; // hardcoded Executive Director
    $toSignatureForm = function ($name) {
        $parts = preg_split('/\s+/', trim($name), -1, PREG_SPLIT_NO_EMPTY);
        if (count($parts) >= 2) {
            return strtoupper(mb_substr($parts[0], 0, 1)) . '. ' . $parts[count($parts) - 1];
        }
        return $name ?: '—';
    };
    $instructorSignature = $toSignatureForm($instructorName);
    $directorSignature = $toSignatureForm($directorName);
@endphp
<div class="container certificate-page-wrap">
    <div class="download-section">
        <h2>Your Professional Certificate</h2>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <button onclick="window.print()" class="btn-primary">
                <i class="fas fa-print me-2"></i>Print / Save PDF
            </button>
            <a href="{{ route('certificates.download', $certificate) }}" class="btn-outline">
                <i class="fas fa-external-link-alt me-2"></i>Full Screen View
            </a>
        </div>
    </div>

    <div class="certificate-container">
        <div class="certificate-inner">
            <div class="certificate-header">
                <div class="certificate-logo-wrap">
                    @if(isset($siteSettings['logo_url']) && !empty($siteSettings['logo_url']))
                        <img src="{{ url($siteSettings['logo_url']) }}" alt="{{ $siteSettings['site_name'] ?? 'Digital Leap Africa' }}">
                    @else
                        <img src="{{ asset('images/logo.png') }}" alt="Digital Leap Africa">
                    @endif
                </div>
                <h1 class="certificate-title">{{ \App\Models\SiteSetting::getValue('certificate_title', 'Certificate of Completion') }}</h1>
                <p class="certificate-subtitle">{{ \App\Models\SiteSetting::getValue('certificate_subtitle', 'Digital Leap Africa') }}</p>
            </div>

            <div class="certificate-body">
                <p class="certificate-text">{{ \App\Models\SiteSetting::getValue('certificate_text', 'This is to certify that') }}</p>
                <div class="recipient-name">{{ $certificate->user->name }}</div>
                <p class="certificate-text">{{ \App\Models\SiteSetting::getValue('certificate_completion_text', 'has successfully completed the course') }}</p>
                <div class="course-title">{{ $certificate->certificate_title }}</div>
                <p class="certificate-text">{{ \App\Models\SiteSetting::getValue('certificate_achievement_text', 'and has demonstrated proficiency through dedicated study and commitment to excellence in digital learning.') }}</p>
            </div>

            <div class="certificate-footer">
                <div class="signature-section">
                    <div class="signature-line">
                        <span class="signature-text">{{ $instructorSignature }}</span>
                    </div>
                    <p class="signature-label">{{ \App\Models\SiteSetting::getValue('certificate_instructor_title', 'Course Instructor') }}</p>
                    <p class="signature-role-name">{{ $certificate->course->instructor }}</p>
                </div>
                <div class="signature-section">
                    <div class="signature-line">
                        <span class="signature-text">{{ $directorSignature }}</span>
                    </div>
                    <p class="signature-label">Executive Director</p>
                    <p class="signature-role-name">{{ $directorName }}</p>
                </div>
            </div>

            <div class="certificate-meta">
                <div class="certificate-date">
                    <i class="fas fa-calendar-alt me-1"></i>{{ $certificate->issued_at->format('F j, Y') }}
                </div>
                <div class="certificate-number">
                    <i class="fas fa-shield-alt me-1"></i>{{ $certificate->certificate_number }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
