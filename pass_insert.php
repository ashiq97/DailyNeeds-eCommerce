<?php
require_once 'core/init.php';
include 'includes/userHead.php';
//include 'includes/navigation.php';
include 'includes/userheaderfull.php';
include 'includes/userLeftbar.php';
   //$hashed = $user_data['password'];
if(isset($_SESSION['user_email']))
{
  $user_email = sanitize($_SESSION['user_email']);
  $user_info = $db->query("SELECT * FROM customer2 where email = '{$user_email}'");
  $result_uinfo = mysqli_fetch_assoc($user_info);

  $u_id = $result_uinfo['id'];
  $u_password = $result_uinfo['password'];

}



   $old_password = ((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
   $old_password = trim($old_password);
   $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
   $password = trim($password);
   $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
   $confirm = trim($confirm);
   //$new_hashed = password_hash($password,PASSWORD_DEFAULT);
   //$user_id = $user_data['id'];
   // $hashed = password_hash($password,PASSWORD_DEFAULT);
   $errors = array();
 ?>
<div id="login-form">
	<div>
		<?php
		//form validation
			if(isset($_POST['submit']))
			{
				if(empty($_POST['old_password']) || empty($_POST['password']) || empty($_POST['confirm'])){
					$errors[] = 'you must fill out all fields.';

				}

				// password is more than 6 characters
				if(strlen($password) < 6)
				{
					$errors[] = 'Password must be at least 6 characters .';
				}
				// check if  new password matches  Confirm
        if($password != $confirm){
          $errors[] = 'The new password and confirm new password does not match';
        }

				if($old_password != $u_password)
				{
					$errors[] = 'Your old password does not match our records.';
				}
		//	check for errors
				if(!empty($errors)){
          echo display_errors($errors);
          //header('Location: change_pass.php');

				}
				else{
						//change password
            $db->query("UPDATE customer2 SET password = '$password' WHERE id='$u_id'");
            // $_SESSION['success_flash'] = 'Your password has been updated!';
           // header('Location: index.php');
             header('Location: change_pass.php');


        }


			}
		 ?>
	</div>
