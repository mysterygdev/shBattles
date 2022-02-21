<?php $__env->startSection('index', 'webmall'); ?>
<?php $__env->startSection('title', 'Webmall'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>
    </div>

    <div class="container youplay-store">
      <h2 class="mt-0">Webmall</h2>
      <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
        <p>Please login to continue.</p>
      <?php else: ?>
        <div class="col-md-9 col-md-push-3 isotope">
          <h2 class="text-center">Your available points to spend: <span class="fw_bold"><?php echo e($data['webmall']->getUserPoints()); ?></span></h2>
          <h3 class="text-center"><?php echo e($data['webmall']->category); ?></h3>
          <div class="isotope-list">
            <?php if(count($data['webmall']->getProducts()) > 0): ?>
              <?php $__currentLoopData = $data['webmall']->getProducts(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <form method="post" name="ItemSubmit" action="/game/webmall/cartAction?action=addToCart&id=<?php echo e($res->ProductID); ?>">
                  <a href="#!" class="item angled-bg" data-filters="popular">
                    <div class="row">
                      <div class="col-lg-2 col-md-3 col-xs-4 shop_icon">
                        <?php echo e($data['webmall']->getTags($res->Tag)); ?>

                        <?php if($res->Tag): ?>
                          <img class="img-border <?php echo e($res->Tag); ?>" src="/resources/themes/core/images/shop_icons/<?php echo e($res->ProductImage); ?>" alt="">
                          <div class="img-special special-<?php echo e($res->Tag); ?>"><?php echo e($res->Tag); ?></div>
                        <?php else: ?>
                          <img src="/resources/themes/core/images/shop_icons/<?php echo e($res->ProductImage); ?>" alt="">
                        <?php endif; ?>
                      </div>
                      <div class="col-lg-10 col-md-9 col-xs-8">
                        <div class="row">
                          <div class="col-xs-6 col-md-9">
                            <h2><?php echo e($res->ProductName); ?></h2>
                            <p><?php echo e($res->ProductDesc); ?></p>
                          </div>
                          <div class="col-xs-6 col-md-3 align-right">
                            <div class="price">
                              <?php echo e($res->ProductCost); ?> DP
                            </div>
                            <select name="Quantity" class="custom-select custom-select-sm form-control form-control-sm">
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                              <option value="7">7</option>
                              <option value="8">8</option>
                              <option value="9">9</option>
                              <option value="10">10</option>
                              <option value="15">15</option>
                              <option value="20">20</option>
                              <option value="30">30</option>
                              <option value="40">40</option>
                              <option value="50">50</option>
                            </select>
                            <?php separator(40) ?>
                            <button type="submit" class="btn btn-sm">Add To Cart</button>
                            <?php separator(20) ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                </form>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
          </div>
        </div>
        <?php echo $__env->make('pages.cms.game.webmall.partials.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php endif; ?>
    </div>
  </section>

  <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/game/webmall/webmall.blade.php ENDPATH**/ ?>