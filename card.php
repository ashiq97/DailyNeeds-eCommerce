<?php
require_once 'core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
?>
<br>
<br>
<br>
<div class="container">
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4 text-center">
			<form method="post">
				<label for="name">Name on Card :</label>
                <input type="text" class="form-control" id="name">
                <br>
                <br>
                <label for="cvc">CVC:</label>
                <input type="text" class="form-control" id="cvc">
                <br>
                <br>
                <label for="exp-month">Expire Month:</label>
                <select id="exp-month" class="form-control">
                        	<option value=""></option>
                        	<?php for($i=1;$i<13;$i++): ?>
                              <option value="<?php echo $i;?>"><?php echo $i;?></option>
                        	<?php endfor; ?>	
                </select>
                <br>
                <br>
                <label for="exp-year">Expire Year:</label>
                <select id="exp-year" class="form-control">
                        	<option value=""></option>
                        	<?php $yr = date("Y");?>
                        	<?php for($i=0;$i<11;$i++): ?>
                              <option value="<?php echo $yr+$i;?>"><?php echo $yr+$i;?></option>
                        	<?php endfor; ?>	
                </select>
                <br>
                <br>
                <input type="submit" name="checkout" class="btn btn-warning btn-lg" value="Checkout">
			</form>
		</div>
		<div class="col-md-4"></div>
	</div>
</div>