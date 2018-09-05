<?php
$cat_id = ((isset($_REQUEST['cat']))?sanitize($_REQUEST['cat']):'');
$price_sort = ((isset($_REQUEST['price_sort']))?sanitize($_REQUEST['price_sort']):'');
$min_price = ((isset($_REQUEST['min_price']))?sanitize($_REQUEST['min_price']):'');
$max_price = ((isset($_REQUEST['max_price']))?sanitize($_REQUEST['max_price']):'');
$b = ((isset($_REQUEST['brand']))?sanitize($_REQUEST['brand']):'');
$brandQ = $db->query("SELECT * FROM brand ORDER BY brand_name");
?>

<h3 class="text-center" style="color: #001a00;">Search Filters</h3>
<h4 class="text-center" style="color: red">Name</h4>
<form action="search2.php" method="post">
	<div class="input-group">
		<input type="text" class="form-control" id="name_on" placeholder="name">
		<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
	</div>
</form>
<h4 class="text-center" style="color: #206040;">Price</h4>
<form action="search.php" method="post">
	<input type="hidden" name="cat" value="<?php echo $cat_id;?>">
	<input type="hidden" name="price_sort" value="0">
	<input type="radio" name="price_sort" value="low"<?=(($price_sort == 'low')?' checked' : '');?>><span style="color: #333300;font-weight: bold;"> Low to High</span><br>
	<input type="radio" name="price_sort" value="high"<?=(($price_sort == 'high')?' checked ': '');?>><span style="color: #333300;font-weight: bold;"> High to Low</span><br><br>
	<input class="form-control" type="text" name="min_price" class="price-range" placeholder="Min " value="<?php echo $min_price;?>"><span style="color: #732626;font-weight: bold;">To</span>
	<input class="form-control" type="text" name="max_price" class="price-range" placeholder="Max " value="<?php echo $max_price;?>"><br><br>
	<h4 class="text-center" style="color: #206040;">Brand</h4>
	<input type="radio" name="brand" value=""<?=(($b == '')?' checked':'');?>><span style="color: #191966;font-weight: bold;"> All</span><br>
	<?php while($brand = mysqli_fetch_assoc($brandQ)): ?>
		<input type="radio" name="brand" value="<?php echo $brand['id'];?>"<?php echo (($b == $brand['id'])?' checked':'');?>>
		<?php echo "<span style='color:#602020;font-weight:bold;'>". $brand['brand_name']."</span>";?><br>
	<?php endwhile;?>
	<br>
	<input type="submit" value="Search" class="btn btn-sm btn-primary">
</form>
<script>
		$(document).ready(function() {
			$("#name_on").keyup(function() {
				var nam = $("#name_on").val();
				$.post("search2.php", {
					search2 : nam
				}, function(data, status) {

					$(".panel-body").html(data);
				});

			});

		});
</script>
