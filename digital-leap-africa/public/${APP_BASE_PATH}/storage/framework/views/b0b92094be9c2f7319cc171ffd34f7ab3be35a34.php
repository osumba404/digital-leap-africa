

<?php $__env->startSection('admin-content'); ?>
<div class="page-header">
    <h1 class="page-title">Site Settings</h1>
    <p style="color: var(--cool-gray); margin-top: 0.5rem;">Configure your site's appearance, functionality, and integrations</p>
</div>

<div class="admin-form">
    <form method="POST" action="<?php echo e(route('admin.settings.update')); ?>" enctype="multipart/form-data" id="settingsForm">
        <?php echo csrf_field(); ?>
        
        <!-- Basic Information -->
        <div class="settings-card">
            <div class="settings-card-header" onclick="toggleSection('basic')">
                <h3><i class="fas fa-info-circle me-2"></i>Basic Information</h3>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </div>
            <div class="settings-card-content" id="basic">
                <div class="form-row">
                    <div class="form-group">
                        <label for="site_name" class="form-label">Site Name</label>
                        <input type="text" id="site_name" name="site_name" class="form-control" 
                               value="<?php echo e(old('site_name', $settings['site_name'] ?? '')); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tagline" class="form-label">Tagline / Short Description</label>
                        <input type="text" id="tagline" name="tagline" class="form-control" 
                               value="<?php echo e(old('tagline', $settings['tagline'] ?? '')); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="contact_email" class="form-label">Primary Contact Email</label>
                        <input type="email" id="contact_email" name="contact_email" class="form-control" 
                               value="<?php echo e(old('contact_email', $settings['contact_email'] ?? '')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="tel" id="phone_number" name="phone_number" class="form-control" 
                               value="<?php echo e(old('phone_number', $settings['phone_number'] ?? '')); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="address" class="form-label">Address / Location</label>
                        <textarea id="address" name="address" class="form-control" rows="2"><?php echo e(old('address', $settings['address'] ?? '')); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="language" class="form-label">Language / Locale</label>
                        <select id="language" name="language" class="form-control">
                            <option value="en" <?php echo e(($settings['language'] ?? 'en') == 'en' ? 'selected' : ''); ?>>English</option>
                            <option value="sw" <?php echo e(($settings['language'] ?? '') == 'sw' ? 'selected' : ''); ?>>Swahili</option>
                            <option value="fr" <?php echo e(($settings['language'] ?? '') == 'fr' ? 'selected' : ''); ?>>French</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="footer_text" class="form-label">Footer Text</label>
                    <input type="text" id="footer_text" name="footer_text" class="form-control" 
                           value="<?php echo e(old('footer_text', $settings['footer_text'] ?? '')); ?>">
                </div>
            </div>
        </div>

        <!-- General Information -->
        <div class="settings-card">
            <div class="settings-card-header" onclick="toggleSection('general')">
                <h3><i class="fas fa-cog me-2"></i>General Information</h3>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </div>
            <div class="settings-card-content" id="general">
                <div class="form-row">
                    <div class="form-group">
                        <label for="logo_url" class="form-label">Site Logo</label>
                        <input type="file" id="logo_url" name="logo_url" class="form-control" accept="image/*">
                        <?php if(!empty($settings['logo_url'])): ?>
                            <div style="margin-top: 0.5rem;">
                                <img src="<?php echo e($settings['logo_url']); ?>" alt="Current Logo" style="height: 40px; border-radius: 4px;">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="favicon" class="form-label">Favicon</label>
                        <input type="file" id="favicon" name="favicon" class="form-control" accept="image/x-icon,image/png">
                    </div>
                </div>
            </div>
        </div>

        <!-- Homepage Hero (Carousel) -->
        <div class="settings-card">
            <div class="settings-card-header" onclick="toggleSection('hero')">
                <h3><i class="fas fa-images me-2"></i>Homepage Hero (Carousel)</h3>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </div>
            <div class="settings-card-content" id="hero">
                <?php
                    $existingSlides = [];
                    if (!empty($settings['hero_slides'])) {
                        $decoded = json_decode($settings['hero_slides'], true);
                        if (is_array($decoded)) { $existingSlides = $decoded; }
                    }
                    if (empty($existingSlides)) {
                        $existingSlides = [[
                            'enabled' => 1,
                            'image' => null,
                            'mini' => '', 'title' => '', 'sub' => '',
                            'cta1_label' => '', 'cta1_route' => '',
                            'cta2_label' => '', 'cta2_route' => '',
                        ]];
                    }
                ?>

                <div id="hero-slides-list">
                    <?php $__currentLoopData = $existingSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="border rounded p-3 mb-3 hero-slide-item" data-index="<?php echo e($i); ?>" style="border-color: rgba(255,255,255,0.1);">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h4 class="h6 m-0">Slide <span class="hero-slide-number"><?php echo e($i + 1); ?></span></h4>
                                <button type="button" class="btn-outline btn-sm" onclick="removeHeroSlide(this)">Remove</button>
                            </div>

                            <div class="form-row">
                                <div class="form-group" style="align-self:center;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="hero_slides[<?php echo e($i); ?>][enabled]" value="1" <?php echo e(!empty($s['enabled']) ? 'checked' : ''); ?>>
                                        <label class="form-check-label">Enable this slide</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Slide Image</label>
                                    <input type="file" name="hero_slides[<?php echo e($i); ?>][image]" class="form-control" accept="image/*">
                                    <?php if(!empty($s['image'])): ?>
                                        <input type="hidden" name="hero_slides[<?php echo e($i); ?>][existing_image]" value="<?php echo e($s['image']); ?>">
                                        <div class="mt-2">
                                            <img src="<?php echo e($s['image']); ?>" alt="Slide <?php echo e($i+1); ?>" style="max-height:120px;border-radius:8px;background:#fff;">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Mini Title</label>
                                    <input type="text" name="hero_slides[<?php echo e($i); ?>][mini]" class="form-control" value="<?php echo e($s['mini'] ?? ''); ?>" placeholder="e.g., New">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Main Title</label>
                                    <input type="text" name="hero_slides[<?php echo e($i); ?>][title]" class="form-control" value="<?php echo e($s['title'] ?? ''); ?>" placeholder="Main headline">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Sub Text</label>
                                <textarea name="hero_slides[<?php echo e($i); ?>][sub]" class="form-control" rows="2" placeholder="Short supporting text"><?php echo e($s['sub'] ?? ''); ?></textarea>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Primary CTA Label</label>
                                    <input type="text" name="hero_slides[<?php echo e($i); ?>][cta1_label]" class="form-control" value="<?php echo e($s['cta1_label'] ?? ''); ?>" placeholder="e.g., Get Started">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Primary CTA Route Name</label>
                                    <input type="text" name="hero_slides[<?php echo e($i); ?>][cta1_route]" class="form-control" value="<?php echo e($s['cta1_route'] ?? ''); ?>" placeholder="e.g., courses.index">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Secondary CTA Label</label>
                                    <input type="text" name="hero_slides[<?php echo e($i); ?>][cta2_label]" class="form-control" value="<?php echo e($s['cta2_label'] ?? ''); ?>" placeholder="e.g., Learn More">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Secondary CTA Route Name</label>
                                    <input type="text" name="hero_slides[<?php echo e($i); ?>][cta2_route]" class="form-control" value="<?php echo e($s['cta2_route'] ?? ''); ?>" placeholder="e.g., projects.index">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <button type="button" class="btn-primary" onclick="addHeroSlide()"><i class="fas fa-plus me-1"></i>Add Slide</button>
                <div class="text-muted mt-2">
                    Enter Laravel route names for CTAs (e.g., <code>courses.index</code>). Leave CTA fields empty to hide buttons.
                </div>

                <template id="hero-slide-template">
                    <div class="border rounded p-3 mb-3 hero-slide-item" data-index="__IDX__" style="border-color: rgba(255,255,255,0.1);">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="h6 m-0">Slide <span class="hero-slide-number"></span></h4>
                            <button type="button" class="btn-outline btn-sm" onclick="removeHeroSlide(this)">Remove</button>
                        </div>
                        <div class="form-row">
                            <div class="form-group" style="align-self:center;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="hero_slides[__IDX__][enabled]" value="1" checked>
                                    <label class="form-check-label">Enable this slide</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Slide Image</label>
                                <input type="file" name="hero_slides[__IDX__][image]" class="form-control" accept="image/*">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Mini Title</label>
                                <input type="text" name="hero_slides[__IDX__][mini]" class="form-control" placeholder="e.g., New">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Main Title</label>
                                <input type="text" name="hero_slides[__IDX__][title]" class="form-control" placeholder="Main headline">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Sub Text</label>
                            <textarea name="hero_slides[__IDX__][sub]" class="form-control" rows="2" placeholder="Short supporting text"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Primary CTA Label</label>
                                <input type="text" name="hero_slides[__IDX__][cta1_label]" class="form-control" placeholder="e.g., Get Started">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Primary CTA Route Name</label>
                                <input type="text" name="hero_slides[__IDX__][cta1_route]" class="form-control" placeholder="e.g., courses.index">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Secondary CTA Label</label>
                                <input type="text" name="hero_slides[__IDX__][cta2_label]" class="form-control" placeholder="e.g., Learn More">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Secondary CTA Route Name</label>
                                <input type="text" name="hero_slides[__IDX__][cta2_route]" class="form-control" placeholder="e.g., projects.index">
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

      

        <!-- Social Media Links -->
        <div class="settings-card">
            <div class="settings-card-header" onclick="toggleSection('social')">
                <h3><i class="fas fa-share-alt me-2"></i>Social Media Links</h3>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </div>
            <div class="settings-card-content" id="social">
                <div class="form-row">
                    <div class="form-group">
                        <label for="facebook_url" class="form-label"><i class="fab fa-facebook me-1"></i>Facebook</label>
                        <input type="url" id="facebook_url" name="facebook_url" class="form-control" 
                               value="<?php echo e(old('facebook_url', $settings['facebook_url'] ?? '')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="instagram_url" class="form-label"><i class="fab fa-instagram me-1"></i>Instagram</label>
                        <input type="url" id="instagram_url" name="instagram_url" class="form-control" 
                               value="<?php echo e(old('instagram_url', $settings['instagram_url'] ?? '')); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="linkedin_url" class="form-label"><i class="fab fa-linkedin me-1"></i>LinkedIn</label>
                        <input type="url" id="linkedin_url" name="linkedin_url" class="form-control" 
                               value="<?php echo e(old('linkedin_url', $settings['linkedin_url'] ?? '')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="youtube_url" class="form-label"><i class="fab fa-youtube me-1"></i>YouTube</label>
                        <input type="url" id="youtube_url" name="youtube_url" class="form-control" 
                               value="<?php echo e(old('youtube_url', $settings['youtube_url'] ?? '')); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="twitter_url" class="form-label"><i class="fab fa-twitter me-1"></i>Twitter/X</label>
                        <input type="url" id="twitter_url" name="twitter_url" class="form-control" 
                               value="<?php echo e(old('twitter_url', $settings['twitter_url'] ?? '')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="tiktok_url" class="form-label"><i class="fab fa-tiktok me-1"></i>TikTok</label>
                        <input type="url" id="tiktok_url" name="tiktok_url" class="form-control" 
                               value="<?php echo e(old('tiktok_url', $settings['tiktok_url'] ?? '')); ?>">
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO & Metadata -->
        <div class="settings-card">
            <div class="settings-card-header" onclick="toggleSection('seo')">
                <h3><i class="fas fa-search me-2"></i>SEO & Metadata</h3>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </div>
            <div class="settings-card-content" id="seo">
                <div class="form-group">
                    <label for="meta_title" class="form-label">Meta Title</label>
                    <input type="text" id="meta_title" name="meta_title" class="form-control" 
                           value="<?php echo e(old('meta_title', $settings['meta_title'] ?? '')); ?>">
                </div>
                <div class="form-group">
                    <label for="meta_description" class="form-label">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" class="form-control" rows="3"><?php echo e(old('meta_description', $settings['meta_description'] ?? '')); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="keywords" class="form-label">Keywords (comma-separated)</label>
                    <input type="text" id="keywords" name="keywords" class="form-control" 
                           value="<?php echo e(old('keywords', $settings['keywords'] ?? '')); ?>">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="opengraph_image" class="form-label">OpenGraph Image</label>
                        <input type="file" id="opengraph_image" name="opengraph_image" class="form-control" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="google_analytics_id" class="form-label">Google Analytics ID</label>
                        <input type="text" id="google_analytics_id" name="google_analytics_id" class="form-control" 
                               value="<?php echo e(old('google_analytics_id', $settings['google_analytics_id'] ?? '')); ?>">
                    </div>
                </div>
            </div>
        </div>
        

        <!-- Legal Pages -->
        <div class="settings-card">
            <div class="settings-card-header" onclick="toggleSection('legal')">
                <h3><i class="fas fa-gavel me-2"></i>Legal Pages</h3>
                <i class="fas fa-chevron-down toggle-icon"></i>
            </div>
            <div class="settings-card-content" id="legal">
                <div class="form-row">
                    <div class="form-group">
                        <label for="privacy_policy_url" class="form-label">Privacy Policy URL</label>
                        <input type="url" id="privacy_policy_url" name="privacy_policy_url" class="form-control" 
                               value="<?php echo e(old('privacy_policy_url', $settings['privacy_policy_url'] ?? '')); ?>">
                    </div>
                    <div class="form-group">
                        <label for="terms_of_service_url" class="form-label">Terms of Service URL</label>
                        <input type="url" id="terms_of_service_url" name="terms_of_service_url" class="form-control" 
                               value="<?php echo e(old('terms_of_service_url', $settings['terms_of_service_url'] ?? '')); ?>">
                    </div>
                </div>
            </div>
        </div>        
        
        <div style="margin-top: 2rem; text-align: center;">
            <button type="submit" class="btn-primary" id="saveSettingsBtn">
                <i class="fas fa-save me-2"></i>Save All Settings
            </button>
        </div>
    </form>
</div>

<?php $__env->startPush('styles'); ?>
<style>
.settings-card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    margin-bottom: 1.5rem;
    overflow: hidden;
}

.settings-card-header {
    padding: 1.25rem 1.5rem;
    background: rgba(255, 255, 255, 0.05);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s ease;
}

.settings-card-header:hover {
    background: rgba(255, 255, 255, 0.08);
}

.settings-card-header h3 {
    margin: 0;
    color: var(--diamond-white);
    font-size: 1.1rem;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.toggle-icon {
    color: var(--cyan-accent);
    transition: transform 0.3s ease;
}

.settings-card-header.active .toggle-icon {
    transform: rotate(180deg);
}

.settings-card-content {
    padding: 1.5rem;
    display: none;
}

.settings-card-content.active {
    display: block;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.toggle-switch {
    margin-bottom: 0.75rem;
}

.toggle-switch input[type="checkbox"] {
    display: none;
}

.toggle-label {
    display: flex;
    align-items: center;
    cursor: pointer;
    color: var(--diamond-white);
    font-weight: 500;
    position: relative;
    padding-left: 3rem;
}

.toggle-label::before {
    content: '';
    position: absolute;
    left: 0;
    width: 2.5rem;
    height: 1.25rem;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 1rem;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.toggle-label::after {
    content: '';
    position: absolute;
    left: 0.125rem;
    top: 0.125rem;
    width: 1rem;
    height: 1rem;
    background: var(--diamond-white);
    border-radius: 50%;
    transition: all 0.3s ease;
}

input[type="checkbox"]:checked + .toggle-label::before {
    background: var(--cyan-accent);
}

input[type="checkbox"]:checked + .toggle-label::after {
    transform: translateX(1.25rem);
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .settings-card-header {
        padding: 1rem;
    }
    
    .settings-card-content {
        padding: 1rem;
    }
}

/* CRITICAL: Light Mode Text Fixes */
[data-theme="light"] .settings-card {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .settings-card-header {
    background: rgba(46, 120, 197, 0.05);
    border-bottom-color: rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .settings-card-header:hover {
    background: rgba(46, 120, 197, 0.1);
}

[data-theme="light"] .settings-card-header h3 {
    color: var(--primary-blue) !important;
}

[data-theme="light"] .toggle-icon {
    color: var(--primary-blue);
}

[data-theme="light"] .form-label {
    color: var(--charcoal) !important;
}

[data-theme="light"] .form-control {
    background: #FFFFFF;
    border-color: rgba(46, 120, 197, 0.3);
    color: var(--charcoal);
}

[data-theme="light"] .form-control:focus {
    border-color: var(--primary-blue);
}

[data-theme="light"] .text-muted,
[data-theme="light"] p[style*="color: var(--cool-gray)"] {
    color: var(--cool-gray) !important;
}

[data-theme="light"] code {
    background: rgba(46, 120, 197, 0.1);
    color: var(--primary-blue);
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function toggleSection(sectionId) {
    const content = document.getElementById(sectionId);
    const header = content.previousElementSibling;
    
    if (content.classList.contains('active')) {
        content.classList.remove('active');
        header.classList.remove('active');
    } else {
        content.classList.add('active');
        header.classList.add('active');
    }
}

// Open first section by default
document.addEventListener('DOMContentLoaded', function() {
    toggleSection('basic');
});



function addHeroSlide() {
    const list = document.getElementById('hero-slides-list');
    const tmpl = document.getElementById('hero-slide-template').innerHTML;
    const idx = list.querySelectorAll('.hero-slide-item').length;
    const html = tmpl.replaceAll('__IDX__', idx);
    const wrapper = document.createElement('div');
    wrapper.innerHTML = html.trim();
    const node = wrapper.firstChild;
    list.appendChild(node);
    renumberHeroSlides();
}

function removeHeroSlide(btn) {
    const item = btn.closest('.hero-slide-item');
    if (!item) return;
    item.parentNode.removeChild(item);
    renumberHeroSlides();
}

function renumberHeroSlides() {
    const items = document.querySelectorAll('#hero-slides-list .hero-slide-item');
    items.forEach((el, i) => {
        el.dataset.index = i;
        const num = el.querySelector('.hero-slide-number');
        if (num) num.textContent = (i + 1);
        el.querySelectorAll('[name]').forEach(inp => {
            inp.name = inp.name.replace(/hero_slides\[[0-9]+\]/, `hero_slides[${i}]`);
        });
    });
}

// Fix form submission
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('settingsForm');
    const saveBtn = document.getElementById('saveSettingsBtn');
    
    // Remove required attribute from URL fields that are causing validation errors
    const urlFields = document.querySelectorAll('input[type="url"]');
    urlFields.forEach(field => {
        field.removeAttribute('required');
        field.pattern = '';
        field.setCustomValidity('');
    });
    
    // Make save button type="button" to prevent default form submission
    if (saveBtn) {
        saveBtn.type = 'button';
        saveBtn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Submitting settings form...');
            
            // Clear any validation errors
            urlFields.forEach(field => {
                field.setCustomValidity('');
            });
            
            if (form) {
                form.submit();
            }
        });
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views/admin/settings/index.blade.php ENDPATH**/ ?>