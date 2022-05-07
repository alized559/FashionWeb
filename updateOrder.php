<?php
    include "includes/validateDriverAuth.php";
    include 'includes/config.php';

    $userID = $_SESSION['userID'];
    if(isset($_GET["id"])){
        $order_id = $_GET["id"];
        $state = $_GET["state"] ?? "Pending";
        $driver_id = -1;
        if($state != "Pending"){
            $driver_id = $userID;
        }
        $sql = "UPDATE orders SET state='$state',driver='$driver_id' WHERE order_id='$order_id'";
        $result = mysqli_query($db, $sql);
        if($result){
            echo json_encode(array('state' => "SUCCESS"));
        }else {
            echo json_encode(array('state' => "FAIL"));
        }
    }
?>