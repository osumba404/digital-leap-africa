

<?php $__env->startSection('title', 'Manage About Page'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-8">
    <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-gray-50 p-6 rounded-lg shadow">
            <form action="<?php echo e(route('admin.content.about.update', $section->id)); ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">
                        <?php echo e(ucfirst($section->section_type)); ?> Section
                    </h3>
                    <div class="flex items-center">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" <?php echo e($section->is_active ? 'checked' : ''); ?>>
                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            <span class="ms-3 text-sm font-medium text-gray-700">Active</span>
                        </label>
                    </div>
                </div>

                <?php if($section->section_type !== 'mission' && $section->section_type !== 'vision'): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label for="mini_title_<?php echo e($section->id); ?>" class="block text-sm font-medium text-gray-700">Mini Title</label>
                                <input type="text" name="mini_title" id="mini_title_<?php echo e($section->id); ?>" 
                                       value="<?php echo e(old('mini_title', $section->mini_title)); ?>"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="title_<?php echo e($section->id); ?>" class="block text-sm font-medium text-gray-700">Title</label>
                                <input type="text" name="title" id="title_<?php echo e($section->id); ?>" 
                                       value="<?php echo e(old('title', $section->title)); ?>" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="content_<?php echo e($section->id); ?>" class="block text-sm font-medium text-gray-700">Content</label>
                                <textarea name="content" id="content_<?php echo e($section->id); ?>" rows="6" 
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"><?php echo e(old('content', $section->content)); ?></textarea>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Current Image</label>
                                <?php if($section->image_path): ?>
                                    <img src="<?php echo e(asset('storage/' . $section->image_path)); ?>" alt="<?php echo e($section->title); ?>" class="mt-2 h-48 w-full object-cover rounded-md">
                                <?php else: ?>
                                    <div class="mt-2 flex items-center justify-center h-48 bg-gray-100 rounded-md">
                                        <span class="text-gray-400">No image uploaded</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div>
                                <label for="image_<?php echo e($section->id); ?>" class="block text-sm font-medium text-gray-700">Update Image</label>
                                <input type="file" name="image" id="image_<?php echo e($section->id); ?>" 
                                       class="mt-1 block w-full text-sm text-gray-500
                                              file:mr-4 file:py-2 file:px-4
                                              file:rounded-md file:border-0
                                              file:text-sm file:font-semibold
                                              file:bg-primary-50 file:text-primary-700
                                              hover:file:bg-primary-100">
                                <p class="mt-1 text-xs text-gray-500">Recommended size: 800x600px</p>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="space-y-4">
                        <div>
                            <label for="title_<?php echo e($section->id); ?>" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title_<?php echo e($section->id); ?>" 
                                   value="<?php echo e(old('title', $section->title)); ?>" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="content_<?php echo e($section->id); ?>" class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea name="content" id="content_<?php echo e($section->id); ?>" rows="4" 
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"><?php echo e(old('content', $section->content)); ?></textarea>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Update <?php echo e(ucfirst($section->section_type)); ?> Section
                    </button>
                </div>
            </form>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    // Add any necessary JavaScript here
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize any plugins or add event listeners
    });
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\content\about-sections.blade.php ENDPATH**/ ?>