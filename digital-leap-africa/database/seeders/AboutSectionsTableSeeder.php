<?php

namespace Database\Seeders;

use App\Models\AboutSection;
use Illuminate\Database\Seeder;

class AboutSectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = [
            [
                'section_type' => 'hero',
                'mini_title' => 'Welcome to Digital Leap Africa',
                'title' => 'Empowering the next generation of African digital professionals',
                'content' => 'We are committed to bridging the digital skills gap in Africa by providing high-quality training and resources to individuals and organizations.',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'section_type' => 'about',
                'mini_title' => 'Who We Are',
                'title' => 'Transforming Africa through Digital Education',
                'content' => "Digital Leap Africa is a leading digital skills training platform dedicated to empowering individuals and organizations across Africa with the knowledge and tools needed to thrive in the digital economy.\n\nOur comprehensive programs are designed to be practical, industry-relevant, and accessible to everyone, regardless of their background or location. We believe that digital literacy is not a luxury but a necessity in today's rapidly evolving world.\n\nThrough our innovative learning approach, we aim to create a community of skilled professionals who will drive digital transformation and economic growth across the continent.",
                'order' => 2,
                'is_active' => true,
            ],
            [
                'section_type' => 'mission',
                'title' => 'Our Mission',
                'content' => 'To empower individuals and organizations in Africa with digital skills and knowledge to drive innovation, create opportunities, and foster economic growth across the continent.',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'section_type' => 'vision',
                'title' => 'Our Vision',
                'content' => 'To be the leading platform for digital skills development in Africa, recognized for our commitment to excellence, innovation, and impact in transforming lives through technology education.',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($sections as $section) {
            AboutSection::updateOrCreate(
                ['section_type' => $section['section_type']],
                $section
            );
        }
    }
}
