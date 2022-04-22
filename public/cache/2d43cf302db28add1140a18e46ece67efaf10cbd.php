<div id="rankingsData"></div>
    <?php if(count($data) > 0): ?>
      <div class="table-responsive">
        <table class="table table-sm table-dark text-center">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              
              
              
              <th>Guild</th>
              <th>Kills</th>
              
              
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $data['users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $data['rankNum']++;
                //$getRank = $data['rank']->get_Rank($rankings->K1);
                $chars = $data['rank']->getChars($user->UserUID);
              ?>
              <tr style="display: table-row;">
                <?php if(count($data['rank']->getChars($user->UserUID)) > 0): ?>
                  
                  <td><?php echo e($data['rankNum']); ?></td>
                  <td><?php echo e($data['rank']->getChars($user->UserUID)[0]->CharName); ?><div class="arrow" data-toggle="collapse" data-target="#_<?php echo e($user->UserUID); ?>"></div></td>
                  <td><?php echo e($data['guild']->getGuildNameByCharName($data['rank']->getChars($user->UserUID)[0]->CharName)); ?></td>
                  <td><?php echo e($data['rank']->getChars($user->UserUID)[0]->K1); ?></td>
                <?php endif; ?>
              </tr>
                <?php for($x = 0; $x < count($data['rank']->getChars($user->UserUID)); $x++): ?>
                  <tr id="_<?php echo e($user->UserUID); ?>" class="panel-collapse collapse">
                    <td></td>
                    <td><?php echo e($data['rank']->getChars($user->UserUID)[$x]->CharName); ?></td>
                    <td>1</td>
                    <td>1</td>
                  </tr>
                <?php endfor; ?>
                  
              
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
        <p>No Rankings found. Please check back later.</p>
    <?php endif; ?>
<?php /**PATH C:\laragon\www\shaiyabattles\resources\views/fetch/cms/rankings/rankings.blade.php ENDPATH**/ ?>