<?php 
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include '../includes/config.php';
include_once "../includes/utils.php";

$currency = $_GET["currency"] ?? "US, USD";
$userID = $_GET['userID'] ?? 0;

$currentCartID = -1;
$sql = "SELECT cart_id FROM cart WHERE `user_id`='$userID'";
$result = mysqli_query($db, $sql);
if($result){
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            $currentCartID = $row["cart_id"];
        }
    }
}

$sql = "SELECT cart_items.quantity,cart_items.prod_item_id,products.name AS product_name,products.price,products.discount,product_items.name AS product_item_name, product_items.quantity AS total_quantity,data FROM cart_items,products,product_items WHERE cart_id='$currentCartID' AND products.prod_id=cart_items.prod_id AND prod_item_id=product_items.item_id";

if($result = mysqli_query($db, $sql)){
  $emparray = array();
  while($row = mysqli_fetch_assoc($result)){
    if($currency != "LB, LBP"){
    } else {
        $row['price'] = $row['price'] * GetConversionRate('LBP');
        $row['discount'] = $row['discount'] * GetConversionRate('LBP');
    }
    $emparray[] = $row;
  }
  echo(json_encode($emparray));
  mysqli_free_result($result);
  mysqli_close($db);
}

?>