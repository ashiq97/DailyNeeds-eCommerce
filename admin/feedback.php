<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/Dailyneeds/core/init.php';
if(!is_logged_in()){
  login_error_redirect();
}
include 'includes/head.php';
include 'includes/navigation.php';
?>
<div id="login-form">
<?php
 			$sql = "SELECT * FROM review ORDER BY DATE  DESC LIMIT 2";
 	 		//$result = mysqli_query($conn, $sql);
      $result = $db->query($sql);
      if(isset($_GET['featured']))
      {
        $id = (int)$_GET['id'];
        $featured = (int)$_GET['featured'];
        $featured_sql = "UPDATE review SET featured = '$featured' WHERE id = '$id'";
        $db->query($featured_sql);
       header('Location: feedback.php');

      }
 	 		if (mysqli_num_rows($result) > 0) {
 	 			# code...
 	 			// while ($row = mysqli_fetch_assoc($result)) {
 	 			// 	# code...
 	 			// 	echo "<p>";
 	 			// 	echo $row['name'];
        //   echo "------------------------------------";
 	 			// 	echo "<input type='submit' value='Submit'>";
 	 			// 	echo "<br>";
 	 			// 	echo $row['description'];
 	 			// 	echo "</p>";
 	 			// }
        while ($row = mysqli_fetch_assoc($result)): {
          # code...
        ?>
        <span>
        <p style="font-size:14px;"><?=$row['name']?>
        <a href="feedback.php?featured=<?=(($row['featured'] == 0)?'1':'0');?>&id=<?=$row['id'];?>" id="nam" class="btn btn-sm btn-success pull-right">
        <span class="glyphicon glyphicon-<?=(($row['featured'] == 1 )?'':'plus');?>"><?=(($row['featured'] == 1)?'Featured':''); ?></span>
        </a></p></span>
        <p style="font-size:10px;"><?=$row['Date']?></p>
        <hr>
        <p><?=$row['description']?></p>
        <hr><br><br>
      <?php }endwhile;
 	 		} else {
 	 			echo "There are no comments!";
 	 		}
 	 ?>
</div>
<div class="text-center">
  <input type="submit" class="btn btn-primary" id="sub" value="Load more" name="sub">
</div>

<!-- <button>Show more comments</button> -->
<script>
	//jQuery code here!
	$(document).ready(function() {
		var commentCount = 2;
		$("#sub").click(function() {
			commentCount = commentCount + 2;
			$("#login-form").load("load-comments.php", {
				commentNewCount: commentCount
			});
		});
	});

</script>
