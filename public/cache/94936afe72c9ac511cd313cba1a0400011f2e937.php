<?php $__env->startSection('index', 'downloads'); ?>
<?php $__env->startSection('title', 'Downloads'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>

      <div class="info">
        <div>
          <div class="container">
            <h1>title</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="container youplay-content text-center">
        <h2 class="mt-0">Downloads</h2>
        <div class="row vertical-gutter">
          <div class="col-md-3"></div>
          <!-- Downloads -->
          <div class="col-md-4">
            <ul class="pricing-table">
              <li class="plan-name">Game Files</li>
              <li class="plan-price">
                <a href="https://mega.nz/#!JIsjVALI!Bo4rUTqhEOJuFlYPXWgwM6a0jQyDuRWgTYPeDQOE2gY" target="_blank" class="btn">Mega</a>
                <a href="https://drive.google.com/file/d/1BLzRs-d4ILybCAVHfIX7Ehtj0AtIMHYd/edit" target="_blank" class="btn" style="margin-left:5px">Google Drive</a>
              </li>
              <li class="plan-action">
                <span>Last Updated On: <b>3.14.19</b></span>
              </li>
            </ul>
          </div>
          <!-- /Downloads -->
          <!-- Patch -->
          <div class="col-md-4">
            <ul class="pricing-table">
              <li class="plan-name">Patch Files</li>
              <li class="plan-price">
                <a href="#" class="btn">Game.exe</a>
                <a href="#" class="btn" style="margin-left:5px">Updater.exe</a>
              </li>
              <li class="plan-action">
                <span>Last Updated On: <b>1.27.19</b></span>
              </li>
            </ul>
          </div>
          <!-- /Patch -->
        </div>
    </div>
  </section>

    <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/server/download.blade.php ENDPATH**/ ?>