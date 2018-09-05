<?php
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
  $u_name = $result_uinfo['name'];
}
if(isset($_POST['submit']))
{
$review = sanitize($_POST['review']);
$sql = "INSERT INTO review (`name`,`email`,`description`) VALUES ('$u_name','$user_email','$review')";
$db->query($sql);
header('Location: myreview.php');
}
if(isset($_POST['update']))
{
$review = sanitize($_POST['review']);
$sql = "UPDATE review SET description = '$review', Date = NOW() WHERE email = '{$user_email}'";
$db->query($sql);

header('Location: myreview.php');
}
