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
        <img class='backImg' src='imgs/profile-back.png' alt='Background Image'>
        <img class='productImg' src='<?php echo $photo ?>' alt='Product Image'>
    </div>
    <div class="container-fluid">
        <h3 class="user-title">Posted Reviews</h3>
            <?php
                $sql = "SELECT * FROM reviews WHERE `user_id`='$id' LIMIT 7";
                $result = mysqli_query($db, $sql);
                if($result){
                    if(mysqli_num_rows($result) > 0) {
                        echo "<div class='reviewsFlex p-4'>";
                        while($row = mysqli_fetch_assoc($result)){
                            $text = str_replace("<lb>","<br>",$row["text"]);
                            $rate = $row["rate"];
                            $prod_id = $row["product_id"];
                            $sql2 = "SELECT name FROM products WHERE `prod_id`='$prod_id'";
                            $result2 = mysqli_query($db, $sql2);
                            if($result2){
                                if(mysqli_num_rows($result2) == 1) {
                                    while($row2 = mysqli_fetch_assoc($result2)){
                                        $prod_name = $row2['name'];
                                        echo "<a href='viewProduct.php?id=$prod_id' class='text-reset' style='text-decoration:none;'>";
                                        echo "<div class='review-box'>";
                                        echo "<div><img src='$file' alt='User Image'></div>";
                                        echo "<div class='vertical-line'></div>";
                                        echo "<div class='column'>";
                                        echo "<h5>$username ● $prod_name</h5>";
                                        echo "<p>";
                                        echo $text;
                                        echo "<span class='rating-flex'>";
                                        $limitReached = false;
                                        for($i = 1; $i < 6; $i++){
                                            if($limitReached){
                                                echo "<i class='fa fa-star'></i>";
                                            }else {
                                                //2.5, 2
                                                if($rate < $i){
                                                    $limitReached = true;
                                                    echo "<i class='fa fa-star-half-stroke rating-enabled'></i>";
                                                }else {
                                                    if($rate - $i == 0){
                                                        echo "<i class='fa fa-star rating-enabled'></i>";
                                                        $limitReached = true;
                                                    }
                                                    else if($rate - $i >= 0.5){
                                                        echo "<i class='fa fa-star rating-enabled'></i>";
                                                    }else {
                                                        echo "<i class='fa fa-star-half-stroke rating-enabled'></i>";
                                                        $limitReached = true;
                                                    }
                                                }
                                            }
                                            
                                        }
                                        echo "</span>";
                                        echo "</p>";
                                        echo "</div>";
                                        echo "</div>";
                                        echo "</a>";
                                    }
                                }
                            }
                        }
                        echo "</div>";
                    } else {
                        echo "<p>No Reviews Yet, Browse Through Our Store To Make Some!</p>";

                    }
                }
            ?>
        </div>
    </div>
    <?php include('footer.php') ?>
</body>
</html>