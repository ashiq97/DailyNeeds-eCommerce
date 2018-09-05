<?php
include 'core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
include 'includes/headfull.php';
include 'includes/leftbar.php';

if(isset($_GET['cat'])){
    $cat_id = sanitize($_GET['cat']);
}
else{
    $cat_id='';
}

$sql = "SELECT * FROM products where categories = '$cat_id' AND deleted = 0";
$productQ = $db->query($sql);
$number_of_results=mysqli_num_rows($productQ);
$category=get_category($cat_id);

$results_per_page = 4;
$number_of_pages = ceil($number_of_results/$results_per_page);
$cur_page = (isset($_GET['page']))?$_GET['page']:1;
$k = ($cur_page-1)*$results_per_page;
$lq = "SELECT * FROM products where categories = '$cat_id' AND deleted = 0 LIMIT $k,$results_per_page";
$lres=$db->query($lq);

?>
<!--Navbar-->

<!--Header-->

	<!--left bar-->
	<!--middle bar-->
	<div class="col-md-8">
		<!-- <div class="row">
			<h2 class="text-center">Featured Products</h2>
		</div> --><br>
		<div class="panel animated zoomIn">
                        <div style="text-align:center;color:#262626;background-color:#ffffff;font-family:consolas;" class="panel-heading"><h2><b><i><?php echo $category['child']?></i></b></h2></div>
                        <div class="panel-body">
                        	<?php while($product =mysqli_fetch_assoc($lres)) :?>
                            <div class="text-center col-md-3">
                                <!-- <div class="panel panel-info">
                                    <div style="text-align:center;color:#003300;font-family:Nunito;" class="panel-heading"><b><?php echo $product['title']; ?></b></div>
                                    <div class="panel-body text-center">
                                    	<img style="width:150px;height:150px;" src="<?php echo $product['image'];?>">
                                    	<p class="u-amount text-center" style="font-size=6px; "><?php echo $product['u_Amount']; ?></p>
                                        <p class="price"><span class="list-price text-danger"> <s> ৳ <?php echo $product['list_price'];?></s> </span>৳<?php echo $product['price'];?></p>
                                    	<button type="button" class="btn btn-sm btn-warning" onclick="detailsmodal(<?php echo $product['id']; ?>)" >Details</button>
                                        <button type="button" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-shopping-cart"></span>ADD</button>
                                    </div> -->
                                    <!-- <div class="panel-heading">$200 -->
                                        <!-- <button style="float:right;" class="btn btn-danger btn-xs">Add To Cart</button> -->
                                    <!-- </div>      -->
                                <!-- </div> -->

                                <!-- testing start -->

                                 <div >
                                    <div class="text-center">
                                        <br>

                                        <!-- <div class="text-center" style="height: 280px;"> -->

                                        <img class="pic" src="<?php echo $product['image'];?>">
                                        <img class="picbig" src="<?php echo $product['image'];?>">
                                        <p style="text-align:center;color:#003300;font-family:Nunito;" class="panel-heading"><b><?php echo $product['title']; ?></b></p>
                                        <p class="u-amount text-center" style="font-size=6px; "><?php echo $product['u_Amount']; ?></p>
                                      <p class="price"><span class="list-price text-danger"> <s><?=(($product['list_price'] == 0)?'':'৳'.$product['list_price']);?></s> </span>৳<?php echo $product['price'];?></p>

                                        <!-- </div> -->

                                        <button type="button" class="btn btn-sm btn-info" onclick="detailsmodal(<?php echo $product['id']; ?>)" >Details</button>
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
                        <div style="text-align:center;" class="panel-footer">&copy;Dailyneeds</div>
                    </div>
                    <div class="text-center">
                    <?php
                     echo "<ul class='pagination'>";
                       if($cur_page > 1){
                        echo '<li><a href="category.php?cat='.$_GET['cat'].'&page='.($cur_page-1).'"><span style="color:#b30000;font-size:15px;font-weight:bold;">Previous Page</span></a></li>';
                        }

                       for ($i=1; $i <=$number_of_pages ; $i++) {
                           echo '<li><a href="category.php?cat='.$_GET['cat'].'&page='.$i.'"><span style="color:#5900b3;font-size:15px;font-weight:bold;">'.$i.'</span></a></li>';
                       }

                        if($cur_page < $number_of_pages)
                        echo '<li><a href="category.php?cat='.$_GET['cat'].'&page='.($cur_page+1).'"> <span style="color:#b30000;font-size:15px;font-weight:bold;">Next Page</span></a></li>';
                    echo "</ul>";
                    ?>
                    </div>
	</div>
	<!--right bar-->

	<?php
	include 'includes/rightcatbar.php';
	include 'includes/footer.php';
	 ?>
