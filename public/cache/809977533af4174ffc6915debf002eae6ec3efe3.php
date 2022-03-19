<?php $__env->startSection('index', 'manageDonations'); ?>
<?php $__env->startSection('title', 'Manage Donations'); ?>
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
                          <h5 class="">Manage donations</h5>
                          <div class="float-right">
                            <button type="button" class="btn btn-sm btn-primary"  onclick="window.open('/admin/paymentCenter/addDonation','_self')">Add New Donation</button>
                          </div>
                        </div>
                        <div class="card-body">
                          <!-- need paginator for other pages of products, maybe datatables?? homepage example?? -->
                          <?php if(count($data['donations']->getDonations()) > 0): ?>
                            <table class="table table-striped" id="NewPlayers">
                              <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>Reward</th>
                                  <th>Bonus</th>
                                  <th>Price</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $__currentLoopData = $data['donations']->getDonations(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <tr>
                                    <td><?php echo e($fet->RowID); ?></td>
                                    <td><?php echo e($fet->Reward); ?></td>
                                    <td><?php echo e(!empty($fet->Bonus) ? $fet->Bonus : 'N/A'); ?></td>
                                    <td><?php echo e($fet->Price); ?></td>
                                    <td><button type="button" class="btn btn-sm btn-primary" name="submit" onclick="window.open('/admin/paymentCenter/editDonation?id=<?php echo e($fet->RowID); ?>','_target')">Edit</button></td>
                                    <td><button type="submit" class="btn btn-sm btn-danger open_mD_rmv_modal" data-toggle="modal" data-id="<?php echo e($fet->RowID); ?>~<?php echo e($fet->Reward); ?>~<?php echo e($fet->Bonus); ?>~<?php echo e($fet->Price); ?>" data-target="#get_mD_rmv_modal">Remove</button></td>
                                  </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </tbody>
                            </table>
                          <?php else: ?>
                            There are currently no donation items.
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
  <?php echo e(display('get_mD_rmv_modal','','0','2','Confirm Donation Removal')); ?>

  <!-- Are you sure you want to remove this product? yes : no -->
  <script>
    $(document).on('click', '.open_mD_rmv_modal', function (e) {
      e.preventDefault();

      var uid = $(this).data("id");

          $("#get_mD_rmv_modal #dynamic-content").html("");
          $("#get_mD_rmv_modal #modal-loader").show();

      $.ajax({
        type: "POST",
        url: "/resources/jquery/addons/ajax/blade/init.donations_remove.php",
        data: "id="+uid,
        dataType: "html"
      })
      .done(function (data) {
        $('#get_mD_rmv_modal #dynamic-content').html('');
        $('#get_mD_rmv_modal #dynamic-content').hide().html(data).fadeIn("slow");
        $('#get_mD_rmv_modal #modal-loader').hide("slow");
      })
      .fail(function () {
        $("#get_mD_rmv_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
        $("#get_mD_rmv_modal #modal-loader").hide();
      });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/ap/paymentCenter/manageDonations.blade.php ENDPATH**/ ?>