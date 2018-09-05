<?php
$sql = "SELECT * FROM categories WHERE  parent = 0";
$pquery = $db->query($sql);
if(isset($_SESSION['user_email']))
{
  $user_email = sanitize($_SESSION['user_email']);
  $modalQ = $db->query("SELECT * FROM customer2 where email = '{$user_email}'");
  $resultQ = mysqli_fetch_assoc($modalQ);

  $u_name = $resultQ['name'];
  $u_email = $resultQ['email'];
}
?>

<nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="170">
<div class="container">
	<!-- <a href="index.php" class="navbar-brand" style="color: white;">Dailyneeds</a> -->
  <div class="navbar-header">
                    <a href="index.php" class="navbar-brand" style="color: white;">Dailyneeds</a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
  </div>
  <div class="collapse navbar-collapse " id="myNavbar">
	<ul class="nav navbar-nav">
		<?php while($parent = mysqli_fetch_assoc($pquery)) : ?>
		  <?php
		   $parent_id=$parent['id'] ;
		   $sql1 = "SELECT * FROM categories WHERE parent = $parent_id";
		   $cquery = $db->query($sql1);
		  ?>
  <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><span style="color: #b3ffff;"><?= $parent['category']; ?></span><span  class =""> </span></a>
        <ul class="dropdown-menu" role="menu" style="background-color: #66ccff;">
          <?php while($child = mysqli_fetch_assoc($cquery)) : ?>
          <li><a href="category.php?cat=<?=$child['id'];?>"><b><span style="color: #801a00;"><?= $child['category']; ?></span></b></a></li>
        <?php endwhile; ?>
       </ul>
   </li>
 <?php endwhile ; ?>
 <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span><span style="color: #ff4d4d;"> My Cart</span> </a></li>
</ul>
<ul class="nav navbar-nav pull-right"><li class="<?=((!isset($_SESSION['user_email']))?'':'dropdown');?>">
      <a class="<?=((!isset($_SESSION['user_email']))?'':'dropdown-toggle');?>" href="<?=((!isset($_SESSION['user_email']))?'/Dailyneeds/admin/rform/user_login.php':'/Dailyneeds/user_index.php');?>"  data-toggle="<?=((!isset($_SESSION['user_email']))?'':'dropdown');?>"
      data-target="<?=((!isset($_SESSION['user_email']))?'':'#');?>" style="color:white;"><span class="glyphicon glyphicon-home"></span><?=((!isset($_SESSION['user_email']))?' Login':' My Account');?></a>
      <ul class="<?=((!isset($_SESSION['user_email']))?'':'dropdown-menu');?>" role="<?=((!isset($_SESSION['user_email']))?'':'menu');?>" style="background-color: #66ccff;">
      <?php if(isset($_SESSION['user_email'])) :?>
      <li><a href="user_logout.php"><b><span style="color: #801a00;"></span> LogOut </b></a></li>
      <?php endif;?>
       </ul>
    </li>
</ul>

</div>
</div>
</nav>
<div><br><br></div>
<script>
$('ul.nav li.dropdown').hover(function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
});
</script>
