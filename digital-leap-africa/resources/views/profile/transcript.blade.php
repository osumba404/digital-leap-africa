@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 1000px; margin: 2rem auto;">
    <div style="display:flex; justify-content:space-between; align-items:center; gap:1rem; flex-wrap:wrap; margin-bottom:1.5rem;">
        <div>
            <h1 style="margin:0; color: var(--diamond-white);">Program Transcript</h1>
            <p style="margin:.35rem 0 0; color: var(--cool-gray);">{{ $course->title }}</p>
        </div>
        <a href="{{ route('profile.edit') }}" class="btn-outline" style="text-decoration:none;">
            <i class="fas fa-arrow-left"></i> Back to Profile
        </a>
    </div>

    <div class="card" style="padding:1.25rem; margin-bottom:1rem;">
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 1rem;">
            <div>
                <div style="color: var(--cool-gray); font-size:.85rem;">Enrollment Status</div>
                <div style="font-weight:700;">{{ ucfirst($enrollment->status) }}</div>
            </div>
            <div>
                <div style="color: var(--cool-gray); font-size:.85rem;">Lessons Completed</div>
                <div style="font-weight:700;">{{ $completedLessons }} / {{ $totalLessons }}</div>
            </div>
            <div>
                <div style="color: var(--cool-gray); font-size:.85rem;">Final Grade</div>
                <div style="font-weight:700;">
                    {{ $enrollment->final_grade_percentage !== null ? number_format($enrollment->final_grade_percentage, 2).'%' : 'Not calculated yet' }}
                </div>
            </div>
            <div>
                <div style="color: var(--cool-gray); font-size:.85rem;">Points (Counted Tests)</div>
                <div style="font-weight:700;">
                    {{ $enrollment->final_grade_points_earned ?? 0 }} / {{ $enrollment->final_grade_points_possible ?? 0 }}
                </div>
            </div>
        </div>
    </div>

    @if($finalAttempt)
        <div class="card" style="padding:1.25rem; margin-bottom:1rem; border-left:4px solid #2E78C5;">
            <h3 style="margin:0 0 .5rem; color: var(--diamond-white);">Final Program Test</h3>
            <p style="margin:0; color: var(--cool-gray);">
                {{ $finalAttempt->exam->title ?? 'Final Test' }} -
                Score: <strong>{{ number_format((float) $finalAttempt->percentage, 2) }}%</strong>
                ({{ $finalAttempt->total_points_earned }} / {{ $finalAttempt->total_points_possible }})
            </p>
        </div>
    @endif

    <div class="card" style="padding:1.25rem;">
        <h3 style="margin:0 0 1rem; color: var(--diamond-white);">All Completed Tests</h3>

        @if($attempts->isEmpty())
            <p style="margin:0; color: var(--cool-gray);">No completed tests yet.</p>
        @else
            <div style="overflow-x:auto;">
                <table style="width:100%; border-collapse:collapse;">
                    <thead>
                        <tr style="border-bottom:1px solid rgba(255,255,255,.1); text-align:left;">
                            <th style="padding:.65rem .4rem;">Test</th>
                            <th style="padding:.65rem .4rem;">Type</th>
                            <th style="padding:.65rem .4rem;">Score</th>
                            <th style="padding:.65rem .4rem;">Completed</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attempts as $attempt)
                            <tr style="border-bottom:1px solid rgba(255,255,255,.06);">
                                <td style="padding:.65rem .4rem;">{{ $attempt->exam->title ?? 'Test' }}</td>
                                <td style="padding:.65rem .4rem;">{{ ucwords(str_replace('_', ' ', $attempt->exam->type ?? 'other')) }}</td>
                                <td style="padding:.65rem .4rem;">{{ number_format((float) $attempt->percentage, 2) }}%</td>
                                <td style="padding:.65rem .4rem;">{{ optional($attempt->completed_at)->format('M d, Y h:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
