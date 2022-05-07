<?php
    include "includes/validateDriverAuth.php";
    $user_id = $_SESSION['userID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion | Orders</title>

    <link href="css/orders.css" rel="stylesheet" media="screen">

    <?php include 'header.php' ?>
</head>
<body>

    <div class="container-fluid">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filter By State
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="orders.php">Clear Filter</a>
                <a class="dropdown-item" href="orders.php?filter=Pending">Pending</a>
                <a class="dropdown-item" href="orders.php?filter=On The Way">On The Way</a>
                <a class="dropdown-item" href="orders.php?filter=Delivered">Delivered</a>
                <a class="dropdown-item" href="orders.php?filter=Returned">Returned</a>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Payment</th>
                    <th scope="col">Items</th>
                    <th scope="col">Edit State</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $filter = $_GET['filter'] ?? "invalid";
                    
                    $sql = "SELECT * FROM orders WHERE state='$filter' ORDER BY date";
                    if($filter == "invalid"){
                        $sql = "SELECT * FROM orders ORDER BY date";
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
                    
                    $totalCartItems = 0;
                    
                    if($result){
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)){
                                $order_id = $row["order_id"];
                                $fullname = $row["fullname"];
                                $address = $row["address"];
                                $country = $row["country"];
                                $countryCode = $row["countryCode"];
                                $phoneNumber = $row["number"];
                                $payment = $row["payment"];
                                $state = $row["state"];
                                $driver_id = $row["driver"];
                                $cart_items = $row["cart_items"];
                                $date = $row["date"];

                                $stateClass = $state == 'Pending' ? 'status-pending' : ($state == 'Returned' ? 'status-returned' : ($state == 'On The Way' ? 'status-ontheway' : 'status'));

                                echo "<tr>";
                                echo "<th scope='row'>#$order_id</th>";
                                echo "<td>";
                                    echo "<i class='fa fa-user-alt'></i> $fullname<br>";
                                    echo "<i class='fa fa-globe'></i> $country<br>";
                                    echo "<i class='fa fa-city'></i> $address<br>";
                                    echo "<i class='fa fa-mobile'></i> +$countryCode $phoneNumber<br>";
                                    echo "<i class='fa-solid fa-calendar'></i> $date<br>";
                                    echo "<i class='fa-solid fa-truck'></i><span id='state_$order_id' class='$stateClass'> $state</span>";
                                echo "</td>";
                                echo "<td>";
                                    echo "<span class='pricetag'>$payment</span><br>";
                                    echo "<i class='fa fa-money'></i> Cash On Delivery";
                                echo "</td>";
                                echo "<td>";
                                    $data2 = str_replace('<qm>', "'", $cart_items);
                                    $data3 = str_replace('<ilb>', "<br>", $data2);
                                    echo "$data3";
                                echo "</td>";
                                echo "<td>";
                                    if($driver_id != -1 && $driver_id != $user_id){
                                        if($_SESSION['type'] == "admin"){
                                            echo "<div class='menu-nav'>";
                                            echo "<div class='drop-container' tabindex='-1'>";
                                            echo "<div class='three-dots'></div>";
                                            echo "<div class='drop'>";
                                            echo "<a href='#' onclick='ChangeOrderState($order_id, \"Pending\")' style='text-decoration: none; color: inherit'><div>Pending</div></a>";
                                            echo "<a href='#' onclick='ChangeOrderState($order_id, \"On The Way\")' style='text-decoration: none; color: inherit'><div>On The Way</div></a>";
                                            echo "<a href='#' onclick='ChangeOrderState($order_id, \"Delivered\")' style='text-decoration: none; color: inherit'><div>Delivered</div></a>";
                                            echo "<a href='#' onclick='ChangeOrderState($order_id, \"Returned\")' style='text-decoration: none; color: inherit'><div>Returned</div></a>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                        }else {
                                            echo "<p>This Order<br>Is Being Processed<br>By Someone Else</p>";
                                        }
                                    }else {
                                        echo "<div class='menu-nav'>";
                                        echo "<div class='drop-container' tabindex='-1'>";
                                        echo "<div class='three-dots'></div>";
                                        echo "<div class='drop'>";
                                        echo "<a href='#' onclick='ChangeOrderState($order_id, \"Pending\")' style='text-decoration: none; color: inherit'><div>Pending</div></a>";
                                        echo "<a href='#' onclick='ChangeOrderState($order_id, \"On The Way\")' style='text-decoration: none; color: inherit'><div>On The Way</div></a>";
                                        echo "<a href='#' onclick='ChangeOrderState($order_id, \"Delivered\")' style='text-decoration: none; color: inherit'><div>Delivered</div></a>";
                                        echo "<a href='#' onclick='ChangeOrderState($order_id, \"Returned\")' style='text-decoration: none; color: inherit'><div>Returned</div></a>";
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</div>";
                                    }
                                echo "</td>";
                                echo "</tr>";

                            }
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>

    <?php include 'footer.php' ?>
</body>

<script>
    function ChangeOrderState(order, state){
        var stateClass = (state == 'Pending' ? 'status-pending' : (state == 'Returned' ? 'status-returned' : (state == 'On The Way' ? 'status-ontheway' : 'status')));
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "updateOrder.php?id=" + order + "&state=" + state, true);
        xmlhttp.addEventListener('error', handleOrderEvent);
        xmlhttp.send();
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                var data = JSON.parse(xmlhttp.responseText);
                if(data.state == "SUCCESS"){
                    $('#state_' + order).removeClass();
                    $('#state_' + order).html(" " + state);
                    $('#state_' + order).attr('class', stateClass);
                }
            }
        }
    }

    function handleOrderEvent(e) {
        alert("Failed To Update Order, Please Contact The System Administrator.");
    }

</script>
</html>