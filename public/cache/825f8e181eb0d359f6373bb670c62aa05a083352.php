
<?php $__env->startSection('index', 'webmall'); ?>
<?php $__env->startSection('title', 'Webmall'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <section class="page-name parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Webmall
      </h1>
      <div class="breadcrumbs">
        <a href="#">Home</a> /
        <a href="#">User</a> /
        <span class="color-1">WebMall</span>
      </div>
    </div>
  </div>
  </section>
  <section class="ptb150">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 col-md-8 col-lg-8 col-sm-push-5 col-md-push-4 col-lg-push-4">
                    <div class="games-container">
                        <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
                            <p>Please login to continue.</p>
                        <?php else: ?>
                            <p>Your available PvP Points to spend:
                                <span class="fw_bold"><?php echo e($data['webmall']->getUserPoints()); ?></span>
                            </p>
                            <?php if(count($data['webmall']->getProducts()) > 0): ?>
                                <?php $__currentLoopData = $data['webmall']->getProducts(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="g-item col-lg-4 col-md-4 col-sm-4 col-xs-12 mb30 wow fadeInUp" data-wow-duration="1s">
                                        <form method="post" name="ItemSubmit" action="/webmall/cartAction?action=addToCart&id=<?php echo e($res->ProductID); ?>">
                                            <div class="bottom-container">
                                                <div class="text-center mt20">
                                                    <div class="float-left" style="margin-left:40%;">
                                                        <?php echo e($data['webmall']->getTags($res->Tag)); ?>

                                                        <?php if($res->Tag): ?>
                                                            <?php if(($res->Tag)=='ANew'): ?>
                                                                <?php
                                                                    $res->Tag ='New'
                                                                ?>
                                                            <?php endif; ?>
                                                            <?php if(($res->Tag)=='ZHot'): ?>
                                                                <?php
                                                                    $res->Tag ='Hot'
                                                                ?>
                                                            <?php endif; ?>
                                                            <img src="/resources/themes/core/images/shop_icons/<?php echo e($res->ProductImage); ?>" alt="" class="img-responsive img-border <?php echo e($res->Tag); ?>">
                                                            <div class="img-special special-<?php echo e($res->Tag); ?>"><?php echo e($res->Tag); ?></div>
                                                        <?php else: ?>
                                                            <img src="/resources/themes/core/images/shop_icons/<?php echo e($res->ProductImage); ?>" alt="" class="img-responsive">
                                                        <?php endif; ?>
                                                    </div>
                                                    <a href="#" class="name font-agency fweight-700 lheight-32 color-white" style="align: center;">
                                                        <?php echo e($res->ProductName); ?>

                                                    </a>
                                                    <div class="position mt666">
                                                        <span style="color:#AFA; padding-left: 30px; margin-top: 3%; font-size: 10pt;" class="float-left">
                                                            <?php echo e($res->ProductCost); ?>

                                                            <?php if(($res->ProductCost)==1): ?>
                                                            DP
                                                            <?php else: ?>
                                                            DPs
                                                            <?php endif; ?>
                                                        </span>
                                                        <div class="float-right" style="padding-right: 20px;">
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
                                                        </div>
                                                    </div><br>
                                                    <div class="social mt20">
                                                        <?php separator(40) ?>
                                                        <input type="submit" class="btn gradient color-white" value="Add to cart"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php echo $__env->make('pages.cms.game.webmall.partials.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </section>
	<?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ShaiyaCMS\resources\views/pages/cms/game/webmall/webmall.blade.php ENDPATH**/ ?>