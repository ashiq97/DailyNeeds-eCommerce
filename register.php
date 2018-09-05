<?php
require_once 'core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
?>
<br>
<br>
<br>

  <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                <div  class="col-md-6">
                    <div class="panel panel-danger">
                        <div style="text-align:center;color:#ffffff;background-color:#003300;" class="panel-heading"><h5><span style="font-weight:bold;font-size:20px">Customer Registration Form</span></h5></div>
                        <div style="background-color:#d9ffcc" class="panel-body">
                            <!-- <div class="row">
                                <div class="col-md-12" id="sign_msg">
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-7">
                                <form method="post">   
                                    <label for="f_name">First Name</label>
                                    <input type="text" id="f_name" name="f_name" placeholder="First Name Should Contain Only Letters" class="form-control">
                                    <label for="l_name">Last Name</label>
                                    <input type="text" id="l_name" name="l_name" placeholder="Last Name Should Contain Only Letters" class="form-control">
                                    <label for="email">Email</label>
                                    <input type="text" id="email" name="email" placeholder="example@gmail.com" class="form-control">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" id="mobile" name="mobile" placeholder="Mobile Number Should Only Contain 11 Digits" class="form-control">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" placeholder="Password Length Must Be More than 9" class="form-control">
                                    <label for="repassword">Re-enter Password</label>
                                    <input type="password" id="repassword" name="repassword" placeholder="Re-enter Password" class="form-control">
                                    <label for="address1">Address 1</label>
                                    <input type="text" id="address1" name="address1" placeholder="Address No.1" class="form-control">
                                    <label for="address2">Address 2</label>
                                    <input type="text" id="address2" name="address2" placeholder="Address No.2" class="form-control">
                                    <p><br></p>
                                    <div class="row">
                                       <div class="col-md-12" id="sign_msg">
                                       </div>
                                    </div>
                                    <p><br></p>
                                    <a href="userlogin.php" class="checkbat">Back</a>
                                    <button style="float:right;" type="button" id="register" name="register" class="btn btn-warning btn-lg">Register</button>
                                </form>    
                            </div>
                            </div>
                        </div>
                        <div class="panel-footer"></div>
                    </div>
                </div>
            </div>
        </div>

<script>
	jQuery("#register").click(function(event){
     event.preventDefault();
     jQuery.ajax({
			url : "registeration.php",
			method: "POST",
			data: $("form").serialize(),
			success: function(data){
			 $("#sign_msg").html(data);
			}
		})
	})
</script>

<?php
include 'includes/footer.php';
?>        