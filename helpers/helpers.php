<?php
function display_errors($errors){
  $display = '<ul class="bg-danger">';
  foreach ($errors as $error) {
    # code...
    $display .= '<li class="text-danger">'.$error.'</li>';
  }
  $display .= '</ul>';
  return $display;
}
function sanitize($dirty)
{
  return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}

function money($number)
{
  return '৳ '.number_format($number,2);
}

function logged($customer_user_email,$cart_id)
{
  $_SESSION['user_email'] = $customer_user_email;
  global $db;
  $_SESSION['success_flash_user'] ='you are now logged in! ';
  $cart_id = $cart_id;
  if($cart_id != '')
  {
  header('Location: /Dailyneeds/cart.php');
  }else{
    header('Location: /Dailyneeds/index.php');
  }

}

function login($admin_user_id)
{
  $_SESSION['SBUser'] = $admin_user_id;
  global $db;
  $date =date("Y-m-d H:i:s");
  $db->query("UPDATE admin_user SET last_login = '$date' WHERE id='$admin_user_id'");
   $_SESSION['success_flash'] ='you are now logged in! ';
   header('Location:index.php');
}
function is_logged_in()
{
  if(isset($_SESSION['SBUser']) && $_SESSION['SBUser'] > 0 )
  {
    return true;
  }
  return false;
}

function login_error_redirect($url = 'admin_login.php'){
  $_SESSION['error_flash'] = 'you must be logged in to access that page ' ;
  header('Location: '.$url);
}

function user_login_error_redirect($url_u = 'user_login.php'){
  $_SESSION['error_flash_user'] = 'you must be logged in to access that page ' ;
  header('Location: '.$url_u);
}

function permission_error_redirect($url = 'admin_login.php'){
  $_SESSION['error_flash'] = 'you dont have the permission to access the page';
  header('Location: '.$url);
}
function has_permission($permission = 'admin')
{
  global $user_data;
  $permissions = explode(',',$user_data['permission']);
  if(in_array($permission,$permissions,true))
  {
    return true;
  }
  return false;
}

function pretty_date($date){
  return date("M d, Y h:i A",strtotime($date));
}

function get_category($child_id){
  global $db;
  $id = sanitize($child_id);
  $sql = "SELECT p.id AS 'pid', p.category AS 'parent', c.id AS 'cid', c.category AS 'child'
          FROM categories c
          INNER JOIN categories p
          ON c.parent = p.id
          WHERE c.id ='$id'";

  $query_sql = $db->query($sql);
  $category  = mysqli_fetch_assoc($query_sql);
  return $category;
}

function sizesToArray($string){
$sizesArray = explode(',',$string);
$returnArray = array();
foreach ($sizesArray as $size) {
  # code...
  $s = explode(':',$size);
  $returnArray[] = array('size' => $s[0], 'quantity' => $s[1],'threshold' => $s[2]);
}
return $returnArray;
}

function sizesToString($sizes){
  $sizeString = '';
  foreach ($sizes as $size) {
    # code...
    $sizeString .= $size['size'].':'.$size['quantity'].':'.$size['threshold'].',';
  }
  $trimmed = rtrim($sizeString, ',');
  return $trimmed;
}
