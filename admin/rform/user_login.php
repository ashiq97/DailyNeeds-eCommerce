<?php
$db=mysqli_connect('localhost','root','','needy');

if(mysqli_connect_errno())
{
  echo "Database connection failed with following errors : ".mysqli_connect_error();
  die();
}
require_once $_SERVER['DOCUMENT_ROOT'].'/Dailyneeds/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Dailyneeds/config.php';
require_once BASEURL.'helpers/helpers.php';

include '../includes/head2.php';
    $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
    $email = trim($email);
    $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
    $password = trim($password);
    // $hashed = password_hash($password,PASSWORD_DEFAULT);


   $errors = array();
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
				$query = $db->query("SELECT * FROM customer2 WHERE email = '$email'");
				$adimn_user = mysqli_fetch_assoc($query);
				$user_count = mysqli_num_rows($query);
				if($user_count < 1)
				{
					$errors[] = 'That email doesn\'t exist in our database .' ;
				}

				if($password != $adimn_user['password'])
				{
					$errors[] = 'The password does not match our records .  please try again .';
				}
		//	check for errors
				if(!empty($errors)){
				echo display_errors($errors);
				}else
        {
          $customer_user_email = $adimn_user['email'];
          logged($customer_user_email,$cart_id);

        }


			}
		 ?>

<div id="custom-bootstrap-menu" class="navbar navbar-default " role="navigation">
    <div class="container">
        <div class="navbar-header"><a class="navbar-brand" href="/Dailyneeds/index.php"><i>Home Page</i></a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
        </div>
    </div>
</div>

        <div class="container">
           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
           <div id="banner">
             <h1>Please fill every field with correct information.</h1>

            <h5><strong>Dailyneeds.com</strong></h5>
           </div>


            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="registrationform">
      <form class="form-horizontal" action="user_login.php" method="post">
                <fieldset>
                    <legend> Sign in <i class="fa fa-pencil pull-right"></i></legend>

                    <div class="form-group">
                        <label for="email" class="col-lg-2 control-label">
                            Email</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?=$email;?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-lg-2 control-label">
                            Password</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?=$password;?>">

                        </div>
                    </div>

                    <!-- <div class="form-group ">
                        <div class="col-lg-10 col-lg-offset-2 pull-right">
                            <a href="in.php"><h5>Sign up</h5></a>

                        </div>
                    </div> -->
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-warning">
                                Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                Submit</button>
                                  <a href="in.php" class="pull-right"><b>Not a member?</a>
                                  <a href="in.php" class="pull-right"><b>Forgot Password?<span>&nbsp;&nbsp;&nbsp;&nbsp;</span></a>

                        </div>
                    </div>
                </fieldset>
            </form>

         </div>



         </div>
        </div>


<?php  include '../includes/fotter2.php'; ?>
