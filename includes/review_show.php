<?php 
$reviewshow = "SELECT * FROM review";
$sqlreview = $db->query($reviewshow);
?>

<div class="container-fluid" >
            <div class="row">
            	<div class="col-md-2"></div>
                <div class="col-md-8">
  <!-- <h2 style="font-family:consolas;font-size:20px;">Demandable Products</h2>   -->
  <div id="byCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#byCarousel" data-slide-to="0"></li>
      <li data-target="#byCarousel" data-slide-to="1"></li>
      <!-- <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
      <li data-target="#myCarousel" data-slide-to="4"></li> -->
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <?php while($re = mysqli_fetch_assoc($sqlreview)) :?>
      <div class="item">
        <div class="text-center">
          <img src="images/products/reviewimg.png"  alt="food" style="width:100%;height:400px;border-radius: 70%;">
        </div>
      </div>
      <div>
        <h2 class="text-center"><?php echo $re['name'];?></h2>
      </div>
      <div class="text-center">
        <p><?php $re['description'];?></p>
      </div>
      <?php endwhile;?>
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
  <div class="col-md-2">
  </div>
 </div>
</div>