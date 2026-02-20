# Test System Database Structure

## Overview

The test system supports three types of assessments:
- **Pre-course**: Before a course begins (optional, does NOT count toward final grade)
- **Post-lesson**: After each lesson (optional per lesson)
- **Final**: At the end of the course (optional)

The instructor can toggle each test on/off via `is_enabled`. Only **lesson tests + final test** are used to calculate the student's final grade.

---

## Database Tables

### 1. `exams`
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| course_id | FK | Course this exam belongs to |
| lesson_id | FK, nullable | For post_lesson only; null for pre_course and final |
| type | enum | `pre_course`, `post_lesson`, `final` |
| title | string | Exam title |
| description | text, nullable | Optional description |
| is_enabled | boolean | Instructor toggle—show/hide exam |
| time_limit_minutes | int, nullable | Optional time limit |
| count_towards_final_grade | boolean | false for pre_course; true for post_lesson and final |
| order | int | Display order |
| timestamps | | |

### 2. `exam_questions`
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| exam_id | FK | Parent exam |
| question_text | text | The question |
| question_type | enum | `single_choice` (radio), `multiple_choice` (checkbox), `text` (plain text answer) |
| points | decimal | Marks per question (instructor-assigned) |
| order | int | Question order |
| timestamps | | |

### 3. `exam_question_options`
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| exam_question_id | FK | Parent question |
| option_text | text | Option label (A, B, C, etc.) |
| is_correct | boolean | Whether this option is correct |
| order | int | Option order |
| timestamps | | |

### 4. `exam_attempts`
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| exam_id | FK | Exam taken |
| user_id | FK | Student |
| enrollment_id | FK | Links to user's course enrollment |
| started_at | timestamp | When attempt started |
| completed_at | timestamp, nullable | When submitted |
| total_points_earned | decimal | Points earned |
| total_points_possible | decimal | Max points for this exam |
| percentage | decimal, nullable | Score % |
| status | enum | `in_progress`, `completed`, `abandoned` |
| timestamps | | |

### 5. `exam_attempt_answers`
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| exam_attempt_id | FK | Parent attempt |
| exam_question_id | FK | Question answered |
| selected_option_ids | JSON, nullable | For single/multiple choice: `[1, 3]` |
| text_answer | text, nullable | For text questions |
| points_earned | decimal | Points for this answer |
| timestamps | | |

### 6. `enrollments` (updated)
Added columns for final grade:

| Column | Type | Description |
|--------|------|-------------|
| final_grade_percentage | decimal, nullable | Calculated final % |
| final_grade_points_earned | decimal, nullable | Total points earned |
| final_grade_points_possible | decimal, nullable | Total points possible |
| final_grade_calculated_at | timestamp, nullable | When grade was calculated |

---

## Question Types

| Type | UI | Storage |
|------|----|---------|
| `single_choice` | Radio buttons | `selected_option_ids`: `[option_id]` |
| `multiple_choice` | Checkboxes | `selected_option_ids`: `[id1, id2, ...]` |
| `text` | Textarea/input | `text_answer`: student's text |

---

## Final Grade Calculation

```
Final Grade = (Sum of lesson test points + Final exam points earned) / (Sum of lesson test points + Final exam points possible) × 100
```

Pre-course exam results are **not** included.

To recalculate an enrollment's final grade:

```php
$enrollment->calculateFinalGrade();
```

---

## Models

- `App\Models\Exam`
- `App\Models\ExamQuestion`
- `App\Models\ExamQuestionOption`
- `App\Models\ExamAttempt`
- `App\Models\ExamAttemptAnswer`

---

## Admin Routes & Views

- **Admin Panel** → Courses → Manage → **Tests**
- `admin/courses/{course}/exams` - List all tests
- Add Pre-Course, Post-Lesson (per lesson), Final tests
- Toggle `is_enabled` per test
- Manage questions: single choice (radio), multiple choice (checkbox), text

## User Routes & Views

- `exams/{exam}` - Test intro (start or view previous result)
- `exams/{exam}/start` - Start new attempt
- `exams/attempt/{attempt}` - Take test
- `exams/attempt/{attempt}/submit` - Submit answers
- `exams/attempt/{attempt}/result` - View score and review

**Integration:**
- **Course page**: Pre-course test (before lessons), Final test (when all lessons done)
- **Lesson page**: Post-lesson quiz (after lesson content, before "Mark as complete")

---

## Example: Creating an Exam

```php
// Pre-course exam (optional, doesn't count toward grade)
$exam = Exam::create([
    'course_id' => $course->id,
    'lesson_id' => null,
    'type' => Exam::TYPE_PRE_COURSE,
    'title' => 'Course Readiness Assessment',
    'is_enabled' => true,
    'count_towards_final_grade' => false,
]);

// Post-lesson exam
$exam = Exam::create([
    'course_id' => $course->id,
    'lesson_id' => $lesson->id,
    'type' => Exam::TYPE_POST_LESSON,
    'title' => 'Lesson 1 Quiz',
    'is_enabled' => true,
    'count_towards_final_grade' => true,
]);

// Question with single choice (radio)
$question = $exam->questions()->create([
    'question_text' => 'What is the capital of France?',
    'question_type' => Exam::QUESTION_TYPE_SINGLE_CHOICE,
    'points' => 5,
    'order' => 1,
]);
$question->options()->createMany([
    ['option_text' => 'London', 'is_correct' => false, 'order' => 1],
    ['option_text' => 'Paris', 'is_correct' => true, 'order' => 2],
]);

// Question with plain text answer
$exam->questions()->create([
    'question_text' => 'Describe the main concept in your own words.',
    'question_type' => Exam::QUESTION_TYPE_TEXT,
    'points' => 10,
    'order' => 2,
]);
```
