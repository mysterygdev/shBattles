<?php $__env->startSection('index', 'addTierRewards'); ?>
<?php $__env->startSection('title', 'Add Rewards'); ?>
<?php $__env->startSection('zone', 'AP'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.ap.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('partials.ap.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="pcoded-main-container">
    <div class="pcoded-wrapper">
      <div class="pcoded-content">
        <div class="pcoded-inner-content">
          
          <?php if($data['user']->isAuthorized()): ?>
            
            <?php if($data['user']->isADM() || $data['user']->isGM() || $data['user']->isGMA()): ?>
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card">
                        <div class="card-header text-center">
                          <h5 class="">Add new reward</h5>
                          <div class="float-right">
                            <button type="button" class="btn btn-sm btn-primary"  onclick="window.open('/admin/site/tieredSpender/manageRewards','_self')">Manage Rewards</button>
                          </div>
                        </div>
                        <div class="card-body">
                          <p>First select an image, and then fill out the rest of the information.</p>
                          <form method="post">
                            <?php echo e($data['rewards']->loadImages()); ?>

                            <p id="response"></p>
                            <div class="form-group">
                              <label for="RewardName">Reward Name</label>
                              <input type="text" class="form-control" id="RewardName" name="RewardName" placeholder="Enter Reward Name">
                              <small id="RewardName" class="form-text text-muted">Reward Name</small>
                            </div>
                            <div class="form-group">
                              <label for="RewardDesc">Reward Desc</label>
                              <input type="text" class="form-control" id="RewardDesc" name="RewardDesc" placeholder="Enter Reward Desc">
                              <small id="RewardDesc" class="form-text text-muted">Reward Desc</small>
                            </div>
                            <div class="form-group">
                              <label for="RewardItemID">Reward Item ID</label>
                              <input type="text" class="form-control" id="RewardItemID" name="RewardItemID" placeholder="Enter Reward Item ID">
                              <small id="RewardItemID" class="form-text text-muted">Reward Item ID</small>
                            </div>
                            <div class="form-group">
                              <label for="RewardQuantity">Reward Quantity</label>
                              <input type="text" class="form-control" id="RewardQuantity" name="RewardQuantity" placeholder="Enter Reward Quantity">
                              <small id="RewardQuantity" class="form-text text-muted">Reward Quantity</small>
                            </div>
                            <div class="form-group">
                              <label for="Tier">Tier</label>
                              <input type="text" class="form-control" id="Tier" name="Tier" placeholder="Enter Tier">
                              <small id="Tier" class="form-text text-muted">Tier 1-10</small>
                            </div>
                            <p class="text-center">
                              <button type="submit" class="btn btn-sm btn-primary" name="submit" id="submit">Create New Reward</button>
                            </p>
                            <input type="hidden" name="image" value="<?php echo e(isset($_GET['img']) ? $_GET['img'] : ''); ?>"/>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          <?php else: ?>
            <?php echo e(redirect('/admin/auth/login')); ?>

          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.body.addEventListener("click", e => {
      if(e.target.closest("#submit")) {
        e.preventDefault();
        const rewardName =  document.querySelector('input[name="RewardName"]').value;
        const rewardDesc =  document.querySelector('input[name="RewardDesc"]').value;
        const rewardImage =  document.querySelector('input[name="image"]').value;
        const rewardItemID =  document.querySelector('input[name="RewardItemID"]').value;
        const rewardQuantity =  document.querySelector('input[name="RewardQuantity"]').value;
        const rewardTier =  document.querySelector('input[name="Tier"]').value;

        const response =  document.querySelector('#response');

        fetch('/admin/site/tieredSpender/submitReward', {
          method: 'post',
          mode: "same-origin",
          credentials: "same-origin",
          headers: {
              "Content-Type": "application/json"
          },
          body: JSON.stringify({
              rewardName,
              rewardDesc,
              rewardImage,
              rewardItemID,
              rewardQuantity,
              rewardTier
          })
        })
        .then(r => r.text())
        .then(data => {
          var parser = new DOMParser();
          var doc = parser.parseFromString(data, "text/html");
          response.innerHTML = doc.documentElement.innerHTML;
        })
      }
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/ap/site/tieredSpender/addReward.blade.php ENDPATH**/ ?>