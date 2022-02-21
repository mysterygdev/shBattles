<form id="pass_form" method="post">
  <div id="response_chpw"></div><br>
  <div class="form-group row">
    <div class="col-md-6">
      <label for="cur-passw" class="col-1 col-form-label">Current Password*</label>
      <div class="col-6 youplay-input">
        <input id="password3" name="password" placeholder="Current Password" type="password">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-md-6">
      <label for="new-passw" class="col-4 col-form-label">New Password*</label>
      <div class="col-6 youplay-input">
        <input id="password" name="new_pass" placeholder="New Password" type="password">
      </div>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-md-6">
      <label for="conf-newpwd" class="col-4 col-form-label">Confirm New Password*</label>
      <div class="col-6 youplay-input">
        <input id="password2" name="conf_pass" placeholder="Confirm New Password" type="password">
      </div>
    </div>
  </div>
  <button name="sub_changepw" id="change_password" class="btn btn-sm btn-dark m_auto">Change Password</button>

  
</form>
<script>
  document.body.addEventListener("click", e => {
    if(e.target.closest("#change_password")) {
      e.preventDefault();

      const pw =  document.querySelector('input[name="password"]').value;
      const new_pass =  document.querySelector('input[name="new_pass"]').value;
      const conf_pass =  document.querySelector('input[name="conf_pass"]').value;

      const response =  document.querySelector('#response_chpw');

      fetch('/auth/changePassword', {
        method: 'post',
        mode: "same-origin",
        credentials: "same-origin",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify({
          pw,
          new_pass,
          conf_pass
        })
      })
      .then(r => r.text())
      .then(data => {
        // Initialize the DOM parser
        var parser = new DOMParser();

        // Parse the text
        var doc = parser.parseFromString(data, "text/html");

        response.innerHTML = doc.documentElement.innerHTML;
      })
    }
  });
</script>
<?php /**PATH C:\laragon\www\shaiyabattles\resources\views/pages/cms/user/panel/changePassword.blade.php ENDPATH**/ ?>