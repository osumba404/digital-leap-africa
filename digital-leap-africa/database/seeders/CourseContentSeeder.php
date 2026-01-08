<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Topic;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class CourseContentSeeder extends Seeder
{
    public function run()
    {
        $courses = Course::all();

        foreach ($courses as $course) {
            $this->createTopicsAndLessons($course);
        }
    }

    private function createTopicsAndLessons($course)
    {
        $courseContent = $this->getCourseContent($course->slug);

        foreach ($courseContent as $topicData) {
            $topic = Topic::updateOrCreate(
                [
                    'course_id' => $course->id,
                    'title' => $topicData['title']
                ],
                [
                    'order' => $topicData['order']
                ]
            );

            foreach ($topicData['lessons'] as $lessonData) {
                Lesson::updateOrCreate(
                    [
                        'topic_id' => $topic->id,
                        'title' => $lessonData['title']
                    ],
                    [
                        'content' => $lessonData['content'],
                        'type' => $lessonData['type'],
                        'order' => $lessonData['order'],
                        'duration' => $lessonData['duration'] ?? null,
                        'video_url' => $lessonData['video_url'] ?? null,
                    ]
                );
            }
        }
    }

    private function getCourseContent($courseSlug)
    {
        $contentMap = [
            'introduction-to-web-development' => [
                [
                    'title' => 'HTML Fundamentals',
                    'description' => 'Learn the building blocks of web pages with HTML',
                    'order' => 1,
                    'lessons' => [
                        [
                            'title' => 'What is HTML?',
                            'content' => '<p>HTML (HyperText Markup Language) is the standard markup language for creating web pages. It describes the structure of a web page using elements and tags.</p><p>Key concepts:</p><ul><li>Elements and tags</li><li>Attributes</li><li>Document structure</li><li>Semantic markup</li></ul>',
                            'type' => 'text',
                            'order' => 1,
                            'duration' => 15,
                        ],
                        [
                            'title' => 'HTML Document Structure',
                            'content' => '<p>Every HTML document follows a basic structure:</p><pre><code>&lt;!DOCTYPE html&gt;\n&lt;html&gt;\n&lt;head&gt;\n    &lt;title&gt;Page Title&lt;/title&gt;\n&lt;/head&gt;\n&lt;body&gt;\n    &lt;h1&gt;Hello World!&lt;/h1&gt;\n&lt;/body&gt;\n&lt;/html&gt;</code></pre>',
                            'type' => 'text',
                            'order' => 2,
                            'duration' => 20,
                        ],
                        [
                            'title' => 'Common HTML Elements',
                            'content' => '<p>Learn about the most commonly used HTML elements:</p><ul><li>Headings (h1-h6)</li><li>Paragraphs (p)</li><li>Links (a)</li><li>Images (img)</li><li>Lists (ul, ol, li)</li><li>Divs and spans</li></ul>',
                            'type' => 'text',
                            'order' => 3,
                            'duration' => 25,
                        ],
                    ]
                ],
                [
                    'title' => 'CSS Styling',
                    'description' => 'Style your web pages with Cascading Style Sheets',
                    'order' => 2,
                    'lessons' => [
                        [
                            'title' => 'Introduction to CSS',
                            'content' => '<p>CSS (Cascading Style Sheets) is used to style and layout web pages. It controls colors, fonts, spacing, and positioning.</p><p>CSS can be applied in three ways:</p><ul><li>Inline styles</li><li>Internal stylesheets</li><li>External stylesheets</li></ul>',
                            'type' => 'text',
                            'order' => 1,
                            'duration' => 18,
                        ],
                        [
                            'title' => 'CSS Selectors',
                            'content' => '<p>CSS selectors are used to target HTML elements for styling:</p><ul><li>Element selectors (p, h1, div)</li><li>Class selectors (.classname)</li><li>ID selectors (#idname)</li><li>Attribute selectors</li><li>Pseudo-classes (:hover, :focus)</li></ul>',
                            'type' => 'text',
                            'order' => 2,
                            'duration' => 22,
                        ],
                        [
                            'title' => 'Box Model and Layout',
                            'content' => '<p>Understanding the CSS box model is crucial for layout:</p><ul><li>Content</li><li>Padding</li><li>Border</li><li>Margin</li></ul><p>Layout techniques include:</p><ul><li>Flexbox</li><li>CSS Grid</li><li>Positioning</li></ul>',
                            'type' => 'text',
                            'order' => 3,
                            'duration' => 30,
                        ],
                    ]
                ],
                [
                    'title' => 'JavaScript Basics',
                    'description' => 'Add interactivity to your web pages with JavaScript',
                    'order' => 3,
                    'lessons' => [
                        [
                            'title' => 'JavaScript Fundamentals',
                            'content' => '<p>JavaScript is a programming language that adds interactivity to web pages.</p><p>Core concepts:</p><ul><li>Variables and data types</li><li>Functions</li><li>Events</li><li>DOM manipulation</li></ul>',
                            'type' => 'text',
                            'order' => 1,
                            'duration' => 25,
                        ],
                        [
                            'title' => 'Working with the DOM',
                            'content' => '<p>The Document Object Model (DOM) represents the structure of HTML documents. JavaScript can:</p><ul><li>Select elements</li><li>Modify content</li><li>Change styles</li><li>Handle events</li></ul>',
                            'type' => 'text',
                            'order' => 2,
                            'duration' => 28,
                        ],
                    ]
                ],
            ],
            'python-for-beginners' => [
                [
                    'title' => 'Python Basics',
                    'description' => 'Learn the fundamentals of Python programming',
                    'order' => 1,
                    'lessons' => [
                        [
                            'title' => 'Introduction to Python',
                            'content' => '<p>Python is a high-level, interpreted programming language known for its simplicity and readability.</p><p>Why Python?</p><ul><li>Easy to learn and use</li><li>Versatile applications</li><li>Large community</li><li>Extensive libraries</li></ul>',
                            'type' => 'text',
                            'order' => 1,
                            'duration' => 20,
                        ],
                        [
                            'title' => 'Variables and Data Types',
                            'content' => '<p>Python supports various data types:</p><ul><li>Numbers (int, float)</li><li>Strings</li><li>Booleans</li><li>Lists</li><li>Dictionaries</li><li>Tuples</li></ul><p>Variables are created by assignment:</p><pre><code>name = "John"\nage = 25\nis_student = True</code></pre>',
                            'type' => 'text',
                            'order' => 2,
                            'duration' => 25,
                        ],
                    ]
                ],
                [
                    'title' => 'Control Structures',
                    'description' => 'Learn about loops, conditions, and program flow',
                    'order' => 2,
                    'lessons' => [
                        [
                            'title' => 'Conditional Statements',
                            'content' => '<p>Control program flow with if, elif, and else statements:</p><pre><code>if age >= 18:\n    print("Adult")\nelif age >= 13:\n    print("Teenager")\nelse:\n    print("Child")</code></pre>',
                            'type' => 'text',
                            'order' => 1,
                            'duration' => 22,
                        ],
                        [
                            'title' => 'Loops',
                            'content' => '<p>Repeat code with for and while loops:</p><pre><code># For loop\nfor i in range(5):\n    print(i)\n\n# While loop\ncount = 0\nwhile count < 5:\n    print(count)\n    count += 1</code></pre>',
                            'type' => 'text',
                            'order' => 2,
                            'duration' => 25,
                        ],
                    ]
                ],
            ],
            'digital-marketing-essentials' => [
                [
                    'title' => 'Digital Marketing Fundamentals',
                    'description' => 'Understanding the basics of digital marketing',
                    'order' => 1,
                    'lessons' => [
                        [
                            'title' => 'What is Digital Marketing?',
                            'content' => '<p>Digital marketing encompasses all marketing efforts that use electronic devices or the internet.</p><p>Key channels include:</p><ul><li>Search engines (SEO/SEM)</li><li>Social media</li><li>Email marketing</li><li>Content marketing</li><li>Mobile marketing</li></ul>',
                            'type' => 'text',
                            'order' => 1,
                            'duration' => 18,
                        ],
                        [
                            'title' => 'Digital Marketing Strategy',
                            'content' => '<p>Creating an effective digital marketing strategy involves:</p><ul><li>Defining target audience</li><li>Setting SMART goals</li><li>Choosing appropriate channels</li><li>Creating compelling content</li><li>Measuring and optimizing</li></ul>',
                            'type' => 'text',
                            'order' => 2,
                            'duration' => 25,
                        ],
                    ]
                ],
            ],
        ];

        return $contentMap[$courseSlug] ?? [];
    }
}