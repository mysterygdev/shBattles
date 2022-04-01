<?php $__env->startSection('index', 'bossRecords'); ?>
<?php $__env->startSection('title', 'Boss Records'); ?>
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
      <h2 class="mt-0">Boss Records</h2>
      <div class="table-responsive">
        <table class="table table-striped text-center">
          <thead>
            <tr class="boss-record">
              <th class="boss-record">Boss</th>
              <th class="boss-record">Killed by</th>
              <th class="boss-record">Respawns in</th>
            </tr>
          </thead>
          <?php
            $time = date("Y-m-d H:i:s.000");
          ?>
          <?php $__currentLoopData = $data['bossrecords']->MobID; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $data['bossrecords']->getBossRecords($time,$value);
            ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
      </div>
    </div>
  </section>

    <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/server/bossrecords.blade.php ENDPATH**/ ?>