<?php
require_once '../core/init.php';
if(!is_logged_in()){
  header('Location: admin_login.php');
}
include 'includes/head.php';
include 'includes/navigation.php';

 // echo $_SESSION['SBUser'];

 ?>
<!-- orders to fill -->
<?php
  $txnQuery = "SELECT t.id,t.cart_id,t.full_name,t.description,t.txn_date,t.grand_total,c.items,c.paid,c.shipped FROM user_transactions t
      LEFT JOIN cart c on t.cart_id = c.id
      WHERE c.paid = 1 AND c.shipped = 0
      ORDER BY t.txn_date";
  $txnResults = $db->query($txnQuery);    
?>
<div class="col-md-12">
	<h2 class="text-center" style="color: #660000;">Orders To Ship</h2>
	<table class="table table-bordered table-condensed table-striped" id="dtable1">
		<thead>
			<th></th>
			<th>Name</th>
			<th>Description</th>
			<th>Total</th>
			<th>Date</th>
		</thead>
		<tbody>
			<?php while($order = mysqli_fetch_assoc($txnResults)): ?>
			<tr>
				<td><a href="orders.php?txn_id=<?php echo $order['id'];?>" class="btn btn-xs btn-success">Details</a></td>
				<td><?php echo $order['full_name'];?></td>
				<td><?php echo $order['description'];?></td>
				<td><?php echo money($order['grand_total']);?></td>
				<td><?php echo pretty_date($order['txn_date']);?></td>
			</tr>
		<?php endwhile;?>
		</tbody>
    </table>
    <br>
    <br>
</div>