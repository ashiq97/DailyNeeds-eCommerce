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
	$thisYr = date("Y");
	$lastYr = $thisYr - 1;
	$thisYrQ = $db->query("SELECT grand_total,txn_date FROM user_transactions WHERE YEAR(txn_date) = '{$thisYr}'");
	$lastYrQ = $db->query("SELECT grand_total,txn_date FROM user_transactions WHERE YEAR(txn_date) = '{$lastYr}'");
	$current = array();
	$last = array();
	$currentTotal = 0;
	$lastTotal = 0;
	while($x = mysqli_fetch_assoc($thisYrQ)){
		$month = date("m",strtotime($x['txn_date']));
		if (!array_key_exists($month, $current)) {
			$current[(int)$month] = $x['grand_total'];
		}
		else{
		  $current[(int)$month] += $x['grand_total'];	
		}

		$currentTotal += $x['grand_total'];
	}
	while($y = mysqli_fetch_assoc($lastYrQ)){
		$month = date("m",strtotime($y['txn_date']));
		if (!array_key_exists($month, $current)) {
			$last[(int)$month] = $y['grand_total'];
		}
		else{
		  $last[(int)$month] += $y['grand_total'];	
		}

		$lastTotal += $y['grand_total'];
	}  
	?>
	<div class="col-md-12">
		<h3 class="text-center" style="color: #002b80;">Sales By Month</h3>
		<table class="table table-bordered table-condensed table-striped" id="dtable2">
			<thead>
				<th></th>
				<th><?php echo $lastYr;?></th>
				<th><?php echo $thisYr;?></th>
			</thead>
			<tbody>
				<?php for($i=1;$i<=12;$i++):
				$dt = DateTime::createFromFormat('!m',$i); 
				?>
				<tr <?php echo (date("m") == $i)?' class="info"':'';?>>
					<td><?php echo $dt->format("F");?></td>
					<td><?php echo (array_key_exists($i, $last))?money($last[$i]):money(0);?></td>
					<td><?php echo (array_key_exists($i, $current))?money($current[$i]):money(0);?></td>
				</tr>
			<?php endfor;?>
			<tr>
				<td>Total</td>
				<td><?php echo money($lastTotal);?></td>
				<td><?php echo money($currentTotal);?></td>
			</tr>
			</tbody>
		</table>
	</div>