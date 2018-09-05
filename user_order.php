<?php
include 'core/init.php';
include 'includes/userHead.php';
include 'includes/navigation.php';
include 'includes/userheaderfull.php';
include 'includes/userLeftbar.php';


if(isset($_SESSION['user_email']))
{
  $user_email = sanitize($_SESSION['user_email']);
  $user_info = $db->query("SELECT * FROM customer2 WHERE email = '{$user_email}'");
  $result_uinfo = mysqli_fetch_assoc($user_info);

  $u_id = $result_uinfo['id'];
  $u_name = $result_uinfo['name'];
}
  // $txnQuery = "SELECT t.id,t.cart_id,t.full_name,t.description,t.txn_date,t.grand_total,c.items,c.paid,c.shipped FROM user_transactions t
  //     LEFT JOIN cart c on t.cart_id = c.id
  //     WHERE c.paid = 1 AND c.shipped = 0
  //     ORDER BY t.txn_date";
  //     $txnResults = $db->query($txnQuery);
  $ttquery = "SELECT * FROM user_transactions WHERE email = '{$user_email}' ORDER BY txn_date DESC";
  $txnResults = $db->query($ttquery);
  $cou = mysqli_num_rows($txnResults)
?>
<div class="col-md-8" >
  <h2 class="text-center" style="color: #660000;">My previous orders</h2>
  <?php if($cou > 10): ?>
  <div style="overflow:scroll;height:500px">
  <?php endif; ?>
	<table class="table table-bordered table-condensed table-striped" id="dtable1">
		<thead style="color:orange">
			<th></th>
			<th>Description</th>
			<th>Total</th>
			<th>Date</th>
		</thead>
		<tbody>
			<?php while($order = mysqli_fetch_assoc($txnResults)): ?>
			<tr>
				<td><a href="user_order_details.php?txn_id=<?php echo $order['id'];?>" class="btn btn-xs btn-success">Details</a></td>

				<td><?php echo $order['description'];?></td>
				<td><?php echo money($order['grand_total']);?></td>
				<td><?php echo pretty_date($order['txn_date']);?></td>
			</tr>
		<?php endwhile;?>
		</tbody>
    </table>
 <?php if($cou > 10): ?>
  </div>
  <?php endif; ?>
</div>
