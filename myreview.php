<?php
include 'core/init.php';
include 'includes/userHead.php';
include 'includes/navigation.php';
include 'includes/userheaderfull.php';
include 'includes/userLeftbar.php';

$sql="SELECT * FROM review WHERE email = {'$user_email'}";
$db->query($sql);
if(isset($_SESSION['user_email']))
{
  $user_email = sanitize($_SESSION['user_email']);
  $user_info = $db->query("SELECT * FROM review WHERE email = '{$user_email}'");
  $result_uinfo = mysqli_fetch_assoc($user_info);
  $count= mysqli_num_rows($user_info);

  //$u_image = $result_uinfo['image'];
  $u_id = $result_uinfo['id'];
  $u_name = $result_uinfo['name'];
  $u_review = $result_uinfo['description'];
}

?>

<br>
<br>

<div class="col-md-6">
<div class="text-center">
<h2 class="text-center" style="color: #660000; margin:20px;" > My FeedBack</h2>
</div>
</div>
<div class="col-md-8">
<form class="form-horizontal" action="review_insert.php" method="post">
              <div class="form-group">
                  <div class="col-lg-10">
                      <textarea class="form-control" name="review" id="review" placeholder="Please say something  " maxlength="300" rows="6" ></textarea>
                  </div>
              </div>

      <!-- <input type="submit" name="submit" value="send"> -->
  <!-- <td><a href="include_r.php?edit=<?=$brand['id'];?>" class="btn btn-md btn-primary"><span class="glyphicon glyphicon-pencil"></span></a></td> -->
  <div class="form-group col-md-3 ">
    <button type="reset" class="btn btn-warning">Cancel</button>
    <?php if($count > 0): ?>
    <input type="submit"  value="Update" name="update" class="btn btn-success">
  <?php else : ?>
    <input type="submit"  value="Send" name="submit" class="btn btn-success">
  <?php endif; ?>
  </div>
  <?php if($count > 0): ?>
    <div id="login-form">
    	<div>
        <p><i style="color:#C70039;"><?=$result_uinfo['description'];?></i><p>
      </div>
    </div>
  <?php endif; ?>
    <!-- <input type="submit"  value="" class="btn btn-success"> -->
    <!-- <a href="products.php?edit=<?=$product['id']; ?>" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></a> -->
    <!-- <input type="submit" class="btn btn-primary" value="Add User"> -->



</form>
</div>
