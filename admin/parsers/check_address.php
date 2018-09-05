<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/Dailyneeds/core/init.php';
$full_name = sanitize($_POST['full_name']);
$email = sanitize($_POST['email']);
$mobile = sanitize($_POST['mobile']);
$city = sanitize($_POST['city']);

$errors = array();
$required = array(
 	'full_name' => 'Name',
	'email'     => 'Email',
	'mobile'    => 'Mobile Number',
	'city'      => 'Home Address', 
);

// check if all required filled are filled out 
foreach ($required as $f => $d) {
	if (empty($_POST[$f]) || $_POST[$f] == '') {
		$errors[] = $d.' is required.';
	}
}


if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
	$errors[] = 'Please enter a valid email.';
}


if (!empty($errors)) {
	echo display_errors($errors);
}
else{
	echo "passed";
}
?>
