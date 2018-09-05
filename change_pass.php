<?php
include 'core/init.php';
include 'includes/userHead.php';
include 'includes/navigation.php';
include 'includes/userheaderfull.php';
include 'includes/userLeftbar.php';
if(isset($_SESSION['user_email']))
{
  $user_email = sanitize($_SESSION['user_email']);
  $user_info = $db->query("SELECT * FROM customer2 WHERE email = '{$user_email}'");
  $result_uinfo = mysqli_fetch_assoc($user_info);

  $u_id = $result_uinfo['id'];
  $u_name = $result_uinfo['name'];
  $u_email = $result_uinfo['email'];
  $u_mobile = $result_uinfo['mobile'];
  $u_password = $result_uinfo['password'];
  $u_address = $result_uinfo['address'];
}
$old_password = ((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
$old_password = trim($old_password);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
$confirm = trim($confirm);


?>
  <div class="col-md-8">
	<h2 class="text-center">Change Password</h2>
	<form action="pass_insert.php" method="post">
		<div class="form-group">
			<label for="old_password">old password</label>
			<input type="password" name="old_password" id="old_password" class="form-control" value="<?=$old_password;?>">
		</div>
		<div class="form-group">
			<label for="password">New Password:</label>
	    <input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
		</div>
    <div class="form-group">
			<label for="confirm">Confirm New Password:</label>
	    <input type="password" name="confirm" id="confirm" class="form-control" value="<?=$confirm;?>">
		</div>

		<div class="form-group">
      

      <button type="reset" class="btn btn-warning">Cancel</button>
      <input type="submit"  value="Submit" name="submit" class="btn btn-primary">


		</div>
	</form>
</div>
