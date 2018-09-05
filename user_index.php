<?php
include 'core/init.php';
include 'includes/userHead.php';
include 'includes/navigation.php';
include 'includes/userheaderfull.php';
include 'includes/userLeftbar.php';
if(isset($_SESSION['user_email']))
{
  $user_email = sanitize($_SESSION['user_email']);
  $user_info = $db->query("SELECT * FROM customer2 WHERE email = '{$user_email}'");
  $result_uinfo = mysqli_fetch_assoc($user_info);

  // $im = $result_uinfo['image'];
  $u_id = $result_uinfo['id'];
  $u_name = $result_uinfo['name'];
}
?>
<div class="col-md-6 text-left" style="margin-top:30px;">
  <div class=" col-md-4" >
Hello, <i class="material-icons"><h3><span style="color:green;"><?=$u_name;?></span><h3></i>
  </div>
    <div class="col-md-4">
  <img src="<?=(($result_uinfo['image'] == '')?'images/products/reviewimg.png':'images/products/'.$result_uinfo['image']);?>"  alt="user" style="width:100px;height:100px;border-radius: 70%;">
    </div>
</div>
