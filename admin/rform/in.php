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
// if(!is_logged_in()){
//   login_error_redirect();
// }
// if(!has_permission('admin'))
// {
//   permission_error_redirect('index.php');
// }
include '../includes/head2.php';
// include 'includes/navigation.php';
 // echo $_SESSION['SBUser'];
 // if(isset($_GET['delete'])){
 //   $delete_id = sanitize($_GET['delete']);
 //   $db->query("DELETE FROM admin_user WHERE id = '$delete_id'");
 //   $_SESSION['success_flash']  = 'User has been deleted!';
 //   header('Location: admin_users.php');
 //
 // }
 /*if(isset($_GET['edit']) && !empty($_GET['edit'])){
   $edit_id = (int)$_GET['edit'];
   $edit_id = sanitize($edit_id);
   //echo $edit_id;
   $sqledit = "SELECT * FROM admin_user WHERE id = '$edit_id'";
   $edit_result = $db->query($sqledit);
   $eUpdate = mysqli_fetch_assoc($edit_result);
 //  header('Location: brands.php');
 //$db->query("DELETE FROM admin_user WHERE id = '$delete_id'");
  // $_SESSION['success_flash']  = 'User has been updated!';
  // header('Location: admin_users.php');
}*/

  // if (isset($_GET['add'])){
 //   $name = ((isset($_POST['name']))?sanitize($_POST['name']):'');
 //
 //  $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
 //
 //   $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
 //
 //   $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
 //
 //   $address = ((isset($_POST['address']))?sanitize($_POST['address']):'');
   $name = ((isset($_POST['name']))?sanitize($_POST['name']):'');
   $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
   $email = trim($email);
   $mobile = ((isset($_POST['mobile']))?sanitize($_POST['mobile']):'');
   $mobile = trim($mobile);
   $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
   $password = trim($password);
   $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
   $confirm = trim($confirm);
   $address = ((isset($_POST['address']))?sanitize($_POST['address']):'');


   $errors = array();
  // $uName = $_SESSION["user_name"];
   $uName = '';
   if(isset($_SESSION["user_name"])){
     $uName = sanitize($_SESSION["user_name"]);
     echo $uName;
   }
   // if($uName != '')
   // {
   //   echo $uName;
   // }
   if($_POST){
     // if(isset($_SESSION["user_name"])){
     //   unset($_SESSION['user_name']);
     // }


    $emailQuery =("SELECT * FROM customer2 WHERE email = '$email'");
     // if(isset($_GET['edit']))
     // {
     //   $emailQuery="SELECT * FROM admin_user WHERE email = '$email' AND id != '$edit_id'";
     //   ///echo "$edit_id";
     // }
     $result = $db->query($emailQuery);
     $count= mysqli_num_rows($result);
    // echo $count;

     if($count > 0 )
     {
       $errors[]  .= $email.' already exists in our database .';
     }


     $required = array('name','email','mobile','password','confirm','address');
     foreach($required as $field){
       if(empty($_POST[$field])){
         $errors[] = 'You must fill out all fields.';
         break;
       }
     }
     if(strlen($password) < 6){
       $errors[] = 'Your password must be at least 6 characters';
     }
     if($password != $confirm){
       $errors[] = "Your password doesn't match. ";
     }
     if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
       $errors[] = 'You must enter a valid email.';
     }


     if(!empty($errors)){
     echo display_errors($errors);
     }else{
     //add  user to database
    // $hashed = password_hash($password,PASSWORD_DEFAULT);

     // if(isset($_GET['edit']))
     // {
     //    $sql = "UPDATE admin_user SET full_name = '$name' , email = '$email', password = '$password' ,permission = '$permissions' WHERE id = '$edit_id'";
     //    $db->query($sql);
     //    $_SESSION['success_flash'] = 'user has been updated!';
     //    header('Location: admin_users.php');
     // }else{
     $sql ="INSERT INTO customer2 (name,email,mobile,password,address) VALUES ('$name','$email','$mobile','$password','$address')";
     $db->query($sql);
     $_SESSION['success_flash'] = 'User has been added!';
    // $db->query("INSERT INTO admin_user (full_name,email,password,permission) VALUES ('$name','$email','$hashed','$permissions')");
    // $_SESSION['success_flash'] = 'user has been added!';
     header('Location: user_login.php');
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
      <form class="form-horizontal" action="in.php?add=1" method="post">
                <fieldset>
                    <legend>Registration Form <i class="fa fa-pencil pull-right"></i></legend>
                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">
                            Name</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?=$name;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-lg-2 control-label">
                            Email</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?=$email;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="col-lg-2 control-label">
                            Mobile</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="mobile" id="mobile" placeholder="+880.." value="<?=$mobile;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-lg-2 control-label">
                            Password</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?=$password;?>">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirm" class="col-lg-2 control-label">
                           Confirm Password</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" name="confirm" id="confirm" placeholder="retype password" value="<?=$confirm;?>">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-lg-2 control-label">
                            Address</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" name="address" id="address" placeholder="Home address & Street name & Zip code" rows="3" value="<?=$address;?>"></textarea>
                        <!--    <span class="help-block">A longer block of help text that breaks onto a new line and
                                may extend beyond one line.</span>-->
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-warning">
                                Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                Submit</button>
                                <a href="user_login.php"class="pull-right" >already a member?</a>
                        </div>
                    </div>
                </fieldset>
            </form>

         </div>



         </div>
        </div>


<?php  include '../includes/fotter2.php'; ?>
