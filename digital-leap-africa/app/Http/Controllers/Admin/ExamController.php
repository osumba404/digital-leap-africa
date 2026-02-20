<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamQuestionOption;
use App\Models\Lesson;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index(Course $course)
    {
        $course->load(['exams.questions', 'topics.lessons']);
        $exams = $course->exams()->with(['questions', 'lesson.topic'])->orderBy('type')->orderBy('order')->get();

        return view('admin.exams.index', compact('course', 'exams'));
    }

    public function create(Course $course)
    {
        $type = request()->query('type', 'pre_course');
        $lessonId = request()->query('lesson_id');
        $lesson = $lessonId ? Lesson::find($lessonId) : null;
        if ($lesson && $lesson->topic->course_id !== $course->id) {
            $lesson = null;
        }

        $exam = new Exam([
            'course_id' => $course->id,
            'lesson_id' => $lesson?->id,
            'type' => $type,
            'is_enabled' => true,
        ]);

        $lessons = $course->topics->flatMap->lessons;

        return view('admin.exams.create', compact('course', 'exam', 'lesson', 'lessons'));
    }

    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'lesson_id' => 'nullable|exists:lessons,id',
            'type' => 'required|in:pre_course,post_lesson,final',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_enabled' => 'nullable|boolean',
            'time_limit_minutes' => 'nullable|integer|min:1|max:480',
        ]);

        $validated['course_id'] = $course->id;
        $validated['lesson_id'] = $validated['type'] === 'post_lesson' ? ($validated['lesson_id'] ?? null) : null;
        $validated['is_enabled'] = $request->boolean('is_enabled');

        $exam = Exam::create($validated);

        $redirect = $validated['type'] === 'post_lesson' && $validated['lesson_id']
            ? route('admin.topics.lessons.index', [$course, $exam->lesson->topic])
            : route('admin.exams.index', $course);

        return redirect($redirect)->with('success', 'Test created. Add questions to complete it.');
    }

    public function edit(Course $course, Exam $exam)
    {
        $exam->load(['questions.options', 'lesson.topic']);
        $lessons = $course->topics->flatMap->lessons;

        return view('admin.exams.edit', compact('course', 'exam', 'lessons'));
    }

    public function update(Request $request, Course $course, Exam $exam)
    {
        $validated = $request->validate([
            'lesson_id' => 'nullable|exists:lessons,id',
            'type' => 'required|in:pre_course,post_lesson,final',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_enabled' => 'nullable|boolean',
            'time_limit_minutes' => 'nullable|integer|min:1|max:480',
        ]);

        $validated['lesson_id'] = $validated['type'] === 'post_lesson' ? ($validated['lesson_id'] ?? null) : null;
        $validated['is_enabled'] = $request->boolean('is_enabled');

        $exam->update($validated);

        if ($exam->type === Exam::TYPE_POST_LESSON && $exam->lesson) {
            return redirect()->route('admin.topics.lessons.index', [$course, $exam->lesson->topic])->with('success', 'Test updated.');
        }
        return redirect()->route('admin.exams.index', $course)->with('success', 'Test updated.');
    }

    public function destroy(Course $course, Exam $exam)
    {
        $isPostLesson = $exam->type === Exam::TYPE_POST_LESSON;
        $topic = $exam->lesson?->topic;
        $exam->delete();
        if ($isPostLesson && $topic) {
            return redirect()->route('admin.topics.lessons.index', [$course, $topic])->with('success', 'Test deleted.');
        }
        return redirect()->route('admin.exams.index', $course)->with('success', 'Test deleted.');
    }

    public function questions(Course $course, Exam $exam)
    {
        $exam->load([
            'questions.options' => fn ($q) => $q->orderBy('order'),
            'lesson.topic',
        ]);

        return view('admin.exams.questions', compact('course', 'exam'));
    }

    public function storeQuestion(Request $request, Course $course, Exam $exam)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|in:single_choice,multiple_choice,text',
            'points' => 'required|numeric|min:0',
            'options' => 'nullable|array',
            'options.*.text' => 'required_with:options|string',
            'options.*.is_correct' => 'nullable|boolean',
        ]);

        $order = $exam->questions()->max('order') + 1;
        $question = $exam->questions()->create([
            'question_text' => $validated['question_text'],
            'question_type' => $validated['question_type'],
            'points' => $validated['points'],
            'order' => $order,
        ]);

        if (in_array($validated['question_type'], ['single_choice', 'multiple_choice']) && !empty($validated['options'])) {
            foreach ($validated['options'] as $i => $opt) {
                $question->options()->create([
                    'option_text' => $opt['text'],
                    'is_correct' => $opt['is_correct'] ?? false,
                    'order' => $i + 1,
                ]);
            }
        }

        return redirect()->route('admin.exams.questions', [$course, $exam])->with('success', 'Question added.');
    }

    public function updateQuestion(Request $request, Course $course, Exam $exam, ExamQuestion $question)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|in:single_choice,multiple_choice,text',
            'points' => 'required|numeric|min:0',
            'options' => 'nullable|array',
            'options.*.id' => 'nullable|exists:exam_question_options,id',
            'options.*.text' => 'required_with:options|string',
            'options.*.is_correct' => 'nullable|boolean',
        ]);

        $question->update([
            'question_text' => $validated['question_text'],
            'question_type' => $validated['question_type'],
            'points' => $validated['points'],
        ]);

        if (in_array($validated['question_type'], ['single_choice', 'multiple_choice'])) {
            $question->options()->delete();
            if (!empty($validated['options'])) {
                foreach ($validated['options'] as $i => $opt) {
                    $question->options()->create([
                        'option_text' => $opt['text'],
                        'is_correct' => $opt['is_correct'] ?? false,
                        'order' => $i + 1,
                    ]);
                }
            }
        } else {
            $question->options()->delete();
        }

        return redirect()->route('admin.exams.questions', [$course, $exam])->with('success', 'Question updated.');
    }

    public function destroyQuestion(Course $course, Exam $exam, ExamQuestion $question)
    {
        $question->delete();
        return redirect()->route('admin.exams.questions', [$course, $exam])->with('success', 'Question deleted.');
    }
}
