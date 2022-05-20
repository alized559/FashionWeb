<?php 

include '../includes/config.php';

$userID = $_GET['userID'];
$order_id = $_GET['orderID'];

$sql = "SELECT * FROM orders WHERE user_id='$userID' AND order_id='$order_id'";
$result = mysqli_query($db, $sql);

// $fullname = "";
// $address = "";
// $country = "";
// $countryCode = "";
// $phoneNumber = "";
// $state = "";
// $payment = "";
// $cart_items = "";
// $driver_id = -1;
$driver_fullname = "Not Yet Assigned";
// $date = "";
// $user_id2 = 0;

// $totalCartItems = 0;

if($result){
  if(mysqli_num_rows($result) > 0) {
    $emparray = array();
    while($row = mysqli_fetch_assoc($result)){
      $emparray[] = $row;
    }
    // $emparray[count($emparray) - 1] = $fullname;
    echo(json_encode($emparray));
    mysqli_free_result($result);
    mysqli_close($db);
  }
}

// if($currentCartID != -1){
//   $sql = "SELECT fullname FROM users WHERE `user_id`='$driver_id'";
//   $result = mysqli_query($db, $sql);
//   if($result){
//     if(mysqli_num_rows($result) > 0){
//       while($row = mysqli_fetch_assoc($result)){
//         $driver_fullname = $row["fullname"];
//       }
//     }
//   }
// }

?>