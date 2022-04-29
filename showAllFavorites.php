<?php 
include "includes/validateAuth.php";
include 'includes/config.php';

$id = $_SESSION['userID'];

$user = $db -> query("SELECT * FROM users WHERE `user_id`='$id'");

$fetch_check = $user->fetch_object();
$fullname = $fetch_check->fullname;
$username = $fetch_check->username;
$email = $fetch_check->email;

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
        <?php 
        // echo "<img class='backImg' src='' alt='Background Image'>";
        // echo "<img class='productImg' src='' alt='Product Image'>";
        ?>
        <img class='backImg' src='imgs/profile-back.png' alt='Background Image'>
        <img class='productImg' src='imgs/user-default-img.png' alt='Product Image'>
    </div>

    <div class="container-fluid">
        <h3 class="user-title">All Favorites</h3>
        <div class="favorite-products">
            <?php
                $sql = "SELECT product_id FROM favorites WHERE `user_id`='$id'";
                $result = mysqli_query($db, $sql);
                if($result){
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)){
                            
                            $id = $row["product_id"];
                            $file = "images/products/" . $id . "/logo.jpg";

                            if(!file_exists($file)){//Deletes the image if it exists
                                $file = "images/products/" . $id . "/logo.png";
                                if(!file_exists($file)){//Deletes the image if it exists
                                    $file = "images/products/" . $id . "/logo.gif";
                                    if(!file_exists($file)){//Deletes the image if it exists
                                        $file = "images/products/default.png";
                                    }
                                }
                            }
                            echo "<a href='viewProduct.php?id=$id'><img src='$file' alt='Product Image'></a>";
                        }
                    } else {
                        //no favorites
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