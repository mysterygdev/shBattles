<?php $__env->startSection('index', 'tickets'); ?>
<?php $__env->startSection('title', 'Tickets'); ?>
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
            <?php echo e(display('get_ticket_modal','','0','2','View Ticket')); ?>

              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Tickets</h5>
                        </div>
                        <div class="card-body">
                          <?php if(count($data['tickets']->getTickets()) > 0): ?>
                            <div class="table-responsive">
                              <table class="table table-dark">
                                <thead>
                                  <tr>
                                    <th>Ticket ID</th>
                                    <th>Category</th>
                                    <th>Account Name</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $__currentLoopData = $data['tickets']->getTickets(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                      <td><?php echo e($res->TicketID); ?></td>
                                      <td><?php echo e($res->Category); ?></td>
                                      <td><?php echo e($res->UserID); ?></td>
                                      <td><?php echo e($res->Subject); ?></td>
                                      <td><?php echo e($data['data']->convertTimeToDate('F d, Y', $res->Date)); ?></td>
                                      <td><button class="btn btn-sm btn-primary open_send_ticket_modal" data-toggle="modal"  data-id="<?php echo e($res->UserUID); ?>~<?php echo e($res->TicketID); ?>~<?php echo e($res->Type); ?>~<?php echo e($res->Status); ?>~<?php echo e($res->Category); ?>~<?php echo e($res->Subject); ?>~<?php echo e($res->Main); ?>~<?php echo e($_SESSION['User']['UserUID']); ?>" data-target="#get_ticket_modal">View</button></td>
                                    </tr>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                              </table>
                            </div>
                          <?php else: ?>
                            There are currently no tickets to edit.
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/ap/site/tickets.blade.php ENDPATH**/ ?>