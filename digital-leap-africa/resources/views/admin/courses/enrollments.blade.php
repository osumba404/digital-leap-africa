@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">{{ $course->title }} - Enrollments</h3>
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Courses
                    </a>
                </div>
                
                <div class="card-body">
                    @if($enrollments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Enrolled Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($enrollments as $enrollment)
                                        <tr>
                                            <td>{{ $enrollment->user->name }}</td>
                                            <td>{{ $enrollment->user->email }}</td>
                                            <td>
                                                @switch($enrollment->status)
                                                    @case('pending')
                                                        <span class="badge badge-warning">Pending</span>
                                                        @break
                                                    @case('active')
                                                        <span class="badge badge-success">Active</span>
                                                        @break
                                                    @case('completed')
                                                        <span class="badge badge-primary">Completed</span>
                                                        @break
                                                    @case('rejected')
                                                        <span class="badge badge-danger">Rejected</span>
                                                        @break
                                                    @case('dropped')
                                                        <span class="badge badge-secondary">Dropped</span>
                                                        @break
                                                @endswitch
                                            </td>
                                            <td>{{ $enrollment->enrolled_at->format('M d, Y H:i') }}</td>
                                            <td>
                                                @if($enrollment->status === 'pending')
                                                    <form method="POST" action="{{ route('admin.courses.enrollments.approve', $enrollment) }}" style="display: inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Approve this enrollment?')">
                                                            <i class="fas fa-check"></i> Approve
                                                        </button>
                                                    </form>
                                                    <form method="POST" action="{{ route('admin.courses.enrollments.reject', $enrollment) }}" style="display: inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Reject this enrollment?')">
                                                            <i class="fas fa-times"></i> Reject
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-muted">No actions available</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No Enrollments Yet</h4>
                            <p class="text-muted">Students will appear here once they enroll in this course.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection