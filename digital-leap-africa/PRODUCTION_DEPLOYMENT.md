# Production Deployment Guide

## 📋 Pre-Deployment Checklist

### 1. Environment Configuration
- [x] `.env.production` file created with performance optimizations
- [x] `APP_ENV=production`
- [x] `APP_DEBUG=false`
- [x] `APP_URL=https://digitalleap.africa`
- [x] Performance settings added (`VIEW_COMPILED_PATH`, `CACHE_PREFIX`)

### 2. Performance Optimizations Applied
- [x] All 7 pages optimized (Homepage, About, Courses, Blog, Events, eLibrary, Contact)
- [x] Critical CSS inlined on all pages
- [x] Image dimensions added (width/height attributes)
- [x] Lazy loading implemented
- [x] Meta descriptions added
- [x] `.htaccess` caching configured (1 year for images, 1 month for CSS/JS)

### 3. Security Configuration
- [x] `APP_DEBUG=false` (prevents error exposure)
- [x] `LOG_LEVEL=error` (production logging)
- [x] Database credentials secured
- [x] Mail credentials configured
- [x] Google OAuth production callback URL set

## 🚀 Deployment Steps

### Step 1: Upload Files to Production Server
```bash
# Upload all files via FTP/SFTP to public_html or web root
# Ensure .env.production is renamed to .env on server
```

### Step 2: Set Correct Permissions
```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Step 3: Install Dependencies (if not done)
```bash
composer install --optimize-autoloader --no-dev
```

### Step 4: Run Production Optimizations
```bash
# Clear all caches
php artisan optimize:clear

# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer dump-autoload --optimize
```

### Step 5: Database Migration (if needed)
```bash
php artisan migrate --force
```

### Step 6: Storage Link (if not created)
```bash
php artisan storage:link
```

## ⚡ Performance Optimizations on Server

### Apache Configuration (.htaccess)
Already configured with:
- ✅ Gzip compression enabled
- ✅ Browser caching (1 year for images, 1 month for CSS/JS)
- ✅ ETags enabled
- ✅ Keep-Alive enabled

### Laravel Optimizations
```bash
# Run these commands on production server
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

### Recommended Server Settings

#### PHP Configuration (php.ini)
```ini
memory_limit = 256M
max_execution_time = 300
upload_max_filesize = 20M
post_max_size = 25M
opcache.enable = 1
opcache.memory_consumption = 128
opcache.max_accelerated_files = 10000
opcache.revalidate_freq = 2
```

#### MySQL Optimization
```sql
-- Enable query cache
SET GLOBAL query_cache_size = 67108864;
SET GLOBAL query_cache_type = 1;
```

## 🔒 Security Checklist

- [x] `APP_DEBUG=false` in production
- [x] Strong `APP_KEY` generated
- [x] Database credentials secured
- [x] HTTPS enabled (SSL certificate)
- [x] CSRF protection enabled
- [x] XSS protection in place
- [x] SQL injection prevention (Eloquent ORM)

## 📊 Performance Monitoring

### Expected PageSpeed Scores (After Deployment)
| Page | Score | Status |
|------|-------|--------|
| Homepage | 85+ | ✅ Optimized |
| About | 85+ | ✅ Optimized |
| Courses | 85+ | ✅ Optimized |
| Blog | 85+ | ✅ Optimized |
| Events | 85+ | ✅ Optimized |
| eLibrary | 83+ | ✅ Optimized |
| Contact | 90+ | ✅ Optimized |

### Core Web Vitals Targets
- **FCP** (First Contentful Paint): < 1.8s ✅
- **LCP** (Largest Contentful Paint): < 2.5s ⚠️ (Needs image compression)
- **TBT** (Total Blocking Time): < 200ms ✅
- **CLS** (Cumulative Layout Shift): < 0.1 ✅

## 🖼️ Critical: Image Optimization Required

### Current Issue
- Images are 2-4MB each (should be <200KB)
- This is the #1 blocker preventing 95+ scores

### Solution
1. **Compress all images** using:
   - TinyPNG (https://tinypng.com)
   - Squoosh (https://squoosh.app)
   - ImageOptim (Mac)

2. **Target sizes**:
   - Hero images: < 200KB
   - Course/blog images: < 100KB
   - Thumbnails: < 50KB

3. **Already using WebP** ✅
   - All uploads converted to WebP with 85% quality
   - Just need to compress source images before upload

## 🔄 Post-Deployment Tasks

### Immediate (After Upload)
```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Weekly Maintenance
```bash
# Clear old logs
php artisan log:clear

# Clear expired sessions
php artisan session:gc
```

### Monthly Optimization
```bash
# Re-optimize everything
php artisan optimize:clear
php artisan optimize
composer dump-autoload --optimize
```

## 🧪 Testing After Deployment

### 1. Functionality Tests
- [ ] Homepage loads correctly
- [ ] User registration/login works
- [ ] Course enrollment functions
- [ ] Payment gateway (M-Pesa) works
- [ ] Email notifications send
- [ ] Google OAuth login works
- [ ] Admin panel accessible
- [ ] File uploads work

### 2. Performance Tests
- [ ] Run PageSpeed Insights on all pages
- [ ] Check GTmetrix scores
- [ ] Test mobile performance
- [ ] Verify caching headers
- [ ] Check Gzip compression

### 3. Security Tests
- [ ] HTTPS working (SSL certificate)
- [ ] No debug information exposed
- [ ] CSRF tokens working
- [ ] XSS protection active
- [ ] SQL injection prevention

## 📝 Environment Variables Changed

### Production vs Local Differences
```diff
- APP_ENV=local
+ APP_ENV=production

- APP_DEBUG=true
+ APP_DEBUG=false

- APP_URL=http://localhost:8000
+ APP_URL=https://digitalleap.africa

- LOG_LEVEL=debug
+ LOG_LEVEL=error

- MAIL_HOST=smtp.gmail.com
+ MAIL_HOST=mail.digitalleap.africa

- MAIL_PORT=587
+ MAIL_PORT=465

- MAIL_ENCRYPTION=tls
+ MAIL_ENCRYPTION=ssl

- GOOGLE_REDIRECT_URI=http://localhost/auth/google/callback
+ GOOGLE_REDIRECT_URI=https://digitalleap.africa/auth/google/callback

+ VIEW_COMPILED_PATH="${APP_BASE_PATH}/storage/framework/views"
+ CACHE_PREFIX=dla_cache
```

## 🎯 Performance Goals

### Current Status (Code Optimizations)
- ✅ Critical CSS inlined (all pages)
- ✅ Image dimensions added (all pages)
- ✅ Lazy loading implemented
- ✅ Meta descriptions added
- ✅ Accessibility improved (ARIA labels)
- ✅ CSS minified
- ✅ Browser caching configured
- ✅ Gzip compression enabled

### Pending (Content Optimizations)
- ⏳ Compress all images from 2-4MB to <200KB
- ⏳ Enable Redis/Memcached (optional)
- ⏳ Implement CDN (optional)

### Expected Final Scores (After Image Compression)
- **Average Score**: 95+/100 (A+)
- **All Pages**: 90+ minimum
- **Core Web Vitals**: All green

## 🆘 Troubleshooting

### If Performance Score is Low
1. Check if caches are built: `php artisan optimize`
2. Verify .htaccess is working: Check response headers
3. Compress images: Use TinyPNG/Squoosh
4. Enable OPcache: Check `php -i | grep opcache`

### If Site is Slow
1. Check database queries: Enable query log temporarily
2. Verify caching is working: Check `storage/framework/cache`
3. Monitor server resources: CPU, RAM, disk I/O
4. Check error logs: `storage/logs/laravel.log`

### If Errors Occur
1. Check permissions: `chmod -R 755 storage bootstrap/cache`
2. Clear caches: `php artisan optimize:clear`
3. Check logs: `tail -f storage/logs/laravel.log`
4. Verify .env: Ensure all credentials are correct

## 📞 Support

**Developer**: Collins Otieno
**Email**: otienocollins0549@gmail.com
**GitHub**: [@osumba404](https://github.com/osumba404)

---

**Deployment Date**: November 23, 2025
**Version**: 9.0 (Complete with Certification System)
**Status**: Production Ready ✅
