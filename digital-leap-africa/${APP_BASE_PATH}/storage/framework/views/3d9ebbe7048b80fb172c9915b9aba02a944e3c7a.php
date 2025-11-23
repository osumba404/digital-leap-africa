<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?> - <?php echo $__env->yieldContent('title', 'Admin'); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="font-sans antialiased bg-gray-100" x-data="{ sidebarCollapsed: false }">
    <div class="min-h-screen">
        <div class="flex">
            <aside :class="sidebarCollapsed ? 'w-16' : 'w-64'" class="bg-white border-r border-gray-200 h-[calc(100vh-4rem)] sticky top-16 transition-all duration-200 ease-in-out hidden md:flex flex-col">
                <div class="flex items-center justify-between px-4 h-14 border-b border-gray-200">
                    <span class="text-sm font-semibold text-gray-700 truncate" x-show="!sidebarCollapsed">Admin Menu</span>
                    <button @click="sidebarCollapsed = !sidebarCollapsed" class="p-2 rounded hover:bg-gray-100">
                        <i class="fas fa-angles-left" x-show="!sidebarCollapsed"></i>
                        <i class="fas fa-angles-right" x-show="sidebarCollapsed"></i>
                    </button>
                </div>
                <nav class="flex-1 overflow-y-auto py-3">
                    <ul class="space-y-1">
                        <li><a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-3 px-4 py-2 text-gray-700 hover:bg-gray-100 <?php if(request()->routeIs('admin.dashboard')): ?> bg-gray-100 font-semibold <?php endif; ?>"><i class="fas fa-gauge w-5 text-gray-500"></i><span x-show="!sidebarCollapsed" class="truncate">Dashboard</span></a></li>
                        <li><a href="<?php echo e(route('admin.content.index')); ?>" class="flex items-center gap-3 px-4 py-2 text-gray-700 hover:bg-gray-100 <?php if(request()->routeIs('admin.content.*')): ?> bg-gray-100 font-semibold <?php endif; ?>"><i class="fas fa-layer-group w-5 text-gray-500"></i><span x-show="!sidebarCollapsed" class="truncate">Content</span></a></li>
                        <li><a href="<?php echo e(route('admin.about.index')); ?>" class="flex items-center gap-3 px-4 py-2 text-gray-700 hover:bg-gray-100 <?php if(request()->routeIs('admin.about.*')): ?> bg-gray-100 font-semibold <?php endif; ?>"><i class="fas fa-circle-info w-5 text-gray-500"></i><span x-show="!sidebarCollapsed" class="truncate">About</span></a></li>
                        <li><a href="<?php echo e(route('admin.articles.index')); ?>" class="flex items-center gap-3 px-4 py-2 text-gray-700 hover:bg-gray-100 <?php if(request()->routeIs('admin.articles.*')): ?> bg-gray-100 font-semibold <?php endif; ?>"><i class="fas fa-newspaper w-5 text-gray-500"></i><span x-show="!sidebarCollapsed" class="truncate">Articles</span></a></li>
                        <li><a href="<?php echo e(route('admin.courses.index')); ?>" class="flex items-center gap-3 px-4 py-2 text-gray-700 hover:bg-gray-100 <?php if(request()->routeIs('admin.courses.*')): ?> bg-gray-100 font-semibold <?php endif; ?>"><i class="fas fa-graduation-cap w-5 text-gray-500"></i><span x-show="!sidebarCollapsed" class="truncate">Courses</span></a></li>
                        <li><a href="<?php echo e(route('admin.projects.index')); ?>" class="flex items-center gap-3 px-4 py-2 text-gray-700 hover:bg-gray-100 <?php if(request()->routeIs('admin.projects.*')): ?> bg-gray-100 font-semibold <?php endif; ?>"><i class="fas fa-diagram-project w-5 text-gray-500"></i><span x-show="!sidebarCollapsed" class="truncate">Projects</span></a></li>
                        <li><a href="<?php echo e(route('admin.jobs.index')); ?>" class="flex items-center gap-3 px-4 py-2 text-gray-700 hover:bg-gray-100 <?php if(request()->routeIs('admin.jobs.*')): ?> bg-gray-100 font-semibold <?php endif; ?>"><i class="fas fa-briefcase w-5 text-gray-500"></i><span x-show="!sidebarCollapsed" class="truncate">Jobs</span></a></li>
                        <li><a href="<?php echo e(route('admin.events.index')); ?>" class="flex items-center gap-3 px-4 py-2 text-gray-700 hover:bg-gray-100 <?php if(request()->routeIs('admin.events.*')): ?> bg-gray-100 font-semibold <?php endif; ?>"><i class="fas fa-calendar-days w-5 text-gray-500"></i><span x-show="!sidebarCollapsed" class="truncate">Events</span></a></li>
                        <li><a href="<?php echo e(route('admin.forum.index')); ?>" class="flex items-center gap-3 px-4 py-2 text-gray-700 hover:bg-gray-100 <?php if(request()->routeIs('admin.forum.*')): ?> bg-gray-100 font-semibold <?php endif; ?>"><i class="fas fa-comments w-5 text-gray-500"></i><span x-show="!sidebarCollapsed" class="truncate">Forum</span></a></li>
                        <li><a href="<?php echo e(route('admin.elibrary-resources.index')); ?>" class="flex items-center gap-3 px-4 py-2 text-gray-700 hover:bg-gray-100 <?php if(request()->routeIs('admin.elibrary-resources.*')): ?> bg-gray-100 font-semibold <?php endif; ?>"><i class="fas fa-book w-5 text-gray-500"></i><span x-show="!sidebarCollapsed" class="truncate">eLibrary</span></a></li>
                        <li><a href="<?php echo e(route('admin.settings.index')); ?>" class="flex items-center gap-3 px-4 py-2 text-gray-700 hover:bg-gray-100 <?php if(request()->routeIs('admin.settings.*')): ?> bg-gray-100 font-semibold <?php endif; ?>"><i class="fas fa-gear w-5 text-gray-500"></i><span x-show="!sidebarCollapsed" class="truncate">Settings</span></a></li>
                    </ul>
                </nav>
            </aside>
            <div class="flex-1 min-w-0">
                <?php if(isset($header)): ?>
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            <?php echo e($header); ?>

                        </div>
                    </header>
                <?php endif; ?>
                <main class="p-4 sm:p-6 lg:p-8">
                    <?php if(session('success')): ?>
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>
                    <?php if(session('error')): ?>
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <?php echo e(session('error')); ?>

                        </div>
                    <?php endif; ?>
                    <?php echo $__env->yieldContent('content'); ?>
                </main>
            </div>
        </div>
     </div>

     <?php echo $__env->yieldPushContent('modals'); ?>
     <?php echo $__env->yieldPushContent('scripts'); ?>
 </body>
 </html><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\layouts\app.blade.php ENDPATH**/ ?>