<?php
    include "includes/validateAdminAuth.php";

    include "includes/config.php";
    $id = $_GET["id"] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion | Product Items</title>
    <link href="css/products.css" rel="stylesheet" media="screen">

    <?php include('header.php') ?>
</head>
<body>
    <div class="flexbox">
        <div class="container-fluid">
            <h5>Admin Tools</h5>
            <div class="admin-tools">
                <?php echo "<a href='addProductItem.php?id=$id' class='btn btn-warning'>Add Item</a>"; ?>
                <?php echo "<a href='manageAllProducts.php' class='btn btn-primary'>Manage All Products</a>"; ?>
            <div>
            <br>
            <div class="row">
                <?php
                    $sql = "SELECT item_id,product_id,name,quantity FROM product_items WHERE product_id='$id'";
                    $result = mysqli_query($db, $sql);

                    if($result){
                        if(mysqli_num_rows($result) > 0){
                          while($row = mysqli_fetch_assoc($result)){
                            $itemID = $row["item_id"];
                            $name = $row["name"];
                            $quantity = $row["quantity"];
                
                            $file = "images/products/$id/items/$itemID" . ".jpg";
                
                            if(!file_exists($file)){//Deletes the image if it exists
                                $file = "images/products/$id/items/$itemID" . ".png";
                                if(!file_exists($file)){//Deletes the image if it exists
                                    $file = "images/products/$id/items/$itemID" . ".gif";
                                    if(!file_exists($file)){//Deletes the image if it exists
                                        $file = "images/products/default.png";
                                    }
                                }
                            }
                            
                            echo "<div class='col'>";
                            echo "<a href='editProductItem.php?id=$itemID' style='text-decoration: none; color: black'>";
                            echo "<div class='product'>";
                            echo "<div class='image-container'>";
                            echo "<img src='$file'>";
                            echo "</div>";
                            echo "<p>$name";
                                echo "<br>";
                                echo "<span class='color'>$quantity Available</span>";
                            echo "</p>";
                            echo "</div>";
                            echo "</a>";
                            echo "</div>";
                          }
                        }else {
                          //No Products
                        }
                      }

                ?>
            </div>
        </div>
    </div>
    <?php include('footer.php') ?>
</body>

</html>