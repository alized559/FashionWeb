<?php
    include "includes/validateAdminAuth.php";

    $id = $_GET["id"] ?? 0;

    if(isset($_POST["create"])){
        include "includes/config.php";

        $id = $_POST["id"];
        $name = str_replace('\'', '', $_POST["name"]);
        $quantity = $_POST["quantity"];

        $file_ext = ".null";
        $file_tmp = "null";
        if(isset($_FILES['image']) && $_FILES['image']['name']){
            $file_tmp = $_FILES['image']['tmp_name'];
            $str = explode('.',$_FILES['image']['name']);                        
            $file_ext = strtolower(end($str));
        }
        $sql = "INSERT INTO product_items(product_id,name,quantity) VALUE ('$id', '$name','$quantity')";
        $result = mysqli_query($db, $sql);
        if($result){
            $itemID = mysqli_insert_id($db);
            $fileDirectory = "images/products/$id/items/";
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
            header("location:viewProductItems.php?id=$id");
            die();
        }else {
            header("location:addProduct.php?error=0");
            die();
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
    <h2>Creating A New Product Item Huh?</h2>
    <br>
    <br>
    <br>
    <form method="POST" action="addProductItem.php" enctype="multipart/form-data">
        <h5>Lets Start With The Name</h5>
        <div class="form-group">
            <input type="text" class="form-control" name="name" aria-describedby="name" placeholder="Enter the product item's name" required>
        </div>
        <h5>Is It Rare Or Available?</h5>
        <div class="form-group">
            <input type="number" class="form-control" name="quantity" aria-describedby="quantity" placeholder="Enter the product item's available quantity" required>
        </div>
        <h5>Last But Not Least The Image :)</h5>
        <div class="form-group">
            <label>Choose the product item's image</label>
            <input type="file" accept=".jpg,.png,.gif" class="form-control-file" name="image" required>
        </div>
        <?php echo "<input type='hidden' name='id' value='$id'>"; ?>
        <button type="submit" class="btn btn-warning mb-1" name="create">Add Product Item</button>
        <?php echo "<a class='btn btn-danger' href='viewProductItems.php?id=$id'>Cancel</a>"; ?>
    </form>

    <?php include('footer.php') ?>
</body>

</html>