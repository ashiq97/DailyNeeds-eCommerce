<?php 
include 'core/init.php';
include 'includes/head.php'; 
include 'includes/navigation.php';
include 'includes/headfull.php';

$id = $_GET['pid'];
$id=(integer)$id;
$sql = "SELECT * FROM products WHERE id='$id'";
$result = $db->query($sql);
$product=mysqli_fetch_assoc($result);
$brand_id=$product['brand'];

$group =$product['grouping'];
$rtl = "SELECT * FROM products where grouping = '$group' AND id<>'$id'";
$alut = $db->query($rtl);

$sql = "SELECT brand_name FROM brand WHERE id = '$brand_id'";
$brand_query=$db->query($sql);
$brand = mysqli_fetch_assoc($brand_query);
$sizestring = $product['sizes'];
$size_array =explode(',', $sizestring);
?>
<br>
<div class="col-md-10">
<div class="container">
	<div class="row">
	  <div class="col-md-12">
		<div style="text-align:center;color:#001a00;font-family:Nunito;font-size: 18px;">
			<b><?php echo $product['title']; ?></b><br>
			<span id="dal_errors" class="bg-danger"></span>
		</div>
	  </div>
	  <div class="col-md-12">
	  	<div class="col-md-2"></div>
	  	<div class="col-md-3">
	  		<div class="center-block">
	  			<div class="zoom-area">
	  				<div class="large"></div>
	  		      <img id="small" style="width:250px;height:250px;" src="<?php echo $product['image'];?>">
	  		    </div>  
	  		</div>
	  	</div>
	  	<div class="col-md-1"></div>
	  	<div class="col-md-5">
	  		<h2 style="color: #001a66;font-family: consolas;font-size: 20px;"><b>Details</b></h2>
						<p style="color: #005ce6;font-family: consolas;font-size: 16px;"><?php echo $product['description']; ?></p>
						<hr>
						<p style="color: #4d0026;font-family: consolas;font-size: 16px;">Price : ৳<?php echo ' '.$product['price'].' '.'('.$product['u_Amount'].')'; ?></p>
						<p style="color: #4d1919;font-family: consolas;font-size: 18px;">Brand : <?php echo $brand['brand_name']; ?></p><br>
						<form action="add_cart.php" method="post" id="add_product_form">
							<input type="hidden" name="product_id" value="<?php echo $id;?>">
							<input type="hidden" name="available" id="available" value="">
									<span style="color: #663300;font-family: consolas;font-size: 18px;">Quantity</span> :<input type="number" name="quantity" id="quantity" class="form-control" min="0"><br>
									<!-- <p class="text-danger">Available:3</p> -->
								<span style="color: #0d1a00;font-family: consolas;font-size: 18px;">Availablity</span>:<select style="color: #333300;font-size: 18px;font-family: consolas;" name="size" id="size" class="form-control" readonly>
									<!-- <option value=""></option> -->
									<?php foreach ($size_array as $string) {
										$string_array = explode(':', $string);
										$size = $string_array[0];
										$available = $string_array[1];
										echo '<option value="'.$size.'" selected data-available="'.$available.'">'.$available.' '.$size.' '.'Available</option>';
									} ?>
								</select>
						</form>
	  	</div>
	  	<div class="col-md-1"></div>
	  	<div class="col-md-12">
	  		<br>
	  		<div class="col-md-11">
			<button class="btn btn-danger pull-right"  onclick="add_to_cart1();return false;"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart</button>
			</div>
			<div class="col-md-1"></div>
		</div>
	  </div>
	</div>
</div>
</div>
<script>
	jQuery('#quantity').change(
       	function(){
       		var available = jQuery('#size option:selected').data('available');
       		jQuery('#available').val(available);
       	}
       	);
	// magnify
	$(document).ready(function()
		{
			var sub_width = 0;
			var sub_height = 0;
		 	$(".large").css("background","url('" + $("#small").attr("src") + "') no-repeat");

			$(".zoom-area").mousemove(function(e){
				if(!sub_width && !sub_height)
				{
					var image_object = new Image();
					image_object.src = $("#small").attr("src");
					sub_width = image_object.width;
					sub_height = image_object.height;
				}
				else
				{
					var magnify_position = $(this).offset();

					var mx = e.pageX - magnify_position.left;
					var my = e.pageY - magnify_position.top;
					
					if(mx < $(this).width() && my < $(this).height() && mx > 0 && my > 0)
					{
						$(".large").fadeIn(100);
					}
					else
					{
						$(".large").fadeOut(100);
					}
					if($(".large").is(":visible"))
					{
						var rx = Math.round(mx/$("#small").width()*sub_width - $(".large").width()/2)*-1;
						var ry = Math.round(my/$("#small").height()*sub_height - $(".large").height()/2)*-1;

						var bgp = rx + "px " + ry + "px";
						
						var px = mx - $(".large").width()/2;
						var py = my - $(".large").height()/2;

						$(".large").css({left: px, top: py, backgroundPosition: bgp});
					}
				}
			})
		})
</script>
<?php 
	include 'includes/rightcatbar.php';
	include 'includes/footer.php';
?>