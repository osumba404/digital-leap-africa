@extends('admin.about.layout')

@section('about-content')
<div class="card bg-primary-light border-0 shadow-sm rounded">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="text-gray-200 m-0">Partners</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPartnerModal">
                <i class="fas fa-plus me-2"></i>Add Partner
            </button>
        </div>
        
        <div class="row">
            @forelse($partners as $partner)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 bg-primary-light border-0">
                        <div class="position-relative">
                            <div class="d-flex align-items-center justify-content-center" style="height: 120px; background-color: #fff; padding: 1rem;">
                                <img src="{{ $partner->logo_url }}" class="img-fluid" alt="{{ $partner->name }}" style="max-height: 80px; width: auto; max-width: 100%;">
                            </div>
                            <div class="position-absolute top-0 end-0 p-2">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light rounded-circle" type="button" id="dropdownMenuButton{{ $partner->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton{{ $partner->id }}">
                                        <li>
                                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editPartnerModal{{ $partner->id }}">
                                                <i class="fas fa-edit me-2"></i>Edit
                                            </button>
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.about.partners.destroy', $partner->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this partner?')">
                                                    <i class="fas fa-trash me-2"></i>Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h6 class="card-title text-gray-200 mb-0">{{ $partner->name }}</h6>
                            @if($partner->website_url)
                                <a href="{{ $partner->website_url }}" target="_blank" class="text-gray-400 small">
                                    {{ parse_url($partner->website_url, PHP_URL_HOST) }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Edit Partner Modal -->
                <div class="modal fade" id="editPartnerModal{{ $partner->id }}" tabindex="-1" aria-labelledby="editPartnerModalLabel{{ $partner->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-primary-light text-gray-200">
                            <div class="modal-header border-0">
                                <h5 class="modal-title" id="editPartnerModalLabel{{ $partner->id }}">Edit Partner</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.about.partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="text-center mb-4">
                                        <div class="d-flex justify-content-center mb-2">
                                            <div style="width: 150px; height: 100px; background-color: #fff; display: flex; align-items: center; justify-content: center; padding: 1rem;">
                                                <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="img-fluid" style="max-height: 80px; max-width: 100%;">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="logo{{ $partner->id }}" class="form-label">Change Logo</label>
                                            <input class="form-control bg-primary-light border-0 text-gray-200" type="file" id="logo{{ $partner->id }}" name="logo">
                                            <small class="text-muted">Leave empty to keep current logo</small>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name{{ $partner->id }}" class="form-label">Partner Name</label>
                                        <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="name{{ $partner->id }}" 
                                               name="name" value="{{ old('name', $partner->name) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="website_url{{ $partner->id }}" class="form-label">Website URL</label>
                                        <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="website_url{{ $partner->id }}" 
                                               name="website_url" value="{{ old('website_url', $partner->website_url) }}">
                                    </div>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="is_active{{ $partner->id }}" 
                                               name="is_active" value="1" {{ $partner->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active{{ $partner->id }}">Active</label>
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
                        No partners found. Add your first partner using the button above.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Add Partner Modal -->
<div class="modal fade" id="addPartnerModal" tabindex="-1" aria-labelledby="addPartnerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-primary-light text-gray-200">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="addPartnerModalLabel">Add New Partner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.about.partners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Partner Name</label>
                        <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <input class="form-control bg-primary-light border-0 text-gray-200" type="file" id="logo" name="logo" required>
                        <small class="text-muted">Recommended size: 300x200px, transparent background preferred</small>
                    </div>
                    <div class="mb-3">
                        <label for="website_url" class="form-label">Website URL</label>
                        <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="website_url" name="website_url">
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Partner</button>
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




