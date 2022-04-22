<?php $__env->startSection('index', 'vote'); ?>
<?php $__env->startSection('title', 'Vote'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>

      
    </div>

    <div class="container youplay-content text-center">
        <h2 class="mt-0">Vote</h2>
        <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
          <p>Please login to continue.</p>
        <?php else: ?>
          <div class="text-center">
            <p>You will receive <?php echo e(VOTE['Point']); ?>  DP per vote.</p>
            <p>You can vote every 12 hours.</p>
            <form name="Vote" method="post" id="Vote" target="_new">
              <input type="radio" name="site" value="nr1" checked> XtremeTop100<br>
              <input type="radio" name="site" value="nr2"> OxigenTop100<br>
              <input type="radio" name="site" value="nr3"> GamingTop100<br>
              <input type="radio" name="site" value="nr4"> Top of Games<br/>
              <?php Separator(20); ?>
              <img style="margin-left:10px;" src="/resources/themes/core/images/Vote/votenew.jpg" alt="Shaiya Servers">
              <img style="margin-left:10px;" src="/resources/themes/core/images/Vote/button_1.gif.png" alt="Shaiya Servers">
              <img style="margin-left:10px;" src="/resources/themes/core/images/Vote/vote.gif" alt="Shaiya Servers">
              <img style="margin-left:10px;" src="/resources/themes/core/images/Vote/47879_original.gif" alt="Shaiya Servers">
              <?php Separator(40); ?>
              <button type="submit" class="btn gradient color-white" id="Button1" name="Vote">Vote</button>
            </form>
          </div>
        <?php endif; ?>
    </div>
  </section>
  <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/game/vote.blade.php ENDPATH**/ ?>