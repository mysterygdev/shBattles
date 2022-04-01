<div class="col-lg-3 mb-20 align-center">
  <h2>Players Online</h2>
  <?php echo e($data['info']->playersOnline()); ?>

  <p class="text-center lead"><?php echo e($data['info']->pOnline); ?></p>
  <p class="text-center lead"><?php echo e($data['info']->AoL); ?> AOL & <?php echo e($data['info']->UoF); ?> UOF</p>
</div>
<div class="col-lg-3 mb-20 align-center">
  <h2>Server Time</h2>
  <p id="server-date" class="text-center lead"><?php echo e(date("d / m / Y", time())); ?></p>
  <p id="server-time" class="text-center lead"><?php echo e(date("H:i:s", time())); ?></p>
</div>
<div class="col-lg-3 mb-20 align-center">
  <h2>GRB Timer</h2>
  <?php if(date("j", strtotime('next sunday', time()) - time()) > 1): ?>
    <p id="grb-days" class="text-center lead"><?php echo e(date("j", strtotime('next sunday', time()) - time())); ?> days</p>
  <?php else: ?>
    <p id="grb-days" class="text-center lead"><?php echo e(date("j", strtotime('next sunday', time()) - time())); ?> day</p>
  <?php endif; ?>
  <p id="grb-time" class="text-center lead"><?php echo e(date("H:i:s", strtotime('next sunday 18:00:00', time()) - time())); ?></p>
</div>
<div class="col-lg-3 mb-20 align-center">
  <h2>Server Status</h2>
  <?php echo e($data['info']->serverStatus()); ?>

</div>
<?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/home/partials/data.blade.php ENDPATH**/ ?>