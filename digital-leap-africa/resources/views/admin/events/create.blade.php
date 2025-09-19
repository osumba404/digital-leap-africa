<x-app-layout>
  <x-slot name="header"><h2 class="fw-semibold fs-4 text-gray-100 m-0">Add New Event</h2></x-slot>
  <div class="py-5"><div class="container" style="max-width: 48rem;">
    <div class="bg-primary-light shadow-sm rounded"><div class="p-4 text-gray-200">
      <form method="POST" action="{{ route('admin.events.store') }}"> @include('admin.events._form') </form>
    </div></div></div></div>
</x-app-layout>