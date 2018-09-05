<?php
   require_once $_SERVER['DOCUMENT_ROOT'].'/Dailyneeds/core/init.php';

   include 'includes/head.php';
   $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
   $email = trim($email);
   $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
   $password = trim($password);
   // $hashed = password_hash($password,PASSWORD_DEFAULT);
   $errors = array();
 ?>
<style>
	body{
		background-image: url("/teacher/image/back-flower1.jpeg");
		background-size: 100vw 100vh;
		background-attachment: fixed;
	}
</style>


<div id="login-form">
	<div>
		<?php
		//form validation
			if($_POST)
			{
				if(empty($_POST['email']) || empty($_POST['password'])){
					$errors[] = 'you must provide email and password.';

				}
				//validate email
				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					$errors[] = 'you must enter a valid email .';

				}
				// password is more than 6 characters
				if(strlen($password) < 6)
				{
					$errors[] = 'Password must be at least 6 characters .';
				}
				//check if email is exist in database
				$query = $db->query("SELECT * FROM admin_user WHERE email = '$email'");
				$adimn_user = mysqli_fetch_assoc($query);
				$user_count = mysqli_num_rows($query);
				if($user_count < 1)
				{
					$errors[] = 'That email doesn\'t exist in our database .' ;
				}

				if(!password_verify($password,$adimn_user['password']))
				{
					$errors[] = 'The password does not match our records .  please try again .';
				}
		//	check for errors
				if(!empty($errors)){
				echo display_errors($errors);
				}else
				{
						 $adimn_user_id = $adimn_user['id'];
						 login($adimn_user_id);
            //echo "login";
				}


			}
		 ?>
	</div>
	<h2 class="text-center">Login</h2>
	<form action="admin_login.php" method="post">
		<div class="form-group">
			<label for="email">Email:</label>
      <!-- <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span> -->
			<input type="text" name="email" id="email" class="form-control" value="<?=$email;?>">
		</div>
		<div class="form-group">
			<label for="password">Password:</label>
	<input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
		</div>
		<div class="form-group">

			<input type="submit"  value="Login" class="btn btn-primary">
		</div>
	</form>
	<p class="text-right"><a href="/teacher/index.php" alt="home"> Visit Site</a></p>
</div>



<?php include 'includes/footer.php'; ?>
