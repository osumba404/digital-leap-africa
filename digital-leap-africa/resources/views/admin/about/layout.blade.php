@extends('layouts.admin')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-primary-light border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h5 class="text-gray-200 mb-4">About Settings</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-gray-300 {{ request()->is('admin/about/sections*') ? 'active text-white fw-bold' : '' }}" 
                                   href="{{ route('admin.about.sections.index') }}">
                                    <i class="fas fa-align-left me-2"></i> Sections
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-gray-300 {{ request()->is('admin/about/team*') ? 'active text-white fw-bold' : '' }}" 
                                   href="{{ route('admin.about.team.index') }}">
                                    <i class="fas fa-users me-2"></i> Team Members
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-gray-300 {{ request()->is('admin/about/partners*') ? 'active text-white fw-bold' : '' }}" 
                                   href="{{ route('admin.about.partners.index') }}">
                                    <i class="fas fa-handshake me-2"></i> Partners
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('about-content')
            </div>
        </div>
    </div>
</div>
@endsection
