<?php
require_once 'core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
?>
<br>
<br>
<div class="col-md-12 text-center">
	<a href="register.php" class="checkbat" >Register Now</a>
</div>
<br>
<br>
<br>
<br>
<br>
<br>

<div class="container">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="row">
			<form>
				<label for="email"> Enter Your Email</label>
				<input type="email" id="email" class="form-control" required>
				<label for="password">Enter Password</label>
				<input type="password" id="password" class="form-control" required>
				<br>
				<br>
				<button type="submit" class="btn btn-danger" id="login">Log In</button>
			</form>	
		</div>
	</div>
</div>
<script>
	jQuery("#login").click(function(event){
     event.preventDefault();
     var email = jQuery("#email").val();
     var pass = jQuery("#password").val();
     jQuery.ajax({
			url : "login.php",
			method: "POST",
			data: {userLogin:1,useremail:email,userpassword:pass},
			success: function(data){
			 if (data == "true") {
			 	window.location.href ="card.php";
			 }
			 else
			 {
			 	// window.location.href ="card.php";
			 	alert("Incorrect Information");
			 }
			}
		})
	})
</script>
<?php
include 'includes/footer.php';
?>