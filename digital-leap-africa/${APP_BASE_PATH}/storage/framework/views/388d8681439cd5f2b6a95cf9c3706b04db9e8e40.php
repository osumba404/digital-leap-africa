<div class="mb-3">
    <label for="name" class="form-label text-gray-200">Template Name</label>
    <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="name" name="name" value="<?php echo e(old('name', $certificateTemplate->name ?? '')); ?>" required>
</div>

<div class="mb-3">
    <label for="content" class="form-label text-gray-200">Certificate Content</label>
    <div id="editor-container" style="height: 300px;"></div>
    <textarea name="content" id="content" style="display: none;"><?php echo e(old('content', $certificateTemplate->content ?? '')); ?></textarea>
    <small class="text-gray-400">Use {{student_name}}, {{course_title}}, {{completion_date}}, {{certificate_number}} as placeholders</small>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="background_color" class="form-label text-gray-200">Background Color</label>
            <input type="color" class="form-control bg-primary-light border-0" id="background_color" name="background_color" value="<?php echo e(old('background_color', $certificateTemplate->background_color ?? '#ffffff')); ?>">
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="text_color" class="form-label text-gray-200">Text Color</label>
            <input type="color" class="form-control bg-primary-light border-0" id="text_color" name="text_color" value="<?php echo e(old('text_color', $certificateTemplate->text_color ?? '#000000')); ?>">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="signature_image" class="form-label text-gray-200">Signature Image</label>
            <input type="file" class="form-control bg-primary-light border-0 text-gray-200" id="signature_image" name="signature_image" accept="image/*">
            <?php if(isset($certificateTemplate) && $certificateTemplate->signature_image): ?>
                <div class="mt-2">
                    <img src="<?php echo e(Storage::url($certificateTemplate->signature_image)); ?>" alt="Current signature" style="max-height: 60px;">
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="logo_image" class="form-label text-gray-200">Logo Image</label>
            <input type="file" class="form-control bg-primary-light border-0 text-gray-200" id="logo_image" name="logo_image" accept="image/*">
            <?php if(isset($certificateTemplate) && $certificateTemplate->logo_image): ?>
                <div class="mt-2">
                    <img src="<?php echo e(Storage::url($certificateTemplate->logo_image)); ?>" alt="Current logo" style="max-height: 60px;">
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="form-check form-switch mb-3">
    <input class="form-check-input" type="checkbox" id="active" name="active" value="1" <?php echo e(old('active', $certificateTemplate->active ?? true) ? 'checked' : ''); ?>>
    <label class="form-check-label text-gray-200" for="active">
        Active Template
    </label>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-2"></i>Save Template
    </button>
    <a href="<?php echo e(route('admin.certificate-templates.index')); ?>" class="btn btn-secondary">Cancel</a>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<script>
document.addEventListener('DOMContentLoaded', function() {
    var quill = new Quill('#editor-container', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline'],
                [{ 'align': [] }],
                ['clean']
            ]
        }
    });

    var hiddenInput = document.getElementById('content');
    if (hiddenInput.value) {
        quill.root.innerHTML = hiddenInput.value;
    }

    quill.on('text-change', function() {
        hiddenInput.value = quill.root.innerHTML;
    });

    document.querySelector('form').addEventListener('submit', function() {
        hiddenInput.value = quill.root.innerHTML;
    });
});
</script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\certificate-templates\_form.blade.php ENDPATH**/ ?>