<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/Dailyneeds/core/init.php';
if(!is_logged_in()){
  login_error_redirect();
}
include 'includes/head.php';
include 'includes/navigation.php';
//Delete products
if(isset($_GET['delete'])){
  $id = sanitize($_GET['delete']);
  $db->query("UPDATE products SET deleted = 1 WHERE id = '$id'");
  header('Location: products.php ');


}


$dbpath ='';
if (isset($_GET['add']) || isset($_GET['edit'])) {
  # code...
  $brand_query = $db->query("SELECT * FROM brand ORDER BY brand_name");
  $group_query = $db->query("SELECT * FROM grouping ORDER BY group_name");
  $parent_query = $db->query("SELECT * FROM categories WHERE parent = 0 ORDER BY category ");
// for sizes and quantity preview

  $title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']):'');
  $qamount_array = array();

  $brand = ((isset($_POST['brand']))?sanitize($_POST['brand']):'');
  $group = ((isset($_POST['group']) && !empty($_POST['group']))?sanitize($_POST['group']):'');
  $parent = ((isset($_POST['parent']) && !empty($_POST['parent']))?sanitize($_POST['parent']):'');
  $category_var = ((isset($_POST['child']) && !empty($_POST['child']))?sanitize($_POST['child']):'');
  $price = ((isset($_POST['price']) && $_POST['price'] != '')?sanitize($_POST['price']):'');
  $list_price = ((isset($_POST['unit_amount']))?sanitize($_POST['unit_amount']):'');
  $u_amount = ((isset($_POST['u_amount']) && $_POST['u_amount'] != '')?sanitize($_POST['u_amount']):'');
  $description = ((isset($_POST['description']))?sanitize($_POST['description']):'');
    $sizes_qamount = ((isset($_POST['qamount']) && $_POST['qamount'] != '')?sanitize($_POST['qamount']):'');
    $sizes_qamount = rtrim($sizes_qamount,',');
    $saved_image = '';
  if(isset($_GET['edit']))
  {
    $edit_id = (int)$_GET['edit'];
    $product_result = $db->query("SELECT * FROM products WHERE id = '$edit_id'");
    $product_res = mysqli_fetch_assoc($product_result);
      if(isset($_GET['delete_image'])){
        $image_url = $_SERVER['DOCUMENT_ROOT'].$product_res['image'];echo $image_url;
        unlink($image_url);
        $db->query("UPDATE products SET image = '' WHERE id = '$edit_id'");
        header('Location: products.php?edit='.$edit_id);
      }

    $title =((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']): $product_res['title']);
    $category_var = ((isset($_POST['child']) && $_POST['child'] != '' )?sanitize($_POST['child']):$product_res['categories']);
    $brand =((isset($_POST['brand']))?sanitize($_POST['brand']):$product_res['brand']);
    $group =((isset($_POST['group']))?sanitize($_POST['group']):$product_res['grouping']);
    $parentQ = $db->query("SELECT * FROM categories WHERE id = '$category_var'");
    $parent_result2 = mysqli_fetch_assoc($parentQ);
    $parent =((isset($_POST['parent']) && $_POST['parent'] != '')?sanitize($_POST['parent']):$parent_result2['parent']);
    $price =((isset($_POST['price']) && $_POST['price'] != '')?sanitize($_POST['price']): $product_res['price']);
    $list_price = ((isset($_POST['unit_amount']))?sanitize($_POST['unit_amount']):$product_res['list_price']);
    $u_amount = ((isset($_POST['u_amount']) && $_POST['u_amount'] != '')?sanitize($_POST['u_amount']):$product_res['u_Amount']);

    $description = ((isset($_POST['description']))?sanitize($_POST['description']):$product_res['description']);
    $sizes_qamount = ((isset($_POST['qamount']) && $_POST['qamount'] != '')?sanitize($_POST['qamount']):$product_res['sizes']);
    $sizes_qamount = rtrim($sizes_qamount,',');
    $saved_image = (($product_res['image'] != '')?$product_res['image']:'');
    $dbpath = $saved_image;
  }
  if(!empty($sizes_qamount)){
    $qamount_string = sanitize($sizes_qamount);
    $qamount_string = rtrim($qamount_string,',');//echo $qamount_string;
    $qamount_array = explode(',',$qamount_string);
    $sarray = array();
    $qarray = array();
    $tarray = array();
    foreach ($qamount_array as $ss) {
      $s = explode(':',$ss);
      $sarray[] = $s[0];//size ex -> small, large
      $qarray[] = $s[1];// quantity -> 1, 2, 4
      $tarray[] = $s[2];
    }

  }else {
    $qamount_array = array();
  }

  // for insert case for the form
  // $title = sanitize($_POST['title']);
  // $brand = sanitize($_POST['brand']);
  // $categories = sanitize($_POST['child']);
  // $price = sanitize($_POST['price']);
  // $list_price_unit_amount = sanitize($_POST['unit_amount']);
  // $sizes_qamount  = sanitize($_POST['qamount']);
  // $sizes_qamount = rtrim($sizes_qamount,',');
  // $description = sanitize($_POST['description']);
  //$errors = array();

  // form validation


if($_POST){
  $errors = array();
  $required = array('title','price','parent','child','qamount'); // here qamount is sizes
  foreach ($required as $field ) {
    if($_POST[$field] == ''){
      $errors[] = 'All fields with and Astrisk are required.';
      break;
    }
  }
  if ($_FILES['photo']['name'] != '') {
    # code...

    var_dump($_FILES);
    // for photo case
    //$dbpath = '';
    //var_dump($_FILES); // no need
    $photo = $_FILES['photo'];
    $name = $photo['name'];
    $nameArray = explode('.',$name);
    $fileName = $nameArray[0];
    $fileExt = $nameArray[1];
    $mime = explode('/',$photo['type']);
    $mimeType = $mime[0];
    $mimeExt = $mime[1];
    $tmpLoc = $photo['tmp_name'];
    $fileSize = $photo['size'];
    $allowed = array('png','jpg','jpeg','gif');
    $upload_name = md5(microtime()).'.'.$fileExt;
    $upload_path = BASEURL.'images/products/'.$name;
    $dbpath = '/Dailyneeds/images/products/'.$name;

    if($mimeType != 'image'){
      $errors[] = 'The file must be an image .';
    }
    if (!in_array($fileExt, $allowed)) {
      $errors[] = 'The file extension  must be an png,jpg, jpeg, or gif ';
    }
    if($fileSize > 15000000){
      $errors[] = 'The file size must be under 15MB';
    }
    if ($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')) {
      $errors[] = 'The file extansion does not match the file';
    }

  }
  if(!empty($errors)){
    echo display_errors($errors);
  }else{
    //upload file and insert into  database
    if(!empty($_FILES)){
    move_uploaded_file($tmpLoc,$upload_path);
  }
    $insertSql = "INSERT INTO products (`title`,`price`,`list_price`,`u_Amount`,`brand`,`categories`,`sizes`,`image`,`description`,`grouping`)
     VALUES ('$title','$price','$list_price','$u_amount','$brand','$category_var','$sizes_qamount','$dbpath','$description','$group')";
     if(isset($_GET['edit']))
     {
       $insertSql = "UPDATE products SET title = '$title', price = '$price', list_price = '$list_price',u_Amount = '$u_amount',
       brand = '$brand', categories = '$category_var', sizes = '$sizes_qamount', image = '$dbpath', description = '$description',grouping = '$group'
       WHERE id = '$edit_id'";

       $db->query($insertSql);
       header('Location: products.php');
     }
     $db->query($insertSql);
     header('Location: products.php');

  }
}
?>
<h2 class="text-center"><?=((isset($_GET['edit']))?'Edit':'Add A New'); ?> Product </h2><hr>
  <form action="products.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1'); ?>" method="POST" enctype="multipart/form-data">
    <div class="form-group col-md-3">
      <label for= "title">Title* </label>
      <input type="text" class="form-control" name="title" id="title" value="<?=$title; ?>">
    </div>
    <div class="form-group col-md-3">
        <label for="brand">Brand</label>
        <select class="form-control" id="brand" name="brand">
          <option value=""<?=(($brand == '' )?'selected':''); ?>></option>
          <?php while($b = mysqli_fetch_assoc($brand_query)) : ?>
            <option value="<?=$b['id'];?>"<?=(($brand == $b['id'] )?'selected':''); ?>><?= $b['brand_name'];?></option>
            <?php endwhile; ?>

        </select>
    </div>
    <div class="form-group col-md-2">
      <label for="parent">Parent Category</label>
      <select class="form-control" id="parent" name="parent">
        <option value=""<?=(($parent == '')?'selected':'');?>></option>
        <?php while($p = mysqli_fetch_assoc($parent_query)) : ?>
        <option value="<?= $p['id']; ?>"<?=(($parent == $p['id'])?'selected':'') ?>><?=$p['category']; ?></option>
      <?php endwhile;  ?>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="child">Child Categories:</label>
      <select class="form-control" name="child" id="child">
      </select>
    </div>

    <div class="form-group col-md-2">
        <label for="group">Group</label>
        <select class="form-control" id="group" name="group">
          <option value=""<?=(($group == '' )?'selected':''); ?>></option>
          <?php while($g = mysqli_fetch_assoc($group_query)) : ?>
            <option value="<?=$g['id'];?>"<?=(($group == $g['id'] )?'selected':''); ?>><?= $g['group_name'];?></option>
            <?php endwhile; ?>

        </select>
    </div>

    <div class="form-group col-md-2">
      <label for="price">Price*:</label>
      <input type="text" id="price" name="price" class="form-control" value="<?=$price;?>">
    </div>
    <div class="form-group col-md-2">
      <label for="unit_amount">old price(Discount) :</label>
      <input type="text" id="unit_amount" name="unit_amount" class="form-control" value="<?=$list_price;?>">
    </div>
    <!-- need to give a value for discount  -->
    <div class="form-group col-md-2">
      <label for="price">Unit Amount</label>
      <input type="text" id="unit_amount" name="u_amount" class="form-control" value="<?=$u_amount;?>">
    </div>
    <div class="form-group col-md-3">
      <label for="quant">Quantity:</label>
      <button class="btn btn-default form-control" onclick="jQuery('#sizesModal').modal('toggle');return false;">Quantity</button>
      <!-- <input type="text" id="quant" class="form-control" name="quant" value=""> -->
    </div>
    <div class="form-group col-md-3">
      <label for="qamount">Quantity preview:</label>
      <input type="text" class= "form-control" name="qamount" id="qamount" value="<?=  $sizes_qamount; ?>"readonly>
    </div>

    <div class="form-group col-md-6">
      <?php if($saved_image != ''): ?>
        <div class="saved-image">
            <img src="<?=$saved_image;?>" alt="Saved image"><br>
            <a href="products.php?delete_image=1&edit=<?=$edit_id;?>" class="text-danger">Delete Image</a>
        </div>
      <?php else: ?>
      <label for="photo">Product photo</label>
      <input type="file" id="photo" class="form-control" name="photo">
      <?php endif; ?>
    </div>
    <div class="from-group col-md-6">
      <label for="description">Description:</label>
      <textarea style="margin-bottom:10px;" id="description" class="form-control" name="description" rows="6"><?=$description; ?></textarea>
    </div><hr>


<!-- <a href="products.php?add=1" class="btn btn-success pull-right" id="add-product-btn" >Add Product</a><div class="clearfix"></div> -->

    <div class="form-group pull-right">
      <a href="products.php" class="btn btn-default">Cancel</a></label>
      <input type="submit" value="<?=((isset($_GET['edit']))?'Edit':'Add') ?> Product" class="btn btn-success">
    <div class="clearfix"></div>
  </div>
  </form>
  <!-- Modal -->
<div class="modal fade" id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="sizesModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="sizesModalLabel">Size and quantity</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <?php for($i=1;$i<=1;$i++): ?>
            <div class="form-group col-md-4">
                <label for="size<?=$i;?>">Qantity Unit:</label>
                <input type="text"  name="size<?=$i; ?> " id="size<?=$i; ?>" value="<?=((!empty($sarray[$i-1]))?$sarray[$i-1]:'');?>" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label for="qty<?=$i;?>">Total Amount:</label>
                <input type="number"  name="qty<?=$i; ?> " id="qty<?=$i; ?>" value="<?=((!empty($qarray[$i-1]))?$qarray[$i-1]:'');?>" min="0" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label for="threshold<?=$i;?>">Threshold:</label>
                <input type="number"  name="threshold<?=$i; ?> " id="threshold<?=$i; ?>" value="<?=((!empty($tarray[$i-1]))?$tarray[$i-1]:'');?>" min="0" class="form-control">
            </div>
          <?php endfor; ?>
      </div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updateSizes();jQuery('#sizesModal').modal('toggle');return false;">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?php } else{

$sql = "SELECT * FROM products WHERE deleted = 0";
$presult = $db->query($sql);

if(isset($_GET['featured']))
{
  $id = (int)$_GET['id'];
  $featured = (int)$_GET['featured'];
  $featured_sql = "UPDATE products SET featured = '$featured' WHERE id = '$id'";
  $db->query($featured_sql);
  header('Location: products.php');

}



$product_array = array();
 ?>
<h2 class="text-center">Products</h2>
<!-- <input type="submit" class="btn btn-success" name="" value="Add product">  same work as below 'a' tag  -->
<a href="products.php?add=1" class="btn btn-success pull-right" id="add-product-btn" >Add Product</a><div class="clearfix"></div>
<table class="table table-bordered table-condenced table-striped"><hr>
      <thead>
          <th>A/D</th>
          <th>Product</th>
          <th>Price</th>
          <th>Category</th>
          <th>Featured</th>
          <th>Sold</th>
      </thead>
      <tbody>
        <?php while($product = mysqli_fetch_assoc($presult)):
          $child_id = $product['categories'];
          $cat_sql    =    "SELECT * FROM categories WHERE id = '$child_id'";
          $cat_query  =    $db->query($cat_sql);
          $child_result =  mysqli_fetch_assoc($cat_query);
          $parent_id    =  $child_result['parent'];
          $parent_sql   =   "SELECT * FROM categories WHERE id = '$parent_id'";
          $parent_query =  $db->query($parent_sql);
          $parent_result = mysqli_fetch_assoc($parent_query);
          $category_final = $parent_result['category'].'~'.$child_result['category'];

          ?>

          <tr>
            <td>
               <a href="products.php?edit=<?=$product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
               <a href="products.php?delete=<?=$product['id']; ?>"  class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span></a>
            </td>
            <td><?php echo $product['title']; ?></td>
            <td><?=money($product['price']); ?></td>
            <td><?= $category_final; ?></td>
            <td><a href="products.php?featured=<?=(($product['featured'] == 0)?'1':'0');?>&id=<?=$product['id'];?>" class="btn btn-xs btn-default">
            <span class="glyphicon glyphicon-<?=(($product['featured'] == 1 )?'minus':'plus');?>"></span>
          </a> &nbsp; <?=(($product['featured'] == 1)?'Featured Product':''); ?></td>

            <td>0</td>
          </tr>

        <?php endwhile; ?>
      </tbody>


</table>

<?php }include 'includes/footer.php'; ?>

<script>
    jQuery('document').ready(function()
    {
      get_child_options('<?=$category_var?>');
    });
</script>
