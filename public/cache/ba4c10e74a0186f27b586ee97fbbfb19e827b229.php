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

<?php $__env->startSection('index', 'checkout'); ?>
<?php $__env->startSection('title', 'Checkout'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>
    </div>

    <div class="container youplay-content text-center">
        <h2 class="mt-0">Review Order</h2>
        <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
          <p>Please login to continue.</p>
        <?php else: ?>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Icon</th>
                <th>Product</th>
                <th>Cost</th>
                <th>Quantity</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <?php $cartItems = $data['webmall']->contents(); ?>
              <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <?php echo e($data['webmall']->getTags($item['tag'])); ?>

                  <?php if($item['tag']): ?>
                    <td>
                      <img src="/resources/themes/core/images/shop_icons/<?php echo e($item['image']); ?>" alt="" class="img-responsive img-border <?php echo e($item['tag']); ?>">
                      <div class="img-special special-<?php echo e($item['tag']); ?>"><?php echo e($item['tag']); ?></div>
                    </td>
                  <?php else: ?>
                    <td><img src="/resources/themes/core/images/shop_icons/<?php echo e($item['image']); ?>" alt="" class="img-responsive"></td>
                  <?php endif; ?>
                  <td><?php echo e($item['name']); ?></td>
                  <td><?php echo e($item['price']); ?> DP</td>
                  <td><?php echo e($item['qty']); ?></td>
                  <td><?php echo e($item['subtotal']); ?></td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
          <?php if($data['webmall']->totalItems() > 0): ?>
            <tr>
              <td></td>
              <td>
                <a href="/game/webmall" class="custom_button" style="text-transform: none;">Back to webmall</a>
              </td>
              <td>
                <a href="/game/webmall/cart" class="custom_button" style="text-transform: none;">Edit cart</a>
              </td>
              <td>
                <p class="text-left">
                  <strong>Coupon code</strong>
                  <div class="col-md-3">
                    <div class="youplay-input">
                      <input type="text" name="couponCode" id="couponCode" placeholder="Coupon code">
                    </div>
                    <p id="responseCoupon"></p>
                    <button type="submit" class="btn btn-sm" name="couponSubmit" id="couponSubmit">Apply</button>
                  </div>
                </p>
                <p class="text-right">
                  <strong>Cart Total</strong>
                  <strong><?php echo e($data['webmall']->total()); ?> DP</strong>
                </p>
              </td>
              <td></td>
            </tr>
          <?php endif; ?>
          <br><br>
          <form method="post" action="/game/webmall/cartAction">
            <input type="hidden" name="action" value="placeOrder"/>
            <button type="submit" class="btn btn-md" name="checkoutSubmit">Place Order</button>
          </form>
        <?php endif; ?>
    </div>
  </section>

  <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <script>
    document.body.addEventListener("click", e => {
      if(e.target.closest("#couponSubmit")) {
        e.preventDefault();

        const code =  document.querySelector('input[name="couponCode"]').value;
        const response =  document.querySelector('#responseCoupon');

        fetch('/game/webmall/couponAdd', {
          method: 'post',
          mode: "same-origin",
          credentials: "same-origin",
          headers: {
              "Content-Type": "application/json"
          },
          body: JSON.stringify({
              code
          })
        })
        .then(r => r.text())
        .then(data => {
          var parser = new DOMParser();
          var doc = parser.parseFromString(data, "text/html");
          response.innerHTML = doc.documentElement.innerHTML;
          console.log(doc.documentElement.innerHTML);
        })
      }
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/game/webmall/checkout.blade.php ENDPATH**/ ?>