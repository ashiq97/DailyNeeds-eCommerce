<?php
require_once '../core/init.php';
if(!is_logged_in()){
  login_error_redirect();
}
include 'includes/head.php';
include 'includes/navigation.php';
 // include er jinispati tui tor ta dibi ar sql er jinis

//get brands from database
$sql="SELECT * FROM brand ORDER BY brand_name ";
$results = $db->query($sql);
$errors=array();
// Edit brand

if(isset($_GET['edit']) && !empty($_GET['edit'])){
  $edit_id = (int)$_GET['edit'];
  $edit_id = sanitize($edit_id);
  //echo $edit_id;
  $sql2 = "SELECT * FROM brand WHERE id = '$edit_id'";
  $edit_result = $db->query($sql2);
  $ebrand = mysqli_fetch_assoc($edit_result);
//  header('Location: brands.php');
}


// Delete Brand
if(isset($_GET['delete']) && !empty($_GET['delete']))
{
  $delete_id = (int)$_GET['delete'];
  $delete_id = sanitize($delete_id);
  $sql="DELETE FROM brand WHERE id = '$delete_id'";
  $db->query($sql);
  header('Location: brands.php');
}



// <!-- if add form is submitted -->

if(isset($_POST['add_submit'])){
  $brand_frm_txt = sanitize($_POST['brand']);
  // check if brand is blank
  //if($_POST['brand'] == '')
 if($brand_frm_txt == '')
  {
    $errors[].='You must enter a brand name!';

  }
  // check if brand exist in database
  $sql="SELECT * FROM brand WHERE brand_name = '$brand_frm_txt'";
  if(isset($_GET['edit']))
  {
    $sql="SELECT * FROM brand WHERE brand_name = '$brand_frm_txt' AND id != '$edit_id'";
    ///echo "$edit_id";
  }
  $result = $db->query($sql);
  $count= mysqli_num_rows($result);
  echo $count;
  if($count > 0 )
  {
    $errors[] .= $brand_frm_txt.' already exist. Please Choose another brand name...';
  }

  //display errors
  if(!empty($errors)){ // mane error arrayte error ache  i mn errors box ta khali na
    echo display_errors($errors);
  }else { // jodi error box ta khaloi thake mane error nei

    // Add brand to database
    $sql = "INSERT INTO brand (brand_name) VALUES ('$brand_frm_txt') ";
    if(isset($_GET['edit']))
    {
      $sql = "UPDATE brand SET brand_name = '$brand_frm_txt' WHERE id = '$edit_id' ";
    }
    $db->query($sql);
    header('Location: brands.php');
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



<h2 class="text-center">Brands</h2><hr>
<!-- Brand Form -->

<div class="text-center">
    <form class="form-inline" action="brands.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" method="post">
      <div class="form-group">
        <?php
        $brand_value = '';
        if(isset($_GET['edit'])){
          $brand_value = $ebrand['brand_name'];
        }else{
          if(isset($_POST['brand']))
          {
            $brand_value = sanitize($_POST['brand']);
          }
        }
         ?>
        <label for="brand"><?= ((isset($_GET['edit']))?'Edit':'Add A'); ?> Brand</label>

        <input type="text" name="brand" id="brand" class="form-control" value="<?=$brand_value; ?>">
        

        <?php if(isset($_GET['edit'])): ?>


        <a href="brands.php" class="btn btn-default">Cancel</a>
        <?php endif; ?>
        <input type="submit" name="add_submit"  value="<?=((isset($_GET['edit']))?'Edit':'Add'); ?> Brand" class="btn btn-success">

      </div>

    </form>
</div>
<hr>



<table class="table table-bordered table-striped table-condensed"  style="width:auto; margin:0 auto">
  <thead>
    <th></th>
    <th>Brands</th>

    <th></th>
  </thead>
  <tbody>
    <?php while($brand = mysqli_fetch_assoc($results)): ?>
      <tr>
        <td><a href="brands.php?edit=<?=$brand['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a></td>
        <td><?= $brand['brand_name']; ?></td>
        
        <td><a href="brands.php?delete=<?=$brand['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a></td>
      </tr>
  <?php endwhile; ?>
    </tbody>
</table>


<?php include 'includes/footer.php'; ?>
