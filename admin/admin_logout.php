<?php
   require_once $_SERVER['DOCUMENT_ROOT'].'/Dailyneeds/core/init.php';
   unset($_SESSION['SBUser']);
   header('Location: admin_Login.php');
?>
