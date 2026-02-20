@extends('admin.layout')

@section('admin-content')
<div class="page-header exams-questions-header">
  <div class="page-header-left">
    <nav aria-label="breadcrumb" class="exams-questions-breadcrumb">
      @if($exam->lesson)
        <a href="{{ route('admin.topics.lessons.index', [$course, $exam->lesson->topic]) }}" class="breadcrumb-link">Lessons</a>
        <span class="breadcrumb-sep">/</span>
        <span class="breadcrumb-sep">{{ $exam->lesson->topic->title }}</span>
        <span class="breadcrumb-sep">/</span>
        <span class="breadcrumb-sep">{{ Str::limit($exam->lesson->title, 30) }}</span>
        <span class="breadcrumb-sep">/</span>
      @else
        <a href="{{ route('admin.exams.index', $course) }}" class="breadcrumb-link">Tests</a>
        <span class="breadcrumb-sep">/</span>
      @endif
      <span class="breadcrumb-current">Questions</span>
    </nav>
    <h1 class="page-title mb-0">Questions: {{ Str::limit($exam->title, 50) }}</h1>
    <p class="page-subtitle text-muted mb-0 mt-1">{{ $exam->lesson ? 'Lesson test – add and manage questions.' : 'Add and manage questions for this test.' }}</p>
  </div>
  <div class="page-actions">
    @if($exam->lesson)
      <a href="{{ route('admin.topics.lessons.index', [$course, $exam->lesson->topic]) }}" class="btn-outline">
        <i class="fas fa-arrow-left me-2"></i>Back to Lessons
      </a>
    @else
      <a href="{{ route('admin.exams.index', $course) }}" class="btn-outline">
        <i class="fas fa-arrow-left me-2"></i>Back to Tests
      </a>
    @endif
    <button type="button" class="btn btn-primary" data-open-popup="addQuestionModal">
      <i class="fas fa-plus me-2"></i>Add Question
    </button>
  </div>
</div>

@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

<div class="admin-content">
  {{-- Stats --}}
  <div class="exam-questions-stats mb-4">
    <div class="stat-pill">
      <i class="fas fa-list-ol"></i>
      <span>{{ $exam->questions->count() }} question{{ $exam->questions->count() !== 1 ? 's' : '' }}</span>
    </div>
    <div class="stat-pill">
      <i class="fas fa-star"></i>
      <span>{{ $exam->questions->sum('points') }} points total</span>
    </div>
  </div>

  <div class="card exam-questions-card">
    <div class="card-body">
      @forelse($exam->questions as $index => $q)
        <article class="question-block" data-question-id="{{ $q->id }}">
          <div class="question-block-header">
            <div class="question-meta">
              <span class="question-num">#{{ $index + 1 }}</span>
              <span class="question-type-badge">{{ ucfirst(str_replace('_', ' ', $q->question_type)) }}</span>
              <span class="question-points-badge">{{ $q->points }} pts</span>
            </div>
            <div class="question-actions">
              <button type="button" class="btn btn-sm btn-outline edit-question-btn" data-question="{{ json_encode([
                'id' => $q->id,
                'question_text' => $q->question_text,
                'question_type' => $q->question_type,
                'points' => $q->points,
                'options' => $q->options->map(fn($o) => ['text' => $o->option_text, 'is_correct' => $o->is_correct])->toArray()
              ]) }}" title="Edit question">
                <i class="fas fa-edit me-1"></i>Edit
              </button>
              <form method="POST" action="{{ route('admin.exams.questions.destroy', [$course, $exam, $q]) }}" class="d-inline" onsubmit="return confirm('Delete this question?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" title="Delete question">
                  <i class="fas fa-trash me-1"></i>Delete
                </button>
              </form>
            </div>
          </div>
          <p class="question-text">{{ $q->question_text }}</p>
          @if($q->options->count())
            <ul class="question-options-list">
              @foreach($q->options as $opt)
                <li class="question-option {{ $opt->is_correct ? 'is-correct' : '' }}">
                  @if($opt->is_correct)
                    <i class="fas fa-check-circle option-check"></i>
                  @else
                    <span class="option-dot"></span>
                  @endif
                  <span>{{ $opt->option_text }}</span>
                </li>
              @endforeach
            </ul>
          @endif
        </article>
      @empty
        <div class="empty-questions-state">
          <div class="empty-questions-icon">
            <i class="fas fa-clipboard-list"></i>
          </div>
          <h3 class="empty-questions-title">No questions yet</h3>
          <p class="empty-questions-text text-muted">Add your first question to build this test.</p>
          <button type="button" class="btn btn-primary" data-open-popup="addQuestionModal">
            <i class="fas fa-plus me-2"></i>Add first question
          </button>
        </div>
      @endforelse
    </div>
  </div>
</div>

{{-- Pop-up overlay: Add Question --}}
<div class="exam-popup-overlay" id="addQuestionModal" role="dialog" aria-labelledby="addQuestionModalLabel" aria-modal="true" hidden>
  <div class="exam-popup-backdrop" data-close="addQuestionModal"></div>
  <div class="exam-popup-dialog">
    <div class="exam-modal-content">
      <div class="exam-modal-header">
        <h5 class="exam-modal-title" id="addQuestionModalLabel"><i class="fas fa-plus-circle me-2"></i>Add Question</h5>
        <button type="button" class="exam-popup-close" data-close="addQuestionModal" aria-label="Close">&times;</button>
      </div>
      <form method="POST" action="{{ route('admin.exams.questions.store', [$course, $exam]) }}">
        @csrf
        <div class="exam-modal-body">
          <div class="mb-4">
            <label class="form-label fw-semibold">Question text</label>
            <textarea name="question_text" class="form-control exam-textarea" rows="3" placeholder="Enter the question..." required></textarea>
          </div>
          <div class="row g-3 mb-4">
            <div class="col-md-6">
              <label class="form-label fw-semibold">Type</label>
              <select name="question_type" class="form-select question-type-select">
                <option value="single_choice">Single choice</option>
                <option value="multiple_choice">Multiple choice</option>
                <option value="text">Text (open answer)</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Points</label>
              <input type="number" name="points" class="form-control" value="1" min="0" step="0.5" required>
            </div>
          </div>
          <div id="options-container" class="options-section">
            <label class="form-label fw-semibold">Answer options</label>
            <p class="form-text text-muted small mb-2">Check the correct option(s).</p>
            <div id="options-list" class="options-list">
              <div class="option-row">
                <input type="text" name="options[0][text]" class="form-control" placeholder="Option A">
                <label class="option-correct-label">
                  <input type="checkbox" name="options[0][is_correct]" value="1" class="form-check-input">
                  <span>Correct</span>
                </label>
              </div>
            </div>
            <button type="button" id="add-option" class="btn btn-sm btn-outline mt-2">
              <i class="fas fa-plus me-1"></i>Add option
            </button>
          </div>
        </div>
        <div class="exam-modal-footer">
          <button type="button" class="btn-outline" data-close="addQuestionModal">Cancel</button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-check me-1"></i>Add question</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Pop-up overlay: Edit Question --}}
<div class="exam-popup-overlay" id="editQuestionModal" role="dialog" aria-labelledby="editQuestionModalLabel" aria-modal="true" hidden>
  <div class="exam-popup-backdrop" data-close="editQuestionModal"></div>
  <div class="exam-popup-dialog">
    <div class="exam-modal-content">
      <div class="exam-modal-header">
        <h5 class="exam-modal-title" id="editQuestionModalLabel"><i class="fas fa-edit me-2"></i>Edit Question</h5>
        <button type="button" class="exam-popup-close" data-close="editQuestionModal" aria-label="Close">&times;</button>
      </div>
      <form id="edit-question-form" method="POST" action="" data-action-base="{{ route('admin.exams.questions.update', [$course, $exam, 0]) }}">
        @csrf
        @method('PUT')
        <div class="exam-modal-body">
          <div class="mb-4">
            <label class="form-label fw-semibold">Question text</label>
            <textarea name="question_text" id="edit_question_text" class="form-control exam-textarea" rows="3" required></textarea>
          </div>
          <div class="row g-3 mb-4">
            <div class="col-md-6">
              <label class="form-label fw-semibold">Type</label>
              <select name="question_type" id="edit_question_type" class="form-select question-type-select">
                <option value="single_choice">Single choice</option>
                <option value="multiple_choice">Multiple choice</option>
                <option value="text">Text (open answer)</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label fw-semibold">Points</label>
              <input type="number" name="points" id="edit_points" class="form-control" min="0" step="0.5" required>
            </div>
          </div>
          <div id="edit-options-container" class="options-section">
            <label class="form-label fw-semibold">Answer options</label>
            <div id="edit-options-list" class="options-list"></div>
            <button type="button" id="add-edit-option" class="btn btn-sm btn-outline mt-2">
              <i class="fas fa-plus me-1"></i>Add option
            </button>
          </div>
        </div>
        <div class="exam-modal-footer">
          <button type="button" class="btn-outline" data-close="editQuestionModal">Cancel</button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('styles')
<style>
/* Exam questions page */
.exams-questions-header {
  flex-wrap: wrap;
  gap: 1rem;
}
.page-header-left .page-title { font-size: 1.35rem; }
.page-subtitle { font-size: 0.9rem; }
.exams-questions-breadcrumb {
  font-size: 0.85rem;
  margin-bottom: 0.35rem;
}
.breadcrumb-link { color: var(--cyan-accent); text-decoration: none; }
.breadcrumb-link:hover { text-decoration: underline; }
.breadcrumb-sep { color: rgba(255,255,255,0.4); margin: 0 0.25rem; }
.breadcrumb-current { color: rgba(255,255,255,0.7); }

.exam-questions-stats {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
}
.stat-pill {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 999px;
  font-size: 0.9rem;
  color: var(--diamond-white);
}
.stat-pill i { color: var(--cyan-accent); opacity: 0.9; }

.exam-questions-card .card-body { padding: 1.5rem; }

.question-block {
  padding: 1.25rem 1.5rem;
  background: rgba(255,255,255,0.03);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 10px;
  margin-bottom: 1rem;
  transition: border-color 0.2s, background 0.2s;
}
.question-block:last-child { margin-bottom: 0; }
.question-block:hover {
  background: rgba(255,255,255,0.05);
  border-color: rgba(255,255,255,0.12);
}

.question-block-header {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: center;
  gap: 0.75rem;
  margin-bottom: 0.75rem;
}
.question-meta { display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; }
.question-num {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 28px;
  height: 28px;
  padding: 0 0.5rem;
  background: rgba(0, 201, 255, 0.15);
  border-radius: 8px;
  font-weight: 600;
  font-size: 0.85rem;
  color: var(--cyan-accent);
}
.question-type-badge {
  font-size: 0.75rem;
  padding: 0.2rem 0.5rem;
  border-radius: 6px;
  background: rgba(255,255,255,0.08);
  color: rgba(255,255,255,0.85);
}
.question-points-badge {
  font-size: 0.75rem;
  padding: 0.2rem 0.5rem;
  border-radius: 6px;
  background: rgba(34, 197, 94, 0.2);
  color: #22c55e;
}
.question-actions { display: flex; gap: 0.5rem; flex-wrap: wrap; }
.question-text {
  margin: 0 0 0.75rem 0;
  font-size: 1rem;
  line-height: 1.5;
  color: var(--diamond-white);
}
.question-options-list {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}
.question-option {
  display: flex;
  align-items: flex-start;
  gap: 0.5rem;
  padding: 0.5rem 0.75rem;
  background: rgba(255,255,255,0.04);
  border-radius: 8px;
  border-left: 3px solid transparent;
  font-size: 0.95rem;
  color: rgba(255,255,255,0.9);
}
.question-option.is-correct {
  border-left-color: #22c55e;
  background: rgba(34, 197, 94, 0.08);
}
.option-check { color: #22c55e; margin-top: 0.15rem; flex-shrink: 0; }
.option-dot {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: rgba(255,255,255,0.35);
  margin-top: 0.5rem;
  flex-shrink: 0;
}

.empty-questions-state {
  text-align: center;
  padding: 3rem 2rem;
}
.empty-questions-icon {
  width: 80px;
  height: 80px;
  margin: 0 auto 1.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(255,255,255,0.06);
  border-radius: 50%;
  color: rgba(255,255,255,0.4);
  font-size: 2rem;
}
.empty-questions-title { font-size: 1.25rem; margin-bottom: 0.5rem; color: var(--diamond-white); }
.empty-questions-text { margin-bottom: 1.5rem; }

/* Pop-up overlay – forms appear on top, scrollable */
.exam-popup-overlay {
  position: fixed;
  inset: 0;
  z-index: 9999;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 1rem;
}
.exam-popup-overlay[hidden] {
  display: none !important;
}
.exam-popup-backdrop {
  position: absolute;
  inset: 0;
  background: rgba(0, 0, 0, 0.65);
  cursor: pointer;
}
.exam-popup-dialog {
  position: relative;
  z-index: 1;
  width: 100%;
  max-width: 800px;
  max-height: calc(100vh - 2rem);
  display: flex;
  flex-direction: column;
}
.exam-popup-close {
  background: none;
  border: none;
  color: rgba(255,255,255,0.8);
  font-size: 1.75rem;
  line-height: 1;
  cursor: pointer;
  padding: 0.25rem;
  margin: -0.25rem 0 0 0.5rem;
}
.exam-popup-close:hover { color: #fff; }

.exam-modal-content {
  background: var(--charcoal);
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: 12px;
  display: flex;
  flex-direction: column;
  max-height: 100%;
}
.exam-modal-header {
  border-bottom: 1px solid rgba(255,255,255,0.1);
  padding: 1rem 1.5rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-shrink: 0;
}
.exam-modal-title { font-size: 1.1rem; color: var(--diamond-white); margin: 0; }
.exam-modal-body {
  padding: 1.5rem;
  overflow-y: auto;
  overflow-x: hidden;
  max-height: min(65vh, 520px);
  -webkit-overflow-scrolling: touch;
}
.exam-modal-footer {
  border-top: 1px solid rgba(255,255,255,0.1);
  padding: 1rem 1.5rem;
  flex-shrink: 0;
}
.exam-textarea { min-height: 80px; resize: vertical; }
.exam-modal-body .row { display: flex; flex-wrap: wrap; margin: 0 -0.5rem; }
.exam-modal-body .row.g-3 > * { padding: 0 0.5rem; margin-bottom: 0.5rem; }
.exam-modal-body .col-md-6 { flex: 0 0 100%; max-width: 100%; }
@media (min-width: 768px) {
  .exam-modal-body .col-md-6 { flex: 0 0 50%; max-width: 50%; }
}
.options-section { margin-bottom: 0; }
.options-list { display: flex; flex-direction: column; gap: 0.75rem; }
.option-row {
  display: flex;
  align-items: center;
  gap: 1rem;
  flex-wrap: wrap;
}
.option-row .form-control { flex: 1; min-width: 180px; }
.option-correct-label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  margin: 0;
  font-weight: normal;
  font-size: 0.9rem;
  color: rgba(255,255,255,0.8);
  white-space: nowrap;
  cursor: pointer;
}
.option-row .btn-remove-option {
  padding: 0.35rem 0.6rem;
  color: #ef4444;
  background: transparent;
  border: 1px solid rgba(239, 68, 68, 0.4);
  border-radius: 6px;
  cursor: pointer;
  transition: background 0.2s, color 0.2s;
}
.option-row .btn-remove-option:hover { background: rgba(239, 68, 68, 0.15); color: #f87171; }

[data-theme="light"] .question-block { background: #f8fafc; border-color: rgba(0,0,0,0.08); }
[data-theme="light"] .question-block:hover { background: #f1f5f9; border-color: rgba(0,0,0,0.12); }
[data-theme="light"] .question-text { color: #1e293b; }
[data-theme="light"] .question-option { background: #f1f5f9; color: #334155; }
[data-theme="light"] .question-option.is-correct { background: rgba(34, 197, 94, 0.1); }
[data-theme="light"] .stat-pill { background: #f1f5f9; color: #1e293b; border-color: rgba(0,0,0,0.08); }
[data-theme="light"] .breadcrumb-link { color: #2e78c5; }
[data-theme="light"] .breadcrumb-current { color: #64748b; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  function escapeHtml(str) {
    if (!str) return '';
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
  }

  function toggleOptions(containerId, show) {
    const container = document.getElementById(containerId);
    if (container) container.style.display = show ? 'block' : 'none';
  }

  function openPopup(id) {
    var el = document.getElementById(id);
    if (el) { el.removeAttribute('hidden'); document.body.style.overflow = 'hidden'; }
  }
  function closePopup(id) {
    var el = document.getElementById(id);
    if (el) { el.setAttribute('hidden', ''); document.body.style.overflow = ''; }
  }

  document.querySelectorAll('[data-open-popup]').forEach(function(btn) {
    btn.addEventListener('click', function() { openPopup(this.getAttribute('data-open-popup')); });
  });
  document.querySelectorAll('[data-close]').forEach(function(el) {
    el.addEventListener('click', function() { closePopup(this.getAttribute('data-close')); });
  });
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      document.querySelectorAll('.exam-popup-overlay:not([hidden])').forEach(function(p) {
        p.setAttribute('hidden', '');
      });
      document.body.style.overflow = '';
    }
  });

  document.querySelectorAll('.question-type-select').forEach(function(sel) {
    sel.addEventListener('change', function() {
      var isChoice = ['single_choice', 'multiple_choice'].indexOf(this.value) !== -1;
      var parent = this.closest('.exam-popup-overlay');
      var container = parent ? parent.querySelector('#options-container, #edit-options-container') : null;
      if (container) container.style.display = isChoice ? 'block' : 'none';
    });
  });

  var optionIndex = 1;
  document.getElementById('add-option') && document.getElementById('add-option').addEventListener('click', function() {
    var list = document.getElementById('options-list');
    var div = document.createElement('div');
    div.className = 'option-row';
    div.innerHTML = '<input type="text" name="options[' + optionIndex + '][text]" class="form-control" placeholder="Option text">' +
      '<label class="option-correct-label"><input type="checkbox" name="options[' + optionIndex + '][is_correct]" value="1" class="form-check-input"><span>Correct</span></label>' +
      '<button type="button" class="btn btn-sm btn-remove-option remove-option" title="Remove option">&times;</button>';
    list.appendChild(div);
    optionIndex++;
    div.querySelector('.remove-option').addEventListener('click', function() { div.remove(); });
  });

  document.querySelectorAll('.edit-question-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var q = JSON.parse(this.dataset.question);
      var form = document.getElementById('edit-question-form');
      form.action = form.dataset.actionBase.replace('/0', '/' + q.id);

      document.getElementById('edit_question_text').value = q.question_text || '';
      document.getElementById('edit_question_type').value = q.question_type || 'single_choice';
      document.getElementById('edit_points').value = q.points ?? 1;

      var optionsList = document.getElementById('edit-options-list');
      optionsList.innerHTML = '';
      if (q.options && q.options.length) {
        q.options.forEach(function(opt, i) {
          var div = document.createElement('div');
          div.className = 'option-row';
          div.innerHTML = '<input type="text" name="options[' + i + '][text]" class="form-control" value="">' +
            '<label class="option-correct-label"><input type="checkbox" name="options[' + i + '][is_correct]" value="1" class="form-check-input"' + (opt.is_correct ? ' checked' : '') + '><span>Correct</span></label>' +
            '<button type="button" class="btn btn-sm btn-remove-option remove-option" title="Remove option">&times;</button>';
          div.querySelector('input[type="text"]').value = opt.text || '';
          optionsList.appendChild(div);
          div.querySelector('.remove-option').addEventListener('click', function() { div.remove(); });
        });
      } else {
        var div = document.createElement('div');
        div.className = 'option-row';
        div.innerHTML = '<input type="text" name="options[0][text]" class="form-control" placeholder="Option text">' +
          '<label class="option-correct-label"><input type="checkbox" name="options[0][is_correct]" value="1" class="form-check-input"><span>Correct</span></label>' +
          '<button type="button" class="btn btn-sm btn-remove-option remove-option" title="Remove option">&times;</button>';
        optionsList.appendChild(div);
        div.querySelector('.remove-option').addEventListener('click', function() { div.remove(); });
      }

      toggleOptions('edit-options-container', ['single_choice', 'multiple_choice'].indexOf(q.question_type) !== -1);
      openPopup('editQuestionModal');
    });
  });

  document.getElementById('add-edit-option') && document.getElementById('add-edit-option').addEventListener('click', function() {
    var list = document.getElementById('edit-options-list');
    var count = list.querySelectorAll('.option-row').length;
    var div = document.createElement('div');
    div.className = 'option-row';
    div.innerHTML = '<input type="text" name="options[' + count + '][text]" class="form-control" placeholder="Option text">' +
      '<label class="option-correct-label"><input type="checkbox" name="options[' + count + '][is_correct]" value="1" class="form-check-input"><span>Correct</span></label>' +
      '<button type="button" class="btn btn-sm btn-remove-option remove-option" title="Remove option">&times;</button>';
    list.appendChild(div);
    div.querySelector('.remove-option').addEventListener('click', function() { div.remove(); });
  });

  var addTypeSelect = document.querySelector('#addQuestionModal .question-type-select');
  if (addTypeSelect) addTypeSelect.addEventListener('change', function() {
    toggleOptions('options-container', ['single_choice', 'multiple_choice'].indexOf(this.value) !== -1);
  });
  document.getElementById('options-container').style.display = 'block';
});
</script>
@endpush
