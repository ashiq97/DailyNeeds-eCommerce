
<?php
require_once '../core/init.php';
if(!is_logged_in()){
  login_error_redirect();
}
if(!has_permission('admin'))
{
  permission_error_redirect('index.php');
}
include 'includes/head.php';
include 'includes/navigation.php';
 // echo $_SESSION['SBUser'];
 if(isset($_GET['delete'])){
   $delete_id = sanitize($_GET['delete']);
   $db->query("DELETE FROM admin_user WHERE id = '$delete_id'");
   $_SESSION['success_flash']  = 'User has been deleted!';
   header('Location: admin_users.php');

 }
 if(isset($_GET['edit']) && !empty($_GET['edit'])){
   $edit_id = (int)$_GET['edit'];
   $edit_id = sanitize($edit_id);
   //echo $edit_id;
   $sqledit = "SELECT * FROM admin_user WHERE id = '$edit_id'";
   $edit_result = $db->query($sqledit);
   $eUpdate = mysqli_fetch_assoc($edit_result);
 //  header('Location: brands.php');
 //$db->query("DELETE FROM admin_user WHERE id = '$delete_id'");
  // $_SESSION['success_flash']  = 'User has been updated!';
  // header('Location: admin_users.php');
 }

 if (isset($_GET['add']) || isset($_GET['edit'])){
   $name = ((isset($_POST['name']))?sanitize($_POST['name']):'');

  $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');

   $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');

   $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');

   $permissions = ((isset($_POST['permissions']))?sanitize($_POST['permissions']):'');


   if(isset($_GET['edit'])){
   $edit_id = (int)$_GET['edit'];
   $edit_id = sanitize($edit_id);
   $sqledit = "SELECT * FROM admin_user WHERE id = '$edit_id'";
   $edit_result = $db->query($sqledit);
   $eUpdate = mysqli_fetch_assoc($edit_result);
   //$name = ((isset($_POST['name']))?sanitize($_POST['name']):'');
   $name =((isset($_POST['name']) && $_POST['name'] != '')?sanitize($_POST['name']): $eUpdate['full_name']);
   //$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
   $email =((isset($_POST['email']) && $_POST['email'] != '')?sanitize($_POST['email']): $eUpdate['email']);
   //$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
   $password =((isset($_POST['password']) && $_POST['password'] != '')?sanitize($_POST['password']): $eUpdate['password']);
   //$confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
   $confirm =((isset($_POST['confirm']) && $_POST['confirm'] != '')?sanitize($_POST['confirm']):$eUpdate['password']);
  // $permissions = ((isset($_POST['permissions']))?sanitize($_POST['permissions']):'');
   $permissions =((isset($_POST['permissions']) && $_POST['permissions'] != '')?sanitize($_POST['permissions']): $eUpdate['permission']);
 }
   $errors = array();
   if($_POST){
    // $emailQuery = $db->query("SELECT * FROM admin_user WHERE email = '$email'");
    // $emailCount = mysqli_num_rows($emailQuery);
    $emailQuery =("SELECT * FROM admin_user WHERE email = '$email'");
    // $sql="SELECT * FROM brand WHERE brand_name = '$brand_frm_txt'";
     if(isset($_GET['edit']))
     {
       $emailQuery="SELECT * FROM admin_user WHERE email = '$email' AND id != '$edit_id'";
       ///echo "$edit_id";
     }
     $result = $db->query($emailQuery);
     $count= mysqli_num_rows($result);
    // echo $count;

     if($count > 0 )
     {
       $errors[]  .= $email.' already exist in our database .';
     }


     $required = array('name','email','password','confirm','permissions');
     foreach($required as $field){
       if(empty($_POST[$field])){
         $errors[] = 'You must fill out all fields.';
         break;
       }
     }
     if(strlen($password) < 6){
       $errors[] = 'Your password must be at least 6 charecters';
     }
     if($password != $confirm){
       $errors[] = 'Your password don\'t match. ';
     }
     if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
       $errors[] = 'You must enter a valid email.';
     }


     if(!empty($errors)){
     echo display_errors($errors);
     }else{
     //add  user to database
     $hashed = password_hash($password,PASSWORD_DEFAULT);

     if(isset($_GET['edit']))
     {
        $sql = "UPDATE admin_user SET full_name = '$name' , email = '$email', password = '$password' ,permission = '$permissions' WHERE id = '$edit_id'";
        $db->query($sql);
        $_SESSION['success_flash'] = 'user has been updated!';
        header('Location: admin_users.php');
     }else{
     $sql ="INSERT INTO admin_user (full_name,email,password,permission) VALUES ('$name','$email','$hashed','$permissions')";
     $db->query($sql);
     $_SESSION['success_flash'] = 'user has been added!';
    // $db->query("INSERT INTO admin_user (full_name,email,password,permission) VALUES ('$name','$email','$hashed','$permissions')");
    // $_SESSION['success_flash'] = 'user has been added!';
     header('Location: admin_users.php');
      }
     }
}

   ?>
   <h2 class="text-center">Add A New User</h2><hr>
   <form class="" action="admin_users.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1'); ?>" method="post" >
     <div class="form-group col-md-4 ">
       <label for="name">Full Name:</label>
       <div class="input-group">
       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
       <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" value="<?=$name?>">
     </div>
   </div>
     <div class="form-group col-md-4 ">
       <label for="email">Email:</label>
       <div class="input-group">
       <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
       <input type="text" name="email" id="email" class="form-control" placeholder="E-Mail address" value="<?=$email?>">
     </div>
   </div>
     <div class="form-group col-md-4 ">
       <label for="password">Password:</label>
       <div class="input-group">
       <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
       <input type="password" name="password" id="password" class="form-control" <?= ((isset($_GET['edit']))?'readonly':'');?> value="<?=$password?>">
     </div></div>
     <div class="form-group col-md-4">
       <label for="confirm">Confirm Password:</label>
       <div class="input-group">
       <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
       <input type="password" name="confirm" id="confirm" class="form-control"  <?= ((isset($_GET['edit']))?'readonly':'');?> value="<?=$confirm?>">
     </div></div>
     <div class="form-group col-md-4">
       <label for="name">Permission:</label>
       <div class="input-group">
       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
       <select class="form-control" name="permissions">
         <option value=""<?=(($permissions == '')?' selected':'');?>></option>
         <option value="editor"<?=(($permissions == 'editor')?' selected':'');?>>Editor</option>
         <option value="admin,editor"<?=(($permissions == 'admin,editor')?' selected':'');?>>Admin</option>
       </select>
     </div>
</div>


     <div class="form-group col-md-4 text-right" style="margin-top:25px;">
       <a href="admin_users.php" class="btn btn-default">Cancel</a>
       <input type="submit"  value="<?=((isset($_GET['edit']))?'Edit':'Add'); ?> Users" class="btn btn-success">
       <!-- <input type="submit" class="btn btn-primary" value="Add User"> -->
     </div>

   </form>
   <?php
 }else{


 $userQuery = $db->query("SELECT * FROM admin_user ORDER BY full_name");

 ?>

<h2 class="text-center">Users</h2>
<a href="admin_users.php?add=1" class="btn btn-success pull-right" id="add-product-btn">Add New Users</a>

<hr>
<table class="table table-bordered table-striped table-codensed">
  <thead>
    <th></th>
    <th>Name</th>
    <th>Email</th>
    <th>Join Date</th>
    <th>Last Login</th>
    <th>permissions</th>
  </thead>
  <tbody>
    <?php while($user = mysqli_fetch_assoc($userQuery))  : ?>
    <tr>
      <td>
        <?php if($user['id'] != $user_data['id']): ?>
          <a href="admin_users.php?delete=<?=$user['id']?>"class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove"></span></a>
          <a href="admin_users.php?edit=<?=$user['id']?>"class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
        <?php endif; ?>
        <?php if($user['id'] == $user_data['id']): ?>
          <a href="admin_users.php?edit=<?=$user['id']?>"class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
        <?php endif; ?>
      </td>
      <td><?= $user['full_name'];?></td>
      <td><?=$user['email'];?></td>
      <td><?=pretty_date($user['join_date']);?></td>
      <td><?=(($user['last_login'] =='0000-00-00 00:00:00')?'Never':pretty_date($user['last_login']));?></td>
      <td><?=$user['permission'];?></td>

    </tr>
  <?php endwhile; ?>
  </tbody>
</table>
<?php } include 'includes/footer.php'; ?>
