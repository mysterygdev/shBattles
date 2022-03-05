<form id="pass_form" method="post">
  <div id="response"></div><br>
  <div class="form-row">
    <div class="col-md-3 mb-3">
      <label for="username">Display name:</label>
      <div class="input-group mb-3 youplay-input">
        <input type="text" placeholder="Display name" value="<?php echo e($data['user']->DisplayName); ?>" disabled>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="username">User name:</label>
      <div class="input-group mb-3 youplay-input">
        <input type="text" placeholder="User name" value="<?php echo e($data['user']->UserID); ?>" disabled>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="username">Email:</label>
      <div class="input-group mb-3 youplay-input">
        <input type="text" placeholder="Email" value="<?php echo e($data['user']->Email); ?>" disabled>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="username">Status:</label>
      <div class="input-group mb-3 youplay-input">
        <input type="text" placeholder="Status" value="<?php echo e($data['data']->statusToText($data['user']->Status)); ?>" disabled>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="username">Points:</label>
      <div class="input-group mb-3 youplay-input">
        <input type="text" placeholder="Points" value="<?php echo e($data['user']->Point); ?>" disabled>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="username">Member since:</label>
      <div class="input-group mb-3 youplay-input">
        <input type="text" placeholder="Member since" value="<?php echo e($data['data']->convertTimeToDate('F d, Y', $data['user']->JoinDate)); ?>" disabled>
      </div>
    </div>
  </div>
</form>
<?php /**PATH C:\laragon\www\originals\resources\views/pages/cms/user/panel/details.blade.php ENDPATH**/ ?>