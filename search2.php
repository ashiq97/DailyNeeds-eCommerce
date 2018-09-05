<?php
include 'core/init.php';
include 'includes/head.php';
//include 'includes/navigation.php';



$search = (($_POST['search2'] != '')?sanitize($_POST['search2']):'');

if ($search != '') {
    $sql = "SELECT * FROM products WHERE deleted = '0' AND title like '%$search%'";
}else{
    $sql = "SELECT * FROM products WHERE deleted = '0' and featured = '1'";
}

$productQ = $db->query($sql);

?>
<div class="panel panel-default animated zoomIn">
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
                    <!-- <div class="panel-heading">$200 -->
                        <!-- <button style="float:right;" class="btn btn-danger btn-xs">Add To Cart</button> -->
                    <!-- </div>      -->
                </div>

                <!-- testing end -->
            </div>
        <?php endwhile; ?>
        </div>
        <!-- <div style="text-align:center;" class="panel-footer">&copy;Dailyneeds</div> -->
    </div>

  <!--right bar-->
