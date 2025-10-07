@extends('admin.layout')

@section('title', 'Manage Team Members')

@section('admin-content')
<div class="space-y-6">
    <!-- Add New Team Member -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Add New Team Member</h3>
        <form action="{{ route('admin.content.team.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Full Name *</label>
                        <input type="text" name="name" id="name" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                        <input type="email" name="email" id="email" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    </div>
                    
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Role/Position *</label>
                        <input type="text" name="role" id="role" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    </div>
                    
                    <div>
                        <label for="bio" class="block text-sm font-medium text-gray-700">Bio *</label>
                        <textarea name="bio" id="bio" rows="4" required
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"></textarea>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">Profile Photo *</label>
                        <div class="mt-1 flex items-center">
                            <span class="inline-block h-12 w-12 overflow-hidden rounded-full bg-gray-100">
                                <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.67 0 8.997 1.701 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </span>
                            <input type="file" name="image" id="image" required accept="image/*"
                                   class="ml-5 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Square image, 400x400px recommended</p>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="linkedin_url" class="block text-sm font-medium text-gray-700">LinkedIn</label>
                            <input type="url" name="linkedin_url" id="linkedin_url"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
                                   placeholder="https://linkedin.com/in/username">
                        </div>
                        <div>
                            <label for="twitter_url" class="block text-sm font-medium text-gray-700">Twitter</label>
                            <input type="url" name="twitter_url" id="twitter_url"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
                                   placeholder="https://twitter.com/username">
                        </div>
                        <div>
                            <label for="instagram_url" class="block text-sm font-medium text-gray-700">Instagram</label>
                            <input type="url" name="instagram_url" id="instagram_url"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
                                   placeholder="https://instagram.com/username">
                        </div>
                        <div>
                            <label for="github_url" class="block text-sm font-medium text-gray-700">GitHub</label>
                            <input type="url" name="github_url" id="github_url"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
                                   placeholder="https://github.com/username">
                        </div>
                    </div>
                    
                    <div class="flex items-center pt-2">
                        <input type="checkbox" name="is_active" id="is_active" value="1" checked
                               class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-700">
                            Active
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end pt-4">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    Add Team Member
                </button>
            </div>
        </form>
    </div>

    <!-- Team Members List -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Team Members</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Manage your team members and their information.</p>
        </div>
        
        <div class="bg-white overflow-hidden">
            <ul role="list" class="divide-y divide-gray-200">
                @forelse($teamMembers as $member)
                    <li>
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if($member->image_path)
                                            <img class="h-10 w-10 rounded-full" src="{{ asset('storage/' . $member->image_path) }}" alt="{{ $member->name }}">
                                        @else
                                            <span class="inline-block h-10 w-10 overflow-hidden rounded-full bg-gray-100">
                                                <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.67 0 8.997 1.701 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                </svg>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $member->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $member->role }}</div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $member->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $member->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                    <button type="button" onclick="editTeamMember({{ $member->id }})" class="text-primary-600 hover:text-primary-900">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </button>
                                    <button type="button" onclick="confirmDelete({{ $member->id }})" class="text-red-600 hover:text-red-900">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="px-4 py-5 sm:px-6 text-center text-gray-500">
                        No team members found. Add your first team member above.
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

<!-- Edit Team Member Modal -->
<div id="editTeamMemberModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Modal content will be loaded here via JavaScript -->
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteConfirmationModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Delete Team Member</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Are you sure you want to delete this team member? This action cannot be undone.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <form id="deleteForm" method="POST" class="inline-flex w-full sm:ml-3 sm:w-auto">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Delete
                    </button>
                </form>
                <button type="button" onclick="closeModal('deleteConfirmationModal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Function to open the edit modal
    function editTeamMember(id) {
        fetch(`/admin/content/team/${id}/edit`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('editTeamMemberModal').innerHTML = html;
                document.getElementById('editTeamMemberModal').classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            });
    }
    
    // Function to confirm deletion
    function confirmDelete(id) {
        const form = document.getElementById('deleteForm');
        form.action = `/admin/content/team/${id}`;
        document.getElementById('deleteConfirmationModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
    
    // Function to close any modal
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
    
    // Close modals when clicking outside
    window.onclick = function(event) {
        if (event.target.classList.contains('fixed') && event.target.classList.contains('inset-0')) {
            document.querySelectorAll('.fixed.inset-0').forEach(modal => {
                if (!modal.classList.contains('hidden')) {
                    modal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            });
        }
    };
</script>
@endpush

@endsection
