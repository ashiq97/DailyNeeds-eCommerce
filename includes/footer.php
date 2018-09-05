</div><br><br>
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
