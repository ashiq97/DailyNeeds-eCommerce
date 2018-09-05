<?php
   require_once $_SERVER['DOCUMENT_ROOT'].'/Dailyneeds/core/init.php';
   unset($_SESSION['user_email']);
   header('Location: index.php');
?>
