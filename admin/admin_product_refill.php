<?php
require_once '../core/init.php';
if(!is_logged_in()){
  header('Location: admin_login.php');
}
include 'includes/head.php';
include 'includes/navigation.php';

 // echo $_SESSION['SBUser'];

 ?>


<?php
	$iQuery = $db->query("SELECT * FROM products WHERE deleted = 0");
	$lowItems = array();
	while($product = mysqli_fetch_assoc($iQuery)){
		$item = array();
		$sizes = sizesToArray($product['sizes']);
		foreach ($sizes as $size ) {
			if($size['quantity'] <= $size['threshold']){
			$cat = get_category($product['categories']);
			$item = array(
				'title' => $product['title'],
				'size' => $size['size'],
				'quantity' => $size['quantity'],
				'threshold' => $size['threshold'],
				'category' => $cat['parent'] .' ~ '.$cat['child']
			);
			$lowItems[] = $item;
		}
		}
	}
?>
	<div class="col-md-12">
		<h3 class="text-center" style="color: #660000;">Products To Be Refilled</h3>
		<table class="table table-bordered table-condensed table-striped" id="dtable3">
			<thead>
				<th>Product</th>
				<th>Category</th>
				<th>Unit</th>
				<th>Quantity</th>
				<!-- <th>Threshold</th> -->
			</thead>
			<tbody>
				<?php foreach($lowItems as $item): ?>
				<tr<?php echo ($item['quantity'] == 0)?' class="danger"':'';?>>
					<td><?php echo $item['title'];?></td>
					<td><?php echo $item['category'];?></td>
					<td><?php echo $item['size'];?></td>
					<td><?php echo $item['quantity'];?></td>
					<!-- <td><?php echo $item['threshold'];?></td> -->
				</tr>
			    <?php endforeach; ?>
			</tbody>
		</table>
    </div>
