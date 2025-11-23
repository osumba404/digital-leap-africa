

<?php $__env->startSection('title', $article->title . ' | Digital Leap Africa Blog'); ?>
<?php $__env->startSection('meta_description', Str::limit(strip_tags($article->content ?? ''), 160)); ?>

<?php $__env->startPush('styles'); ?>
<style>
  /* Dark Mode (Default) */
  .blog-article {
    background: var(--navy-bg);
    color: var(--diamond-white);
    min-height: 100vh;
  }
  
  .article-header {
    background: linear-gradient(135deg, #0a1628 0%, #1a2942 50%, #2E78C5 100%);
    padding: 0;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
  }
  
  .article-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.03)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.5;
  }
  
  .article-header-content {
    position: relative;
    z-index: 1;
    padding: 4rem 0 3rem;
  }
  
  .article-title {
    font-size: 3rem;
    font-weight: 800;
    color: #ffffff;
    margin-bottom: 2rem;
    line-height: 1.2;
    text-shadow: 0 2px 20px rgba(0,0,0,0.3);
    letter-spacing: -0.5px;
  }
  
  .article-meta {
    display: flex;
    align-items: center;
    gap: 2.5rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
  }
  
  .author-info {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    background: rgba(255, 255, 255, 0.08);
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
  }
  
  .author-info:hover {
    background: rgba(255, 255, 255, 0.12);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
  }
  
  .author-avatar {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: linear-gradient(135deg, #00C9FF 0%, #7A5FFF 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.25rem;
    color: white;
    box-shadow: 0 4px 15px rgba(0, 201, 255, 0.3);
    border: 3px solid rgba(255, 255, 255, 0.2);
  }
  
  .article-stats {
    display: flex;
    gap: 2rem;
    color: rgba(255, 255, 255, 0.85);
    font-size: 0.95rem;
    font-weight: 500;
  }
  
  .article-stats > div {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: rgba(255, 255, 255, 0.06);
    border-radius: 20px;
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    transition: all 0.3s ease;
  }
  
  .article-stats > div:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-1px);
  }
  
  .article-stats i {
    color: #00C9FF;
    font-size: 1.1rem;
  }
  
  .article-content {
    background: rgba(255, 255, 255, 0.05);
    color: var(--diamond-white);
    padding: 2.5rem;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    margin-bottom: 2rem;
    line-height: 1.7;
    border: 1px solid rgba(255, 255, 255, 0.1);
  }
  
  .article-content h1, .article-content h2, .article-content h3 {
    color: var(--cyan-accent);
    margin-top: 2rem;
    margin-bottom: 1rem;
  }
  
  .article-content p {
    margin-bottom: 1.5rem;
    font-size: 1.1rem;
    color: var(--cool-gray);
  }
  
  .article-featured-image {
    width: 100%;
    max-height: 400px;
    object-fit: cover;
    border-radius: 12px;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
  }
  
  .sidebar-card {
    background: rgba(255, 255, 255, 0.05);
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    margin-bottom: 1.5rem;
    border: 1px solid rgba(255, 255, 255, 0.1);
  }
  
  .sidebar-title {
    color: var(--cyan-accent);
    font-size: 1.25rem;
    margin-bottom: 1rem;
    font-weight: 600;
  }
  
  .related-article {
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }
  
  .related-article:last-child {
    border-bottom: none;
  }
  
  .related-article a {
    color: var(--diamond-white);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s;
  }
  
  .related-article a:hover {
    color: var(--cyan-accent);
  }
  
  .comments-section {
    background: rgba(255, 255, 255, 0.05);
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    margin-top: 2rem;
    border: 1px solid rgba(255, 255, 255, 0.1);
  }
  
  .comment {
    display: flex;
    gap: 1rem;
    padding: 1.5rem 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }
  
  .comment:last-child {
    border-bottom: none;
  }
  
  .comment-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-blue), var(--cyan-accent));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    flex-shrink: 0;
  }
  
  .comment-author {
    font-weight: bold;
    color: var(--cyan-accent);
  }
  
  .comment-date {
    color: var(--cool-gray);
    font-size: 0.9rem;
  }
  
  .comment-text {
    color: var(--diamond-white);
    margin-top: 0.5rem;
  }
  
  .form-control {
    background: rgba(255, 255, 255, 0.05);
    border: 2px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    padding: 0.75rem 1rem;
    transition: border-color 0.3s;
    color: var(--diamond-white);
  }
  
  .form-control:focus {
    border-color: var(--cyan-accent);
    box-shadow: 0 0 0 0.2rem rgba(100, 255, 218, 0.25);
    background: rgba(255, 255, 255, 0.08);
  }
  
  .btn-primary {
    background: linear-gradient(135deg, var(--primary-blue), var(--cyan-accent));
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    transition: transform 0.2s;
    color: white;
  }
  
  .btn-primary:hover {
    transform: translateY(-2px);
  }
  
  .tag {
    display: inline-block;
    background: rgba(100, 255, 218, 0.1);
    color: var(--cyan-accent);
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
    text-decoration: none;
    transition: background-color 0.3s;
    border: 1px solid rgba(100, 255, 218, 0.2);
  }
  
  .tag:hover {
    background: rgba(100, 255, 218, 0.2);
    color: var(--cyan-accent);
  }

  /* Light Mode */
  [data-theme="light"] .blog-article {
    background: #f8fafc;
    color: var(--navy-bg);
  }
  
  [data-theme="light"] .article-header {
    background: linear-gradient(135deg, #E6F2FF 0%, #FFFFFF 50%, #2E78C5 100%);
  }
  
  [data-theme="light"] .article-header::before {
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(46,120,197,0.08)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
  }
  
  [data-theme="light"] .article-title {
    color: #0a1628;
    text-shadow: 0 2px 20px rgba(255,255,255,0.5);
  }
  
  [data-theme="light"] .author-info {
    background: rgba(255, 255, 255, 0.6);
    border: 1px solid rgba(46, 120, 197, 0.2);
  }
  
  [data-theme="light"] .author-info:hover {
    background: rgba(255, 255, 255, 0.8);
  }
  
  [data-theme="light"] .author-avatar {
    box-shadow: 0 4px 15px rgba(46, 120, 197, 0.3);
  }
  
  [data-theme="light"] .article-stats {
    color: #1a2942;
  }
  
  [data-theme="light"] .article-stats > div {
    background: rgba(255, 255, 255, 0.5);
    border: 1px solid rgba(46, 120, 197, 0.15);
  }
  
  [data-theme="light"] .article-stats > div:hover {
    background: rgba(255, 255, 255, 0.7);
  }
  
  [data-theme="light"] .article-stats i {
    color: #2E78C5;
  }
  
  [data-theme="light"] .article-stats {
    color: #64748b;
  }
  
  [data-theme="light"] .article-content {
    background: white;
    color: var(--navy-bg);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    border: 1px solid #e2e8f0;
  }
  
  [data-theme="light"] .article-content h1,
  [data-theme="light"] .article-content h2,
  [data-theme="light"] .article-content h3 {
    color: var(--primary-blue);
  }
  
  [data-theme="light"] .article-content p {
    color: #374151;
  }
  
  [data-theme="light"] .sidebar-card {
    background: white;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border: 1px solid #e2e8f0;
  }
  
  [data-theme="light"] .sidebar-title {
    color: var(--primary-blue);
  }
  
  [data-theme="light"] .related-article {
    border-bottom: 1px solid #e2e8f0;
  }
  
  [data-theme="light"] .related-article a {
    color: var(--navy-bg);
  }
  
  [data-theme="light"] .related-article a:hover {
    color: var(--primary-blue);
  }
  
  [data-theme="light"] .comments-section {
    background: white;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border: 1px solid #e2e8f0;
  }
  
  [data-theme="light"] .comment {
    border-bottom: 1px solid #e2e8f0;
  }
  
  [data-theme="light"] .comment-author {
    color: var(--primary-blue);
  }
  
  [data-theme="light"] .comment-date {
    color: #64748b;
  }
  
  [data-theme="light"] .comment-text {
    color: #374151;
  }
  
  [data-theme="light"] .form-control {
    background: white;
    border: 2px solid #e2e8f0;
    color: var(--navy-bg);
  }
  
  [data-theme="light"] .form-control:focus {
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 0.2rem rgba(46, 120, 197, 0.25);
    background: white;
  }
  
  [data-theme="light"] .tag {
    background: rgba(46, 120, 197, 0.1);
    color: var(--primary-blue);
    border: 1px solid rgba(46, 120, 197, 0.2);
  }
  
  [data-theme="light"] .tag:hover {
    background: rgba(46, 120, 197, 0.2);
    color: var(--primary-blue);
  }
  
  @media (max-width: 768px) {
    .article-header-content {
      padding: 3rem 0 2rem;
    }
    
    .article-title {
      font-size: 2rem;
    }
    
    .article-meta {
      flex-direction: column;
      align-items: flex-start;
      gap: 1rem;
    }
    
    .author-info {
      width: 100%;
      justify-content: flex-start;
    }
    
    .article-stats {
      width: 100%;
      flex-wrap: wrap;
      gap: 0.75rem;
    }
    
    .article-stats > div {
      font-size: 0.85rem;
      padding: 0.4rem 0.8rem;
    }
    
    .article-content {
      padding: 1.5rem;
    }
    
    .comment {
      flex-direction: column;
      gap: 0.75rem;
    }
  }
</style>
<?php $__env->stopPush(); ?>

<style>
  :root {
    --primary-dark: #0a192f;
    --secondary-dark: #112240;
    --accent-blue: #64ffda;
    --accent-light-blue: #57cbff;
    --accent-purple: #7c4dff;
    --text-primary: #e6f1ff;
    --text-secondary: #8892b0;
    --border-color: #233554;
    --card-shadow: rgba(2, 12, 27, 0.7);
    --radius: 10px;
  }

  body { background-color: var(--primary-dark); color: var(--text-primary); }

  .article-container { max-width: 1200px; margin: 0 auto; }

  .article-header {
    background: linear-gradient(135deg, var(--primary-dark), var(--secondary-dark));
    padding: 3rem 0; margin-bottom: 2rem; border-bottom: 1px solid var(--border-color);
  }

  .article-title { font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem; line-height: 1.2; color: var(--text-primary); }

  .article-meta { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 1.5rem; flex-wrap: wrap; }

  .author-info { display: flex; align-items: center; gap: 0.75rem; }
  .author-avatar {
    width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, var(--accent-blue), var(--accent-light-blue));
    display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.2rem; color: var(--primary-dark);
  }

  .article-stats { display: flex; gap: 1.5rem; color: var(--text-secondary); }

  .article-featured-image {
    width: 100%; max-height: 500px; object-fit: cover; border-radius: var(--radius); margin-bottom: 2rem;
    box-shadow: 0 10px 30px var(--card-shadow); border: 1px solid var(--border-color);
  }

  .article-content {
    background: var(--secondary-dark); padding: 2.5rem; border-radius: var(--radius);
    box-shadow: 0 10px 30px var(--card-shadow); margin-bottom: 2rem; border: 1px solid var(--border-color);
  }

  .article-content p { margin-bottom: 1.25rem; font-size: 1.1rem; line-height: 1.7; color: var(--text-secondary); }
  .article-content h1 {
    font-size: 2rem; margin: 2rem 0 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid var(--border-color); color: var(--accent-blue);
  }
  .article-content h2 { font-size: 1.75rem; margin: 1.75rem 0 0.9rem; color: var(--accent-light-blue); }
  .article-content h3 { font-size: 1.5rem; margin: 1.5rem 0 0.8rem; color: var(--text-primary); }
  .article-content h4 { font-size: 1.25rem; margin: 1.25rem 0 0.7rem; color: var(--text-primary); }
  .article-content h5 { font-size: 1.1rem; margin: 1.1rem 0 0.6rem; color: var(--text-primary); }
  .article-content h6 { font-size: 1rem; margin: 1rem 0 0.5rem; color: var(--text-primary); }

  .article-content blockquote {
    border-left: 4px solid var(--accent-blue); padding: 1.5rem; margin: 1.5rem 0; font-style: italic; color: var(--text-secondary);
    background: rgba(100, 255, 218, 0.05); border-radius: 0 var(--radius) var(--radius) 0;
  }

  .article-content ul, .article-content ol { margin-bottom: 1.25rem; padding-left: 1.5rem; color: var(--text-secondary); }
  .article-content li { margin-bottom: 0.5rem; }
  .article-content strong, .article-content b { font-weight: 700; color: var(--text-primary); }
  .article-content em, .article-content i { font-style: italic; }
  .article-content code {
    background: rgba(100, 255, 218, 0.1); color: var(--accent-blue); padding: 0.2rem 0.4rem; border-radius: 4px; font-family: 'Courier New', monospace;
  }
  .article-content pre {
    background: var(--primary-dark); padding: 1.5rem; border-radius: var(--radius); overflow-x: auto; margin: 1.5rem 0; border: 1px solid var(--border-color);
  }
  .article-content pre code { background: none; padding: 0; }
  .article-content img {
    max-width: 100%; height: auto; border-radius: var(--radius); margin: 1.5rem 0;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3); border: 1px solid var(--border-color);
  }

  .comments-section {
    background: var(--secondary-dark); padding: 2rem; border-radius: var(--radius);
    box-shadow: 0 10px 30px var(--card-shadow); margin-bottom: 2rem; border: 1px solid var(--border-color);
  }

  .comment { display: flex; gap: 1rem; padding: 1.5rem 0; border-bottom: 1px solid var(--border-color); }
  .comment:last-child { border-bottom: none; }
  .comment-avatar {
    width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, var(--accent-purple), var(--accent-light-blue));
    display: flex; align-items: center; justify-content: center; color: var(--primary-dark); font-weight: bold; flex-shrink: 0;
  }
  .comment-content { flex-grow: 1; }
  .comment-header { display: flex; justify-content: space-between; margin-bottom: 0.5rem; }
  .comment-author { font-weight: bold; color: var(--text-primary); }
  .comment-date { color: var(--text-secondary); font-size: 0.9rem; }
  .comment-text { margin-bottom: 0; color: var(--text-secondary); }
  .comment-form { margin-top: 2rem; }

  .form-control {
    background: var(--primary-dark); border: 1px solid var(--border-color); border-radius: var(--radius);
    padding: 0.75rem 1rem; color: var(--text-primary); transition: all 0.3s;
  }
  .form-control:focus {
    border-color: var(--accent-blue); box-shadow: 0 0 0 0.2rem rgba(100, 255, 218, 0.25); background: var(--primary-dark); color: var(--text-primary);
  }

  .btn-primary {
    background: linear-gradient(135deg, var(--accent-blue), var(--accent-light-blue)); border: none; color: var(--primary-dark);
    padding: 0.75rem 1.5rem; border-radius: var(--radius); font-weight: 600; transition: all 0.3s;
  }
  .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(100, 255, 218, 0.4); }

  .sidebar { position: sticky; top: 2rem; }
  .sidebar-card {
    background: var(--secondary-dark); border-radius: var(--radius); box-shadow: 0 10px 30px var(--card-shadow);
    padding: 1.5rem; margin-bottom: 1.5rem; border: 1px solid var(--border-color);
  }
  .sidebar-title {
    font-size: 1.25rem; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid var(--border-color); color: var(--accent-blue);
  }
  .related-articles { list-style: none; padding: 0; margin: 0; }
  .related-article { padding: 0.75rem 0; border-bottom: 1px solid var(--border-color); transition: all 0.3s; }
  .related-article:last-child { border-bottom: none; }
  .related-article:hover { background: rgba(100, 255, 218, 0.05); padding-left: 0.5rem; }
  .related-article a { text-decoration: none; color: var(--text-primary); font-weight: 500; transition: color 0.3s; }
  .related-article a:hover { color: var(--accent-blue); }

  .article-actions { display: flex; gap: 1.5rem; margin-top: 2rem; align-items: center; }
  .action-btn {
    background: none; border: none; color: #8892b0; cursor: pointer; display: inline-flex; align-items: center;
    gap: 0.4rem; font-size: 0.9rem; transition: all 0.2s ease; padding: 0.25rem 0.5rem; border-radius: 6px;
  }
  .action-btn i { font-size: 1.1rem; }
  .action-btn:hover { color: #64b5f6; background: rgba(100,181,246,0.1); }
  .action-count { font-weight: 500; }

  .tag {
    display: inline-block; background: rgba(59,130,246,0.1); color: #3b82f6; padding: 0.2rem 0.5rem; border-radius: 999px;
    font-size: 0.7rem; margin-right: 0.35rem; margin-bottom: 0.35rem; border: 1px solid rgba(59,130,246,0.2); font-weight: 500;
  }
  .tag:hover { background: rgba(59,130,246,0.15); border-color: rgba(59,130,246,0.3); }

  /* Enhanced Mobile Responsiveness */
  @media (max-width: 768px) {
    .article-container { padding: 0 1rem; }
    .article-header { padding: 2rem 0; margin-bottom: 1.5rem; }
    .article-title { font-size: 1.8rem; line-height: 1.3; }
    .article-meta { flex-direction: column; align-items: flex-start; gap: 1rem; }
    .article-stats { flex-wrap: wrap; gap: 1rem; }
    .article-content { padding: 1.5rem; margin-bottom: 1.5rem; }
    .article-actions { flex-wrap: wrap; gap: 1rem; justify-content: center; }
    .action-btn { padding: 0.5rem 1rem; font-size: 1rem; }
    .comments-section { padding: 1.5rem; margin-bottom: 1.5rem; }
    .comment { flex-direction: column; gap: 0.75rem; padding: 1rem 0; }
    .comment-avatar { align-self: flex-start; width: 40px; height: 40px; }
    .comment-form textarea { font-size: 16px; }
    .sidebar { margin-top: 2rem; }
    .sidebar-card { padding: 1.25rem; margin-bottom: 1.25rem; }
    .tags { justify-content: center; }
    .tag { margin: 0.2rem; }
  }
  
  @media (max-width: 480px) {
    .article-container { padding: 0 0.75rem; }
    .article-header { padding: 1.5rem 0; }
    .article-title { font-size: 1.5rem; }
    .author-info { flex-direction: column; align-items: center; text-align: center; gap: 0.5rem; }
    .article-stats { justify-content: center; }
    .article-content { padding: 1rem; }
    .article-content p { font-size: 1rem; }
    .article-actions { gap: 0.75rem; }
    .action-btn { padding: 0.4rem 0.8rem; font-size: 0.9rem; }
    .comments-section { padding: 1rem; }
    .comment-avatar { width: 35px; height: 35px; }
    .sidebar-card { padding: 1rem; }
    .form-control { font-size: 16px; padding: 0.75rem; }
    .btn-primary { padding: 0.75rem 1rem; font-size: 1rem; }
  }

  /* ========== Light Mode Styles ========== */
  [data-theme="light"] body {
      background-color: var(--navy-bg);
      color: var(--diamond-white);
  }

  [data-theme="light"] .article-header {
      background: linear-gradient(135deg, #E6F2FF, #F8FAFC);
      border-bottom: 1px solid rgba(46, 120, 197, 0.2);
  }

  [data-theme="light"] .article-title {
      color: var(--primary-blue);
  }

  [data-theme="light"] .author-avatar {
      background: linear-gradient(135deg, var(--primary-blue), var(--cyan-accent));
      color: #FFFFFF;
  }

  [data-theme="light"] .author-name,
  [data-theme="light"] .sidebar-title,
  [data-theme="light"] .comment-author {
      color: var(--primary-blue) !important;
  }

  [data-theme="light"] .publish-date,
  [data-theme="light"] .article-stats,
  [data-theme="light"] .comment-date,
  [data-theme="light"] .comment-text {
      color: var(--cool-gray) !important;
  }

  [data-theme="light"] .article-featured-image {
      border: 1px solid rgba(46, 120, 197, 0.2);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
  }

  [data-theme="light"] .article-content {
      background: #FFFFFF;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      border: 1px solid rgba(46, 120, 197, 0.15);
  }

  [data-theme="light"] .article-content p {
      color: var(--cool-gray);
  }

  [data-theme="light"] .article-content h1 {
      color: var(--primary-blue);
      border-bottom-color: rgba(46, 120, 197, 0.2);
  }

  [data-theme="light"] .article-content h2 {
      color: var(--primary-blue);
  }

  [data-theme="light"] .article-content h3,
  [data-theme="light"] .article-content h4,
  [data-theme="light"] .article-content h5,
  [data-theme="light"] .article-content h6 {
      color: var(--diamond-white);
  }

  [data-theme="light"] .article-content blockquote {
      border-left-color: var(--primary-blue);
      background: rgba(46, 120, 197, 0.05);
      color: var(--cool-gray);
  }

  [data-theme="light"] .article-content ul,
  [data-theme="light"] .article-content ol {
      color: var(--cool-gray);
  }

  [data-theme="light"] .article-content strong,
  [data-theme="light"] .article-content b {
      color: var(--diamond-white);
  }

  [data-theme="light"] .article-content code {
      background: rgba(46, 120, 197, 0.1);
      color: var(--primary-blue);
  }

  [data-theme="light"] .article-content pre {
      background: #F8FAFC;
      border: 1px solid rgba(46, 120, 197, 0.2);
  }

  [data-theme="light"] .comments-section {
      background: #FFFFFF;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      border: 1px solid rgba(46, 120, 197, 0.15);
  }

  [data-theme="light"] .comment {
      border-bottom-color: rgba(46, 120, 197, 0.15);
  }

  [data-theme="light"] .comment-avatar {
      background: linear-gradient(135deg, #8b5cf6, var(--primary-blue));
      color: #FFFFFF;
  }

  [data-theme="light"] .form-control {
      background: #FFFFFF;
      border: 1px solid rgba(46, 120, 197, 0.2);
      color: var(--diamond-white);
  }

  [data-theme="light"] .form-control:focus {
      border-color: var(--primary-blue);
      box-shadow: 0 0 0 0.2rem rgba(46, 120, 197, 0.25);
      background: #FFFFFF;
  }

  [data-theme="light"] .sidebar-card {
      background: #FFFFFF;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      border: 1px solid rgba(46, 120, 197, 0.15);
  }

  [data-theme="light"] .sidebar-title {
      border-bottom-color: rgba(46, 120, 197, 0.2);
  }

  [data-theme="light"] .related-article {
      border-bottom-color: rgba(46, 120, 197, 0.15);
  }

  [data-theme="light"] .related-article:hover {
      background: rgba(46, 120, 197, 0.05);
  }

  [data-theme="light"] .related-article a {
      color: var(--diamond-white);
  }

  [data-theme="light"] .related-article a:hover {
      color: var(--primary-blue);
  }

  [data-theme="light"] .action-btn {
      color: #4A5568;
  }

  [data-theme="light"] .action-btn:hover {
      background: rgba(46, 120, 197, 0.1);
      color: #2E78C5;
  }

  [data-theme="light"] .tag {
      background: rgba(46, 120, 197, 0.1);
      color: var(--primary-blue);
      border-color: rgba(46, 120, 197, 0.2);
  }
  
  [data-theme="light"] .tag:hover {
      background: rgba(46, 120, 197, 0.15);
  }

  [data-theme="light"] #shareModal > div {
      background: #FFFFFF;
      box-shadow: 0 20px 60px rgba(0,0,0,0.3);
  }
  
  [data-theme="light"] #shareModal input {
      background: #F8FAFC;
      border-color: #E2E8F0;
      color: #1A202C;
  }
  
  .share-btn:hover { transform: translateY(-2px); opacity: .9; }
  .copy-link-btn:hover { background: #2563eb; transform: scale(1.02); }

  [data-theme="light"] .article-content img {
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      border-color: rgba(46, 120, 197, 0.2);
  }
  
  /* Newsletter Form Enhancements */
  .newsletter-card {
    background: linear-gradient(135deg, var(--secondary-dark), rgba(100, 255, 218, 0.05));
    border: 1px solid rgba(100, 255, 218, 0.1);
  }
  
  .newsletter-input {
    transition: all 0.3s ease;
    border: 2px solid transparent;
  }
  
  .newsletter-input:focus {
    border-color: var(--accent-blue);
    box-shadow: 0 0 0 0.2rem rgba(100, 255, 218, 0.25);
    transform: translateY(-1px);
  }
  
  .newsletter-btn {
    background: linear-gradient(135deg, var(--accent-blue), var(--accent-light-blue));
    border: none;
    transition: all 0.3s ease;
    font-weight: 600;
  }
  
  .newsletter-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(100, 255, 218, 0.3);
  }
  
  .newsletter-btn:disabled {
    opacity: 0.7;
    transform: none;
  }
  
  /* Light Mode Newsletter */
  [data-theme="light"] .newsletter-card {
    background: linear-gradient(135deg, #FFFFFF, rgba(46, 120, 197, 0.02));
    border: 1px solid rgba(46, 120, 197, 0.15);
  }
  
  [data-theme="light"] .newsletter-input:focus {
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 0.2rem rgba(46, 120, 197, 0.25);
  }
  
  [data-theme="light"] .newsletter-btn {
    background: linear-gradient(135deg, var(--primary-blue), var(--cyan-accent));
  }
  
  [data-theme="light"] .newsletter-btn:hover {
    box-shadow: 0 8px 25px rgba(46, 120, 197, 0.3);
  }
  
  /* Mobile Newsletter Optimizations */
  @media (max-width: 768px) {
    .newsletter-card {
      text-align: center;
    }
    
    .newsletter-input {
      font-size: 16px;
      padding: 0.875rem 1rem;
    }
    
    .newsletter-btn {
      padding: 0.875rem 1.5rem;
      font-size: 1rem;
    }
  }
  
  @media (max-width: 480px) {
    .newsletter-card {
      margin: 1rem 0;
    }
    
    .sidebar-title {
      font-size: 1.1rem;
      text-align: center;
    }
  }

  /* Lazy Loading Styles */
  .lazy-load {
    opacity: 0;
    transition: opacity 0.3s ease;
  }
  
  .lazy-load.loaded {
    opacity: 1;
  }
  
  .article-featured-image.lazy-load {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
  }
  
  @keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
  }
  
  [data-theme="light"] .article-featured-image.lazy-load {
    background: linear-gradient(90deg, #f8f9fa 25%, #e9ecef 50%, #f8f9fa 75%);
    background-size: 200% 100%;
  }
  
  /* Performance optimizations */
  .article-featured-image {
    will-change: transform;
    backface-visibility: hidden;
    transform: translateZ(0);
    content-visibility: auto;
    contain-intrinsic-size: 1200px 600px;
    aspect-ratio: 2/1;
  }
  
  /* Reduce layout shifts */
  .article-content img {
    height: auto;
    max-width: 100%;
    aspect-ratio: attr(width) / attr(height);
  }
</style>

<?php $__env->startSection('content'); ?>
<?php
  $authorName = $article->author->name ?? 'Digital Leap Africa';
  $initials = collect(explode(' ', $authorName))->map(fn($p) => strtoupper(substr($p,0,1)))->take(2)->implode('');
  $readMinutes = max(1, ceil(str_word_count(strip_tags($article->content ?? ''))/200));
  $tags = is_array($article->tags ?? null) ? $article->tags : [];
?>

<div class="blog-article">
  <div class="article-header">
    <div class="article-header-content">
      <div class="container">
        <h1 class="article-title"><?php echo e($article->title); ?></h1>
        <div class="article-meta">
          <div class="author-info">
            <div class="author-avatar"><?php echo e($initials ?: 'DL'); ?></div>
            <div>
              <div class="fw-bold text-white" style="font-size: 1.05rem; margin-bottom: 0.25rem;"><?php echo e($authorName); ?></div>
              <div class="text-light" style="opacity: 0.8; font-size: 0.9rem;">
                <?php echo e($article->published_at ? $article->published_at->format('M d, Y') : $article->created_at->format('M d, Y')); ?>

              </div>
            </div>
          </div>
          <div class="article-stats">
            <div><i class="fas fa-clock"></i> <?php echo e($readMinutes); ?> min read</div>
            <div><i class="fas fa-comments"></i> <?php echo e($article->comments->count()); ?> comments</div>
            <div><i class="fas fa-heart"></i> <?php echo e($article->likes_count ?? 0); ?> likes</div>
          </div>
        </div>

        <?php if(!empty($tags)): ?>
          <div class="mt-3">
            <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <a class="tag" href="<?php echo e(route('blog.index', ['tag' => $tag])); ?>" style="background: rgba(0, 201, 255, 0.15); border: 1px solid rgba(0, 201, 255, 0.3); color: #00C9FF; padding: 0.4rem 1rem; font-weight: 600;"><?php echo e($tag); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="container py-4">
    <div class="row g-4">
      <div class="col-lg-8">
        <?php if($article->featured_image_url): ?>
          <img class="article-featured-image" src="<?php echo e($article->featured_image_url); ?>" alt="<?php echo e($article->title); ?>">
        <?php endif; ?>

        <div class="article-content">
          <?php echo $article->content; ?>

        </div>




          <section class="comments-section mt-4">
            <h2 class="h4 mb-4" style="color: var(--accent-blue);">Comments (<?php echo e($article->comments->count()); ?>)</h2>

            <?php $__empty_1 = true; $__currentLoopData = $article->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <?php
                $cname = $comment->user->name ?? 'User';
                $ci = collect(explode(' ', $cname))->map(fn($p) => strtoupper(substr($p,0,1)))->take(2)->implode('');
              ?>
              <div class="comment">
                <div class="comment-avatar"><?php echo e($ci ?: 'U'); ?></div>
                <div class="comment-content">
                  <div class="comment-header">
                    <div class="comment-author"><?php echo e($cname); ?></div>
                    <div class="comment-date"><?php echo e($comment->created_at->diffForHumans()); ?></div>
                  </div>
                  <p class="comment-text"><?php echo e($comment->content); ?></p>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <p class="text-muted">No comments yet.</p>
            <?php endif; ?>

            <div class="comment-form">
              <?php if(auth()->guard()->check()): ?>
                <h3 class="h5 mb-3" style="color: var(--accent-light-blue);">Add a comment</h3>
                <form id="comment-form" method="POST" action="<?php echo e(route('blog.comments.store', $article)); ?>">
                  <?php echo csrf_field(); ?>
                  <div class="mb-3">
                    <textarea id="comment" name="content" rows="4" class="form-control <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Share your thoughts..."></textarea>
                    <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div id="comment-error" class="invalid-feedback" style="display: none;"></div>
                  </div>
                  <button type="submit" class="btn btn-primary" id="comment-submit">Post Comment</button>
                </form>
                <div id="comment-success" style="display: none; color: #22c55e; margin-top: 1rem;">
                  <i class="fas fa-check-circle"></i> Comment posted successfully!
                </div>
              <?php else: ?>
                <div class="alert alert-info mt-3">
                  Please <a href="<?php echo e(route('login')); ?>" class="alert-link">log in</a> to post a comment.
                </div>
              <?php endif; ?>
            </div>
          </section>
        </div>

        <div class="col-lg-4 order-lg-2 order-1">
          <div class="sidebar">
            <div class="sidebar-card">
              <h3 class="sidebar-title">Related Articles</h3>
              <ul class="related-articles">
                <?php $__empty_1 = true; $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                  <li class="related-article"><a href="<?php echo e(route('blog.show', $r)); ?>"><?php echo e($r->title); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                  <li class="related-article text-muted">No related articles.</li>
                <?php endif; ?>
              </ul>
            </div>

            <div class="sidebar-card newsletter-card">
              <h3 class="sidebar-title">📧 Subscribe to Our Newsletter</h3>
              <p class="mb-3" style="color: var(--text-secondary); font-size: 0.9rem; line-height: 1.5;">Get the latest web development insights and Digital Leap Africa updates delivered to your inbox.</p>
              <form id="newsletter-form">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                  <input type="email" name="email" class="form-control newsletter-input" placeholder="Enter your email address" required>
                  <div id="newsletter-error" class="invalid-feedback" style="display: none; margin-top: 0.5rem;"></div>
                </div>
                <button type="submit" class="btn btn-primary w-100 newsletter-btn" id="newsletter-submit">
                  <i class="fas fa-paper-plane me-2"></i>Subscribe Now
                </button>
              </form>
              <div id="newsletter-success" style="display: none; color: #22c55e; margin-top: 1rem; font-size: 0.9rem; padding: 0.75rem; background: rgba(34, 197, 94, 0.1); border-radius: 6px; border: 1px solid rgba(34, 197, 94, 0.2);">
                <i class="fas fa-check-circle"></i> Thank you for subscribing!
              </div>
            </div>

            <div class="sidebar-card">
              <h3 class="sidebar-title">Popular Tags</h3>
              <div class="tags">
                <?php $__currentLoopData = array_slice($tags,0,8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <a class="tag" href="<?php echo e(route('blog.index', ['tag' => $t])); ?>"><?php echo e($t); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if(empty($tags)): ?>
                  <span class="tag">Technology</span>
                  
                <?php endif; ?>
              </div>
            </div>

            <div class="sidebar-card">
              <h3 class="sidebar-title">Author</h3>
              <div class="author-info">
                <div class="author-avatar"><?php echo e($initials ?: 'AU'); ?></div>
                <div>
                  <div style="color: var(--accent-blue); font-weight: bold;"><?php echo e($authorName); ?></div>
                  <div style="color: var(--text-secondary); font-size: 0.9rem;">Contributor</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\articles\show.blade.php ENDPATH**/ ?>