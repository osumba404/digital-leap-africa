@extends('admin.layout')
@section('title', 'Manage Jobs')

@section('admin-content')
<div class="py-5">
    <div class="container">
        {{-- Original content starts --}}
        <div class="bg-primary-light shadow-sm rounded">
            <div class="p-4 text-gray-200">
                @yield('jobs-index-inner')
            </div>
        </div>
        {{-- Original content ends --}}
    </div>
</div>
@endsection

{{-- Preserve original markup by injecting it into a section used above --}}
@section('jobs-index-inner')
    {!! (function(){ ob_start(); ?>
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-semibold fs-4 text-gray-100 m-0">
                {{ __('Manage Jobs') }}
            </h2>
            <a href="{{ route('admin.jobs.create') }}" class="btn btn-primary btn-sm">+ Add New Job</a>
        </div>
    </x-slot>
    <div class="py-5">
        <div class="container">
            <div class="bg-primary-light shadow-sm rounded">
                <div class="p-4 text-gray-200">
                    @yield('jobs-table')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<?php return ob_get_clean(); })() !!}
@endsection

{{-- Preserve original table markup by injecting it into a section used above --}}
@section('jobs-table')
    {!! (function(){ ob_start(); ?>
    <div class="table-responsive">
        <table class="table table-sm table-borderless align-middle text-gray-200 mb-0">
            <thead>
                <tr class="border-bottom border-dark-subtle">
                    <th class="py-2">Title</th>
                    <th class="py-2">Company</th>
                    <th class="py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                    <tr class="border-bottom border-dark-subtle">
                        <td class="py-2">{{ $job->title }}</td>
                        <td class="py-2">{{ $job->company }}</td>
                        <td class="py-2">
                            <a href="{{ route('admin.jobs.edit', $job) }}" class="link-info text-decoration-none">Edit</a>
                            <form method="POST" action="{{ route('admin.jobs.destroy', $job) }}" class="d-inline ms-3" onsubmit="return confirm('Are you sure you want to delete this job?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link link-danger p-0 align-baseline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <?php return ob_get_clean(); })() !!}
@endsection