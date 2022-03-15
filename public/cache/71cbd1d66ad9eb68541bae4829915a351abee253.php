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
                        <div class="card-header text-center">
                          <h5 class="">Manage products</h5>
                          <div class="float-right">
                            <button type="button" class="btn btn-sm btn-primary"  onclick="window.open('/admin/webmall/addProduct','_self')">Add New Product</button>
                          </div>
                        </div>
                        <div class="card-body">
                          <!-- need paginator for other pages of products, maybe datatables?? homepage example?? -->
                          <?php if(count($data['manageProducts']->getProducts()) > 0): ?>
                            <table class="table table-striped" id="NewPlayers">
                              <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>Name</th>
                                  <th>Cost</th>
                                  <th>Image</th>
                                  <th>Category</th>
                                  <th>Tag</th>
                                  
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $__currentLoopData = $data['manageProducts']->getProducts(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <tr>
                                    <td><?php echo e($fet->ProductID); ?></td>
                                    <td><?php echo e($fet->ProductName); ?></td>
                                    <td><?php echo e($fet->ProductCost); ?></td>
                                    <td><img src="/resources/themes/core/images/shop_icons/<?php echo e($fet->ProductImage); ?>.png"></td>
                                    <td><?php echo e(WEBMALL['categories'][$fet->Category]); ?></td>
                                    <td><?php echo e(WEBMALL['tags'][$fet->Tag]); ?></td>
                                    
                                    <td><button type="submit" class="btn btn-sm btn-primary" name="submit">Edit</button></td>
                                    <td><button type="submit" class="btn btn-sm btn-danger open_mp_rmv_modal" data-toggle="modal" data-id="<?php echo e($fet->ProductID); ?>~<?php echo e($fet->ProductName); ?>~<?php echo e($fet->ProductCode); ?>" data-target="#get_mP_rmv_modal">Remove</button></td>
                                  </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </tbody>
                            </table>
                          <?php else: ?>
                            no
                          <?php endif; ?>
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
  <?php echo e(display('get_mP_rmv_modal','','0','2','Confirm Product Removal')); ?>

  <!-- Are you sure you want to remove this product? yes : no -->
  <script>
    $(document).on('click', '.open_mp_rmv_modal', function (e) {
      e.preventDefault();

      var uid = $(this).data("id");

          $("#get_mP_rmv_modal #dynamic-content").html("");
          $("#get_mP_rmv_modal #modal-loader").show();

      $.ajax({
        type: "POST",
        url: "/resources/jquery/addons/ajax/blade/init.products_remove.php",
        data: "id="+uid,
        dataType: "html"
      })
      .done(function (data) {
        $('#get_mP_rmv_modal #dynamic-content').html('');
        $('#get_mP_rmv_modal #dynamic-content').hide().html(data).fadeIn("slow");
        $('#get_mP_rmv_modal #modal-loader').hide("slow");
      })
      .fail(function () {
        $("#get_mP_rmv_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
              $("#get_mP_rmv_modal #modal-loader").hide();
      });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/ap/webmall/manageProducts.blade.php ENDPATH**/ ?>