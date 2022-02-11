<form id="pass_form" method="post">
  <div id="response"></div><br>
  <div class="form-row">
    <div class="col-md-9 mb-3">
      <label for="username">Current Password:</label>
      <div class="input-group mb-3">
        <input type="password" class="form-control" name="password" id="password3" placeholder="Current password">
        <div class="input-group-append">
          <span class="input-group-text" id="basic-addon2"><span toggle="#cpw" class="fa fa-fw fa-eye fa-eye-slash field-icon2" id="togglePassword3"></span></span>
        </div>
      </div>
    </div>
    <div class="col-md-9 mb-3">
      <label for="username">New password:</label>
      <div class="input-group mb-3">
        <input type="password" class="form-control" name="new_pass" id="password"  placeholder="New password">
        <div class="input-group-append">
          <span class="input-group-text" id="basic-addon2"><span toggle="#password" class="fa fa-fw fa-eye fa-eye-slash field-icon2" id="togglePassword"></span></span>
        </div>
      </div>
    </div>
    <div class="col-md-9 mb-3">
      <label for="username">Confirm new password:</label>
      <div class="input-group mb-3">
        <input type="password" class="form-control" name="conf_pass" id="password2" placeholder="Confirm new password">
        <div class="input-group-append">
          <span class="input-group-text" id="basic-addon2"><span toggle="#cpassword" class="fa fa-fw fa-eye fa-eye-slash field-icon2" id="togglePassword2"></span></span>
        </div>
      </div>
    </div>
    <div class="form-group input-group">
      <p class="text-center">
        <button class="custom_button" id="change_password">Change password</button>
      </p>
    </div>
  </div>
</form>
<script>
  document.body.addEventListener("click", e => {
    if(e.target.closest("#change_password")) {
      e.preventDefault();

      const pw =  document.querySelector('input[name="password"]').value;
      const new_pass =  document.querySelector('input[name="new_pass"]').value;
      const conf_pass =  document.querySelector('input[name="conf_pass"]').value;

      const response =  document.querySelector('#response');

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
