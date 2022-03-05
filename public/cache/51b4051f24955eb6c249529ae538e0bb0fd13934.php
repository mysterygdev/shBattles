<?php $__env->startSection('index', 'patchNotes'); ?>
<?php $__env->startSection('title', 'PatchNotes'); ?>
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
        <?php if(count($data['patchnotes']->getPatchNotes()) > 0): ?>
          <?php $__currentLoopData = $data['patchnotes']->getPatchNotes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
              <h2><?php echo e($res->Title); ?></h2>
              <p class="section-description">
                <?php
                  $text = str_replace("\\n", "<br>", $res->Detail);
                  echo $text
                ?>
              </p>
              <span class="float-right"><?php echo e(date('F d Y H:i', strtotime($res->Date))); ?></span>
            </div>
            <div class="row items-container bottom-wrapper">
              <p>&nbsp;<br>&nbsp;</p>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          <p class="text-center">
            There is currently nothing to see here. Please check back later and see what has been added.
          </p>
        <?php endif; ?>
      </section>
    </main>
  </div>

    <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  
  <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\originals\resources\views/pages/cms/community/patchnotes.blade.php ENDPATH**/ ?>