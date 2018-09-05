photo<?php
include 'core/init.php';
include 'includes/userHead.php';
//include 'includes/navigation.php';
include 'includes/userheaderfull.php';
include 'includes/userLeftbar.php';
if(isset($_SESSION['user_email']))
{
  $user_email = sanitize($_SESSION['user_email']);
  $user_info = $db->query("SELECT * FROM customer2 WHERE email = '{$user_email}'");
  $result_uinfo = mysqli_fetch_assoc($user_info);

  $u_id = $result_uinfo['id'];
  $u_email = $result_uinfo['email'];
  $u_image = $result_uinfo['image'];

}


    $c=$_POST['c_image'];

   if(isset($_POST['Upload'])){
     $sql1 = "UPDATE customer2 SET image = '$c' WHERE email='$u_email'";
      $sql2="UPDATE review SET image = '$c' WHERE email='$u_email'";
      $db->query($sql1);
      $db->query($sql2);
      header('Location: account_info.php');


    }
