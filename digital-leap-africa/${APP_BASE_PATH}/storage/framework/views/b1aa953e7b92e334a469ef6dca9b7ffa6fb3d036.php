<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Admin - <?php echo e(config('app.name', 'Digital Leap Africa')); ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary-blue: #2E78C5;
            --deep-blue: #1E4C7C;
            --navy-bg: #0C121C;
            --diamond-white: #F5F7FA;
            --cool-gray: #AEB8C2;
            --charcoal: #252A32;
            --cyan-accent: #00C9FF;
            --purple-accent: #7A5FFF;
            --radius: 12px;
            --max-width: 1200px;
            --header-height: 4rem;
        }

        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body {
            margin: 0;
            font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: linear-gradient(180deg, #07101a 0%, var(--navy-bg) 100%);
            color: var(--diamond-white);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding-top: var(--header-height);
        }

        .admin-header {
            padding: 1rem 0;
            background: linear-gradient(135deg, var(--charcoal) 0%, var(--navy-bg) 100%);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 201, 255, 0.2);
            height: var(--header-height);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .admin-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: var(--max-width);
            margin: 0 auto;
            width: 90%;
            padding: 0 1rem;
        }

        .admin-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: #ffffff;
        }

        .admin-brand h1 {
            font-size: 1.1rem;
            margin: 0;
            font-weight: 700;
        }

        .admin-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .container {
            width: 90%;
            max-width: var(--max-width);
            margin: 0 auto;
            padding: 2rem 0;
            flex: 1;
        }

        .card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: var(--radius);
            padding: 1.5rem;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .admin-header h1 {
            margin: 0 0 0.5rem 0;
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--diamond-white);
        }

        .admin-header p {
            margin: 0;
            color: var(--cool-gray);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            color: var(--diamond-white);
        }

        .table th {
            text-align: left;
            padding: 0.75rem 1rem;
            font-weight: 600;
            color: var(--cool-gray);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            vertical-align: middle;
        }

        .table tr:last-child td {
            border-bottom: none;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            border: none;
        }

        .btn-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.85rem;
        }

        .btn-edit {
            background: rgba(255, 255, 255, 0.05);
            color: var(--cyan-accent);
            border: 1px solid rgba(0, 201, 255, 0.2);
        }

        .btn-edit:hover {
            background: rgba(0, 201, 255, 0.1);
            color: var(--cyan-accent);
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
            color: white;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #ffffff;
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: #64b5f6;
            color: #64b5f6;
        }

        .d-flex {
            display: flex;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .d-inline {
            display: inline;
        }

        .text-center {
            text-align: center;
        }

        .text-muted {
            color: var(--cool-gray);
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .mt-4 {
            margin-top: 1rem;
        }

        .text-decoration-none {
            text-decoration: none;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: var(--radius);
            margin-bottom: 1rem;
            border: 1px solid;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border-color: rgba(16, 185, 129, 0.3);
            color: #10b981;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.3);
            color: #ef4444;
        }

        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 1rem 0;
            }
            
            .admin-nav {
                width: 95%;
                padding: 0 0.5rem;
            }
            
            .table {
                font-size: 0.9rem;
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            
            .table th,
            .table td {
                padding: 0.75rem 0.5rem;
                min-width: 100px;
            }
            
            .card {
                padding: 1rem;
            }
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <header class="admin-header">
        <nav class="admin-nav">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="admin-brand">
                <i class="fas fa-shield-alt"></i>
                <h1>Admin Panel</h1>
            </a>
            
            <div class="admin-actions">
                <a href="<?php echo e(route('home')); ?>" class="btn btn-outline btn-sm">
                    <i class="fas fa-home me-1"></i> View Site
                </a>
                <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-outline btn-sm">
                    <i class="fas fa-user me-1"></i> User Dashboard
                </a>
            </div>
        </nav>
    </header>

    <main class="container">
        <?php if(session('success')): ?>
            <div class="alert alert-success mb-4" role="alert">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\layouts\admin.blade.php ENDPATH**/ ?>