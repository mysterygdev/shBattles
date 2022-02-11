<?php $__env->startSection('index', 'bossRecords'); ?>
<?php $__env->startSection('title', 'Boss Records'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('headerTitle', 'Boss Records'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <section class="page-name parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Boss Records
      </h1>
      <div class="breadcrumbs">
        <a href="#">Home</a> /
        <a href="#">Server Info</a> /
        <span class="color-1">Boss Records</span>
      </div>
    </div>
  </div>
  </section>
  <section class="blog-content ptb150 each-element">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
            <div class="table-responsive">
                <table class="table table-dark table-striped text-center">
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
        <?php echo $__env->make('partials.cms.widgets', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div>
  </section>
	<?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ShaiyaCMS\resources\views/pages/cms/server/bossrecords.blade.php ENDPATH**/ ?>