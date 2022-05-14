<?php 
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include '../includes/config.php';
include_once "../includes/utils.php";

$currency = $_GET["currency"] ?? "US, USD";

$sql = "SELECT prod_id,name,price,discount FROM products ORDER BY likes DESC LIMIT 4";//Get The Top 4 Products

if ($result = mysqli_query($db, $sql)) {
    $emparray = array();
    while($row =mysqli_fetch_assoc($result)){
      if($currency != "LB, LBP"){
      }else {
        $row['price'] = $row['price'] * GetConversionRate('LBP');
        $row['discount'] = $row['discount'] * GetConversionRate('LBP');
      }
      $emparray[] = $row;
   }

  echo(json_encode($emparray));
  // Free result set
  mysqli_free_result($result);
  mysqli_close($db);
}

?>