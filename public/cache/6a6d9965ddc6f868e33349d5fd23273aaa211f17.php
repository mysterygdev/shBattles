<?php $__env->startSection('index', 'patchNotes'); ?>
<?php $__env->startSection('title', 'Patch Notes'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <section class="page-name parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Patch Notes
      </h1>
      <div class="breadcrumbs">
        <a href="#">Home</a> /
        <a href="#">Community</a> /
        <span class="color-1">Patch Notes</span>
      </div>
    </div>
  </div>
  </section>
  <section class="blog-content ptb150 each-element">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
          <?php if(count($data['patchnotes']) > 0): ?>
            <?php $__currentLoopData = $data['patchnotes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patchnotes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="eventHeader6">
                          <div class="fsize-14 fweight-700 uppercase" style="text-align: center">
                            <?php echo e(date('F d Y H:i', strtotime($patchnotes->Date))); ?>

                          </div>
                          </div>
              <article class="vertical-item format-thumb fsize-0 clearfix">
              <div class="post-content col-lg-12 col-md-8 col-sm-12 col-xs-12 equal-height">
                  <div class="post-wrapper">
                    <div class="table">
                      <div class="table-row">
                        </div>
                    </div>
                    <div class="mt15">
                        <div  style="text-align: center">
                          <h5><?php echo e($patchnotes->Title); ?></h5>
                        </div>
                      <div class="fsize-16 lheight-26 mt15"  data-trim="1000">
                        <div  style="text-align: center">
                          <?php
                          $text = str_replace("\\n", "<br>", $patchnotes->Detail);
                          echo $text
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
            There is currently no patch notes to display. Please check back later.
          <?php endif; ?>
        </div>
        <?php echo $__env->make('partials.cms.widgets', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div>
  </section>
	<?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ShaiyaCMS\resources\views/pages/cms/community/patchnotes.blade.php ENDPATH**/ ?>