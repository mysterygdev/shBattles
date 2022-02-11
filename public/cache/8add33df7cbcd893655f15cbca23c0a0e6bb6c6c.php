<div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
  <?php if(count($data['news']->getNews()) > 0): ?>
    <?php $__currentLoopData = $data['news']->getNews(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="eventHeader5">
        <div class="fsize-14 fweight-700 uppercase" style="text-align: center">
          <?php echo e(date('F d Y H:i', strtotime($res->Date))); ?>

        </div>
      </div>
      <article class="vertical-item format-thumb fsize-0 clearfix">
        <div class="post-content col-lg-12 col-md-8 col-sm-12 col-xs-12 equal-height">
          <div class="post-wrapper">
            <div class="mt15">
              <div  style="text-align: center">
                <h5><?php echo e($res->Title); ?></h5>
              </div>
              <div class="fsize-16 lheight-26 mt15"  data-trim="1000">
                <div  style="text-align: center">
                  <?php
                    $text = str_replace("\\n", "<br>", $res->Detail);
                    echo $text
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </article>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\ShaiyaCMS\resources\views/pages/cms/home/partials/news.blade.php ENDPATH**/ ?>