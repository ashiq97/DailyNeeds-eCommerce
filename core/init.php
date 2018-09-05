<?php
$db=mysqli_connect('localhost','root','','needy');

if(mysqli_connect_errno())
{
  echo "Database connection failed with following errors : ".mysqli_connect_error();
  die();
}
session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/Dailyneeds/config.php';
require_once BASEURL.'helpers/helpers.php';
require BASEURL.'vendor/autoload.php';

$cart_id = '';
if(isset($_COOKIE[CART_COOKIE])){
  $cart_id = sanitize($_COOKIE[CART_COOKIE]);
}

if(isset($_SESSION['SBUser']))
{
  $admin_user_id = $_SESSION['SBUser'];
  $query = $db->query("SELECT * FROM admin_user WHERE id ='$admin_user_id'");
  $user_data = mysqli_fetch_assoc($query);
  $fn = explode(' ',$user_data['full_name']);
  $user_data['first']  = $fn[0];
  $user_data['last'] = $fn[1];
}

// if(isset($_SESSION['success_flash'])){
//   echo '<div class="bg-success"><p class="text-success text-center">'.$_SESSION['success_flash'].'</p></div>';
//   unset($_SESSION['success_flash']);
// }
if(isset($_SESSION['success_flash'])){
  echo "<div class='alert alert-success text-center'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>".$_SESSION['success_flash']."</b></div>";
  unset($_SESSION['success_flash']);
}
if(isset($_SESSION['error_flash'])){
  echo '<div class="bg-danger" ><p class="text-danger text-center">'.$_SESSION['error_flash'].'</p></div>';
  unset($_SESSION['error_flash']);
}

if(isset($_SESSION['success_flash_user'])){
  echo '<div class="bg-success"><p class="text-success text-center">'.$_SESSION['success_flash_user'].'</p></div>';
  unset($_SESSION['success_flash_user']);
}
if(isset($_SESSION['error_flash_user'])){
  echo '<div class="bg-danger"><p class="text-danger text-center">'.$_SESSION['error_flash_user'].'</p></div>';
  unset($_SESSION['error_flash_user']);
}


// session_destroy();
