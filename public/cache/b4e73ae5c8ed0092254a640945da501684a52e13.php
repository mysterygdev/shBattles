<script>
function updateCartItem(obj,id){
    $.get("/game/webmall/cartAction", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
        if(data == 'ok'){
            location.reload();
        }else{
            alert('Cart update failed, please try again.');
        }
    });
}
</script>

<?php $__env->startSection('index', 'orderFail'); ?>
<?php $__env->startSection('title', 'Order Fail'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>
    </div>

    <div class="container youplay-content text-center">
        <h2 class="mt-0">Purchase Failed!</h2>
        <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
          <p>Please login to continue.</p>
        <?php else: ?>
          <p>You do not have enough points to purchase this!</p>
          <a href="/game/webmall" class="custom_button" style="text-transform: none;">Back to webmall</a>
          <a href="/game/webmall/cart" class="custom_button" style="text-transform: none;">Back to cart</a>
        <?php endif; ?>
    </div>
  </section>

  <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/game/webmall/orderFail.blade.php ENDPATH**/ ?>