<?php $__env->startSection('index', 'rankings'); ?>
<?php $__env->startSection('title', 'Rankings'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <div id="exception"></div>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="wrapper">
    <?php echo $__env->make('partials.cms.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container">
      <main class="content">
        <?php echo $__env->make('partials.cms.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div id="content">
          <div id="box1">
            <div class="title1">
              <h1>Rankings</h1>
            </div>
            <div id="content_center">
              <div class="box-style1" style="margin-bottom:55px;">
                <div class="entry">
                  <div id="rankingsData"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
      <?php echo $__env->make('partials.cms.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ShaiyaCMS\resources\views/pages/cms/community/rankings.blade.php ENDPATH**/ ?>