<?php $__env->startSection('index', 'donateProcess'); ?>
<?php $__env->startSection('title', 'Donate Process'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <section class="page-name parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Donate Process
      </h1>
      <div class="breadcrumbs">
        <a href="#">Home</a> /
        <a href="#">User</a> /
        <span class="color-1">Donate Process</span>
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
                
                <?php if($data['donate']->getMethod() == 'paypal'): ?>
                  <h2 class="text-center">Processing Your Donation...</h2>
                  We are now processing your donation. You will be re-directed to PayPal to complete the process.<br><br>
                  <?php echo e($data['donate']->getDonateInfo($data['donate']->getKey(), $data['donate']->getMethod())); ?>

                <?php elseif($data['donate']->getMethod() == 'stripe'): ?>
                  <h2 class="text-center">Processing Your Donation...</h2>
                  We are now processing your donation. You will be re-directed to Stripe to complete the process.<br><br>
                  
                  <form action="/stripePost?id=<?php echo e($data['donate']->getKey()); ?>" method="POST">
                    <script
                      src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                      data-key="<?php echo e(STRIPE['publishable_key']); ?>"
                      data-amount="2345"
                      data-name="<?php echo e($data['donate']->getReward($data['donate']->getKey()).' points'); ?>"
                      data-description="receive <?php echo e($data['donate']->getReward($data['donate']->getKey())); ?> donation points"
                      data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                      data-locale="auto">
                    </script>
                  </form>
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

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ShaiyaCMS\resources\views/pages/cms/user/donate/donateProcess.blade.php ENDPATH**/ ?>