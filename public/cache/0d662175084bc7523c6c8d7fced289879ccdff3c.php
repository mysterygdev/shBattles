<?php $__env->startSection('index', 'guildRankings'); ?>
<?php $__env->startSection('title', 'Guild Rankings'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>

      <div class="info">
        <div>
          <div class="container">
            <h1>title</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="container youplay-content text-center">
      <h2 class="mt-0">Guild Rankings</h2>
      <table class="table table-responsive">
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

    <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/community/guildrankings.blade.php ENDPATH**/ ?>