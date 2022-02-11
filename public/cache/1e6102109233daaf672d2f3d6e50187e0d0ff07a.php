<?php header('HTTP/1.0 404 Not Found'); ?>

<?php $__env->startSection('index', '404'); ?>
<?php $__env->startSection('title', '404'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="error-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="error-content">
                    <img src="/resources/themes/zelda/img/error.png" alt="image">
                    <h3>Error 404 : Page Not Found</h3>
                    <p>The page you are looking for might have been removed had its name changed or is temporarily unavailable.</p>
                    <a href="/" class="default-btn">Go to Homepage</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ShaiyaCMS\resources\views/errors/404.blade.php ENDPATH**/ ?>