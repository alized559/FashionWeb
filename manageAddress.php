<?php
    include "includes/validateAuth.php";
    include 'includes/config.php';

    $userID = $_SESSION['userID'];
    $currentUserID = -1;
    $sql = "SELECT `user_id` FROM address WHERE `user_id`='$userID'";
    $result = mysqli_query($db, $sql);
    if($result){
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)){
                $currentUserID = $row["user_id"];
            }
        }
    }

    if($currentUserID == -1){
        $sql = "INSERT INTO address(`user_id`) VALUE ('$userID')";
        $result = mysqli_query($db, $sql);
    }

    $fullname = $_GET["fullname"];
    $address = $_GET["address"];
    $country = $_GET["country"];
    $countryCode = $_GET["code"];
    $phoneNumber = $_GET["number"];
    $sql2 = "UPDATE address SET fullname='$fullname', address='$address', country='$country', code='$countryCode', phone='$phoneNumber' WHERE `user_id`='$userID'";
    $result2 = mysqli_query($db, $sql2);
    if($result2){
        echo json_encode(array('state' => "SUCCESS"));
        die();
    }else {
        echo json_encode(array('state' => "FAIL"));
        die();
    }
?>