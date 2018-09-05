<?php
include 'core/init.php';
include 'includes/userHead.php';
include 'includes/navigation.php';
include 'includes/userheaderfull.php';
include 'includes/userLeftbar.php';
// complete order
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
$productQ = $db->query("SELECT i.id as 'id',i.price as 'price', i.title as 'title',c.id as 'cid',c.category as 'child',p.category as 'parent' FROM products i LEFT JOIN categories c on i.categories = c.id LEFT JOIN categories p ON c.parent = p.id WHERE i.id IN ({$ids})");
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
<div class="col-md-8">
<h2 class="text-center" style="color: #003300;">Items Ordered</h2>
<table class="table table-bordered table-condensed table-striped" id="dtable4">
		<thead style="color:orange">

			<th>Title</th>
      <th>Unit Price</th>
      <th>Quantity</th>
			<th>Unit</th>
		</thead>
		<tbody>
			<?php foreach($products as $product): ?>
			<tr>

        <td><?php echo $product['title'];?></td>
        <td><?php echo $product['price'];?></td>
        <td><?php echo $product['quantity'];?></td>

				<td><?php echo $product['size'];?></td>
			</tr>
		<?php endforeach;?>
		</tbody>
</table>
<button type="button" class="btn btn-success" name="back" value="Back To profile" onclick="location.href = 'user_order.php'">Back To profile</button>
</div>
