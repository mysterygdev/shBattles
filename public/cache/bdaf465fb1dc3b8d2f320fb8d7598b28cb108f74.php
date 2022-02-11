<?php $__env->startSection('index', 'guildRankings'); ?>
<?php $__env->startSection('title', 'Guild Rankings'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <section class="page-name parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Guild Rankings
      </h1>
      <div class="breadcrumbs">
        <a href="#">Home</a> /
        <a href="#">Community</a> /
        <span class="color-1">Guild Rankings</span>
      </div>
    </div>
  </div>
  </section>
  <section class="blog-content ptb150 each-element">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
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
        <?php echo $__env->make('partials.cms.widgets', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div>
  </section>
	<?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ShaiyaCMS\resources\views/pages/cms/community/guildrankings.blade.php ENDPATH**/ ?>