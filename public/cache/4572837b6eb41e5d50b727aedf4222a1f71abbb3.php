<script>
function updateCartItem(obj,id){
    $.get("/webmall/cartAction", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
        if(data == 'ok'){
            location.reload();
        }else{
            alert('Cart update failed, please try again.');
        }
    });
}
</script>

<?php $__env->startSection('index', 'cart'); ?>
<?php $__env->startSection('title', 'Cart'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>
    </div>

    <div class="container youplay-content text-center">
        <h2 class="mt-0">Cart</h2>
        <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
          <p>Please login to continue.</p>
        <?php else: ?>
          <div class="col-md-9 col-md-push-3 isotope">
            <?php echo e($data['webmall']->initCart()); ?>

            <?php if($data['webmall']->totalItems() > 0): ?>
              <?php $cartItems = $data['webmall']->contents(); ?>
              <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item angled-bg">
                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-xs-4 shop_icon">
                      <?php if($item['image']): ?>
                        <?php if($item['tag']): ?>
                          <?php echo e($data['webmall']->getTags($item['tag'])); ?>

                          <img src="/resources/themes/core/images/shop_icons/<?php echo e($item['image']); ?>" alt="" class="img-responsive img-border <?php echo e($item['tag']); ?>">
                          <div class="img-special special-<?php echo e($item['tag']); ?>"><?php echo e($item['tag']); ?></div>
                        <?php else: ?>
                          <img src="/resources/themes/core/images/shop_icons/<?php echo e($item['image']); ?>" alt="" class="img-responsive">
                        <?php endif; ?>
                      <?php endif; ?>
                    </div>
                    <div class="col-lg-10 col-md-9 col-xs-8">
                      <div class="row">
                        <div class="col-xs-6 col-md-9">
                          <h4><?php echo e($item['name']); ?></h4>
                          <?php echo e($item['desc']); ?>

                        </div>
                        <div class="col-xs-6 col-md-3 align-right">
                          <div class="price">
                            <strong style="margin-right:10px">x<?php echo e($item['qty']); ?></strong>
                            <?php echo e($item['price']); ?> DP
                          </div>
                          <a href="/game/webmall/cartAction?action=removeCartItem&id=<?php echo e($item['rowid']); ?>" class="remove fas fa-trash-alt" title="Remove Item"></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <div class="align-right h3 mr-20 mb-20">
                <span style="margin-right:10px;">Total: <strong><?php echo e($data['webmall']->total()); ?> DP</strong></span>
              </div>
              <div class="align-left">
                <a href="/game/webmall/cartAction/?action=clearCart" class="btn btn-lg">Empty Cart</a>
              </div>
              <div class="align-right">
                <a href="/game/webmall/checkout" class="btn btn-lg">Proceed to Checkout</a>
              </div>
            <?php else: ?>
              <?php if (\Illuminate\Support\Facades\Blade::check('auth')): ?>
                <p>Your cart is empty.</p>
                <p class="text-center">
                  <a class="btn btn-lg" href="/game/webmall">Return to Webmall</a>
                </p>
              <?php else: ?>
                <p>You need to login to view your cart.</p>
              <?php endif; ?>
            <?php endif; ?>
          </div>
          <?php echo $__env->make('pages.cms.game.webmall.partials.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
  </section>

  <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/game/webmall/cart.blade.php ENDPATH**/ ?>