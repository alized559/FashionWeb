<?php
    include "includes/validateAdminAuth.php";
    include "includes/config.php";
    if(isset($_POST["edit"])){

        $prodID = $_POST["prod_id"];
        $itemID = $_POST["id"];
        $name = str_replace('\'', '', $_POST["name"]);
        $quantity = $_POST["quantity"];
        $extraname = $_POST["extraname"];
        $extraoptions = $_POST["extraoptions"];

        $file_ext = ".null";
        $file_tmp = "null";
        if(isset($_FILES['image']) && $_FILES['image']['name']){
            $file_tmp = $_FILES['image']['tmp_name'];
            $str = explode('.',$_FILES['image']['name']);                        
            $file_ext = strtolower(end($str));
        }

        $sql = "UPDATE product_items SET name='$name', quantity='$quantity', extra_name='$extraname', extra_options='$extraoptions' WHERE item_id='$itemID'";
        $result = mysqli_query($db, $sql);
        if($result){
            $fileDirectory = "images/products/$prodID/items/";
            if (!file_exists($fileDirectory)) {
                mkdir($fileDirectory, 0777, true);
            }
            if(isset($_FILES['image']) && $_FILES['image']['name']){
                $file = $fileDirectory . "/$itemID." . $file_ext;
                $testFile = $fileDirectory . "/$itemID." . "png";
                if(file_exists($testFile)){//Deletes the image if it exists
                    unlink($testFile);
                }
                $testFile = $fileDirectory . "/$itemID." . "jpg";
                if(file_exists($testFile)){//Deletes the image if it exists
                    unlink($testFile);
                }
                if(file_exists($file)){//Deletes the image if it exists
                    unlink($file);
                }
                move_uploaded_file($file_tmp, $file);
            }
            header("location:viewProductItems.php?id=$prodID");
            die();
        }else {
            header("location:editProductItem.php?error=0");
            die();
        }

    }else if(isset($_POST["delete"])){
        include "includes/utils.php";
        $prodID = $_POST["prod_id"];
        $itemID = $_POST["id"];
        $sql = "DELETE FROM product_items WHERE item_id='$itemID'";
        $result = mysqli_query($db, $sql);
        if($result){
            $file = "images/products/$prodID/items/$itemID.jpg";
            if(file_exists($file)){//Deletes the image if it exists
                unlink($file);
            }
            $file = "images/products/$prodID/items/$itemID.png";
            if(file_exists($file)){//Deletes the image if it exists
                unlink($file);
            }
            $file = "images/products/$prodID/items/$itemID.gif";
            if(file_exists($file)){//Deletes the image if it exists
                unlink($file);
            }
            $sql = "DELETE FROM cart_items WHERE prod_item_id='$itemID'";
            $result = mysqli_query($db, $sql);
        }else {
            
        }
        header("location:viewProductItems.php?id=$prodID");
        die();
    }else if(isset($_GET['id'])){
        $id = $_GET['id'];
        $prodID = 0;
        $name = "";
        $quantity = "";
        $extraname = "";
        $extraoptions = "";

        $sql = "SELECT * FROM product_items WHERE item_id='$id'";
        $result = mysqli_query($db, $sql);
        if($result){
            if(mysqli_num_rows($result) == 1){
                while($row = mysqli_fetch_assoc($result)){
                    $name = $row["name"];
                    $quantity = $row["quantity"];
                    $prodID = $row["product_id"];
                    $extraname = $row["extra_name"];
                    $extraoptions = $row["extra_options"];
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
    <title>Fashion | Product Item</title>
    <link href="css/addProduct.css" rel="stylesheet" media="screen">

    <?php include('header.php') ?>
</head>
<body>
    <h2>Editing A Product Item, Again! Huh?</h2>
    <br>
    <br>
    <br>
    <form method="POST" action="editProductItem.php" enctype="multipart/form-data">
        <h5>Lets Start With The Name</h5>
        <div class="form-group">
            <input type="text" class="form-control" name="name" aria-describedby="name" placeholder="Enter the product item's name" required value="<?= $name ?>">
        </div>
        <h5>Is It Rare Or Available?</h5>
        <div class="form-group">
            <input type="number" class="form-control" name="quantity" aria-describedby="quantity" placeholder="Enter the product items's available quantity" required value="<?= $quantity ?>">
        </div>
        <h5>Any Extra Variables?</h5>
        <div class="form-group">
            <input type="text" class="form-control" name="extraname" aria-describedby="extraname" placeholder="Enter the extra variable name" value="<?= $extraname ?>">
        </div>
        <h5>Extra Variable Options?</h5>
        <div class="form-group">
            <textarea class="form-control" name="extraoptions" aria-describedby="extraoptions" placeholder="Enter the extra options split by a new line" rows="4"><?= $extraoptions ?></textarea>
        </div>
        <h5>Last But Not Least The Image :)</h5>
        <div class="form-group">
            <label>Choose the product item's image</label>
            <input type="file" accept=".jpg,.png,.gif" class="form-control-file" name="image">
        </div>
        <?php echo "<input type='hidden' name='id' value='$id'>"; ?>
        <?php echo "<input type='hidden' name='prod_id' value='$prodID'>"; ?>
        <button type="submit" class="btn btn-warning mb-1" name="edit">Save Item</button>
        <button type="submit" class="btn btn-danger mb-1" name="delete">Delete Item</button>
        <?php echo "<a class='btn btn-primary' href='viewProductItems.php?id=$prodID'>Cancel</a>" ?>
    </form>

    <?php include('footer.php') ?>
</body>

</html>