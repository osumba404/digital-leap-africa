<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqsSeeder extends Seeder
{
    public function run()
    {
        $faqs = [
            [
                'question' => 'How do I enroll in a course?',
                'answer' => 'To enroll in a course, simply browse our course catalog, select the course you\'re interested in, and click the "Enroll Now" button. If it\'s a free course, you\'ll have immediate access. For paid courses, you\'ll need to complete the payment process first.',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Are the courses self-paced or do they have fixed schedules?',
                'answer' => 'Most of our courses are self-paced, allowing you to learn at your own speed and convenience. However, we also offer cohort-based courses with fixed schedules for those who prefer structured learning with peers.',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Do I receive a certificate upon course completion?',
                'answer' => 'Yes! Upon successfully completing a course and passing all assessments, you\'ll receive a digital certificate that you can share on your LinkedIn profile or include in your resume.',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'question' => 'What payment methods do you accept?',
                'answer' => 'We accept various payment methods including credit/debit cards, mobile money (M-Pesa, Airtel Money), and bank transfers. We\'re constantly adding new payment options to make our courses more accessible.',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'question' => 'Can I access courses on my mobile device?',
                'answer' => 'Absolutely! Our platform is fully responsive and optimized for mobile devices. You can access all course content, participate in discussions, and track your progress from your smartphone or tablet.',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'question' => 'Is there a refund policy?',
                'answer' => 'Yes, we offer a 30-day money-back guarantee for all paid courses. If you\'re not satisfied with a course within the first 30 days of enrollment, you can request a full refund.',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'question' => 'How does the points and leveling system work?',
                'answer' => 'You earn points by completing lessons, participating in discussions, and achieving milestones. As you accumulate points, you level up, unlocking badges and special recognition within our community.',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'question' => 'Can I interact with instructors and other students?',
                'answer' => 'Yes! Each course has discussion forums where you can ask questions, share insights, and connect with fellow learners. Our instructors actively participate in these discussions to provide guidance and support.',
                'order' => 8,
                'is_active' => true,
            ],
            [
                'question' => 'Are there any prerequisites for the courses?',
                'answer' => 'Prerequisites vary by course and are clearly listed on each course page. Beginner courses typically have no prerequisites, while advanced courses may require prior knowledge or completion of foundational courses.',
                'order' => 9,
                'is_active' => true,
            ],
            [
                'question' => 'How often is new content added to the platform?',
                'answer' => 'We regularly update our course catalog with new content. New courses are added monthly, and existing courses are updated to reflect the latest industry trends and best practices.',
                'order' => 10,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faqData) {
            Faq::updateOrCreate(
                ['question' => $faqData['question']],
                $faqData
            );
        }
    }
}