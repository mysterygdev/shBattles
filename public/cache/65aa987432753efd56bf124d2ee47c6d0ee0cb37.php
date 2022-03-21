<?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
  <p>Please login to continue.</p>
<?php else: ?>
  <form id="pass_form" method="post">
    <div id="response"></div><br>
    <div class="secOption">
      <div id="2FA" class="MFA">
        <span>Two-Factor Authentication(2FA):</span>
        <input type="radio" id="huey" name="drone" value="huey">
        <label for="huey">Enabled</label>
        <input type="radio" id="huey" name="drone" value="huey">
        <label for="huey">Disabled</label>
      </div>
    </div>
    <div class="secOption">
      <div id="2FAType" class="MFAType">
        <span>Two-Factor Authentication(2FA) Type:</span>
        <label class="block"><input type="radio" name="radgroup" value="A">Google</label>
        <label class="block"><input type="radio" name="radgroup" value="A">Email</label>
      </div>
    </div>
    <?php separator(20) ?>
    <button type="submit" class="btn btn-sm btn-dark m_auto">
      Save Changes
    </button>
  </form>
<?php endif; ?>
<?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/user/panel/security.blade.php ENDPATH**/ ?>