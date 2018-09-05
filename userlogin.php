<?php
  // require_once $_SERVER['DOCUMENT_ROOT'].'/core/init.php';
   require_once 'core/init.php';
   include 'includes/head.php';
   include 'includes/navigation.php';
  // include 'includes/headerpartial.php';
   // session_start();
   $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
   $email = trim($email);
   $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
   $password = trim($password);
   // $hashed = password_hash($password,PASSWORD_DEFAULT);
   $errors = array();
 ?>
<style>
	body{
		background-image: url("/Dailyneeds/images/back-flower2.jpg");
		background-size: 100vw 100vh;
		background-attachment: fixed;
	}
</style>

<br>
<br>
<div class="col-md-12 text-center">
	<p style="font-size: 16px;font-weight: bold;color: #b32d00;">If You Don't Have Any Account</p>
	<a href="register.php" class="checkbat" >Register Now</a>
</div>
<br>
<br>
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
				$query = $db->query("SELECT * FROM Customer WHERE email = '$email'");
				$adimn_user = mysqli_fetch_assoc($query);
				$user_count = mysqli_num_rows($query);
				if($user_count < 1)
				{
					$errors[] = 'That email doesn\'t exist in our database .' ;
				}
				//echo $adimn_user['password'];
				if(!password_verify($password,$adimn_user['password']))
				//if($password != $adimn_user['password'])
				{
					$errors[] = 'The password does not match our records .  please try again .';
				}
		//	check for errors
				if(!empty($errors)){
				echo display_errors($errors);
				}else
				{
						// $adimn_user_id = $adimn_user['id'];
						// login($adimn_user_id);
					// $_SESSION["uid"] = $row["customer_id"];
                    // $_SESSION["name"] = $row["first_name"]; 
					header("location:card.php");

				}


			}
		 ?>
	</div>
	<h2 class="text-center">Login</h2>
	<form action="userlogin.php" method="post">
		<div class="form-group">
			<label for="email">Email:</label>
      <!-- <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span> -->
			<input type="text" name="email" id="email" class="form-control" value="<?php echo $email;?>">
		</div>
		<div class="form-group">
			<label for="password">Password:</label>
	<input type="password" name="password" id="password" class="form-control" value="<?php echo $password;?>">
		</div>
		<div class="form-group">

			<input type="submit"  value="Login" class="btn btn-primary">
		</div>
	</form>
	<p class="text-right"><a href="/Dailyneeds/index.php" alt="home"> Visit Site</a></p>
</div>



<?php include 'includes/footer.php'; ?>
