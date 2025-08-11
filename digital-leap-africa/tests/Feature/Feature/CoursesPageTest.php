<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Course;

class CoursesPageTest extends TestCase
{
    // This trait automatically resets the database for each test
    use RefreshDatabase;

    /**
     * Test that the main courses index page is accessible and displays courses.
     *
     * @return void
     */
    public function test_the_courses_index_page_is_accessible_and_displays_courses()
    {
        // 1. ARRANGE: Set up the necessary data.
        // We need to run our seeders to create the courses.
        $this->seed();

        // 2. ACT: Perform the action we want to test.
        // Simulate a user visiting the /courses page.
        $response = $this->get('/courses');

        // 3. ASSERT: Check that the outcome is what we expect.
        // Assert that the page loaded successfully.
        $response->assertStatus(200);

        // Assert that Laravel is using the correct view file.
        $response->assertViewIs('pages.courses.index');

        // Assert that we can see the title of a course from our seeder.
        // This proves the database query is working correctly.
        $response->assertSee('Introduction to Web Development');
    }

    /**
     * Test that a single course detail page is accessible.
     *
     * @return void
     */
    public function test_a_single_course_detail_page_is_accessible()
    {
        // ARRANGE: Create a single course to visit.
        $course = Course::factory()->create(['title' => 'My Test Course']);

        // ACT: Visit the specific course's page using its slug.
        $response = $this->get('/courses/' . $course->slug);

        // ASSERT: Check for success and that the course title is visible.
        $response->assertStatus(200);
        $response->assertSee('My Test Course');
    }
}