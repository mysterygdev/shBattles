<?php $__env->startSection('index', 'sendNotice'); ?>
<?php $__env->startSection('title', 'Add Product'); ?>
<?php $__env->startSection('zone', 'AP'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.ap.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('partials.ap.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="pcoded-main-container">
    <div class="pcoded-wrapper">
      <div class="pcoded-content">
        <div class="pcoded-inner-content">
          
          <?php if($data['user']->isAuthorized()): ?>
            
            <?php if($data['user']->isADM() || $data['user']->isGM() || $data['user']->isGMA()): ?>
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card">
                        <?php if(!isset($_GET['id'])): ?>
                          No product id specified.
                        <?php else: ?>
                          <?php if(!is_numeric($_GET['id'])): ?>
                            Product Id must be a numeric value.
                          <?php else: ?>
                            <?php if(count($data['editProduct']->getProductById($_GET['id'])) > 0): ?>
                              <div class="card-header text-center">
                                <h5>Editing product:
                                  <strong class="font-weight-bold"><?php echo e($data['editProduct']->getProductName($_GET['id'])); ?></strong>
                                </h5>
                              </div>
                              <div class="card-body">
                                ok
                              </div>
                              <!-- foreach -->
                            <?php else: ?>
                              <div class="card-header text-center">
                                Product doesn't exist.
                              </div>
                              <div class="card-body">
                                Product doesn't exist.
                              </div>
                            <?php endif; ?>
                          <?php endif; ?>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          <?php else: ?>
            <?php echo e(redirect('/admin/auth/login')); ?>

          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/ap/webmall/editProduct.blade.php ENDPATH**/ ?>