@guest
  <p>Please login to continue.</p>
@else
  <form id="security_form" method="post">
    <div id="response"></div><br>
    <div class="secOption">
      <h4>Account Status</h4>
      @if($data['panel']->checkVerificationStatus() == true)
        <span style="color: lime;">Your account is verified</span>
      @else
        <p class="text-red">Your account is not verified</p>
        <button type="submit" class="btn btn-sm btn-dark">Resend Verification Email</button>
      @endif
      <button id="deactivate" class="btn btn-sm btn-danger">Deactivate account</button>
    </div>
    <div class="secOption">
      <p>Your IP address:</p>
    </div>
    <div class="secOption">
      {{-- <p>Your Recovery Key</p> --}}
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
        {{-- <label class="block"><input type="radio" name="radgroup" value="A">Google</label> --}}
        <label class="block"><input type="radio" name="2faType" value="email">Email</label>
      </div>
    </div>
    <div class="secOption">
      <p>Update Security Q/A</p>
      @foreach ($data['panel']->getWebData() as $fet)
        <div class="form-row">
          <div class="col-md-6">
            <div class="input-group youplay-input">
              {!!security_question($fet->SecQuestion)!!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-group youplay-input">
              <input type="text" name="SecAnswer" id="Input-SecAnswer" placeholder="Security answer" value="{{isset($fet->SecAnswer) ? $fet->SecAnswer : NULL}}">
            </div>
          </div>
        </div>
      @endforeach
    </div>
    {{-- <div class="secOption">
      <p>WhiteList IPS..</p>
    </div> --}}
    <div class="secOption">
      {{-- lets do it --}}
      {{-- {{$data['panel']->sendVerificationEmail()}} --}}
    </div>
    @Separator(20)
    <button id="submit" class="btn btn-sm btn-dark">
      Save Changes
    </button>
  </form>
@endguest
