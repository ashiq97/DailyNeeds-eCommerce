<?php
require_once '../core/init.php';
include '../includes/head.php'; 
$id = $_POST['id'];
$id=(int)$id;
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


<?php ob_start() ?>
<div class="modal fade details-1" id="details-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		<div class="modal-header">
			<button class="close" type="button" onclick="closeModal()" aria-label="close">
				<span aria-hidden="true">&times;</span>
			</button>
			<h4 style="color: #400080;font-family: consolas;font-size: 22px;" class="modal-title text-center"><b><?php echo $product['title']; ?></b></h4>
		</div>
		<div class="modal-body">
			<div class="container-fluid">
				<div class="row">
					<span id="modal_errors" class="bg-danger"></span>
					<div class="col-sm-6">
						<div class="center-block">
							<img  src="<?php echo $product['image']; ?>" class="details img-responsive">
						</div>
					</div>
					<div class="col-sm-6">
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
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<div>
			<button class="btn btn-default" onclick="closeModal()">Cancel</button>
			<button class="btn btn-danger" onclick="add_to_cart();return false;"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart</button>
			</div>
			<br>
			<div class="col-sm-12">
				<div class="row">
					<h3 class="text-center">Recommended Products</h3>
					<?php while($alu =mysqli_fetch_assoc($alut)) :?>
						<div class="col-sm-4">
							<div >
                                    <div class="text-center">
                                        <br>
                                        <img style="width: 150px;height: 150px;" src="<?php echo $alu['image'];?>">
                                        <p style="text-align:center;color:#003300;font-family:Nunito;"><b><?php echo $alu['title']; ?></b></p>
                                        <p class="text-center" style="font-size=6px; "><?php echo $alu['u_Amount']; ?></p>
                                        <p class="price"><span class="list-price text-danger"> <s> ৳ <?php echo $alu['list_price'];?></s> </span>৳<?php echo $alu['price'];?></p>
                                        <button type="button" class="btn btn-sm btn-info" onclick="detailsmodal(<?php echo $alu['id']; ?>)" >Details</button>
                                        <button type="button" class="btn btn-sm btn-success" onclick="modaldetails(<?php echo $alu['id']; ?>)"><span class="glyphicon glyphicon-shopping-cart"></span>ADD</button>
                                    </div>
                            </div>     
				    </div>
				    <?php endwhile; ?>
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
	function closeModal(){
		jQuery('#details-modal').modal('hide');
		setTimeout(function(){
          jQuery('#details-modal').remove();
          jQuery('.modal-backdrop').remove();
		},500);
	}
</script>
<?php echo ob_get_clean(); ?>
