<?php
require_once '../core/init.php';
if(!is_logged_in()){
  header('Location: admin_login.php');
}
include 'includes/head.php';
include 'includes/navigation.php';

// complete order
if(isset($_GET['complete']) && $_GET['complete'] == 1){
	$cart_id = sanitize((int)$_GET['cart_id']);
	$db->query("UPDATE cart SET shipped = 1 where id = '{$cart_id}'");
	$_SESSION['success_flash'] = "The Order Has Been Completed !";
	header('Location: index.php');
}

$txn_id = sanitize((int)$_GET['txn_id']);
$txnQuery = $db->query("SELECT * FROM user_transactions WHERE id = '{$txn_id}'");
$txn = mysqli_fetch_assoc($txnQuery);
$cart_id = $txn['cart_id'];
$cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
$cart  = mysqli_fetch_assoc($cartQ);
$items = json_decode($cart['items'],true);
$idArray = array();
$products = array();
foreach($items as $item){
	$idArray[] = $item['id'];
}
$ids = implode(',',$idArray);
$productQ = $db->query("SELECT i.id as 'id',i.title as 'title',c.id as 'cid',c.category as 'child',p.category as 'parent' FROM products i LEFT JOIN categories c on i.categories = c.id LEFT JOIN categories p ON c.parent = p.id WHERE i.id IN ({$ids})");
while($p = mysqli_fetch_assoc($productQ)){
	foreach($items as $item){
		if($item['id'] == $p['id']){
			$x = $item;
			continue;
		}
	}
	$products[] = array_merge($x,$p);
}
?>
<h2 class="text-center" style="color: #003300;">Items Ordered</h2>
<table class="table table-bordered table-condensed table-striped" id="dtable4">
		<thead>
			<th>Quantity</th>
			<th>Title</th>
			<th>Category</th>
			<th>Unit</th>
		</thead>
		<tbody>
			<?php foreach($products as $product): ?>
			<tr>
				<td><?php echo $product['quantity'];?></td>
				<td><?php echo $product['title'];?></td>
				<td><?php echo $product['parent'].'~'.$product['child'];?></td>
				<td><?php echo $product['size'];?></td>
			</tr>
		<?php endforeach;?>
		</tbody>
</table>
<div class="row">
	<div class="col-md-6">
		<h3 class="text-center" style="color: #003300;">Order Details</h3>
		<table class="table table-bordered table-condensed table-striped" id="dtable5">
			<tbody>
				<tr>
					<td>Sub Total</td>
					<td><?php echo money($txn['sub_total']);?></td>
				</tr>
				<tr>
					<td>Vat</td>
					<td><?php echo money($txn['tax']);?></td>
				</tr>
				<tr>
					<td>Grand Total</td>
					<td><?php echo money($txn['grand_total']);?></td>
				</tr>
				<tr>
					<td>Order Date</td>
					<td><?php echo pretty_date($txn['txn_date']);?></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-md-2"></div>
	<div class="col-md-4">
		<h3 style="color: #1a0000;">Shipping Address</h3>
		<address>
		<b><span style="color: #1a001a;"><?php echo "Name &nbsp&nbsp&nbsp&nbsp&nbsp: &nbsp&nbsp".$txn['full_name'];?></span></b><br>
		<b><span style="color: #1a001a;"><?php echo "Address &nbsp: &nbsp&nbsp".$txn['address'];?></span></b><br>
		<b><span style="color: #1a001a;"><?php echo "Mobile &nbsp&nbsp&nbsp: &nbsp&nbsp".$txn['mobile'];?></span></b><br>
		</address>
	</div>
</div>
<div class="pull-right">
	<a href="index.php" class="btn btn-large btn-default">Cancel</a>
	<a href="orders.php?complete=1&cart_id=<?php echo $cart_id;?>" class="btn btn-large btn-primary">Complete Order</a>
</div>

<?php include 'includes/footer.php'; ?>
