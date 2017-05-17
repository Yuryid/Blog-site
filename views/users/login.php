<?php
	//login view with login form
	//page header
  require(HEADER_PATH);
	?>
	<!-- title. -->
  <h1>Login page</h1>
  <!-- login form -->
 <form action="<?php print _DS.'users'._DS.'login'._DS."check?last_url={$_GET['last_url']}"; ?>" method="POST" class="form-login">
    <div class="field-item">
      <label for="name">Login</label>
      <input type="text" name="name" id="name" required>
    </div>
    <div class="field-item">
      <label for="pass">Password</label>
      <input type="password" name="pass" maxlength="16" minlength="3">
    </div>
    <input type="submit" name="submit" value="Send">
  </form>
  <div class="login-status"> <?php print $contents['message']; ?> </div>
<?php
	//footer
	require(FOOTER_PATH);
?>