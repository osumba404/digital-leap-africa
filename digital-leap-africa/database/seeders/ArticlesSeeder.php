<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticlesSeeder extends Seeder
{
    public function run()
    {
        $adminUser = User::where('role', 'admin')->first();
        $userId = $adminUser ? $adminUser->id : 1;

        $articles = [
            [
                'title' => 'The Future of Digital Education in Africa',
                'content' => '<p>Digital education is transforming the learning landscape across Africa. With increasing internet penetration and mobile device adoption, more learners than ever before have access to quality educational content.</p><p>This transformation is not just about technology; it\'s about creating opportunities for millions of young Africans to develop skills that will drive economic growth and innovation across the continent.</p><p>Key trends shaping digital education in Africa include:</p><ul><li>Mobile-first learning platforms</li><li>Localized content in native languages</li><li>Affordable internet access initiatives</li><li>Public-private partnerships in education</li><li>Skills-based learning programs</li></ul><p>As we look to the future, digital education will play a crucial role in bridging the skills gap and creating a more inclusive economy.</p>',
                'excerpt' => 'Exploring how digital education is transforming learning opportunities across Africa and creating pathways for economic growth.',
                'status' => 'published',
                'featured_image' => 'articles/digital-education-africa.jpg',
                'tags' => json_encode(['education', 'africa', 'digital transformation', 'technology']),
                'views' => 1250,
                'likes' => 89,
                'shares' => 34,
            ],
            [
                'title' => 'Building Your First Web Application: A Beginner\'s Guide',
                'content' => '<p>Creating your first web application can seem daunting, but with the right approach and tools, it becomes an exciting journey of discovery and creativity.</p><p>In this comprehensive guide, we\'ll walk through the essential steps to build a simple yet functional web application from scratch.</p><h3>Getting Started</h3><p>Before diving into code, it\'s important to plan your application. Consider:</p><ul><li>What problem does your app solve?</li><li>Who is your target audience?</li><li>What features are essential vs. nice-to-have?</li></ul><h3>Choosing Your Tech Stack</h3><p>For beginners, we recommend starting with:</p><ul><li><strong>Frontend:</strong> HTML, CSS, JavaScript</li><li><strong>Backend:</strong> Node.js or Python</li><li><strong>Database:</strong> SQLite or MongoDB</li></ul><p>Remember, the best tech stack is the one you\'re comfortable learning and using consistently.</p>',
                'excerpt' => 'A step-by-step guide for beginners to create their first web application using modern development tools and best practices.',
                'status' => 'published',
                'featured_image' => 'articles/first-web-app.jpg',
                'tags' => json_encode(['web development', 'beginner', 'tutorial', 'programming']),
                'views' => 2100,
                'likes' => 156,
                'shares' => 67,
            ],
            [
                'title' => 'Career Opportunities in Tech: Beyond Software Development',
                'content' => '<p>When people think of tech careers, software development often comes to mind first. However, the technology industry offers a vast array of career paths that don\'t necessarily require coding skills.</p><p>The tech ecosystem is diverse and includes roles in design, marketing, sales, project management, data analysis, and much more.</p><h3>Non-Coding Tech Roles</h3><p>Here are some exciting career opportunities in tech that don\'t require extensive programming knowledge:</p><ul><li><strong>UX/UI Design:</strong> Creating user-friendly interfaces and experiences</li><li><strong>Product Management:</strong> Guiding product development and strategy</li><li><strong>Digital Marketing:</strong> Promoting tech products and services</li><li><strong>Technical Writing:</strong> Creating documentation and content</li><li><strong>Data Analysis:</strong> Interpreting data to drive business decisions</li><li><strong>Cybersecurity:</strong> Protecting digital assets and systems</li></ul><p>Each of these roles plays a crucial part in bringing technology products to market and ensuring their success.</p>',
                'excerpt' => 'Discover diverse career opportunities in the tech industry that go beyond traditional software development roles.',
                'status' => 'published',
                'featured_image' => 'articles/tech-careers.jpg',
                'tags' => json_encode(['careers', 'technology', 'professional development', 'opportunities']),
                'views' => 1800,
                'likes' => 134,
                'shares' => 45,
            ],
            [
                'title' => 'The Rise of Remote Work in African Tech Companies',
                'content' => '<p>The COVID-19 pandemic accelerated the adoption of remote work globally, and African tech companies have been at the forefront of this transformation.</p><p>This shift has opened up new opportunities for talent across the continent and changed how we think about work-life balance and productivity.</p><h3>Benefits of Remote Work</h3><ul><li>Access to global talent pool</li><li>Reduced operational costs</li><li>Improved work-life balance</li><li>Environmental benefits</li><li>Increased productivity for many workers</li></ul><h3>Challenges and Solutions</h3><p>While remote work offers many advantages, it also presents challenges:</p><ul><li><strong>Communication:</strong> Solved through better tools and processes</li><li><strong>Collaboration:</strong> Enhanced with project management platforms</li><li><strong>Company Culture:</strong> Maintained through virtual team building</li></ul><p>As we move forward, hybrid work models are becoming the norm, combining the best of both remote and in-office work.</p>',
                'excerpt' => 'How African tech companies are embracing remote work and the impact on talent acquisition and company culture.',
                'status' => 'published',
                'featured_image' => 'articles/remote-work-africa.jpg',
                'tags' => json_encode(['remote work', 'africa', 'tech companies', 'future of work']),
                'views' => 950,
                'likes' => 78,
                'shares' => 23,
            ],
            [
                'title' => 'Introduction to Machine Learning for Beginners',
                'content' => '<p>Machine Learning (ML) is one of the most exciting fields in technology today, with applications ranging from recommendation systems to autonomous vehicles.</p><p>Despite its complexity, the fundamental concepts of machine learning are accessible to anyone willing to learn.</p><h3>What is Machine Learning?</h3><p>Machine learning is a subset of artificial intelligence that enables computers to learn and make decisions from data without being explicitly programmed for every scenario.</p><h3>Types of Machine Learning</h3><ul><li><strong>Supervised Learning:</strong> Learning from labeled examples</li><li><strong>Unsupervised Learning:</strong> Finding patterns in unlabeled data</li><li><strong>Reinforcement Learning:</strong> Learning through trial and error</li></ul><h3>Getting Started</h3><p>To begin your ML journey:</p><ol><li>Learn Python programming basics</li><li>Understand statistics and probability</li><li>Practice with real datasets</li><li>Start with simple algorithms</li><li>Build projects to apply your knowledge</li></ol><p>Remember, machine learning is a journey, not a destination. Start small and build your skills progressively.</p>',
                'excerpt' => 'A beginner-friendly introduction to machine learning concepts, types, and how to get started in this exciting field.',
                'status' => 'published',
                'featured_image' => 'articles/machine-learning-intro.jpg',
                'tags' => json_encode(['machine learning', 'AI', 'beginner', 'data science']),
                'views' => 2800,
                'likes' => 210,
                'shares' => 89,
            ],
            [
                'title' => 'Cybersecurity Best Practices for Small Businesses',
                'content' => '<p>Small businesses are increasingly becoming targets for cyber attacks. With limited resources and IT expertise, they often struggle to implement effective security measures.</p><p>However, following basic cybersecurity best practices can significantly reduce the risk of security breaches.</p><h3>Essential Security Measures</h3><ul><li><strong>Strong Passwords:</strong> Use complex, unique passwords for all accounts</li><li><strong>Two-Factor Authentication:</strong> Add an extra layer of security</li><li><strong>Regular Updates:</strong> Keep software and systems up to date</li><li><strong>Employee Training:</strong> Educate staff about security threats</li><li><strong>Data Backup:</strong> Regularly backup important business data</li></ul><h3>Common Threats to Watch For</h3><ul><li>Phishing emails</li><li>Ransomware attacks</li><li>Social engineering</li><li>Unsecured Wi-Fi networks</li><li>Outdated software vulnerabilities</li></ul><p>Investing in cybersecurity is not just about protecting data; it\'s about protecting your business reputation and customer trust.</p>',
                'excerpt' => 'Essential cybersecurity practices that small businesses can implement to protect themselves from digital threats.',
                'status' => 'published',
                'featured_image' => 'articles/cybersecurity-small-business.jpg',
                'tags' => json_encode(['cybersecurity', 'small business', 'security', 'best practices']),
                'views' => 1400,
                'likes' => 98,
                'shares' => 41,
            ],
        ];

        foreach ($articles as $index => $articleData) {
            $articleData['user_id'] = $userId;
            $articleData['slug'] = Str::slug($articleData['title']);
            $articleData['published_at'] = now()->subDays(rand(1, 30));
            
            Article::updateOrCreate(
                ['slug' => $articleData['slug']],
                $articleData
            );
        }
    }
}