<?php $__env->startSection('index', 'tieredSpender'); ?>
<?php $__env->startSection('title', 'Tiered Spender'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>
    </div>

    <div class="container youplay-content text-center">
        <h2 class="mt-0">Tiered Spender</h2>
        
        <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
          <p>Please login to continue.</p>
        <?php else: ?>
          <?php
            $data['tiered']->isUnlocked();
            $data['tiered']->isRedeemed();
            $data['tiered']->getRewardsProgress();
          ?>
          Total points spent: <?php echo e($data['tiered']->total); ?> DP
          <!-- Legend and Progress -->
          <?php echo $__env->make('pages.cms.game.webmall.tieredSpender.menu.progress', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <br>
          <div class="tabset">
            <!-- Menu/Navigation -->
            <?php echo $__env->make('pages.cms.game.webmall.tieredSpender.menu.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="tab-panels">
              <section id="tier1" class="tab-panel">
                <!-- If rewards exist, continue -->
                <?php if(count($data['tiered']->getTierRewards($data['tiered']->getTier('Point1'))) > 0): ?>
                  <!-- If user has enough points, continue -->
                  <?php if($data['tiered']->total > $data['tiered']->getPointArr()['Point1']): ?>
                    <!-- if reward not redeemed, continue -->
                    <?php if($data['tiered']->hasUserRedeemedTier($data['tiered']->getTier('Point1')) < 1): ?>
                      <h3>Tier <?php echo e($data['tiered']->getTier('Point1')); ?></h3>
                      <h5>Rewards:</h5>
                      <p id="tier1"></p>
                      <?php $__currentLoopData = $data['tiered']->getTierRewards($data['tiered']->getTier('Point1')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="reward">
                          <img class="reward-img" src="/resources/themes/core/images/shop_icons/<?php echo e($res->RewardImage); ?>">
                          <p class="reward-title"><?php echo e($res->RewardQuantity); ?>x <?php echo e($res->RewardName); ?></p>
                          <p class="reward-desc"><?php echo e($res->RewardDesc); ?></p>
                        </div>
                        <?php separator(20) ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <div class="col-sm-3"></div>
                      <div class="col-sm-6">
                        <button class="btn gradient mt30 color-white plr50 ptb19 btn-sm open_send_reward_modal" id="submit" data-id="1">Recieve Rewards</button>
                      </div>
                    <?php else: ?>
                      You have already redeemed the rewards for this tier.
                    <?php endif; ?>
                  <?php else: ?>
                    You don't have enough points to redeem this tier.
                  <?php endif; ?>
                <?php else: ?>
                  There are currently no rewards for this tier.
                <?php endif; ?>
              </section>
              <section id="tier2" class="tab-panel">
                <!-- If rewards exist, continue -->
                <?php if(count($data['tiered']->getTierRewards($data['tiered']->getTier('Point2'))) > 0): ?>
                  <!-- If user has enough points, continue -->
                  <?php if($data['tiered']->total > $data['tiered']->getPointArr()['Point2']): ?>
                    <!-- if reward not redeemed, continue -->
                    <?php if($data['tiered']->hasUserRedeemedTier($data['tiered']->getTier('Point2')) < 1): ?>
                      <h3>Tier <?php echo e($data['tiered']->getTier('Point2')); ?></h3>
                      <h5>Rewards:</h5>
                      <p id="tier2"></p>
                      <?php $__currentLoopData = $data['tiered']->getTierRewards($data['tiered']->getTier('Point2')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="reward">
                          <img class="reward-img" src="/resources/themes/core/images/shop_icons/<?php echo e($res->RewardImage); ?>">
                          <p class="reward-title"><?php echo e($res->RewardQuantity); ?>x <?php echo e($res->RewardName); ?></p>
                          <p class="reward-desc"><?php echo e($res->RewardDesc); ?></p>
                        </div>
                        <?php separator(20) ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <div class="col-sm-3"></div>
                      <div class="col-sm-6">
                        <button class="btn gradient mt30 color-white plr50 ptb19 btn-sm open_send_reward_modal" id="submit" data-id="2">Recieve Rewards</button>
                      </div>
                    <?php else: ?>
                      You have already redeemed the rewards for this tier.
                    <?php endif; ?>
                  <?php else: ?>
                    You don't have enough points to redeem this tier.
                  <?php endif; ?>
                <?php else: ?>
                  There are currently no rewards for this tier.
                <?php endif; ?>
              </section>
              <section id="tier3" class="tab-panel">
                <!-- If rewards exist, continue -->
                <?php if(count($data['tiered']->getTierRewards($data['tiered']->getTier('Point3'))) > 0): ?>
                  <!-- If user has enough points, continue -->
                  <?php if($data['tiered']->total > $data['tiered']->getPointArr()['Point3']): ?>
                    <!-- if reward not redeemed, continue -->
                    <?php if($data['tiered']->hasUserRedeemedTier($data['tiered']->getTier('Point3')) < 1): ?>
                      <h3>Tier <?php echo e($data['tiered']->getTier('Point3')); ?></h3>
                      <h5>Rewards:</h5>
                      <p id="tier3"></p>
                      <?php $__currentLoopData = $data['tiered']->getTierRewards($data['tiered']->getTier('Point3')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="reward">
                          <img class="reward-img" src="/resources/themes/core/images/shop_icons/<?php echo e($res->RewardImage); ?>">
                          <p class="reward-title"><?php echo e($res->RewardQuantity); ?>x <?php echo e($res->RewardName); ?></p>
                          <p class="reward-desc"><?php echo e($res->RewardDesc); ?></p>
                        </div>
                        <?php separator(20) ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <div class="col-sm-3"></div>
                      <div class="col-sm-6">
                        <button class="btn gradient mt30 color-white plr50 ptb19 btn-sm open_send_reward_modal" id="submit" data-id="3">Recieve Rewards</button>
                      </div>
                    <?php else: ?>
                      You have already redeemed the rewards for this tier.
                    <?php endif; ?>
                  <?php else: ?>
                    You don't have enough points to redeem this tier.
                  <?php endif; ?>
                <?php else: ?>
                  There are currently no rewards for this tier.
                <?php endif; ?>
              </section>
              <section id="tier4" class="tab-panel">
                <!-- If rewards exist, continue -->
                <?php if(count($data['tiered']->getTierRewards($data['tiered']->getTier('Point4'))) > 0): ?>
                  <!-- If user has enough points, continue -->
                  <?php if($data['tiered']->total > $data['tiered']->getPointArr()['Point4']): ?>
                    <!-- if reward not redeemed, continue -->
                    <?php if($data['tiered']->hasUserRedeemedTier($data['tiered']->getTier('Point4')) < 1): ?>
                      <h3>Tier <?php echo e($data['tiered']->getTier('Point4')); ?></h3>
                      <h5>Rewards:</h5>
                      <p id="tier4"></p>
                      <?php $__currentLoopData = $data['tiered']->getTierRewards($data['tiered']->getTier('Point4')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="reward">
                          <img class="reward-img" src="/resources/themes/core/images/shop_icons/<?php echo e($res->RewardImage); ?>">
                          <p class="reward-title"><?php echo e($res->RewardQuantity); ?>x <?php echo e($res->RewardName); ?></p>
                          <p class="reward-desc"><?php echo e($res->RewardDesc); ?></p>
                        </div>
                        <?php separator(20) ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <div class="col-sm-3"></div>
                      <div class="col-sm-6">
                        <button class="btn gradient mt30 color-white plr50 ptb19 btn-sm open_send_reward_modal" id="submit" data-id="4">Recieve Rewards</button>
                      </div>
                    <?php else: ?>
                      You have already redeemed the rewards for this tier.
                    <?php endif; ?>
                  <?php else: ?>
                    You don't have enough points to redeem this tier.
                  <?php endif; ?>
                <?php else: ?>
                  There are currently no rewards for this tier.
                <?php endif; ?>
              </section>
              <section id="tier5" class="tab-panel">
                <!-- If rewards exist, continue -->
                <?php if(count($data['tiered']->getTierRewards($data['tiered']->getTier('Point5'))) > 0): ?>
                  <!-- If user has enough points, continue -->
                  <?php if($data['tiered']->total > $data['tiered']->getPointArr()['Point5']): ?>
                    <!-- if reward not redeemed, continue -->
                    <?php if($data['tiered']->hasUserRedeemedTier($data['tiered']->getTier('Point5')) < 1): ?>
                      <h3>Tier <?php echo e($data['tiered']->getTier('Point5')); ?></h3>
                      <h5>Rewards:</h5>
                      <p id="tier5"></p>
                      <?php $__currentLoopData = $data['tiered']->getTierRewards($data['tiered']->getTier('Point5')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="reward">
                          <img class="reward-img" src="/resources/themes/core/images/shop_icons/<?php echo e($res->RewardImage); ?>">
                          <p class="reward-title"><?php echo e($res->RewardQuantity); ?>x <?php echo e($res->RewardName); ?></p>
                          <p class="reward-desc"><?php echo e($res->RewardDesc); ?></p>
                        </div>
                        <?php separator(20) ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <div class="col-sm-3"></div>
                      <div class="col-sm-6">
                        <button class="btn gradient mt30 color-white plr50 ptb19 btn-sm open_send_reward_modal" id="submit" data-id="5">Recieve Rewards</button>
                      </div>
                    <?php else: ?>
                      You have already redeemed the rewards for this tier.
                    <?php endif; ?>
                  <?php else: ?>
                    You don't have enough points to redeem this tier.
                  <?php endif; ?>
                <?php else: ?>
                  There are currently no rewards for this tier.
                <?php endif; ?>
              </section>
              <section id="tier6" class="tab-panel">
                <!-- If rewards exist, continue -->
                <?php if(count($data['tiered']->getTierRewards($data['tiered']->getTier('Point6'))) > 0): ?>
                  <!-- If user has enough points, continue -->
                  <?php if($data['tiered']->total > $data['tiered']->getPointArr()['Point6']): ?>
                    <!-- if reward not redeemed, continue -->
                    <?php if($data['tiered']->hasUserRedeemedTier($data['tiered']->getTier('Point6')) < 1): ?>
                      <h3>Tier <?php echo e($data['tiered']->getTier('Point6')); ?></h3>
                      <h5>Rewards:</h5>
                      <p id="tier6"></p>
                      <?php $__currentLoopData = $data['tiered']->getTierRewards($data['tiered']->getTier('Point6')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="reward">
                          <img class="reward-img" src="/resources/themes/core/images/shop_icons/<?php echo e($res->RewardImage); ?>">
                          <p class="reward-title"><?php echo e($res->RewardQuantity); ?>x <?php echo e($res->RewardName); ?></p>
                          <p class="reward-desc"><?php echo e($res->RewardDesc); ?></p>
                        </div>
                        <?php separator(20) ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <div class="col-sm-3"></div>
                      <div class="col-sm-6">
                        <button class="btn gradient mt30 color-white plr50 ptb19 btn-sm open_send_reward_modal" id="submit" data-id="6">Recieve Rewards</button>
                      </div>
                    <?php else: ?>
                      You have already redeemed the rewards for this tier.
                    <?php endif; ?>
                  <?php else: ?>
                    You don't have enough points to redeem this tier.
                  <?php endif; ?>
                <?php else: ?>
                  There are currently no rewards for this tier.
                <?php endif; ?>
              </section>
              <section id="tier7" class="tab-panel">
                <!-- If rewards exist, continue -->
                <?php if(count($data['tiered']->getTierRewards($data['tiered']->getTier('Point7'))) > 0): ?>
                  <!-- If user has enough points, continue -->
                  <?php if($data['tiered']->total > $data['tiered']->getPointArr()['Point7']): ?>
                    <!-- if reward not redeemed, continue -->
                    <?php if($data['tiered']->hasUserRedeemedTier($data['tiered']->getTier('Point7')) < 1): ?>
                      <h3>Tier <?php echo e($data['tiered']->getTier('Point7')); ?></h3>
                      <h5>Rewards:</h5>
                      <p id="tier7"></p>
                      <?php $__currentLoopData = $data['tiered']->getTierRewards($data['tiered']->getTier('Point7')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="reward">
                          <img class="reward-img" src="/resources/themes/core/images/shop_icons/<?php echo e($res->RewardImage); ?>">
                          <p class="reward-title"><?php echo e($res->RewardQuantity); ?>x <?php echo e($res->RewardName); ?></p>
                          <p class="reward-desc"><?php echo e($res->RewardDesc); ?></p>
                        </div>
                        <?php separator(20) ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <div class="col-sm-3"></div>
                      <div class="col-sm-6">
                        <button class="btn gradient mt30 color-white plr50 ptb19 btn-sm open_send_reward_modal" id="submit" data-id="7">Recieve Rewards</button>
                      </div>
                    <?php else: ?>
                      You have already redeemed the rewards for this tier.
                    <?php endif; ?>
                  <?php else: ?>
                    You don't have enough points to redeem this tier.
                  <?php endif; ?>
                <?php else: ?>
                  There are currently no rewards for this tier.
                <?php endif; ?>
              </section>
              <section id="tier8" class="tab-panel">
                <!-- If rewards exist, continue -->
                <?php if(count($data['tiered']->getTierRewards($data['tiered']->getTier('Point8'))) > 0): ?>
                  <!-- If user has enough points, continue -->
                  <?php if($data['tiered']->total > $data['tiered']->getPointArr()['Point8']): ?>
                    <!-- if reward not redeemed, continue -->
                    <?php if($data['tiered']->hasUserRedeemedTier($data['tiered']->getTier('Point8')) < 1): ?>
                      <h3>Tier <?php echo e($data['tiered']->getTier('Point8')); ?></h3>
                      <h5>Rewards:</h5>
                      <p id="tier8"></p>
                      <?php $__currentLoopData = $data['tiered']->getTierRewards($data['tiered']->getTier('Point8')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="reward">
                          <img class="reward-img" src="/resources/themes/core/images/shop_icons/<?php echo e($res->RewardImage); ?>">
                          <p class="reward-title"><?php echo e($res->RewardQuantity); ?>x <?php echo e($res->RewardName); ?></p>
                          <p class="reward-desc"><?php echo e($res->RewardDesc); ?></p>
                        </div>
                        <?php separator(20) ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <div class="col-sm-3"></div>
                      <div class="col-sm-6">
                        <button class="btn gradient mt30 color-white plr50 ptb19 btn-sm open_send_reward_modal" id="submit" data-id="8">Recieve Rewards</button>
                      </div>
                    <?php else: ?>
                      You have already redeemed the rewards for this tier.
                    <?php endif; ?>
                  <?php else: ?>
                    You don't have enough points to redeem this tier.
                  <?php endif; ?>
                <?php else: ?>
                  There are currently no rewards for this tier.
                <?php endif; ?>
              </section>
              <section id="tier9" class="tab-panel">
                <!-- If rewards exist, continue -->
                <?php if(count($data['tiered']->getTierRewards($data['tiered']->getTier('Point9'))) > 0): ?>
                  <!-- If user has enough points, continue -->
                  <?php if($data['tiered']->total > $data['tiered']->getPointArr()['Point9']): ?>
                    <!-- if reward not redeemed, continue -->
                    <?php if($data['tiered']->hasUserRedeemedTier($data['tiered']->getTier('Point9')) < 1): ?>
                      <h3>Tier <?php echo e($data['tiered']->getTier('Point9')); ?></h3>
                      <h5>Rewards:</h5>
                      <p id="tier9"></p>
                      <?php $__currentLoopData = $data['tiered']->getTierRewards($data['tiered']->getTier('Point9')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="reward">
                          <img class="reward-img" src="/resources/themes/core/images/shop_icons/<?php echo e($res->RewardImage); ?>">
                          <p class="reward-title"><?php echo e($res->RewardQuantity); ?>x <?php echo e($res->RewardName); ?></p>
                          <p class="reward-desc"><?php echo e($res->RewardDesc); ?></p>
                        </div>
                        <?php separator(20) ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <div class="col-sm-3"></div>
                      <div class="col-sm-6">
                        <button class="btn gradient mt30 color-white plr50 ptb19 btn-sm open_send_reward_modal" id="submit" data-id="9">Recieve Rewards</button>
                      </div>
                    <?php else: ?>
                      You have already redeemed the rewards for this tier.
                    <?php endif; ?>
                  <?php else: ?>
                    You don't have enough points to redeem this tier.
                  <?php endif; ?>
                <?php else: ?>
                  There are currently no rewards for this tier.
                <?php endif; ?>
              </section>
              <section id="tier10" class="tab-panel">
                <!-- If rewards exist, continue -->
                <?php if(count($data['tiered']->getTierRewards($data['tiered']->getTier('Point10'))) > 0): ?>
                  <!-- If user has enough points, continue -->
                  <?php if($data['tiered']->total > $data['tiered']->getPointArr()['Point10']): ?>
                    <!-- if reward not redeemed, continue -->
                    <?php if($data['tiered']->hasUserRedeemedTier($data['tiered']->getTier('Point10')) < 1): ?>
                      <h3>Tier <?php echo e($data['tiered']->getTier('Point10')); ?></h3>
                      <h5>Rewards:</h5>
                      <p id="tier10"></p>
                      <?php $__currentLoopData = $data['tiered']->getTierRewards($data['tiered']->getTier('Point10')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="reward">
                          <img class="reward-img" src="/resources/themes/core/images/shop_icons/<?php echo e($res->RewardImage); ?>">
                          <p class="reward-title"><?php echo e($res->RewardQuantity); ?>x <?php echo e($res->RewardName); ?></p>
                          <p class="reward-desc"><?php echo e($res->RewardDesc); ?></p>
                        </div>
                        <?php separator(20) ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <div class="col-sm-3"></div>
                      <div class="col-sm-6">
                        <button class="btn gradient mt30 color-white plr50 ptb19 btn-sm open_send_reward_modal" id="submit" data-id="10">Recieve Rewards</button>
                      </div>
                    <?php else: ?>
                      You have already redeemed the rewards for this tier.
                    <?php endif; ?>
                  <?php else: ?>
                    You don't have enough points to redeem this tier.
                  <?php endif; ?>
                <?php else: ?>
                  There are currently no rewards for this tier.
                <?php endif; ?>
              </section>
            </div>
          </div>
        <?php endif; ?>
    </div>
  </section>
  <?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('layouts.cms.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <script>
    $(document).ready(function(){
        $("button#submit").click(function(e){
          e.preventDefault();

          let tier             = $(this).data("id");

          $.ajax(
                {
                    url: '/resources/jquery/addons/ajax/site/tieredSpender/tiered.submit.php',
                    method: 'POST',
                    data: {
                        sent: 1,
                        tier: tier
                    },
                    success: function(response) {
                        $("#tier"+tier).prepend(response);
                    },
                    dataType: 'text'
                }
            )
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/game/webmall/tieredSpender/tieredspender.blade.php ENDPATH**/ ?>