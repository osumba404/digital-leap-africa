@extends('admin.about.layout')

@section('about-content')
<div class="card bg-primary-light border-0 shadow-sm rounded">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="text-gray-200 m-0">Team Members</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTeamMemberModal">
                <i class="fas fa-plus me-2"></i>Add Team Member
            </button>
        </div>
        
        <div class="row">
            @forelse($teamMembers as $member)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 bg-primary-light border-0">
                        <div class="position-relative">
                            <img src="{{ $member->image_url }}" class="card-img-top" alt="{{ $member->name }}" style="height: 200px; object-fit: cover;">
                            <div class="position-absolute top-0 end-0 p-2">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light rounded-circle" type="button" id="dropdownMenuButton{{ $member->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton{{ $member->id }}">
                                        <li>
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editTeamMemberModal{{ $member->id }}">
                                                <i class="fas fa-edit me-2"></i>Edit
                                            </button>
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.about.team.destroy', $member->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this team member?')">
                                                    <i class="fas fa-trash me-2"></i>Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-gray-200">{{ $member->name }}</h5>
                            <p class="card-text text-gray-400">{{ $member->role }}</p>
                            <div class="d-flex gap-2 mt-3">
                                @if($member->facebook_url)
                                    <a href="{{ $member->facebook_url }}" target="_blank" class="text-gray-400 hover:text-blue-400">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                @endif
                                @if($member->twitter_url)
                                    <a href="{{ $member->twitter_url }}" target="_blank" class="text-gray-400 hover:text-blue-400">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                @endif
                                @if($member->instagram_url)
                                    <a href="{{ $member->instagram_url }}" target="_blank" class="text-gray-400 hover:text-pink-500">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                @endif
                                @if($member->linkedin_url)
                                    <a href="{{ $member->linkedin_url }}" target="_blank" class="text-gray-400 hover:text-blue-600">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Team Member Modal -->
                <div class="modal fade" id="editTeamMemberModal{{ $member->id }}" tabindex="-1" aria-labelledby="editTeamMemberModalLabel{{ $member->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content bg-primary-light text-gray-200">
                            <div class="modal-header border-0">
                                <h5 class="modal-title" id="editTeamMemberModalLabel{{ $member->id }}">Edit Team Member</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.about.team.update', $member->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name{{ $member->id }}" class="form-label">Name</label>
                                                <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="name{{ $member->id }}" 
                                                       name="name" value="{{ old('name', $member->name) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="role{{ $member->id }}" class="form-label">Role</label>
                                                <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="role{{ $member->id }}" 
                                                       name="role" value="{{ old('role', $member->role) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="image{{ $member->id }}" class="form-label">Profile Image</label>
                                                <input class="form-control bg-primary-light border-0 text-gray-200" type="file" id="image{{ $member->id }}" name="image">
                                                <small class="text-muted">Leave empty to keep current image</small>
                                            </div>
                                            <div class="form-check form-switch mb-3">
                                                <input class="form-check-input" type="checkbox" id="is_active{{ $member->id }}" 
                                                       name="is_active" value="1" {{ $member->is_active ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_active{{ $member->id }}">Active</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="facebook_url{{ $member->id }}" class="form-label">Facebook URL</label>
                                                <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="facebook_url{{ $member->id }}" 
                                                       name="facebook_url" value="{{ old('facebook_url', $member->facebook_url) }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="twitter_url{{ $member->id }}" class="form-label">Twitter URL</label>
                                                <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="twitter_url{{ $member->id }}" 
                                                       name="twitter_url" value="{{ old('twitter_url', $member->twitter_url) }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="instagram_url{{ $member->id }}" class="form-label">Instagram URL</label>
                                                <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="instagram_url{{ $member->id }}" 
                                                       name="instagram_url" value="{{ old('instagram_url', $member->instagram_url) }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="linkedin_url{{ $member->id }}" class="form-label">LinkedIn URL</label>
                                                <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="linkedin_url{{ $member->id }}" 
                                                       name="linkedin_url" value="{{ old('linkedin_url', $member->linkedin_url) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="bio{{ $member->id }}" class="form-label">Bio</label>
                                        <textarea class="form-control bg-primary-light border-0 text-gray-200" id="bio{{ $member->id }}" 
                                                  name="bio" rows="4">{{ old('bio', $member->bio) }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        No team members found. Add your first team member using the button above.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Add Team Member Modal -->
<div class="modal fade" id="addTeamMemberModal" tabindex="-1" aria-labelledby="addTeamMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-primary-light text-gray-200">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="addTeamMemberModalLabel">Add New Team Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.about.team.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="role" name="role" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Profile Image</label>
                                <input class="form-control bg-primary-light border-0 text-gray-200" type="file" id="image" name="image" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="facebook_url" class="form-label">Facebook URL</label>
                                <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="facebook_url" name="facebook_url">
                            </div>
                            <div class="mb-3">
                                <label for="twitter_url" class="form-label">Twitter URL</label>
                                <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="twitter_url" name="twitter_url">
                            </div>
                            <div class="mb-3">
                                <label for="instagram_url" class="form-label">Instagram URL</label>
                                <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="instagram_url" name="instagram_url">
                            </div>
                            <div class="mb-3">
                                <label for="linkedin_url" class="form-label">LinkedIn URL</label>
                                <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="linkedin_url" name="linkedin_url">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control bg-primary-light border-0 text-gray-200" id="bio" name="bio" rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Team Member</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .form-control:focus {
        background-color: #2d3748;
        color: #e2e8f0;
    }
    .form-control {
        color: #e2e8f0;
    }
    .form-control::placeholder {
        color: #a0aec0;
    }
    .dropdown-menu {
        background-color: #2d3748;
        border: 1px solid #4a5568;
    }
    .dropdown-item {
        color: #e2e8f0;
    }
    .dropdown-item:hover {
        background-color: #4a5568;
        color: #fff;
    }
    .modal-content {
        border: 1px solid #4a5568;
    }
    .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }
</style>
@endpush
