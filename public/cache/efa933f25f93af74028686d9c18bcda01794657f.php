<table class="table table-dark table-striped text-center">
  <thead style="border: hidden !important;">
    <tr style="border: hidden !important;">
      <th>Rank</th>
      <th>Guild Name</th>
      <th>Guild Leader</th>
      <th>Fact.</th>
    </tr>
  </thead>
  <tbody>
      <?php if(count($data['model']->getGuildRankings()) > 0): ?>
        <?php $__currentLoopData = $data['model']->getGuildRankings(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($fet->Rank); ?></td>
            <td><?php echo e($fet->GuildName); ?></td>
            <td><?php echo e($fet->MasterName); ?></td>
            <?php if($fet->Country == 0): ?>
              <td><img src="/resources/themes/core/images/icons/guildranking/aol.png" height="35" width="35"></td>
            <?php else: ?>
              <td><img src="/resources/themes/core/images/icons/guildranking/uof.png" height="35" width="35"></td>
            <?php endif; ?>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
        There are currently no guilds found.
      <?php endif; ?>
  </tbody>
</table>
<?php separator(20) ?>
<?php /**PATH C:\laragon\www\shaiyabattles\app\widgets\guildRankings\php/script.blade.php ENDPATH**/ ?>