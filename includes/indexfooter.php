</div><br><br>

<div class="container">
  <h2 class="text-center"><b>Exclusive Offers</b></h2>
  <br>
  <div class="col-md-12">
                <?php while($productof =mysqli_fetch_assoc($offers)) :?>
                    <div class="col-md-2 text-center" style="border: 1px solid green;height: 300px;width: 200px;padding: 5px;">
                          <div style="text-align:center;color:#001a00;font-family:Nunito;"><b><?php echo $productof['title']; ?></b></div>
                                  <div class="text-center" style="height:230px;">
                                    <img style="width:150px;height:150px;" src="<?php echo $productof['image'];?>">
                      <p class="u-amount text-center" style="font-size=6px; "><?php echo $productof['u_Amount']; ?></p>
                                      <p class="price"><span class="list-price text-danger"> <s> ৳ <?php echo $productof['list_price'];?></s> </span>৳<?php echo $productof['price'];?></p>
                                  </div><div>
                    <button type="button" class="btn btn-sm btn-primary" onclick="detailsmodal(<?php echo $productof['id']; ?>)" >Details</button>
                                      <button type="button" class="btn btn-sm btn-success" onclick="location.href = 'adder.php?id=<?php echo $productof['id']; ?>'" ><span class="glyphicon glyphicon-shopping-cart"></span>ADD</button>
                              </div>
                          </div>
                    <div class="col-md-1"></div>
                <?php endwhile; ?>
    </div>
</div>
<br>
<br>
<!-- review -->


<div class="container" >
      <h2 class="text-center"><b>Our Customer Reviews</b></h2>
      <br>
      <br>
      <br>
      <div class="col-md-12" style="height: 200px;">
        <div id="dynamic_slide_show" class="carousel slide" data-ride="carousel">
    <!-- <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
           <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
           <li data-target="#myCarousel" data-slide-to="1"></li>
           <li data-target="#myCarousel" data-slide-to="2"></li>
         </ol> -->
         <!-- <div class="carousel-inner"> -->
         <div class="carousel-inner">
        <?php  $output = '';
              $count = 0;   ?>
        <?php while($re = mysqli_fetch_assoc($sqlreview)) :?>
          <!-- <div class="item active"> -->
          <?php if($count == 0):?>
            <div class="item active">
          <?php else : ?>
            <div class="item">
          <?php endif; ?>
            <div class="col-md-12 text-center" >
            <div class="col-md-2">
              <img src="<?=(($re['image'] == '')?'images/products/reviewimg.png':'images/products/'.$re['image']);?>"  alt="user" style="width:100px;height:100px;border-radius: 70%;">
              <h2 ><?php echo $re['name'];?></h2>
            </div>
            <!-- <div class="carousel-caption">
            <h2 ><?php echo $re['name'];?></h2>
            <p style="color: #003366;"><b><?php echo $re['description'];?></b></p>
          </div> -->
          <div class="col-md-8">
          <br>
          <br>
          <br>
          <p style="color: #003366;"><b><?php echo $re['description'];?></b></p>
          </div>
          <div class="col-md-2"></div>
        </div>
        <!-- </div> -->
      </div>
      <?php $count = $count + 1; ?>
        <?php endwhile;?>
      </div>

</div>
</div>
</div>

<!-- review -->
<br>
<br>
<br>
<div class="container-fluid" style="background-color: #333333;color: #ffffff;">
  <div class="col-md-4 text-center">
    <h3><b>About Us</b></h3>
    <hr style="height:2px;width:200px;border:none;color:#999999;background-color:#999999;">
    <p>
      Dailyneeds.com is an online shopping platform in Bangladesh. We offer your daily necessary products at Reasonable price. Shop smarter than ever at dailyneeds.com!
    </p>
  </div>
  <div class="col-md-4 text-center">
    <h3><b>Contact</b></h3>
      <hr style="height:2px;width:200px;border:none;color:#999999;background-color:#999999;">
      <p style="font-size:18px;font-family:consolas;color:#f2f2f2;"><span class="glyphicon glyphicon-map-marker" ></span> Gazipur,Dhaka</p><br>
    <p style="font-size:18px;font-family:consolas;color:#f2f2f2;"><span class="glyphicon glyphicon-earphone" ></span> +088-9827398275</p><br>
    <p style="font-size:18px;font-family:consolas;color:#f2f2f2;"><span class="glyphicon glyphicon-envelope" ></span> dailyneeds@gmail.com</p><br>
  </div>
  <div class="col-md-4 text-center">
    <h3><b>Find Us At</b></h3>
     <hr style="height:2px;width:200px;border:none;color:#999999;background-color:#999999;">
      <div>
        <div class="col-md-3"><img src="images/products/fb.png" style="height: 50px;width: 50px;"></div>
        <div class="col-md-3"><img src="images/products/twit.png" style="height: 50px;width: 50px;"></div>
        <div class="col-md-3"><img src="images/products/github.png" style="height: 50px;width: 50px;"></div>
        <div class="col-md-3"><img src="images/products/link.png" style="height: 50px;width: 50px;"></div>
      </div>
  </div>
</div>

<div class="text-center" id = "footer">&copy;Copyright 2017 Dailyneeds</div>
<!--Details Modal-->
<script >


	function detailsmodal(id){
     var data = {'id':id};
     jQuery.ajax({

			url : '/Dailyneeds/includes/detailsmodal.php',

      method:'post',
      data : data,
      success: function(data){
      	jQuery('body').append(data);
      	jQuery('#details-modal').modal('toggle');
      },
      error: function(){
      	alert('Something Wrong!');
      },
     });
	}

  function detmodals(id){
     var data = {'id':id};
     jQuery.ajax({

      url : '/Dailyneeds/includes/detmodals.php',

      method:'post',
      data : data,
      success: function(data){
        jQuery('body').append(data);
        jQuery('#details-modal').modal('toggle');
      },
      error: function(){
        alert('Something Wrong!');
      },
     });
  }



  function modaldetails(id){
     var data = {'id':id};
     jQuery.ajax({

      url : '/Dailyneeds/includes/modaldetails.php',

      method:'post',
      data : data,
      success: function(data){
        jQuery('body').append(data);
        jQuery('#details-modal').modal('toggle');
      },
      error: function(){
        alert('Something Wrong!');
      },
     });
  }

function update_cart(mode,edit_id,edit_size){
 var data = {"mode" : mode, "edit_id" : edit_id, "edit_size" : edit_size};
 jQuery.ajax({
        url : '/Dailyneeds/admin/parsers/update_cart.php',
        method : "post",
        data : data,
        success : function(){
          location.reload();
        },
        error : function(){
          alert('Something went wrong');
        },
 });
}


function add_to_cart(){
  jQuery('#modal_errors').html("");
  var size = jQuery('#size').val();
  var quantity = jQuery('#quantity').val();
  var available = jQuery('#available').val();
  var error = '';
  var data = jQuery('#add_product_form').serialize();
  if(size == '' || quantity == '' || quantity == 0){
    error += '<p class="text-danger text-center"> You must choose a Quantity.</p>';
    jQuery('#modal_errors').html(error);
    return;
  }else if(quantity > available){
    error += '<p class="text-danger text-center"> There are only '+available+' available.</p>';
    jQuery('#modal_errors').html(error);
    return;
  }else{
      jQuery.ajax({
        url : '/Dailyneeds/admin/parsers/add_cart.php',
        method :'post',
        data : data,
        success : function(){
          location.reload();
        },
        error : function(){
          alert("Somthing went wrong");
        }
      });
  }
}

function add_to_cart1(){
  jQuery('#dal_errors').html("");
  var size = jQuery('#size').val();
  var quantity = jQuery('#quantity').val();
  var available = jQuery('#available').val();
  var error = '';
  var data = jQuery('#add_product_form').serialize();
  if(size == '' || quantity == '' || quantity == 0){
    error += '<p class="text-danger text-center"> You must choose a quantity.</p>';
    jQuery('#dal_errors').html(error);
    return;
  }else if(quantity > available){
    error += '<p class="text-danger text-center"> There are only '+available+' available.</p>';
    jQuery('#dal_errors').html(error);
    return;
  }else{
      jQuery.ajax({
        url : '/Dailyneeds/admin/parsers/add_cart.php',
        method :'post',
        data : data,
        success : function(){
          location.reload();
        },
        error : function(){
          alert("Somthing went wrong");
        }
      });
  }
}

</script>
</body>
</html>
