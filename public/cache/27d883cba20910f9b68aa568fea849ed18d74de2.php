<?php $__env->startSection('index', 'donateProcess'); ?>
<?php $__env->startSection('title', 'Donate Process'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>

      
    </div>

    <div class="container youplay-content text-center">
        <h2 class="mt-0">Donate</h2>
        <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
          <p>Please login to continue.</p>
        <?php else: ?>
          <?php if($data['donate']->getMethod() == 'paypal' && $data['donate']->getType() == 'normal'): ?>
            <h2 class="text-center">Processing Your Donation...</h2>
            We are now processing your donation. You will be re-directed to PayPal to complete the process.<br><br>
            <?php echo e($data['donate']->getDonateInfo($data['donate']->getKey(), $data['donate']->getMethod())); ?>

          <?php elseif($data['donate']->getMethod() == 'paypal' && $data['donate']->getType() == 'toFriend' && !empty($data['donate']->getKey())): ?>
            <div class="row">
              <div class="col-md-3">
                <div class="youplay-input">
                  <input type="text" name="char" id="char" placeholder="Character Name">
                </div>
              </div>
            </div>
              <div class="donate-btns">
                <button type="submit" name="SubmitBtn" class="btn gradient color-white" value="paypal">
                  Send Payment
                </button>
              </div>
          <?php elseif(empty($data['donate']->getMethod()) || empty($data['donate']->getKey())): ?>
            An error has seemed to occur. Please try again.
          <?php endif; ?>
        <?php endif; ?>
    </div>
  </section>

    <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/user/donate/donateProcess.blade.php ENDPATH**/ ?>