<?php $__env->startSection('index', 'bossRecords'); ?>
<?php $__env->startSection('title', 'Boss Records'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <div class="container-fluid">
    <div class="row">
      <header id="home">
        <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <h1>
          <img onload="this.style.opacity='1';" class="big-logo" src="/resources/themes/Originals/images/shaiya_titan_logo.png" alt="Dragonic big logo">
        </h1>
      </header>
    </div>
    <?php echo $__env->make('partials.cms.divider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <main>
      <section class="container">
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
      </section>
    </main>
  </div>

    <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  
  <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\originals\resources\views/pages/cms/server/bossrecords.blade.php ENDPATH**/ ?>