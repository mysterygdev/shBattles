<?php $__env->startSection('index', 'rewards'); ?>
<?php $__env->startSection('title', 'Rewards'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>

      
    </div>

    <div class="container youplay-content text-center">
      <h2 class="mt-0">Rewards</h2>
      <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
        <p>Please login to continue.</p>
      <?php else: ?>
        <?php echo e(display('get_reward_modal','','0','2','Redeem Reward')); ?>

        <div class="table-responsive">
          <table class="table table-dark text-center">
            <thead>
              <tr>
                <th>Prize ID</th>
                <th>Kills Required</th>
                <th>Icon</th>
                <th>Reward</th>
                <th>Redeem</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $data['rewards']->getPvPRewards();

              ?>
              <?php $__currentLoopData = $data['rewards']->getRewards(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Reward): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($Reward->RewardID); ?></td>
                  <td><?php echo e($data['rewards']->getKillsReq($Reward->RewardID)); ?></td>
                  <td><div class="RankIcon RankIcon<?php echo e($Reward->RewardID); ?>"></div></td>
                  <td><?php echo e($Reward->Points); ?> DP</td>
                  <?php if($data['rewards']->k1 >=$data['rewards']->getKillsReq($Reward->RewardID)): ?>
                    <?php if(count($data['rewards']->validateKills($Reward->RewardID)) === 0): ?>
                      <td class="text-center"><button class="btn gradient color-white open_send_prize_modal" data-toggle="modal" data-id="<?php echo e($Reward->RewardID); ?>~<?php echo e($Reward->Points); ?> DP~<?php echo e($_SESSION['User']['UserUID']); ?>" data-target="#get_reward_modal">Redeem Prize</button></td>
                    <?php else: ?>
                      <td class="text-center">You already redeemed this Prize!</td>
                    <?php endif; ?>
                  <?php else: ?>
                    <td>You need more kills to redeem this Prize!</td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
  </section>
  <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/game/rewards.blade.php ENDPATH**/ ?>