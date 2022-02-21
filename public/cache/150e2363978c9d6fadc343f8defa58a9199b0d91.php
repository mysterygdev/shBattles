<?php $__env->startSection('index', 'panel'); ?>
<?php $__env->startSection('title', 'User Panel'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>
    </div>

    <div class="container youplay-content text-center">
      <h2 class="mt-0">User Panel</h2>
      <div role="tabpanel">
        <div class="panel-btns text-center">
          <button type="button" class="btn btn-sm btn-dark m_auto" onclick="location.href='/user/panel/details';">
            Account Details
          </button>
          <button type="button" class="btn btn-sm btn-dark m_auto" onclick="location.href='/user/panel/chars';">
            Characters
          </button>
          <button type="button" class="btn btn-sm btn-dark m_auto" onclick="location.href='/user/panel/password';">
            Change Password
          </button>
          <button type="button" class="btn btn-sm btn-dark m_auto" onclick="location.href='/user/panel/res';">
            Resurrect
          </button>
        </div>
        <div class="panel-content text-center">
          <?php if(!$data['page']): ?>
            <?php echo $__env->make('pages.cms.user.panel.details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php else: ?>
            <?php if($data['page'] == 'details'): ?>
              <?php echo $__env->make('pages.cms.user.panel.details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php elseif($data['page'] == 'chars'): ?>
              <?php echo $__env->make('pages.cms.user.panel.characters', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php elseif($data['page'] == 'password'): ?>
              <?php echo $__env->make('pages.cms.user.panel.changePassword', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php elseif($data['page'] == 'res'): ?>
              <?php echo $__env->make('pages.cms.user.panel.resurrect', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
          <?php endif; ?>
        </div>
        
        
      </div>
    </div>
  </section>

  <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/user/panel.blade.php ENDPATH**/ ?>