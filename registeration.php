<?php

include 'core/init.php';

$f_name=$_POST["f_name"];
$l_name=$_POST["l_name"];
$email=$_POST["email"];
$password=$_POST["password"];
$repassword=$_POST["repassword"];
$mobile=$_POST["mobile"];
$address1=$_POST["address1"];
$address2=$_POST["address2"];
$name="/^[a-zA-Z]+$/";
$emailvalidation="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
$number="/^[0-9]+$/";
if (empty($f_name) || empty($l_name) || empty($email) || empty($password) || empty($repassword) || empty($mobile) || empty($address1) || empty($address2)) {
   echo "
     <div class='alert alert-danger'>
     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill all the fields.........</b>
     </div>
   ";
   exit();
}else{
if (!preg_match($name, $f_name)) {
	echo "
	 <div class='alert alert-danger'>
     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>First Name $f_name is not valid</b>
     </div>
	";
	exit();
}
if (!preg_match($name, $l_name)) {
	echo "<div class='alert alert-danger'>
     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Last Name $l_name is not valid</b>
     </div>";
	exit();
}
if (!preg_match($emailvalidation, $email)) {
	echo "<div class='alert alert-danger'>
     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Email $email is not valid</b>
     </div>";
	exit();
}
if (!preg_match($number, $mobile)) {
	echo "<div class='alert alert-danger'>
     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Mobile Number $mobile is not valid</b>
     </div>";
	exit();
}
if (!(strlen($mobile) == 11)) {
	echo "<div class='alert alert-danger'>
     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Mobile Number must be 11 digit</b>
     </div>";
	exit();
}
if (strlen($password)<9) {
	echo "<div class='alert alert-danger'>
     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Password is weak</b>
     </div>";
	exit();
}
if (strlen($repassword)<9) {
	echo "<div class='alert alert-danger'>
     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Repassword is not same</b>
     </div>";
	exit();
}
if ($password != $repassword) {
	echo "<div class='alert alert-danger'>
     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Password is not same</b>
     </div>";
	exit();
}

$sql = "SELECT customer_id from customer where email = '$email' LIMIT 1";
$run = mysqli_query($db,$sql);
$count = mysqli_num_rows($run);
if ($count > 0) {
   echo "<div class='alert alert-danger'>
     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Try another email , email already exists</b>
     </div>";
   exit();
}else
{
	//$pass = md5($password);
	$pass = password_hash($password,PASSWORD_DEFAULT);

    // $sql="INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `email`,
	//  `password`, `mobile`, `Address1`, `Address2`) VALUES
	//  (NULL, '$f_name', '$l_name', '$email', '$pass', '$mobile', '$address1', '$address2')";
    $sql="INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `email`, `phone`, 
        `password`, `address1`, `address2`) VALUES (NULL, '$f_name', '$l_name', '$email',
         '$mobile', '$pass', '$address1', '$address2')"; 
	$execute = mysqli_query($db,$sql);
	if ($execute) {
		echo "<div class='alert alert-info'>
     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>You are registered successfully</b>
     </div>";
	}
}
}
?>