<?php $__env->startSection('index', 'donate'); ?>
<?php $__env->startSection('title', 'Donate'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <section class="page-name parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Donate
      </h1>
      <div class="breadcrumbs">
        <a href="#">Home</a> /
        <a href="#">User</a> /
        <span class="color-1">Donate</span>
      </div>
    </div>
  </div>
  </section>
  <section class="blog-content ptb150 each-element">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
          <div class="title-bl text-center wow fadeIn" data-wow-duration="2s">
            <div class="title color-white">
              Donate
            </div>
          </div>
            <div class="text-center">
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
                    <div class="separator_30"></div>
                    <br>
                    <div class="col-md-12 tac">
                      <div class="donate-btns">
                        <button type="submit" name="SubmitBtn" class="btn gradient color-white" value="paypal">
                          Donate with Paypal
                        </button>
                      </div>
                    </div>
                  </form>
                <?php else: ?>
                  Sorry. At the moment there are no donation options. Please come back later.
                <?php endif; ?>
              <?php endif; ?>
              <?php endif; ?>
            </div>
        </div>
        <?php echo $__env->make('partials.cms.widgets', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div>
  </section>
	<?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ShaiyaCMS\resources\views/pages/cms/user/donate/donate.blade.php ENDPATH**/ ?>