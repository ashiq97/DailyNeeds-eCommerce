<?php
require_once 'core/init.php';
// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey(STRIPE_PRIVATE);

// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
$token = $_POST['stripeToken'];
//GET the rest of the post data
$full_name = sanitize($_POST['full_name']);
$email = sanitize($_POST['email']);
$mobile = sanitize($_POST['mobile']);
$city = sanitize($_POST['city']);

$tax = sanitize($_POST['tax']);
$sub_total = sanitize($_POST['sub_total']);
$grand_total = sanitize($_POST['grand_total']);
$cart_id = sanitize($_POST['cart_id']);
$description = sanitize($_POST['description']);
$charge_amount = number_format((int)$grand_total,2) * 100;
$metadata = array(
  "cart_id"   => $cart_id,
  "tax"       => $tax,
  "sub_total" => $sub_total,
);




// Charge the user's card:
try{
$charge = \Stripe\Charge::create(array(
  "amount" => $charge_amount,
  "currency" => CURRENCY,
  "source" => $token,
  "description" => $description,
  "receipt_email" => $email,
  "metadata" => $metadata)
);
//adjust incventory

$itemQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
$iresults = mysqli_fetch_assoc($itemQ);
$items = json_decode($iresults['items'],true);
foreach ($items as $item){
  # code...
  $newSizes = array();
  $item_id = $item['id'];
  $productQ = $db->query("SELECT sizes from products WHERE id = '{$item_id}'");
  $product = mysqli_fetch_assoc($productQ);
  $sizes = sizesToArray($product['sizes']);
  foreach ($sizes as $size){
    # code...
    if($size['size'] == $item['size']){

      $update_quantity = $size['quantity'] - $item['quantity'];
      // $size['quantity'] indicates total quantity and $item['quantity'] indicates quantity that is odered
      $newSizes[] = array('size' => $size['size'],'quantity' => $update_quantity,'threshold' => $size['threshold']);

    }else{
      $newSizes[] = array('size' => $size['size'],'quantity' => $size['quantity'],'threshold' => $size['threshold']);
    }
  }
  $sizeString = sizesToString($newSizes);
  $db->query("UPDATE products SET sizes = '{$sizeString}' WHERE id = '{$item_id}'");

}


// update cart
$db->query("UPDATE cart SET paid = 1 WHERE id ='{$cart_id}'");

$db->query("INSERT INTO user_transactions
(charge_id,cart_id,full_name,email,mobile,address,sub_total,tax,grand_total,description,txn_type) VALUES
('$charge->id','$cart_id','$full_name','$email','$mobile','$city','$sub_total','$tax','$grand_total','$description','$charge->object')");



$domain = ($_SERVER['HTTP_HOST'] != 'localhost')? '.'.$_SERVER['HTTP_HOST']:false;
setcookie(CART_COOKIE,'',1,"/",$domain,false);

include 'includes/head.php';
include 'includes/navigation.php';

?>
<div class="container" id="div-id-name">
 <h1 class="text-center text-success">Thank You!</h1>
<p><b> Your cart has been successfully charged <span style="color: red;"><?=money($grand_total);?></span>. you have been  emailed a receipt. please
check your spam folder if it is not your inbox. Additionally you can print this page as a receipt.</b></p>
<p><b>Your receipt number is: <strong><?=$cart_id;?></strong></b></p>
<p><b>Your order will be shipped to the address bellow.</b></p>

<!-- items ordered -->
<?php
$acartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
$acart  = mysqli_fetch_assoc($acartQ);
$aitems = json_decode($acart['items'],true);
$aidArray = array();
$aproducts = array();
foreach($aitems as $aitem){
  $aidArray[] = $aitem['id'];
}
$aids = implode(',',$aidArray);
$aproductQ = $db->query("SELECT i.id as 'id',i.title as 'title',i.price as 'price',c.id as 'cid',c.category as 'child',p.category as 'parent' FROM products i LEFT JOIN categories c on i.categories = c.id LEFT JOIN categories p ON c.parent = p.id WHERE i.id IN ({$aids})");
while($ap = mysqli_fetch_assoc($aproductQ)){
  foreach($aitems as $aitem){
    if($aitem['id'] == $ap['id']){
      $ax = $aitem;
      continue;
    }
  }
  $aproducts[] = array_merge($ax,$ap);
}
?>
<h2 class="text-center" style="color: #003300;">Items Ordered</h2>
<table class="table table-bordered table-condensed table-striped" id="thankyoutable">
    <thead>
      <th>Quantity</th>
      <th>Title</th>
      <th>Price</th>
      <th>Unit</th>
    </thead>
    <tbody>
      <?php foreach($aproducts as $aproduct): ?>
      <tr>
        <td><?php echo $aproduct['quantity'];?></td>
        <td><?php echo $aproduct['title'];?></td>
        <td><?php echo $aproduct['price'];?></td>
        <td><?php echo $aproduct['size'];?></td>
      </tr>
    <?php endforeach;?>
    </tbody>
</table>
 <!-- items ordered -->
 <!-- order details -->
 <h2 class="text-center" style="color: #003300;">Order Details</h2>
 <table class="table table-bordered table-condensed table-striped" id="thankyoutable">
   <thead>
     <th>Sub Total</th>
     <th>Vat</th>
     <th>Grand Total</th>
   </thead>
   <tbody>
     <tr>
       <td><?=money($sub_total);?></td>
       <td><?=money($tax);?></td>
       <td><?=money($grand_total);?></td>
     </tr>
   </tbody>
 </table>

<address>
 <b><p class="text-center" style="color: #1a001a;">Name    :  <?=$full_name;?> </p></b><br>
 <b><p class="text-center" style="color: #1a001a;">Address : <?=$city;?></p></b><br>
</address>

</div>
<h3 class="text-center">
  <a href="#" id="print" class="btn btn-danger"  onclick="javascript:printlayer('div-id-name')">Print as a receipt</a>
  <!-- <input type="button" value="print" onclick="window.print();"> -->
</h3>
<?php
include 'includes/footer.php';
} catch(\Stripe\Error\Card $e){
  echo $e;
}
 ?>
<script type="text/javascript">
  function printlayer(layer){
    var generator = window.open(",name,");
    var layertext = document.getElementById(layer);
    generator.document.write(layertext.innerHTML.replace("Print Me"));

    generator.document.close();
    generator.print();
    generator.close();
  }
</script>
