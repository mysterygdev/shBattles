<?php $__env->startSection('index', 'patchNotes'); ?>
<?php $__env->startSection('title', 'Patch Notes'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>

      <div class="info">
        <div>
          <div class="container">
            <h1>Verificaiton</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="container youplay-content text-center">
        <h2 class="mt-0">Verification</h2>
        <?php if($data['verify']->getActivationData($data['id'])): ?>
          <?php if($data['verify']->getActivationData($data['id'])->Verified == 1): ?>
            your account: <strong><?php echo e($data['verify']->getActivationData($data['id'])->UserID); ?></strong> has already been activated.
          <?php else: ?>
            Account: <strong><?php echo e($data['verify']->getActivationData($data['id'])->UserID); ?></strong> found, activating...
            <?php if($data['verify']->getUserStatus($data['verify']->getActivationData($data['id'])->UserID) == '-1' || $data['verify']->getUserStatus($data['verify']->getActivationData($data['id'])->UserID) == '-5'): ?>
                It looks like your account is banned, therefore we cannot activate your account.
            <?php else: ?>
              <?php if($data['verify']->updateUserStatus($data['verify']->getActivationData($data['id'])->UserID, 16) && $data['verify']->updateVerified($data['verify']->getActivationData($data['id'])->UserID, 1)): ?>
                Your account has been successfully activated.
              <?php else: ?>
                There was an error attempting to verify your account.
              <?php endif; ?>
            <?php endif; ?>
          <?php endif; ?>
        <?php else: ?>
          Activation Key Doesn't Exist
        <?php endif; ?>
    </div>
  </section>

<?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/auth/verify.blade.php ENDPATH**/ ?>