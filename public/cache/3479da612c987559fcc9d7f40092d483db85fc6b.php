<?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
  <p>Please login to continue.</p>
<?php else: ?>
  <form id="security_form" method="post">
    <div id="response"></div><br>
    <div class="secOption">
      <h4>Account Status</h4>
      <?php if($data['panel']->checkVerificationStatus() == true): ?>
        <span style="color: lime;">Your account is verified</span>
      <?php else: ?>
        <p class="text-red">Your account is not verified</p>
        <button type="submit" class="btn btn-sm btn-dark">Resend Verification Email</button>
      <?php endif; ?>
      <button id="deactivate" class="btn btn-sm btn-danger">Deactivate account</button>
    </div>
    <div class="secOption">
      <p>Your IP address:</p>
    </div>
    <div class="secOption">
      
      <span>Export your recovery key</span>
      <button class="btn btn-sm btn-dark" id="dwnRecoveryKey" style="vertical-align: inherit !important;margin-left:2%;">
        Export
      </button>
    </div>
    <div class="secOption">
      <div id="2FA" class="MFA">
        <span>Two-Factor Authentication(2FA):</span>
        <input type="radio" id="2fa" name="2fa" value="true">
        <label for="enabled">Enabled</label>
        <input type="radio" id="2fa" name="2fa" value="false">
        <label for="disabled">Disabled</label>
      </div>
    </div>
    <div class="secOption">
      <div id="2FAType" class="MFAType">
        <span>Two-Factor Authentication(2FA) Type:</span>
        
        <label class="block"><input type="radio" name="2faType" value="email">Email</label>
      </div>
    </div>
    <div class="secOption">
      <p>Update Security Q/A</p>
      <?php $__currentLoopData = $data['panel']->getWebData(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="form-row">
          <div class="col-md-6">
            <div class="input-group youplay-input">
              <?php echo security_question($fet->SecQuestion); ?>

            </div>
          </div>
          <div class="col-md-6">
            <div class="input-group youplay-input">
              <input type="text" name="SecAnswer" id="Input-SecAnswer" placeholder="Security answer" value="<?php echo e(isset($fet->SecAnswer) ? $fet->SecAnswer : NULL); ?>">
            </div>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    
    <div class="secOption">
      
      
    </div>
    <?php separator(20) ?>
    <button id="submit" class="btn btn-sm btn-dark">
      Save Changes
    </button>
  </form>
<?php endif; ?>
<?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/user/panel/security.blade.php ENDPATH**/ ?>