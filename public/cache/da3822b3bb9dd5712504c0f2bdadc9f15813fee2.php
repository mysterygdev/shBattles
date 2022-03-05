<?php $__env->startSection('index', 'guildRankings'); ?>
<?php $__env->startSection('title', 'Guild Rankings'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <div class="container-fluid">
    <div class="row">
      <header id="home">
        <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <h1>
          <img onload="this.style.opacity='1';" class="big-logo" src="/resources/themes/Originals/images/shaiya_titan_logo.png" alt="Dragonic big logo">
        </h1>
      </header>
    </div>
    <?php echo $__env->make('partials.cms.divider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <main>
      <section class="container">
        <div class="table-responsive">
          <table class="table table-sm table-dark table-striped text-center">
            <thead>
              <tr>
                <th>Rank</th>
                <th>Guild Name</th>
                <th>Guild Leader</th>
                <th>Members</th>
                <th>Points</th>
                <th>Faction</th>
              </tr>
            </thead>
            <tbody>
              <?php if(count($data['guildrankings']) > 0): ?>
                <?php $__currentLoopData = $data['guildrankings']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($fet->Rank); ?></td>
                    <td><?php echo e($fet->GuildName); ?></td>
                    <td><?php echo e($fet->MasterName); ?></td>
                    <td><?php echo e($fet->TotalCount); ?></td>
                    <td><?php echo e($fet->GuildPoint); ?></td>
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
        </div>
      </section>
    </main>
  </div>

    <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  
  <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\originals\resources\views/pages/cms/community/guildrankings.blade.php ENDPATH**/ ?>