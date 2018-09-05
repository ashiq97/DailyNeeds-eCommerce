<nav class ="navbar navbar-default navbar-fixed-top" style="background:black;">
 <div  class ="container ">
   <a  href="/Dailyneeds/admin/index.php" class="navbar-brand" style="color: white;"> Daily Needs admin </a>
   <ul class="nav navbar-nav">

     <li><a href="index.php" style="color: white;">Dashboard</a></li>
     <li><a href="brands.php" style="color: white;">Brands</a></li>
     <li><a href="categories.php" style="color: white;">Categories</a></li>
     <li><a href="products.php" style="color: white;">Products</a></li>
     <li><a href="grouping.php" style="color: white;">Grouping</a></li>
     <li><a href="archived.php" style="color: white;">Archived</a></li>
     <li><a href="feedback.php" style="color: white;">Feedback</a></li>
     <?php if(has_permission('admin')): ?>
     <li><a href="admin_users.php" style="color: white;">Users</a></li>
   <?php endif; ?>
 </ul>
   <ul class="nav navbar-nav pull-right"><li class="dropdown">
     <a href="#" style="color: white;" class="dropdown-toggle" data-toggle="dropdown"> Hello <?=$user_data['first'];?>!
       <span class="caret"></span>
     </a>
     <ul class="dropdown-menu" role="menu">
       <li><a href="change_password.php">Change Password</a></li>
       <li><a href="admin_logout.php">Log Out</a></li>

     </ul>
   </li>
 </ul>

      <!-- <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span  class ="caret" </span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#"> </a></li>
         </ul>
      </li> -->
 </div>
</nav>
