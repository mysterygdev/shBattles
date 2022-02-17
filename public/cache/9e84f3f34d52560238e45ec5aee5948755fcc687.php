<?php $__env->startSection('index', 'donate'); ?>
<?php $__env->startSection('title', 'Donate'); ?>
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
          <?php if(isset($_POST["SubmitBtn"]) || isset($_POST["SubmitBtn"]) && !empty($_POST["SubmitBtn"]) || !empty($_POST["SubmitBtn"])): ?>
            <?php echo e($data['donate']->getHeader()); ?>

          <?php else: ?>
            <?php if(count($data['donate']->getOptions()) > 0): ?>
              <form style="display:inline;" action="" method="post">
                <div class="table-responsive">
                  <table class="table table-dark text-center">
                    <thead>
                      <tr>
                        <th><input type="radio" name="RewardID" disabled="disabled" /></th>
                        <th>Reward</th>
                        <th>Price</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $data['donate']->getOptions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><input type="radio" name="RewardID" value="<?php echo e($res->RowID); ?>"></td>
                          <td><?php echo e($res->Reward); ?> points</td>
                          <td><?php echo e($res->Price); ?> <?php echo e(DONATE['currency']); ?></td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
                <?php separator(40) ?>
                <div class="donate-btns">
                  <button type="submit" name="SubmitBtn" class="btn gradient color-white" value="paypal">
                    Donate with Paypal
                  </button>
                </div>
              </form>
            <?php else: ?>
              Sorry. At the moment there are no donation options. Please come back later.
            <?php endif; ?>
          <?php endif; ?>
        <?php endif; ?>
    </div>
  </section>

    <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/user/donate/donate.blade.php ENDPATH**/ ?>