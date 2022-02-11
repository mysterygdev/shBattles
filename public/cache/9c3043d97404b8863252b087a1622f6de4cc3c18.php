<?php $__env->startSection('index', 'rewards'); ?>
<?php $__env->startSection('title', 'Rewards'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <section class="page-name parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Rewards
      </h1>
      <div class="breadcrumbs">
        <a href="#">Home</a> /
        <a href="#">User</a> /
        <span class="color-1">Rewards</span>
      </div>
    </div>
  </div>
  </section>
  <?php echo e(display('get_reward_modal','','0','2','Redeem Reward')); ?>

  <section class="blog-content ptb150 each-element">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
          <div class="title-bl text-center wow fadeIn" data-wow-duration="2s">
            <div class="title color-white">
              PvP Rewards
            </div>
          </div>
            <div class="text-center">
              <?php if(!$data['user']->LoginStatus==true): ?>
                <p>Please login to continue.</p>
              <?php else: ?>
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
                        $index=1;
                      ?>
                      <?php $__currentLoopData = $data['rewards']->Rewards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Reward): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($index); ?></td>
                          <td><?php echo e($data['rewards']->Kills['K'.$index]); ?></td>
                          <td><div class="RankIcon RankIcon<?php echo e($index); ?>"></div></td>
                          <td><?php echo e($Reward); ?></td>
                          <?php if($data['rewards']->k1 >=$data['rewards']->Kills['K'.$index]): ?>
                            <?php
                              $data['rewards']->validateKills($index);
                            ?>
                            <?php if($data['rewards']->rowCount==0): ?>
                              <td class="text-center"><button class="btn gradient color-white open_send_prize_modal" data-toggle="modal" data-id="<?php echo e($index); ?>~<?php echo e($Reward); ?>~<?php echo e($_SESSION['User']['UserUID']); ?>" data-target="#get_reward_modal">Redeem Prize</button></td>
                            <?php else: ?>
                              <td class="tac">You already redeemed this Prize!</td>
                            <?php endif; ?>
                          <?php else: ?>
                            <td>You need more kills to redeem this Prize!</td>
                          <?php endif; ?>
                        </tr>
                        <?php $index++; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              <?php endif; ?>
            </div>
        </div>
        <?php echo $__env->make('partials.cms.widgets', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div>
  </section>
	<?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ShaiyaCMS\resources\views/pages/cms/user/rewards.blade.php ENDPATH**/ ?>