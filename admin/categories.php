<?php
   require_once $_SERVER['DOCUMENT_ROOT'].'/Dailyneeds/core/init.php';
   if(!is_logged_in()){
     login_error_redirect();
   } 
   include 'includes/head.php';
   include 'includes/navigation.php';

   $sql = "SELECT * FROM categories WHERE  parent = 0";
   $result = $db->query($sql);
   $errors = array();
   $category_frm_txt = '';
   $parent_frm_txt = '';
// Edit Category
if(isset($_GET['edit']) && !empty($_GET['edit'])){
  $edit_id = (int)$_GET['edit'];
  $edit_id = sanitize($edit_id);
  $edit_sql = "SELECT * FROM categories WHERE id = $edit_id";
  $edit_result = $db->query($edit_sql);
  $cat_array = mysqli_fetch_assoc($edit_result);
}



//Delete Category
  if(isset($_GET['delete']) && !empty($_GET['delete'])){
    $delete_id = (int)$_GET['delete'];
    $delete_id = sanitize($delete_id);
    $sql = "SELECT * FROM categories WHERE id = '$delete_id'";
    $result = $db->query($sql);
    $cat_array = mysqli_fetch_assoc($result);
    if ($cat_array['parent'] == 0){
       $sql = "DELETE FROM categories WHERE parent = '$delete_id'";
       $db->query($sql);
      //echo "hi";
    }
    $dsql =  "DELETE FROM categories WHERE id = '$delete_id'";
    $db->query($dsql);

  header('Location: categories.php');

  }


// procees Form
if(isset($_POST) && !empty($_POST)){
  $parent_frm_txt = sanitize($_POST['parent']);
  $category_frm_txt = sanitize($_POST['category']);
  $sqlform = "SELECT * FROM categories WHERE category = '$category_frm_txt' AND parent = '$parent_frm_txt' ";
  if(isset($_GET['edit']))
  {
    $eid = $cat_array['id'];
    $sqlform = "SELECT * FROM categories WHERE category =  '$category_frm_txt' AND parent = '$parent_frm_txt' AND id != $eid ";
  }


  $fresult = $db->query($sqlform);
  $count = mysqli_num_rows($fresult);
  //if category is blank
  if($category_frm_txt == '')
  {
    $errors[] .= 'THe category cannot be left blank';
  }
  // if exist in the database
  if($count > 0)
  {
    $errors[] .= $category_frm_txt. ' already exists . Please choose a new category.  '  ;
  }
  // Display errors or Updates database
  if(!empty($errors)){
    //dispaly errors
    $display = display_errors($errors); ?>
    <script>
      jQuery('document').ready(function(){
        jQuery('#errors').html('<?=$display; ?>');
      });
    </script>
  <?php }else{
    //update database
    $update_sql = "INSERT INTO categories (category,parent) VALUES ('$category_frm_txt','$parent_frm_txt') ";
    if(isset($_GET['edit'])){
      $update_sql = "UPDATE categories SET category = '$category_frm_txt', parent = '$parent_frm_txt' WHERE id ='$edit_id' " ;
    }
    $db->query($update_sql);
    header('Location: categories.php');
  }

}

$category_value = '';
$parent_value = 0;
if(isset($_GET['edit'])){
  $category_value = $cat_array['category'];
  $parent_value = $cat_array['parent'];
}else {
  if(isset($_POST)){
    $category_value = $category_frm_txt;
    $parent_value = $parent_frm_txt;
  }
}

?>
<h2 class="text-center"> Categories </h2><hr>
<div class="row">
 <!-- This is for Form  -->
  <div class="col-md-6">

    <form class="form" action="categories.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" method="post">
      <legend><?=((isset($_GET['edit']))?'Edit ':'Add A '); ?> Category</legend>
      <div id="errors"></div>
      <div class="form-group">
        <label for="parent">Parent</label>
        <select class="form-control" name="parent" id="parent">
          <option value="0"<?=(($parent_value == 0)?' selected="selected"':'');?>>Parent</option>
          <?php while($parent = mysqli_fetch_assoc($result)):  ?>
            <option value="<?=$parent['id'];?>"<?=(($parent_value == $parent['id'])?' selected="selected"':'');?>><?=$parent['category']; ?></option>
          <?php endwhile; ?>

        </select>
      </div>
      <div class="form-group">
      <label for="category">Category</label>
      <input type="text" class="form-control" id="category" name="category" value="<?=$category_value; ?>">
      </div>
      <div class="form-group">
        <input type="submit" value="<?=((isset($_GET['edit']))?'Edit':'Add'); ?> Category " class="btn btn-success">

      </div>
    </form>

  </div>


 <!-- category table  -->
  <div class="col-md-6"><!--FOR table -->
    <table class="table table-bordered">
      <thead>
        <th>Category</th><th>Parent</th><th></th>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM categories WHERE  parent = 0";
        $result = $db->query($sql);
        while($parent = mysqli_fetch_assoc($result)):
          $parent_id = (int)$parent['id'];
          //echo "$parent_id";
          $sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
          $cresult = $db->query($sql2);
        //  echo $cresult;
        ?>
        <tr class="bg-primary">
          <td><?= $parent['category']; ?></td>
          <td>Parent</td>
          <td>
            <a href="Categories.php?edit=<?= $parent['id']; ?>" class="btn btn-xm btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
            <a href="Categories.php?delete=<?= $parent['id']; ?>" class="btn btn-xm btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
          </td>
        </tr>
        <?php while($child=mysqli_fetch_assoc($cresult)): ?>
          <tr class="bg-info">
            <td><?= $child['category']; ?></td>
            <td><?= $parent['category'];?></td>
            <td>
              <a href="Categories.php?edit=<?= $child['id']; ?>" class="btn btn-xm btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
              <a href="Categories.php?delete=<?= $child['id']; ?>" class="btn btn-xm btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
            </td>
          </tr>
        <?php endwhile; ?>

      <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>


<?php include 'includes/footer.php'; ?>
