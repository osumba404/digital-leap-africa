@extends('admin.layout')

@push('styles')
<style>
.user-selection-container {
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}

.search-box {
    margin-bottom: 1.5rem;
}

.search-box input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    background: var(--input-bg);
    color: var(--text-primary);
    font-size: 0.95rem;
}

.search-box input:focus {
    outline: none;
    border-color: var(--cyan-accent);
}

.user-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1rem;
    max-height: 500px;
    overflow-y: auto;
    padding: 0.5rem;
}

.user-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: rgba(0, 201, 255, 0.05);
    border: 1px solid rgba(0, 201, 255, 0.2);
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s;
}

.user-card:hover {
    background: rgba(0, 201, 255, 0.1);
    border-color: rgba(0, 201, 255, 0.4);
}

.user-card.selected {
    background: rgba(0, 201, 255, 0.15);
    border-color: var(--cyan-accent);
    border-width: 2px;
}

.user-checkbox {
    width: 20px;
    height: 20px;
    cursor: pointer;
    accent-color: var(--cyan-accent);
}

.user-info {
    flex: 1;
}

.user-name {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
}

.user-email {
    font-size: 0.85rem;
    color: var(--cool-gray);
}

.selection-summary {
    background: rgba(139, 92, 246, 0.1);
    border: 1px solid rgba(139, 92, 246, 0.3);
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.selection-count {
    font-size: 1rem;
    color: var(--purple-accent);
    font-weight: 600;
}

.select-all-btn {
    background: rgba(139, 92, 246, 0.1);
    color: var(--purple-accent);
    border: 1px solid rgba(139, 92, 246, 0.3);
    padding: 0.5rem 1rem;
    border-radius: 6px;
    cursor: pointer;
    font-size: 0.9rem;
    transition: all 0.2s;
}

.select-all-btn:hover {
    background: rgba(139, 92, 246, 0.2);
}

[data-theme="light"] .user-selection-container {
    background: #ffffff;
    border-color: rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .search-box input {
    background: #f8fafc;
    border-color: rgba(46, 120, 197, 0.2);
    color: #1a202c;
}

[data-theme="light"] .search-box input:focus {
    border-color: #2563eb;
}

[data-theme="light"] .user-card {
    background: rgba(46, 120, 197, 0.05);
    border-color: rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .user-card:hover {
    background: rgba(46, 120, 197, 0.1);
    border-color: rgba(46, 120, 197, 0.4);
}

[data-theme="light"] .user-card.selected {
    background: rgba(46, 120, 197, 0.15);
    border-color: #2563eb;
}

[data-theme="light"] .user-name {
    color: #1a202c;
}

[data-theme="light"] .user-email {
    color: #64748b;
}

[data-theme="light"] .selection-summary {
    background: rgba(139, 92, 246, 0.1);
    border-color: rgba(139, 92, 246, 0.3);
}

[data-theme="light"] .selection-count {
    color: #7c3aed;
}

[data-theme="light"] .select-all-btn {
    background: rgba(139, 92, 246, 0.1);
    color: #7c3aed;
    border-color: rgba(139, 92, 246, 0.3);
}
</style>
@endpush

@section('admin-content')
<div class="page-header">
    <h1 class="page-title">Assign Badge: {{ $badge->badge_name }}</h1>
</div>

@if(session('success'))
    <div class="success-message">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('admin.badges.storeAssignment', $badge) }}" id="assignmentForm">
    @csrf
    
    <div class="selection-summary">
        <div class="selection-count">
            <i class="fas fa-users"></i>
            <span id="selectedCount">{{ count($assignedUsers) }}</span> user(s) selected
        </div>
        <div style="display: flex; gap: 0.5rem;">
            <button type="button" class="select-all-btn" onclick="selectAll()">
                <i class="fas fa-check-double"></i> Select All
            </button>
            <button type="button" class="select-all-btn" onclick="deselectAll()">
                <i class="fas fa-times"></i> Deselect All
            </button>
        </div>
    </div>

    <div class="user-selection-container">
        <div class="search-box">
            <input 
                type="text" 
                id="userSearch" 
                placeholder="Search users by name or email..." 
                onkeyup="filterUsers()"
            >
        </div>

        <div class="user-grid" id="userGrid">
            @foreach($users as $user)
                <label class="user-card {{ in_array($user->id, $assignedUsers) ? 'selected' : '' }}" data-user-id="{{ $user->id }}" data-user-name="{{ strtolower($user->name) }}" data-user-email="{{ strtolower($user->email) }}">
                    <input 
                        type="checkbox" 
                        name="user_ids[]" 
                        value="{{ $user->id }}" 
                        class="user-checkbox"
                        {{ in_array($user->id, $assignedUsers) ? 'checked' : '' }}
                        onchange="updateSelection(this)"
                    >
                    <div class="user-info">
                        <div class="user-name">{{ $user->name }}</div>
                        <div class="user-email">{{ $user->email }}</div>
                    </div>
                </label>
            @endforeach
        </div>
    </div>

    @error('user_ids')
        <div class="error-message" style="margin-bottom: 1rem;">{{ $message }}</div>
    @enderror

    <div class="form-actions">
        <button type="submit" class="btn-primary">
            <i class="fas fa-save"></i> Save Assignments
        </button>
        <a href="{{ route('admin.badges.index') }}" class="btn-outline">
            <i class="fas fa-arrow-left"></i> Back to Badges
        </a>
    </div>
</form>

@push('scripts')
<script>
function updateSelection(checkbox) {
    const card = checkbox.closest('.user-card');
    if (checkbox.checked) {
        card.classList.add('selected');
    } else {
        card.classList.remove('selected');
    }
    updateCount();
}

function updateCount() {
    const count = document.querySelectorAll('.user-checkbox:checked').length;
    document.getElementById('selectedCount').textContent = count;
}

function selectAll() {
    const checkboxes = document.querySelectorAll('.user-checkbox');
    checkboxes.forEach(cb => {
        if (!cb.checked) {
            cb.checked = true;
            cb.closest('.user-card').classList.add('selected');
        }
    });
    updateCount();
}

function deselectAll() {
    const checkboxes = document.querySelectorAll('.user-checkbox');
    checkboxes.forEach(cb => {
        cb.checked = false;
        cb.closest('.user-card').classList.remove('selected');
    });
    updateCount();
}

function filterUsers() {
    const searchTerm = document.getElementById('userSearch').value.toLowerCase();
    const cards = document.querySelectorAll('.user-card');
    
    cards.forEach(card => {
        const name = card.dataset.userName;
        const email = card.dataset.userEmail;
        
        if (name.includes(searchTerm) || email.includes(searchTerm)) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>
@endpush
@endsection