<?php header('HTTP/1.0 404 Not Found'); ?>

<?php $__env->startSection('index', '404'); ?>
<?php $__env->startSection('title', '404'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-wrap full youplay-404">

    <!-- Banner -->
    <div class="youplay-banner banner-top">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/game-dark-souls-ii-10-1680x1050.jpg')">
      </div>

      <div class="info">
        <div>
          <div class="container align-center">
            <h2 class="h1">404</h2>
            <h3>Page Not Found ;(</h3>
          </div>
        </div>
      </div>
    </div>
    <!-- /Banner -->

  </section>
<?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\originals\resources\views/errors/404.blade.php ENDPATH**/ ?>