@guest
  <p>Please login to continue.</p>
@else
  <form id="pass_form" method="post">
    <div id="response"></div><br>
    <div class="secOption">
      <p class="text-red">Your account is not verified</p>
      <button type="submit" class="btn btn-sm btn-dark">Resend Verification Email</button>
    </div>
    <div class="secOption">
      <p>Your IP address:</p>
    </div>
    <div class="secOption">
      <p>Your Recovery Key</p>
      <span>Export your recovery key</span>
      <button class="btn btn-sm btn-dark" id="dwnRecoveryKey" style="vertical-align: inherit !important;margin-left:2%;">
        Export
      </button>
    </div>
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
        {{-- <label class="block"><input type="radio" name="radgroup" value="A">Google</label> --}}
        <label class="block"><input type="radio" name="radgroup" value="A">Email</label>
      </div>
    </div>
    <div class="secOption">
      <p>Update Security Q/A</p>
    </div>
    <div class="secOption">
      <p>WhiteList IPS..</p>
    </div>
    <div class="secOption">
      {{-- lets do it --}}
      {{$data['panel']->sendVerificationEmail()}}
    </div>
    @Separator(20)
    <button type="submit" class="btn btn-sm btn-dark">
      Save Changes
    </button>
  </form>
@endguest
