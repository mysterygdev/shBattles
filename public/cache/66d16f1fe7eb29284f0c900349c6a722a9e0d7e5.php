<?php $__env->startSection('index', 'managePvpRewards'); ?>
<?php $__env->startSection('title', 'Manage Rewards'); ?>
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
                          <h5 class="">Manage Rewards</h5>
                          <div class="float-right">
                            <button type="button" class="btn btn-sm btn-primary"  onclick="window.open('/admin/site/pvpRewards/addReward','_self')">Add New Reward</button>
                          </div>
                        </div>
                        <div class="card-body">
                          <?php if(count($data['rewards']->getRewards()) > 0): ?>
                            <table class="table table-striped" id="Payments">
                              <thead>
                                <tr>
                                  <th>RewardID</th>
                                  <th>RewardType</th>
                                  <th>Kills Required</th>
                                  <th>Points</th>
                                  <th>Action</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $__currentLoopData = $data['rewards']->getRewards(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <tr>
                                    <td><?php echo e($fet->RewardID); ?></td>
                                    <td><?php echo e($fet->RewardType); ?></td>
                                    <td><?php echo e($fet->K1Req); ?></td>
                                    <td><?php echo e($fet->Points); ?></td>
                                    <td><button type="button" class="btn btn-sm btn-primary" name="submit" onclick="window.open('/admin/site/pvpRewards/editReward/<?php echo e($fet->RewardID); ?>','_target')">Edit</button></td>
                                    <td><button type="submit" class="btn btn-sm btn-danger open_mR_rmv_modal" data-toggle="modal" data-id="<?php echo e($fet->RewardID); ?>~<?php echo e($fet->RewardType); ?>~<?php echo e($fet->K1Req); ?>~<?php echo e($fet->Points); ?>" data-target="#get_mR_rmv_modal">Remove</button></td>
                                  </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </tbody>
                            </table>
                          <?php else: ?>
                            There are currently no rewards.
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
  <?php echo e(display('get_mR_rmv_modal','','0','2','Confirm Reward Removal')); ?>

  <script>
  $(document).ready(function(){
    $('#Payments').dataTable( {
      "searching": true,
			"info": false,
			"bLengthChange": false
    });
	});
  $(document).on('click', '.open_mR_rmv_modal', function (e) {
      e.preventDefault();

      var uid = $(this).data("id");

          $("#get_mR_rmv_modal #dynamic-content").html("");
          $("#get_mR_rmv_modal #modal-loader").show();

      $.ajax({
        type: "POST",
        url: "/resources/jquery/addons/ajax/blade/init.pvpRewards_remove.php",
        data: "id="+uid,
        dataType: "html"
      })
      .done(function (data) {
        $('#get_mR_rmv_modal #dynamic-content').html('');
        $('#get_mR_rmv_modal #dynamic-content').hide().html(data).fadeIn("slow");
        $('#get_mR_rmv_modal #modal-loader').hide("slow");
      })
      .fail(function () {
        $("#get_mR_rmv_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
        $("#get_mR_rmv_modal #modal-loader").hide();
      });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/ap/site/pvpRewards/manageRewards.blade.php ENDPATH**/ ?>