<div class="container-fluid" style="background-color: #ffff99;position-top:200px; ">
            <div class="row">
            	<!-- <div class="col-md-1"></div> -->
                <div class="col-md-9">
  <!-- <h2 style="font-family:consolas;font-size:20px;">Demandable Products</h2>   -->
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
      <li data-target="#myCarousel" data-slide-to="4"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="images/products/vegi.jpg"  alt="food" style="width:100%;height:400px;">
      </div>

      <div class="item">
        <img src="images/products/combo.jpg"  alt="beauty" style="width:100%;height:400px;">
      </div>
    
      <div class="item">
        <img src="images/products/freshfood.jpg"  alt="cleaner" style="width:100%;height:400px;">
      </div>
      <div class="item">
        <img src="images/products/cleaner2.jpg"  alt="sport" style="width:100%;height:400px;">
      </div>
      <div class="item">
        <img src="images/products/officee.jpg"  alt="baby" style="width:100%;height:400px;">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
   </div>
  </div>
  <div class="col-md-3" >
    <?php
  include "widgets/cart.php";
  ?>
  </div>
 </div>
</div>