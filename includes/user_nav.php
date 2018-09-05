<?php
if(isset($_SESSION['user_email']))
{
  $user_email = sanitize($_SESSION['user_email']);
  $modalQ = $db->query("SELECT * FROM customer2 where email = '{$user_email}'");
  $resultQ = mysqli_fetch_assoc($modalQ);

  $u_name = $resultQ['name'];
  $u_email = $resultQ['email'];
}
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="container">
	<!-- <a href="index.php" class="navbar-brand" style="color: white;">Dailyneeds</a> -->
  <div class="navbar-header pull-right">
                    <a href="/Dailyneeds/index.php" class="navbar-brand" style="color: white;">Dailyneed's Home Page</a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
  </div>
  <div class="navbar-header">
                    <p  class="navbar-brand" style="color: white;">Welcome <?=$u_name;?></a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
  </div>
</div>
</nav>
<div><br><br></div>
