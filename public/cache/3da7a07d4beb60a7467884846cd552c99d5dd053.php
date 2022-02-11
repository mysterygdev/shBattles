<?php $__env->startSection('index', 'tieredSpender'); ?>
<?php $__env->startSection('title', 'Tiered Spender'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <section class="page-name parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Tiered Spender
      </h1>
      <div class="breadcrumbs">
        <a href="#">Home</a> /
        <a href="#">User</a> /
        <a href="#">WebMall</a> /
        <span class="color-1">Tiered Spender</span>
      </div>
    </div>
  </div>
  </section>
  <section class="blog-content ptb150 each-element">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
          <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
            <p>Please login to continue.</p>
          <?php else: ?>
            <?php
              $data['tiered']->isUnlocked();
              $data['tiered']->isRedeemed();
              $data['tiered']->getRewardsProgress();
            ?>
            Total points spent: <?php echo e($data['tiered']->total); ?> DP
            <div class="ns_progress_container">
              <ul class="tiered_flex">
                <li class="fw_bold">DP:</li>
                <li><span>1000</span></li>
                <li><span>2000</span></li>
                <li><span>3000</span></li>
                <li><span>4000</span></li>
                <li><span>5000</span></li>
                <li><span>6000</span></li>
                <li><span>7000</span></li>
                <li><span>8000</span></li>
                <li><span>9000</span></li>
                <li><span>10000</span></li>
              </ul>
              <ul class="tiered_progress tiered_flex">
                <li class=""><div class="" style="width: 0%"></div> &nbsp;</li>
                <li class="Point1"><div class="" style="width: 0%"></div> &nbsp;</li>
                <li class="Point2"><div class="" style="width: 0%"></div> &nbsp;</li>
                <li class="Point3"><div class="" style="width: 0%"></div> &nbsp;</li>
                <li class="Point4"><div class="" style="width: 0%"></div> &nbsp;</li>
                <li class="Point5"><div class="" style="width: 0%"></div> &nbsp;</li>
                <li class="Point6"><div class="" style="width: 0%"></div> &nbsp;</li>
                <li class="Point7"><div class="" style="width: 0%"></div> &nbsp;</li>
                <li class="Point8"><div class="" style="width: 0%"></div> &nbsp;</li>
                <li class="Point9"><div class="" style="width: 0%"></div> &nbsp;</li>
                <li class="Point10"><div class="" style="width: 0%"></div> &nbsp;</li>
              </ul>
              <ul class="tiered_flex">
                <li class="fw_bold">Tier:</li>
                <li><span>1</span></li>
                <li><span>2</span></li>
                <li><span>3</span></li>
                <li><span>4</span></li>
                <li><span>5</span></li>
                <li><span>6</span></li>
                <li><span>7</span></li>
                <li><span>8</span></li>
                <li><span>9</span></li>
                <li><span>10</span></li>
              </ul>
            </div>
            <h5>Color Legend</h5>
            <div class="legend_container">
              <div class="color_legend">
                <div class="redeemed"></div>
                Tier Redeemed
              </div>
              <div class="color_legend">
                <div class="unlocked"></div>
                Tier Unlocked
              </div>
              <div class="color_legend">
                <div class="t_progress"></div>
                Rewards Progress
              </div>
            </div>
            <br>

            <div class="tabset">
              <input type="radio" name="tabset" id="tab1" aria-controls="tier1" checked>
              <label for="tab1">Tier 1</label>
              <input type="radio" name="tabset" id="tab2" aria-controls="tier2">
              <label for="tab2">Tier 2</label>
              <input type="radio" name="tabset" id="tab3" aria-controls="tier3">
              <label for="tab3">Tier 3</label>
              <input type="radio" name="tabset" id="tab4" aria-controls="tier4">
              <label for="tab4">Tier 4</label>
              <input type="radio" name="tabset" id="tab5" aria-controls="tier5">
              <label for="tab5">Tier 5</label>
              <input type="radio" name="tabset" id="tab6" aria-controls="tier6">
              <label for="tab6">Tier 6</label>
              <input type="radio" name="tabset" id="tab7" aria-controls="tier7">
              <label for="tab7">Tier 7</label>
              <input type="radio" name="tabset" id="tab8" aria-controls="tier8">
              <label for="tab8">Tier 8</label>
              <input type="radio" name="tabset" id="tab9" aria-controls="tier9">
              <label for="tab9">Tier 9</label>
              <input type="radio" name="tabset" id="tab10" aria-controls="tier10">
              <label for="tab10">Tier 10</label>

              <div class="tab-panels">
                <section id="tier1" class="tab-panel">
                  <?php if($data['tiered']->total > $data['tiered']->getPointArr()['Point1']): ?>
                    <h3>Tier <?php echo e($data['tiered']->getTier('Point1')); ?></h3>
                    <h5>Rewards:</h5>
                    <p id="tier1"></p>
                    <!-- if reward not redeemed, continue -->
                    <?php if($data['tiered']->hasUserRedeemedTier($data['tiered']->getTier('Point1')) < 1): ?>
                      <!-- If rewards exist, continue -->
                      <?php if(count($data['tiered']->getTierRewards($data['tiered']->getTier('Point1'))) > 0): ?>
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
                        There are currently no rewards for this tier.
                      <?php endif; ?>
                    <?php else: ?>
                      You have already redeemed the rewards for this tier.
                    <?php endif; ?>
                  <?php else: ?>
                    You don't have enough points to redeem this tier.
                  <?php endif; ?>
                </section>
                <section id="tier2" class="tab-panel">
                  <?php if($data['tiered']->total > $data['tiered']->getPointArr()['Point2']): ?>
                    <h3>Tier <?php echo e($data['tiered']->getTier('Point2')); ?></h3>
                    <h5>Rewards:</h5>
                    <p id="tier2"></p>
                    <!-- if reward not redeemed, continue -->
                    <?php if($data['tiered']->hasUserRedeemedTier($data['tiered']->getTier('Point2')) < 1): ?>
                      <!-- If rewards exist, continue -->
                      <?php if(count($data['tiered']->getTierRewards($data['tiered']->getTier('Point2'))) > 0): ?>
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
                        There are currently no rewards for this tier.
                      <?php endif; ?>
                    <?php else: ?>
                      You have already redeemed the rewards for this tier.
                    <?php endif; ?>
                  <?php else: ?>
                    You don't have enough points to redeem this tier.
                  <?php endif; ?>
                </section>
                <section id="tier3" class="tab-panel">
                  <?php if($data['tiered']->total > $data['tiered']->getPointArr()['Point3']): ?>
                    <h3>Tier <?php echo e($data['tiered']->getTier('Point3')); ?></h3>
                    <h5>Rewards:</h5>
                    <p id="tier3"></p>
                    <!-- if reward not redeemed, continue -->
                    <?php if($data['tiered']->hasUserRedeemedTier($data['tiered']->getTier('Point3')) < 1): ?>
                      <!-- If rewards exist, continue -->
                      <?php if(count($data['tiered']->getTierRewards($data['tiered']->getTier('Point3'))) > 0): ?>
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
                        There are currently no rewards for this tier.
                      <?php endif; ?>
                    <?php else: ?>
                      You have already redeemed the rewards for this tier.
                    <?php endif; ?>
                  <?php else: ?>
                    You don't have enough points to redeem this tier.
                  <?php endif; ?>
                </section>
                <section id="tier4" class="tab-panel">
                  <?php if($data['tiered']->total > $data['tiered']->getPointArr()['Point4']): ?>
                    <h3>Tier <?php echo e($data['tiered']->getTier('Point4')); ?></h3>
                    <h5>Rewards:</h5>
                    <p id="tier4"></p>
                    <!-- if reward not redeemed, continue -->
                    <?php if($data['tiered']->hasUserRedeemedTier($data['tiered']->getTier('Point4')) < 1): ?>
                      <!-- If rewards exist, continue -->
                      <?php if(count($data['tiered']->getTierRewards($data['tiered']->getTier('Point4'))) > 0): ?>
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
                        There are currently no rewards for this tier.
                      <?php endif; ?>
                    <?php else: ?>
                      You have already redeemed the rewards for this tier.
                    <?php endif; ?>
                  <?php else: ?>
                    You don't have enough points to redeem this tier.
                  <?php endif; ?>
                </section>
                <section id="tier5" class="tab-panel">
                  <?php if($data['tiered']->total > $data['tiered']->getPointArr()['Point5']): ?>
                    <h3>Tier <?php echo e($data['tiered']->getTier('Point5')); ?></h3>
                    <h5>Rewards:</h5>
                    <p id="tier5"></p>
                    <!-- if reward not redeemed, continue -->
                    <?php if($data['tiered']->hasUserRedeemedTier($data['tiered']->getTier('Point5')) < 1): ?>
                      <!-- If rewards exist, continue -->
                      <?php if(count($data['tiered']->getTierRewards($data['tiered']->getTier('Point5'))) > 0): ?>
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
                        There are currently no rewards for this tier.
                      <?php endif; ?>
                    <?php else: ?>
                      You have already redeemed the rewards for this tier.
                    <?php endif; ?>
                  <?php else: ?>
                    You don't have enough points to redeem this tier.
                  <?php endif; ?>
                </section>
                <section id="tier6" class="tab-panel">
                  <?php if($data['tiered']->total > $data['tiered']->getPointArr()['Point6']): ?>
                    <h3>Tier <?php echo e($data['tiered']->getTier('Point6')); ?></h3>
                    <h5>Rewards:</h5>
                    <p id="tier6"></p>
                    <!-- if reward not redeemed, continue -->
                    <?php if($data['tiered']->hasUserRedeemedTier($data['tiered']->getTier('Point6')) < 1): ?>
                      <!-- If rewards exist, continue -->
                      <?php if(count($data['tiered']->getTierRewards($data['tiered']->getTier('Point6'))) > 0): ?>
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
                        There are currently no rewards for this tier.
                      <?php endif; ?>
                    <?php else: ?>
                      You have already redeemed the rewards for this tier.
                    <?php endif; ?>
                  <?php else: ?>
                    You don't have enough points to redeem this tier.
                  <?php endif; ?>
                </section>
                <section id="tier7" class="tab-panel">
                  <?php if($data['tiered']->total > $data['tiered']->getPointArr()['Point7']): ?>
                    <h3>Tier <?php echo e($data['tiered']->getTier('Point7')); ?></h3>
                    <h5>Rewards:</h5>
                    <p id="tier7"></p>
                    <!-- if reward not redeemed, continue -->
                    <?php if($data['tiered']->hasUserRedeemedTier($data['tiered']->getTier('Point7')) < 1): ?>
                      <!-- If rewards exist, continue -->
                      <?php if(count($data['tiered']->getTierRewards($data['tiered']->getTier('Point7'))) > 0): ?>
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
                        There are currently no rewards for this tier.
                      <?php endif; ?>
                    <?php else: ?>
                      You have already redeemed the rewards for this tier.
                    <?php endif; ?>
                  <?php else: ?>
                    You don't have enough points to redeem this tier.
                  <?php endif; ?>
                </section>
                <section id="tier8" class="tab-panel">
                  <?php if($data['tiered']->total > $data['tiered']->getPointArr()['Point8']): ?>
                    <h3>Tier <?php echo e($data['tiered']->getTier('Point8')); ?></h3>
                    <h5>Rewards:</h5>
                    <p id="tier8"></p>
                    <!-- if reward not redeemed, continue -->
                    <?php if($data['tiered']->hasUserRedeemedTier($data['tiered']->getTier('Point8')) < 1): ?>
                      <!-- If rewards exist, continue -->
                      <?php if(count($data['tiered']->getTierRewards($data['tiered']->getTier('Point8'))) > 0): ?>
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
                        There are currently no rewards for this tier.
                      <?php endif; ?>
                    <?php else: ?>
                      You have already redeemed the rewards for this tier.
                    <?php endif; ?>
                  <?php else: ?>
                    You don't have enough points to redeem this tier.
                  <?php endif; ?>
                </section>
                <section id="tier9" class="tab-panel">
                  <?php if($data['tiered']->total > $data['tiered']->getPointArr()['Point9']): ?>
                    <h3>Tier <?php echo e($data['tiered']->getTier('Point9')); ?></h3>
                    <h5>Rewards:</h5>
                    <p id="tier9"></p>
                    <!-- if reward not redeemed, continue -->
                    <?php if($data['tiered']->hasUserRedeemedTier($data['tiered']->getTier('Point9')) < 1): ?>
                      <!-- If rewards exist, continue -->
                      <?php if(count($data['tiered']->getTierRewards($data['tiered']->getTier('Point9'))) > 0): ?>
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
                        There are currently no rewards for this tier.
                      <?php endif; ?>
                    <?php else: ?>
                      You have already redeemed the rewards for this tier.
                    <?php endif; ?>
                  <?php else: ?>
                    You don't have enough points to redeem this tier.
                  <?php endif; ?>
                </section>
                <section id="tier10" class="tab-panel">
                  <?php if($data['tiered']->total > $data['tiered']->getPointArr()['Point10']): ?>
                    <h3>Tier <?php echo e($data['tiered']->getTier('Point10')); ?></h3>
                    <h5>Rewards:</h5>
                    <p id="tier10"></p>
                    <!-- if reward not redeemed, continue -->
                    <?php if($data['tiered']->hasUserRedeemedTier($data['tiered']->getTier('Point10')) < 1): ?>
                      <!-- If rewards exist, continue -->
                      <?php if(count($data['tiered']->getTierRewards($data['tiered']->getTier('Point10'))) > 0): ?>
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
                        There are currently no rewards for this tier.
                      <?php endif; ?>
                    <?php else: ?>
                      You have already redeemed the rewards for this tier.
                    <?php endif; ?>
                  <?php else: ?>
                    You don't have enough points to redeem this tier.
                  <?php endif; ?>
                </section>
              </div>
            </div>
          <?php endif; ?>
        </div>
        <?php echo $__env->make('partials.cms.widgets', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div>
  </section>
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
	<?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ShaiyaCMS\resources\views/pages/cms/game/webmall/tieredspender.blade.php ENDPATH**/ ?>