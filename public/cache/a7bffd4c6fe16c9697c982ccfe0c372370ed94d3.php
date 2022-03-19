<?php $__env->startSection('index', 'addDonation'); ?>
<?php $__env->startSection('title', 'Add Donation'); ?>
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
                          <h5 class="">Add new donation</h5>
                          <div class="float-right">
                            <button type="button" class="btn btn-sm btn-primary"  onclick="window.open('/admin/paymentCenter/manageDonations','_self')">Manage Donations</button>
                          </div>
                        </div>
                        <div class="card-body">
                          <form method="post">
                            <p id="response"></p>
                            <div class="form-group">
                              <label for="Reward">Reward</label>
                              <input type="text" class="form-control" id="Reward" name="Reward" placeholder="Enter Reward">
                            </div>
                            <div class="form-group">
                              <label for="Bonus">Bonus</label>
                              <input type="text" class="form-control" id="Bonus" name="Bonus" placeholder="Bonus">
                              <small id="Bonus" class="form-text text-muted">Bonus Points (Not Required)</small>
                            </div>
                            <div class="form-group">
                              <label for="Price">Price</label>
                              <input type="text" class="form-control" id="Price" name="Price" placeholder="Price">
                            </div>
                            <p class="text-center">
                              <button type="submit" class="btn btn-sm btn-primary" name="submit" id="submit">Create New Donation</button>
                            </p>
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

        const reward =  document.querySelector('input[name="Reward"]').value;
        const bonus =  document.querySelector('input[name="Bonus"]').value;
        const price =  document.querySelector('input[name="Price"]').value;

        const response =  document.querySelector('#response');

        fetch('/admin/paymentCenter/submitDonation', {
          method: 'post',
          mode: "same-origin",
          credentials: "same-origin",
          headers: {
              "Content-Type": "application/json"
          },
          body: JSON.stringify({
              reward,
              bonus,
              price
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

<?php echo $__env->make('layouts.ap.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/ap/paymentCenter/addDonation.blade.php ENDPATH**/ ?>