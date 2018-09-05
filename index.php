<?php
include 'core/init.php';
include 'includes/head.php';
// include 'includes/navigation.php';
include 'includes/upnav.php';
include 'includes/indexnav.php';
include 'includes/slider.php';
echo "<br>";
include 'includes/headfull.php';
include 'includes/leftbar.php';

$sql = "SELECT * FROM products WHERE featured = 1 AND deleted = 0 ORDER BY RAND() LIMIT 12 ";
$featured = $db->query($sql);
$special = "SELECT * FROM products WHERE grouping = 3 ORDER BY rand() LIMIT 4";
$offers = $db->query($special);

$reviewshow = "SELECT * FROM review WHERE featured = 1 ORDER BY RAND() LIMIT 6";
$sqlreview = $db->query($reviewshow);
?>
<!--Navbar-->

<!--Header-->

	<!--left bar-->
	<!--middle bar-->
	<div class="col-md-9">
		<!-- <div class="row">
			<h2 class="text-center">Featured Products</h2>
		</div> --><br>
		<div class="panel animated zoomIn">
                        <div style="text-align:center;color:#e6e6e6;background-color: #140033;font-family:consolas;" class="panel-heading"><h2><b><i>Popular Products</i></b></h2></div>
                        <div class="panel-body">
                        	<?php while($product =mysqli_fetch_assoc($featured)) :?>
                            <div class="col-md-3">
                                <div class="panel panel-info ">
                                    <div style="text-align:center;color:#001a00;font-family:Nunito;" class="panel-heading"><b><?php echo $product['title']; ?></b></div>
                                    <div class="panel-body text-center">
                                    	<img style="width:150px;height:150px;" src="<?php echo $product['image'];?>">
									    <p class="u-amount text-center" style="font-size=6px; "><?php echo $product['u_Amount']; ?></p>

<p class="price"><span class="list-price text-danger"> <s><?=(($product['list_price'] == 0)?'':'৳'.$product['list_price']);?></s> </span>৳<?php echo $product['price'];?></p>
										<button type="button" class="btn btn-sm btn-warning" onclick="detailsmodal(<?php echo $product['id']; ?>)" >Details</button>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="location.href = 'adder.php?id=<?php echo $product['id']; ?>'" ><span class="glyphicon glyphicon-shopping-cart"></span>ADD</button>
                                        <!-- <a href='adder.php?id=<?php echo $product['id']; ?>'>Add</a> -->
                                    </div>
                                    <!-- <div class="panel-heading">$200 -->
                                        <!-- <button style="float:right;" class="btn btn-danger btn-xs">Add To Cart</button> -->
                                    <!-- </div>      -->
                                </div>
                            </div>
                        <?php endwhile; ?>
                        </div>
                        <!-- <div style="text-align:center;" class="panel-footer">&copy;Dailyneeds</div> -->
                    </div>
	</div>
	<!--right bar-->
    <div class="col-md-1"></div>
	<?php
	// include 'includes/rightbar.php';
	include 'includes/indexfooter.php';
	 ?>
