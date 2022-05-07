<?php
include "includes/validateAuth.php";
include 'includes/config.php';

$userID = $_SESSION['userID'];

$currentOrderID = $_GET["id"] ?? -1;

$currentCartID = -1;
$sql = "SELECT * FROM orders WHERE `user_id`='$userID' AND order_id='$currentOrderID'";
if(isset($_SESSION['type']) && ($_SESSION['type'] == "admin" || $_SESSION['type'] == "driver")){
    $sql = "SELECT * FROM orders WHERE `order_id`='$currentOrderID'";
}

$result = mysqli_query($db, $sql);

$fullname = "";
$address = "";
$country = "";
$countryCode = "";
$phoneNumber = "";
$state = "";
$payment = "";
$cart_items = "";
$driver_id = -1;
$driver_fullname = "Not Yet Assigned";
$date = "";
$user_id2 = 0;

$totalCartItems = 0;

if($result){
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            $user_id2 = $row["user_id"];
            $currentCartID = $row["cart_id"];
            $fullname = $row["fullname"];
            $address = $row["address"];
            $country = $row["country"];
            $countryCode = $row["countryCode"];
            $phoneNumber = $row["number"];
            $payment = $row["payment"];
            $state = $row["state"];
            $driver_id = $row["driver"];
            $cart_items = $row["cart_items"];
            $totalCartItems = count(explode("<ilb>", $cart_items)) - 1;
            $date = $row["date"];
        }
    }
}

if($currentCartID != -1){
    $sql = "SELECT fullname FROM users WHERE `user_id`='$driver_id'";
    $result = mysqli_query($db, $sql);
    if($result){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $driver_fullname = $row["fullname"];
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion | Cart</title>

    <link href="css/cart.css" rel="stylesheet" media="screen">

    <?php include "header.php"; ?>
</head>
<body>
    <div class="cart">
        <div class="cart-container">
            <div class="header">
                <h3 class="heading">Order № <?= $currentOrderID ?> Summary</h3>
            </div>
            <div class="header2">
                <p>User ID: <?= $user_id2 ?></p>
                <p>Fullname: <?= $fullname ?></p>
                <p>Deliver To: <?= $country ?>, <?= $address ?></p>
                <p>Phone Number: (+<?= $countryCode ?>) <?= $phoneNumber ?></p>
                <p>Order Date: <?= $date ?></p>
                <?php
                    $stateClass = $state == 'Pending' ? 'status-pending' : ($state == 'Returned' ? 'status-returned' : ($state == 'On The Way' ? 'status-ontheway' : 'status'));
                    echo "<p>Delivery State: <span class='$stateClass'>$state</span></p>";
                ?>
                <p>Assigned Driver: <?= $driver_fullname ?></p>
            </div>
            <br>
            <div class="header">
                <h3 class="heading">Items Summary</h3>
            </div>
            <div class="header3">
                <?php
                    $data2 = str_replace('<qm>', "'", $cart_items);
                    $data3 = str_replace('<ilb>', "<br>", $data2);
                    echo "<p>$data3</p>";
                ?>
            </div>

            <div class="vertical-line2"></div>
            <div class="checkout">
                <div class="total">

                    <div>
                        <div class="Subtotal">Total</div>
                        <div class="items" id="total_items"><?= $totalCartItems ?> Items</div>
                    </div>

                    <div class="total-amount2" id="total_price"><?= $payment ?></div>
                </div>
                <div id="gotoCheckoutDiv">
                <?php
                    echo "<button class='button' onclick='OnCheckoutClicked()'>Back To Panel</button>";
                ?>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
    <script>
        function OnCheckoutClicked(){
            window.location.href = "/panel.php";
        }

    </script>
</body>
</html>