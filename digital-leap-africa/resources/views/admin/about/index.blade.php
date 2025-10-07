@extends('admin.layout')

@section('title', 'About Page Management')

@section('admin-content')
    <div class="page-header">
        <h1 class="page-title">About Page Management</h1>
        <div class="page-actions">
            <a href="{{ route('admin.about.sections.create') }}" class="status-badge status-active" title="Add a new about section">Add New Section</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th style="width: 160px;">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($sections as $section)
                <tr>
                    <td>{{ $section->title }}</td>
                    <td>{{ $section->subtitle }}</td>
                    <td>
                        <div class="page-actions">
                            <a href="{{ route('admin.about.sections.edit', $section) }}" class="status-badge">Edit</a>
                            <form action="{{ route('admin.about.sections.destroy', $section) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="status-badge status-draft" onclick="return confirm('Delete this section?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No sections found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="page-header" style="margin-top: 2rem;">
        <h2 class="page-title">Team Members</h2>
        <div class="page-actions">
            <a href="{{ route('admin.about.team.create') }}" class="status-badge status-active" title="Add a new team member">Add Team Member</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th style="width: 220px;">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($teamMembers as $member)
                <tr>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->role }}</td>
                    <td>{{ $member->email }}</td>
                    <td>
                        @if($member->is_active)
                            <span class="status-badge status-active">Active</span>
                        @else
                            <span class="status-badge">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="page-actions">
                            <a href="{{ route('admin.about.team.edit', $member) }}" class="status-badge">Edit</a>
                            <form action="{{ route('admin.about.team.destroy', $member) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="status-badge status-draft" onclick="return confirm('Delete this team member?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No team members found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="page-header" style="margin-top: 2rem;">
        <h2 class="page-title">Partners</h2>
        <div class="page-actions">
            <a href="{{ route('admin.about.partners.create') }}" class="status-badge status-active" title="Add a new partner">Add Partner</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Website</th>
                    <th>Status</th>
                    <th style="width: 220px;">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($partners as $partner)
                <tr>
                    <td>{{ $partner->name }}</td>
                    <td>
                        @if($partner->website_url)
                            <a href="{{ $partner->website_url }}" target="_blank">{{ $partner->website_url }}</a>
                        @endif
                    </td>
                    <td>
                        @if($partner->is_active)
                            <span class="status-badge status-active">Active</span>
                        @else
                            <span class="status-badge">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="page-actions">
                            <a href="{{ route('admin.about.partners.edit', $partner) }}" class="status-badge">Edit</a>
                            <form action="{{ route('admin.about.partners.destroy', $partner) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="status-badge status-draft" onclick="return confirm('Delete this partner?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No partners found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection