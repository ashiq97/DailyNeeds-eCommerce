
</div><br><br>
<div class="col-md-12 text-center" > &copy; copy right 2017 Daily Needs Shop</div>
<script type="text/javascript">
  function  updateSizes(){
    var sizeString = '';
    for (var i = 1; i <= 1; i++) {
      if(jQuery('#size'+i).val()!= '')
      {
        sizeString += jQuery('#size'+i).val()+':'+jQuery('#qty'+i).val()+':'+jQuery('#threshold'+i).val()+',';
      }
    }
    jQuery('#qamount').val(sizeString);
  }

  function get_child_options(selected){
    if(typeof selected === 'undefined'){ // 2 no value
      var selected = '';
    }
    var parentID = jQuery('#parent').val(); // no 1
    jQuery.ajax({
      url: '/teacher/admin/parsers/child_categories.php',
      type:'POST',
    //  data:{parentID : parentID}, //1st parentID is a key and 2nd parentID is var ParentID i mn no 1 er variable
      data:{parentID : parentID, selected : selected}, // 2nd selected ta 2 no er value ar 1st selected ta post key
      success: function(data){
        jQuery("#child").html(data);
      },
      error: function(){alert("somthing went wrong with the child options.")},
    });
  }
  jQuery('select[name="parent"]').change(function(){
    get_child_options();
  });
</script>
  </body>
</html>
