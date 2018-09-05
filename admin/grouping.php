<?php
require_once '../core/init.php';
if(!is_logged_in()){
  login_error_redirect();
}
include 'includes/head.php';
include 'includes/navigation.php';
 // include er jinispati tui tor ta dibi ar sql er jinis

//get brands from database
$sql="SELECT * FROM grouping ORDER BY group_name ";
$results = $db->query($sql);
$errors=array();
// Edit brand

if(isset($_GET['edit']) && !empty($_GET['edit'])){
  $edit_id = (int)$_GET['edit'];
  $edit_id = sanitize($edit_id);
  //echo $edit_id;
  $sql2 = "SELECT * FROM grouping WHERE id = '$edit_id'";
  $edit_result = $db->query($sql2);
  $egroup = mysqli_fetch_assoc($edit_result);
//  header('Location: brands.php');
}


// Delete Brand
if(isset($_GET['delete']) && !empty($_GET['delete']))
{
  $delete_id = (int)$_GET['delete'];
  $delete_id = sanitize($delete_id);
  $sql="DELETE FROM grouping WHERE id = '$delete_id'";
  $db->query($sql);
  header('Location: grouping.php');
}



// <!-- if add form is submitted -->

if(isset($_POST['add_submit'])){
  $group_frm_txt = sanitize($_POST['group']);
  // check if brand is blank
  //if($_POST['brand'] == '')
 if($group_frm_txt == '')
  {
    $errors[].='You must enter a Group name!';

  }
  // check if brand exist in database
  $sql="SELECT * FROM grouping WHERE group_name = '$group_frm_txt'";
  if(isset($_GET['edit']))
  {
    $sql="SELECT * FROM grouping WHERE group_name = '$group_frm_txt' AND id != '$edit_id'";
    ///echo "$edit_id";
  }
  $result = $db->query($sql);
  $count= mysqli_num_rows($result);
  echo $count;
  if($count > 0 )
  {
    $errors[] .= $brand_frm_txt.' already exist. Please Choose another Group name...';
  }

  //display errors
  if(!empty($errors)){ // mane error arrayte error ache  i mn errors box ta khali na
    echo display_errors($errors);
  }else { // jodi error box ta khaloi thake mane error nei

    // Add brand to database
    $sql = "INSERT INTO grouping (group_name) VALUES ('$group_frm_txt') ";
    if(isset($_GET['edit']))
    {
      $sql = "UPDATE grouping SET group_name = '$group_frm_txt' WHERE id = '$edit_id' ";
    }
    $db->query($sql);
    header('Location: grouping.php');
  }


}
// error function

//   function display_errors($errors){
//   $display = '<ul class="bg-danger">';
//   foreach ($errors as $error) {
//     # code...
//     $display .= '<li class="text-danger">'.$error.'</li>';
//   }
//   $display .= '</ul>';
//   return $display;
// }


 ?>



<h2 class="text-center">Grouping</h2><hr>
<!-- Brand Form -->

<div class="text-center">
    <form class="form-inline" action="grouping.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" method="post">
      <div class="form-group">
        <?php
        $group_value = '';
        if(isset($_GET['edit'])){
          $group_value = $egroup['group_name'];
        }else{
          if(isset($_POST['group']))
          {
            $group_value = sanitize($_POST['group']);
          }
        }
         ?>
        <label for="group"><?= ((isset($_GET['edit']))?'Edit':'Add A'); ?> Group</label>

        <input type="text" name="group" id="group" class="form-control" value="<?=$group_value; ?>">
        

        <?php if(isset($_GET['edit'])): ?>


        <a href="grouping.php" class="btn btn-default">Cancel</a>
        <?php endif; ?>
        <input type="submit" name="add_submit"  value="<?=((isset($_GET['edit']))?'Edit':'Add'); ?> Group" class="btn btn-success">

      </div>

    </form>
</div>
<hr>



<table class="table table-bordered table-striped table-condensed"  style="width:auto; margin:0 auto">
  <thead>
    <th></th>
    <th>Grouping</th>

    <th></th>
  </thead>
  <tbody>
    <?php while($group = mysqli_fetch_assoc($results)): ?>
      <tr>
        <td><a href="grouping.php?edit=<?=$group['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a></td>
        <td><?= $group['group_name']; ?></td>
        
        <td><a href="grouping.php?delete=<?=$group['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a></td>
      </tr>
  <?php endwhile; ?>
    </tbody>
</table>


<?php include 'includes/footer.php'; ?>
