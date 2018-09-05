<?php
require_once '../core/init.php';
if(!is_logged_in()){
  login_error_redirect();
}
include 'includes/head.php';
include 'includes/navigation.php';
$sqlArc = "SELECT * FROM products WHERE deleted = 1 ORDER BY title";
$sqlArc_res = $db->query($sqlArc);
//$sqlArc_result = mysqli_fetch_assoc($sqlArc_res);
if(isset($_GET['edit'])){
  $id = sanitize($_GET['edit']);
  $db->query("UPDATE products SET deleted = 0 WHERE id = '$id'");
  header('Location: archived.php ');


}
?>

<h2 class="text-center">Archived Products</h2><hr>
<!-- <input type="submit" class="btn btn-success" name="" value="Add product">  same work as below 'a' tag  -->
<table class="table table-bordered table-condenced table-striped"><hr>
      <thead>
          <th>Ref</th>
          <th>Product</th>
          <th>Price</th>
          <th>Category</th>
          <th>Sold</th>
      </thead>
      <tbody>
          <?php while($sqlArc_result = mysqli_fetch_assoc($sqlArc_res)):
            $child_id = $sqlArc_result['categories'];
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
               <a href="archived.php?edit=<?=$sqlArc_result['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-refresh"></span></a>
            </td>
              <td><?php echo $sqlArc_result['title']; ?></td>
              <td><?=money($sqlArc_result['price']); ?></td>
              <td><?= $category_final; ?></td>

              <td>0</td>
            </tr>

          <?php endwhile; ?>
  </tbody>
</table>
<?php include 'includes/footer.php'; ?>
