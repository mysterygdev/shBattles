<?php $__env->startSection('index', 'orders'); ?>
<?php $__env->startSection('title', 'Orders'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>
    </div>

    <div class="container youplay-content text-center">
        <h2 class="mt-0">Orders</h2>
        <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
          <p>Please login to continue.</p>
        <?php else: ?>
          <div class="col-md-9 col-md-push-3 isotope">
            <?php if(count($data['webmall']->getOrderHistory()) > 0): ?>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Order #</th>
                    <th>Product Name</th>
                    <th>Product Desc</th>
                    <th>Product Cost</th>
                    <th>Product Quantity</th>
                    <th>Order Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $data['webmall']->getOrderHistory(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($fet->OrderNumber); ?></td>
                    <td><?php echo e($fet->ItemName); ?></td>
                    <td><?php echo e($fet->ItemDesc); ?></td>
                    <td><?php echo e($fet->ItemCost); ?></td>
                    <td><?php echo e($fet->ItemQuantity); ?></td>
                    <td><?php echo e(date('F d, Y', strtotime($fet->Date))); ?></td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            <?php else: ?>
              It appears that you have not placed any orders. Please come back later.
            <?php endif; ?>
          </div>
          <?php echo $__env->make('pages.cms.game.webmall.partials.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
  </section>

  <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/game/webmall/orders.blade.php ENDPATH**/ ?>