<?php
include 'core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
include 'includes/headfull.php';
include 'includes/leftbar.php';


$sql = "SELECT * FROM products ";
$cat_id = (($_POST['cat'] != '')?sanitize($_POST['cat']):'');
if($cat_id == ''){
    $sql .= 'WHERE deleted = 0';
}else{
    $sql .= "WHERE categories = '{$cat_id}' AND deleted = '0'";
}

$price_sort = (($_POST['price_sort'] != '')?sanitize($_POST['price_sort']):'');
$min_price = (($_POST['min_price'] != '')?sanitize($_POST['min_price']):'');
$max_price = (($_POST['max_price'] != '')?sanitize($_POST['max_price']):'');
$brand = (($_POST['brand'] != '')?sanitize($_POST['brand']):'');
//echo $brand;die();

if ($min_price != '') {
    $sql .= " AND price >= '{$min_price}'";
}
if ($max_price != '') {
 $sql .= " AND price <= '{$max_price}'";
}

if ($brand != '') {
    $sql .= " AND brand = '{$brand}'";
}
if ($price_sort == 'low') {
    $sql .= " ORDER BY price";
}
if ($price_sort == 'high') {
    $sql .= " ORDER BY price DESC";
}

$productQ = $db->query($sql);
$category=get_category($cat_id);
?>
<!--Navbar-->

<!--Header-->

    <!--left bar-->
    <!--middle bar-->
    <div class="col-md-8">
        <!-- <div class="row">
            <h2 class="text-center">Featured Products</h2>
        </div> --><br>
        <div class="panel panel-default animated zoomIn">
      <?php if($cat_id != ''): ?>
      <!-- <div style="text-align:center;color:#131339;background-color:#669999;font-family:consolas;" class="panel-heading">
        <h2><b><i><?php echo $category['child']?></i></b></h2></div> -->
        <h2 class="text-center"><?php echo $category['child'];?></h2>
      <?php else: ?>
          <h2 class="text-center">Featured Products</h2>
      <?php endif; ?>
      <div class="panel-body">
        <?php while($product =mysqli_fetch_assoc($productQ)) :?>
          <div class="col-md-3">
           <div >
              <div class="text-center">
                  <br>
                  <img style="width:150px;height:150px;" src="<?php echo $product['image'];?>">
                  <p style="text-align:center;color:#003300;font-family:Nunito;" class="panel-heading"><b><?php echo $product['title']; ?></b></p>
                  <p class="u-amount text-center" style="font-size=6px; "><?php echo $product['u_Amount']; ?></p>
                  <p class="price"><span class="list-price text-danger"> <s> ৳ <?php echo $product['list_price'];?></s> </span>৳<?php echo $product['price'];?></p>
                  <button type="button" class="btn btn-sm btn-info" onclick="detailsmodal(<?php echo $product['id']; ?>)" >Details</button>
                  <!-- <button type="button" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-shopping-cart"></span>ADD</button> -->
                  <button type="button" class="btn btn-sm btn-success" onclick="location.href = 'adder.php?id=<?php echo $product['id']; ?>'" ><span class="glyphicon glyphicon-shopping-cart"></span>ADD</button>
              </div>
          </div>
      </div>
          <?php endwhile; ?>
    </div>
          <div style="text-align:center;" class="panel-footer">&copy;Dailyneeds</div>
      </div>
    </div>
    <!--right bar-->

    <?php
    include 'includes/rightcatbar.php';
    include 'includes/footer.php';
     ?>
