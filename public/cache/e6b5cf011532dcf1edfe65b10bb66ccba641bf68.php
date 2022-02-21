<div class="table-responsive">
  <table class="table table-sm table-dark">
    <thead>
      <tr>
        <?php if($data['panel']->getDeadCharacterCount() > 0): ?>
          <?php
            $count = 1;
          ?>
          <th></th>
          <?php $__currentLoopData = $data['panel']->getDeadCharacters(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <th>Dead Character <?php echo e($count); ?></th>
            <?php
              $count++;
            ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          You don't have any dead characters.
        <?php endif; ?>
      </tr>
    </thead>
    <tbody>
      <?php if($data['panel']->getDeadCharacterCount() > 0): ?>
        <tr>
          <th>Character Name</th>
          <?php $__currentLoopData = $data['panel']->getDeadCharacters(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td><?php echo e($res->CharName); ?></td>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
        <tr>
          <th>Slot</th>
          <?php $__currentLoopData = $data['panel']->getDeadCharacters(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td><?php echo e($res->Slot); ?></td>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
        <tr>
          <th>Level</th>
          <?php $__currentLoopData = $data['panel']->getDeadCharacters(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td><?php echo e($res->Level); ?></td>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
        <tr>
          <th>Mode</th>
          <?php $__currentLoopData = $data['panel']->getDeadCharacters(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td><?php echo e($res->Grow); ?></td>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
        <tr>
          <th>Class</th>
          <?php $__currentLoopData = $data['panel']->getDeadCharacters(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td><?php echo e($data['user']->getClass($data['user']->getUserFaction($data['user']->UserUID), $res->Job)); ?></td>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
        <tr>
          <th>Map</th>
          <?php $__currentLoopData = $data['panel']->getDeadCharacters(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td><?php echo e($data['user']->getMap($res->Map)); ?></td>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
        <tr>
          <th>Kills</th>
          <?php $__currentLoopData = $data['panel']->getDeadCharacters(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td><?php echo e($res->K1); ?></td>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
        <tr>
          <th>Deaths</th>
          <?php $__currentLoopData = $data['panel']->getDeadCharacters(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td><?php echo e($res->K2); ?></td>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
        <tr>
          <?php echo e(display('get_res_modal','','0','2','Resurrect Character')); ?>

          <th></th>
          <?php $__currentLoopData = $data['panel']->getDeadCharacters(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td><button class="btn gradient color-white color-white" id="res_btn" data-toggle="modal" data-id="<?php echo e($res->CharID); ?>~<?php echo e($res->CharName); ?>" data-target="#get_res_modal">Resurrect</button></td>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
<?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/user/panel/resurrect.blade.php ENDPATH**/ ?>