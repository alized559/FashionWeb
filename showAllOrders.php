<?php
if(isset($_GET['id'])){
    include "includes/validateAdminAuth.php";
}else {
    include "includes/validateAuth.php";
}
include 'includes/config.php';

$id = $_GET['id'] ?? $_SESSION['userID'];

$username = "";
$fullname = "";
$email = "";
$photo = "";

$sql = "SELECT * FROM users WHERE `user_id`='$id'";
$result = mysqli_query($db, $sql);

if ($result) {
    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $username = $row['username'];
            $fullname = $row['fullname'];
            $email = $row['email'];
        }
    }
}

$fileDirectory = "images/users/$id";
if (!file_exists($fileDirectory)) {
    mkdir($fileDirectory, 0777, true);
}

$photo = "images/users/$id/logo.jpg";

if(!file_exists($photo)){//Deletes the image if it exists
    $photo = "images/users/$id/logo.png";
    if(!file_exists($photo)){//Deletes the image if it exists
        $photo = "images/users/$id/logo.gif";
        if(!file_exists($photo)){//Deletes the image if it exists
            $photo = "images/users/default.png";
        }
    }
}

$banner = "images/users/$id/banner.jpg";

if(!file_exists($banner)){//Deletes the image if it exists
    $banner = "images/users/$id/banner.png";
    if(!file_exists($banner)){//Deletes the image if it exists
        $banner = "images/users/$id/banner.gif";
        if(!file_exists($banner)){//Deletes the image if it exists
            $banner = "imgs/profile-back.png";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion | User Panel</title>

    <link href="css/profile.css" rel="stylesheet" media="screen">

    <?php include('header.php') ?>
</head>
<body>
    <div class="image-container">
        <img class='backImg' src='<?= $banner ?>' alt='Background Image'>
        <img class='productImg' src='<?= $photo ?>' alt='Product Image'>
    </div>

    <div class="container-fluid">
        <h3 class="user-title">@<?= $username ?> (<?= $fullname ?>) • Previous Orders</h3>
        <div class="previous-orders">
            <?php
                $sql = "SELECT * FROM orders WHERE `user_id`='$id' LIMIT 7";

                $result = mysqli_query($db, $sql);

                $order_id = 0;
                $address = "";
                $country = "";
                $countryCode = "";
                $phoneNumber = "";
                $state = "";
                $payment = "";
                $date = "";
                if($result){
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)){
                            
                            $order_id = $row["order_id"];
                            $address = $row["address"];
                            $country = $row["country"];
                            $countryCode = $row["countryCode"];
                            $phoneNumber = $row["number"];
                            $payment = $row["payment"];
                            $state = $row["state"];
                            $date = $row["date"];

                            $stateClass = $state == 'Pending' ? 'status-pending' : 'status';

                            echo "<a class='text-reset' href='viewOrder.php?id=$order_id' style='text-decoration: none;'>";
                            echo "<h3>Order № $order_id</h3>";
                            echo "<p>$country, $address";
                            echo "<br>(+$countryCode) $phoneNumber";
                            echo "<br><span class='$stateClass'>$state</span>";
                            echo "<br>$date";
                            echo "<br>$payment</p>";
                            echo "</a>";
                        }
                    } else {
                        echo "<p>No Orders Yet, Browse Through Our Store To Add More!</p>";
                    }
                }
            ?>
        </div>
        <br>
        <br>
    </div>

    <?php include('footer.php') ?>
</body>
</html>