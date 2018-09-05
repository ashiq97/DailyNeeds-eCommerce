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

  $u_id = $result_uinfo['id'];
  $u_name = $result_uinfo['name'];
  $u_email = $result_uinfo['email'];
  $u_mobile = $result_uinfo['mobile'];
  $u_photo = $result_uinfo['image'];
  $u_address = $result_uinfo['address'];
}
?>
<div class="col-md-8">
<h2 class="text-center"> My Account information </h2><hr>
  <form class="" action="account_insert.php" method="post">
    <div class="form-group col-md-4">
       <label for="address"> Address:</label>
      <!--  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> -->
        <textarea style="margin-bottom:10px;" id="address" class="form-control" name="address" rows="5"><?=$u_address;?></textarea>

</div>
     <div class="form-group col-md-4 ">
       <label for="name">Full Name:</label>
       <div class="input-group">
       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
       <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" value="<?=$u_name;?>">
     </div>
   </div>
     <div class="form-group col-md-4 ">
       <label for="email">Email:</label>
       <div class="input-group">
       <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
       <input type="text" name="email" id="email" class="form-control" placeholder="E-Mail address" readonly value="<?=$u_email;?>">
     </div>
   </div>
   <div class="form-group col-md-4">
       <label for="mobile"> Mobile Number:</label>
       <div class="input-group">
       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
       <input type="text" name="mobile" id="mobile" class="form-control" value="<?=$u_mobile;?>">
     </div></div>
     <!-- <div class="form-group col-md-4 ">
       <label for="photo">Photo:</label>
       <div class="input-group">
       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> -->
       <!-- <input type="photo" name="photo" id="photo" class="form-control" readonly value=""> -->
       <!-- <label for="photo">Product photo</label> -->
       <!-- <input type="file" id="photo" name="photo" class="form-control">
     </div></div> -->



     <div class="form-group col-md-3 text-right" style="margin-top:25px;">
       <a href="" class="btn btn-default">Cancel</a>
       <input type="submit"  value="Update" class="btn btn-success">
       <!-- <input type="submit" class="btn btn-primary" value="Add User"> -->
     </div>

   </form>


   <form class="" action="account2_info.php" method="post">
     <div class="form-group col-md-4 ">
       <label for="photo">Photo:</label>
       <div class="input-group">
       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
       <!-- <input type="photo" name="photo" id="photo" class="form-control" readonly value=""> -->
       <!-- <label for="photo">Product photo</label> -->
        <input type="file" name="c_image" id="c_image" class="form-control">
     </div></div>
     <div class="form-group col-md-3" style="margin-top:25px;">
       <!-- <a href="" class="btn btn-default">Cancel</a> -->
       <input type="submit"  value="Upload" name="Upload" class="btn btn-success">
       <!-- <input type="submit" class="btn btn-primary" value="Add User"> -->
     </div>


   </form>
 </div>
