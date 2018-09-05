photo<?php
include 'core/init.php';
include 'includes/userHead.php';
//include 'includes/navigation.php';
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




   if($_POST){
      $errors = array();
     $emailQuery="SELECT * FROM customer2 WHERE email = '$u_email' AND id != '$u_id'";

     $result = $db->query($emailQuery);
     $count= mysqli_num_rows($result);
    // echo $count;
      $name = ((isset($_POST['name']))?sanitize($_POST['name']):'');
      $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
      $photo =((isset($_POST['photo']))?sanitize($_POST['photo']):'');

      $mobile = ((isset($_POST['mobile']))?sanitize($_POST['mobile']):'');
      $address = ((isset($_POST['address']))?sanitize($_POST['address']):'');

      //
      // if (isset($_POST['photo']['name']) == '')
      // {
      //     // cover_image is empty (and not an error)
      //     $photo =$u_photo;
      // }



      // if ($_FILES['photo']['size'] == 0 && $_FILES['photo']['error'] == 0)
      //   {
      //       // cover_image is empty (and not an error)
      //       $photo = $u_photo;
      //   }

        // if(empty($_FILES))
        // {
        //     $photo = $u_photo;
        // }
        // else {
        //   $photo = $photo;
        // }
     // if ($_FILES['cover_image'] == " ")
     //  {
     //        // Code comes here
     //        echo "string";
     //         $photo = $u_photo;
     //  }
     //  else{
     //    echo "sadsad";
     //    $photo = $phot;
     //  }

     // if ($_FILES['cover_image']['error'] > 0)
     //  {
     //      // cover_image is empty (and not an error)
     //      $photo = $u_photo;
     //  }

      // if(empty($_FILES['cover_image']['tmp_name']) || !is_uploaded_file($_FILES['cover_image']['tmp_name']))
      // {
      //    // Handle no image here...
      //
      // }

     $required = array('name','email','mobile','address');
     foreach($required as $field){
       if(empty($_POST[$field])){
         $errors[] = 'You must fill out all fields.';
         break;
       }
     }
     // if(strlen($photo) < 6){
     //   $errors[] = 'Your photo must be at least 6 charecters';
     // }

     // if ($_FILES != '')
     // {
     //     $photo =$_POST['photo'];
     //    // $errors[] = 'sadkjasndsad  .';
     // }else{
     //   $photo = $u_photo;
     // }

     if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
       $errors[] = 'You must enter a valid email .';
     }
     if(!empty($errors)){?>
      <div id="err" style="margin-top:50px;">
     <?php echo display_errors($errors);?>
     </div>
     <?php
     }else{
     //add  user to database
    // $hashed = photo_hash($photo,photo_DEFAULT);
        $sql = "UPDATE customer2 SET name = '$name' , email = '$email', mobile = '$mobile', address = '$address' WHERE id = '$u_id'";
    //    $sql2="UPDATE review SET image = '$photo' WHERE email='$email'";
        $db->query($sql);
        $db->query($sql2);


         if($email != $u_email)
         {
           unset($_SESSION['user_email']);
          header('Location: /Dailyneeds/index.php');

         }else{
           header('Location: /Dailyneeds/account_info.php');
         }

     }

}
?>
