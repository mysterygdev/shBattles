<div class="table-responsive">
  <table class="table table-dark table-striped text-center">
    <thead>
      <tr>
        <th></th>
        <th>Character 1</th>
        <th>Character 2</th>
        <th>Character 3</th>
        <th>Character 4</th>
        <th>Character 5</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th>Character Name</th>
        <?php if($data['panel']->getCharacterCount() > 0): ?>
          <?php $__currentLoopData = $data['panel']->getData(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td><?php echo e($res->CharName); ?></td>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php for($i = $data['panel']->getCharacterCount(); $i < 5; $i++): ?>
            <td>Character is empty</td>
          <?php endfor; ?>
        <?php else: ?>
          <?php for($i = $data['panel']->getCharacterCount(); $i < 5; $i++): ?>
            <td>Character is empty</td>
          <?php endfor; ?>
        <?php endif; ?>
      </tr>
        <tr>
          <th>Level</th>
          <?php if($data['panel']->getCharacterCount() > 0): ?>
            <?php $__currentLoopData = $data['panel']->getData(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <td><?php echo e($res->Level); ?></td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php for($i = $data['panel']->getCharacterCount(); $i < 5; $i++): ?>
              <td>Character is empty</td>
            <?php endfor; ?>
          <?php else: ?>
            <?php for($i = $data['panel']->getCharacterCount(); $i < 5; $i++): ?>
              <td>Character is empty</td>
            <?php endfor; ?>
          <?php endif; ?>
        </tr>
        <tr>
          <th>Mode</th>
          <?php if($data['panel']->getCharacterCount() > 0): ?>
            <?php $__currentLoopData = $data['panel']->getData(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <td><?php echo e($res->Grow); ?></td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php for($i = $data['panel']->getCharacterCount(); $i < 5; $i++): ?>
              <td>Character is empty</td>
            <?php endfor; ?>
          <?php else: ?>
            <?php for($i = $data['panel']->getCharacterCount(); $i < 5; $i++): ?>
              <td>Character is empty</td>
            <?php endfor; ?>
          <?php endif; ?>
        </tr>
        <tr>
          <th>Class</th>
          <?php if($data['panel']->getCharacterCount() > 0): ?>
            <?php $__currentLoopData = $data['panel']->getData(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <td><?php echo e($data['user']->getClass($data['user']->getUserFaction($data['user']->UserUID), $res->Job)); ?></td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php for($i = $data['panel']->getCharacterCount(); $i < 5; $i++): ?>
              <td>Character is empty</td>
            <?php endfor; ?>
          <?php else: ?>
            <?php for($i = $data['panel']->getCharacterCount(); $i < 5; $i++): ?>
              <td>Character is empty</td>
            <?php endfor; ?>
          <?php endif; ?>
        </tr>
        <tr>
          <th>Map</th>
          <?php if($data['panel']->getCharacterCount() > 0): ?>
            <?php $__currentLoopData = $data['panel']->getData(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <td><?php echo e($data['user']->getMap($res->Map)); ?></td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php for($i = $data['panel']->getCharacterCount(); $i < 5; $i++): ?>
              <td>Character is empty</td>
            <?php endfor; ?>
          <?php else: ?>
            <?php for($i = $data['panel']->getCharacterCount(); $i < 5; $i++): ?>
              <td>Character is empty</td>
            <?php endfor; ?>
          <?php endif; ?>
        </tr>
        <tr>
          <th>Kills</th>
          <?php if($data['panel']->getCharacterCount() > 0): ?>
            <?php $__currentLoopData = $data['panel']->getData(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <td><?php echo e($res->K1); ?></td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php for($i = $data['panel']->getCharacterCount(); $i < 5; $i++): ?>
              <td>Character is empty</td>
            <?php endfor; ?>
          <?php else: ?>
            <?php for($i = $data['panel']->getCharacterCount(); $i < 5; $i++): ?>
              <td>Character is empty</td>
            <?php endfor; ?>
          <?php endif; ?>
        </tr>
        <tr>
          <th>Deaths</th>
          <?php if($data['panel']->getCharacterCount() > 0): ?>
            <?php $__currentLoopData = $data['panel']->getData(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <td><?php echo e($res->K2); ?></td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php for($i = $data['panel']->getCharacterCount(); $i < 5; $i++): ?>
              <td>Character is empty</td>
            <?php endfor; ?>
          <?php else: ?>
            <?php for($i = $data['panel']->getCharacterCount(); $i < 5; $i++): ?>
              <td>Character is empty</td>
            <?php endfor; ?>
          <?php endif; ?>
        </tr>
        <tr>
          <th>Login Status</th>
          <?php if($data['panel']->getCharacterCount() > 0): ?>
            <?php $__currentLoopData = $data['panel']->getData(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <td><?php echo e($data['user']->getLoginStatus($res->LoginStatus)); ?></td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php for($i = $data['panel']->getCharacterCount(); $i < 5; $i++): ?>
              <td>Character is empty</td>
            <?php endfor; ?>
          <?php else: ?>
            <?php for($i = $data['panel']->getCharacterCount(); $i < 5; $i++): ?>
              <td>Character is empty</td>
            <?php endfor; ?>
          <?php endif; ?>
      </tr>
    </tbody>
  </table>
</div>
<?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/user/panel/characters.blade.php ENDPATH**/ ?>