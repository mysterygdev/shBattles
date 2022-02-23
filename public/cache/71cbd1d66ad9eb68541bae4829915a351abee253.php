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
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Manage products</h5>
                        </div>
                        <div class="card-body">
                          <!-- need paginator for other pages of products, maybe datatables?? homepage example?? -->
                          <table class="table table-striped" id="NewPlayers">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Cost</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Count</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>1</td>
                                <td>test</td>
                                <td>2</td>
                                <td>image</td>
                                <td>main</td>
                                <td>3</td>
                                <td><button type="submit" class="btn btn-sm btn-primary" name="submit">Edit</button></td>
                                <td><button type="submit" class="btn btn-sm btn-danger" name="submit">Remove</button></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
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

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/ap/webmall/manageProducts.blade.php ENDPATH**/ ?>