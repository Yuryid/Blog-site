<?php
	//login view with login form
	//page header
	require('base/header.php');
	?>
	<!-- title. -->
  <h1></h1>
  <!-- login form -->
 <form action="<?php print _DS . "users". _DS . "login" . _DS . "check"; ?>" method="POST" class="form-login">
    <div class="field-item">
      <label for="name">Login</label>
      <input type="text" name="name" id="name" required>
    </div>

    <div class="field-item">
      <label for="pass">Password</label>
      <input type="password" name="pass">
    </div>

    <input type="submit" name="submit" value="Send">
  </form>
  <div class="login-status"> <?php print $contents['message']; ?> </div>
<?php
	//footer
	require('base/footer.php');
?>