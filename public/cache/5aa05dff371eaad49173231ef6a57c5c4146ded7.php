<?php $__env->startSection('index', 'payments'); ?>
<?php $__env->startSection('title', 'Payments'); ?>
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
                          <h5 class="">View Payments</h5>
                        </div>
                        <div class="card-body">
                          <?php if(count($data['payments']->getPayments()) > 0): ?>
                            <table class="table table-striped" id="Payments">
                              <thead>
                                <tr>
                                  <th>UserID</th>
                                  <th>Amount Paid</th>
                                  <th>Reward</th>
                                  <th>Email</th>
                                  <th>Payment Status</th>
                                  <th>Payment Type</th>
                                  <th>Payment Date</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $__currentLoopData = $data['payments']->getPayments(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <tr>
                                    <td><?php echo e($fet->UserID); ?></td>
                                    <td><?php echo e($fet->Paid); ?></td>
                                    <td><?php echo e($fet->Reward); ?></td>
                                    <td><?php echo e($fet->DonatorEmail); ?></td>
                                    <td><?php echo e(!empty($fet->PaymentStatus) ? $fet->PaymentStatus : 'NULL'); ?></td>
                                    <td><?php echo e(!empty($fet->PaymentType) ? $fet->PaymentType : 'NULL'); ?></td>
                                    <td><?php echo e($data['data']->convertTimeToDate('F d, Y h:i:s A', $fet->PaymentDate)); ?></td>
                                  </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </tbody>
                            </table>
                          <?php else: ?>
                            There are currently no posted payments.
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
  <script>
  $(document).ready(function(){
    $('#Payments').dataTable( {
      "searching": true,
			"info": false,
			"bLengthChange": false
    });
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/ap/paymentCenter/payments.blade.php ENDPATH**/ ?>