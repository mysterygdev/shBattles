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
  <section class="page-name parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Cart
      </h1>
      <div class="breadcrumbs">
        <a href="#">Home</a> /
        <a href="#">User</a> /
        <a href="#">WebMall</a> /
        <span class="color-1">Cart</span>
      </div>
    </div>
  </div>
  </section>
  <section class="team-bl ptb150">
        <div class="container">
            <div class="row">
                <div class="container-wrapper">
                    <div class="text-center">
                        <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
                            <p>Please login to continue.</p>
                        <?php else: ?>
                          <?php echo e($data['webmall']->initCart()); ?>

                          <?php if($data['webmall']->totalItems() > 0): ?>
                            <table class="table table-responsive">
                              <thead>
                                <tr>
                                  <th>Icon</th>
                                  <th>Product</th>
                                  <th>Cost</th>
                                  <th>Quantity</th>
                                  <th>Total</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $cartItems = $data['webmall']->contents(); ?>
                                <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <tr>
                                    <?php echo e($data['webmall']->getTags($item['tag'])); ?>

                                    <?php if($item['tag']): ?>
                                      <?php if(($item['tag'])=='ANew'): ?>
                                      <?php
                                        $item['tag'] ='New'
                                      ?>
                                      <?php endif; ?>
                                      <?php if(($item['tag'])=='ZHot'): ?>
                                      <?php
                                        $item['tag'] ='Hot'
                                      ?>
                                      <?php endif; ?>
                                      <td>
                                        <img src="/resources/themes/core/images/shop_icons/<?php echo e($item['image']); ?>" alt="" class="img-responsive img-border <?php echo e($item['tag']); ?>">
                                        <div class="img-special special-<?php echo e($item['tag']); ?>"><?php echo e($item['tag']); ?></div>
                                      </td>
                                    <?php else: ?>
                                      <td><img src="/resources/themes/core/images/shop_icons/<?php echo e($item['image']); ?>" alt="" class="img-responsive"></td>
                                    <?php endif; ?>
                                    <td><?php echo e($item['name']); ?></td>
						                        <td><?php echo e($item['price']); ?> DP</td>
                                    <td><input class="form-control" style="color:#000;" type="number" value="<?php echo e($item['qty']); ?>" onchange="updateCartItem(this, '<?php echo e($item['rowid']); ?>')"/></td>
                                    <td><?php echo e($item['subtotal']); ?></td>
                                    <td class="">
                                      <button class="btn btn-sm btn-danger" onclick="window.location.href='/webmall/cartAction?action=removeCartItem&id=<?php echo e($item['rowid']); ?>';">
                                      <i class="material-icons">delete</i></button>
                                    </td>
                                  </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </tbody>
                            </table>
                          <?php else: ?>
                            <?php if (\Illuminate\Support\Facades\Blade::check('auth')): ?>
                              <p>Your cart is empty.</p>
                              <p class="text-center">
                                <a class="btn btn-sm btn-dark" href="/webmall">Return to Webmall</a>
                              </p>
                            <?php else: ?>
                              <p>You need to login to view your cart.</p>
                            <?php endif; ?>
                          <?php endif; ?>
                          <?php if($data['webmall']->totalItems() > 0): ?>
                            <tr>
                              <td></td>
                              <td>
                                <a href="/webmall/checkout" class="btn gradient color-white">Checkout</a>
                              </td>
                              <td>
                                <a href="/webmall" class="btn gradient color-white">Continue Shopping</a>
                              </td>
                              <td><strong>Cart Total</strong></td>
                              <td class="text-right"><strong><?php echo e($data['webmall']->total()); ?> DP</strong></td>
                              <td></td>
                            </tr>
                          <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
	<?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ShaiyaCMS\resources\views/pages/cms/game/webmall/cart.blade.php ENDPATH**/ ?>