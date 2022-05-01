<?php 
include "includes/validateAuth.php";
include 'includes/config.php';

$id = $_SESSION['userID'];

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

$file = "images/users/$id/logo.jpg";

if(!file_exists($file)){//Deletes the image if it exists
    $file = "images/users/$id/logo.png";
    if(!file_exists($file)){//Deletes the image if it exists
        $file = "images/users/$id/logo.gif";
        if(!file_exists($file)){//Deletes the image if it exists
            $file = "images/users/default.png";
        }
    }
}
$photo = $file;

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
        <img class='backImg' src='<?= $photo ?>' alt='Background Image'>
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
                        echo "<p>No Favorite Products Yet, Browse Through Our Store To Add More!</p>";
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