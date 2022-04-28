<?php
    include "includes/validateAdminAuth.php";

    if(isset($_POST["create"])){
        include "includes/config.php";

        $name = str_replace('\'', '', $_POST["name"]);
        $description = str_replace('\'', '', $_POST["description"]);
        $details = str_replace('\'', '', $_POST["details"]);
        $price = $_POST["price"];
        $delivery_time = $_POST["delivery_time"];
        $discount = $_POST["discount"];
        $department = $_POST["department"];
        $category = $_POST["category"];
        $type = $_POST["type"];
        $brand = $_POST["brand"];

        $file_ext = ".null";
        $file_tmp = "null";
        if(isset($_FILES['image']) && $_FILES['image']['name']){
            $file_tmp = $_FILES['image']['tmp_name'];
            $str = explode('.',$_FILES['image']['name']);                        
            $file_ext = strtolower(end($str));
        }

        $bannerfile_ext = ".null";
        $bannerfile_tmp = "null";
        if(isset($_FILES['banner']) && $_FILES['banner']['name']){
            $bannerfile_tmp = $_FILES['banner']['tmp_name'];
            $str = explode('.',$_FILES['banner']['name']);                        
            $bannerfile_ext = strtolower(end($str));
        }

        $sql = "INSERT INTO products(name,description,details,price,delivery_time,discount,department,category,type,brand) VALUE ('$name','$description','$details','$price','$delivery_time','$discount','$department','$category','$type','$brand')";
        $result = mysqli_query($db, $sql);
        if($result){
            $prodID = mysqli_insert_id($db);
            $fileDirectory = 'images/products/' . $prodID;
            if (!file_exists($fileDirectory)) {
                mkdir($fileDirectory, 0777, true);
            }
            if(isset($_FILES['image']) && $_FILES['image']['name']){
                $file = $fileDirectory . "/logo." . $file_ext;
                $testFile = $fileDirectory . "/logo." . "png";
                if(file_exists($testFile)){//Deletes the image if it exists
                    unlink($testFile);
                }
                $testFile = $fileDirectory . "/logo." . "jpg";
                if(file_exists($testFile)){//Deletes the image if it exists
                    unlink($testFile);
                }
                if(file_exists($file)){//Deletes the image if it exists
                    unlink($file);
                }
                move_uploaded_file($file_tmp, $file);
                //echo "Moving Imae File: " . $file_tmp . " To: " . $file;

                if(isset($_FILES['banner']) && $_FILES['banner']['name']){
                    $bannerfile = $fileDirectory . "/banner." . $bannerfile_ext;

                    $testFile = $fileDirectory . "/banner." . "png";
                    if(file_exists($testFile)){//Deletes the image if it exists
                        unlink($testFile);
                    }
                    $testFile = $fileDirectory . "/banner." . "jpg";
                    if(file_exists($testFile)){//Deletes the image if it exists
                        unlink($testFile);
                    }

                    if(file_exists($bannerfile)){//Deletes the image if it exists
                        unlink($bannerfile);
                    }
                    move_uploaded_file($bannerfile_tmp, $bannerfile);
                   // echo "Moving Banner File: " . $bannerfile_tmp . " To: " . $bannerfile;
                }
            }
            header("location:manageAllProducts.php");
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
    <title>Fashion | Add Product</title>
    <link href="css/addProduct.css" rel="stylesheet" media="screen">

    <?php include('header.php') ?>
</head>
<body>
    <h2>Creating A New Product Huh?</h2>
    <br>
    <br>
    <br>
    <form method="POST" action="addProduct.php" enctype="multipart/form-data">
        <h5>Lets Start With The Name</h5>
        <div class="form-group">
            <input type="text" class="form-control" name="name" aria-describedby="name" placeholder="Enter the product's name" required>
        </div>
        <h5>What Is It About This Product?</h5>
        <div class="form-group">
            <textarea class="form-control" name="description" aria-describedby="description" placeholder="Enter the product's description" rows="4" required></textarea>
        </div>
        <h5>You Some More Details?</h5>
        <div class="form-group">
            <textarea class="form-control" name="details" aria-describedby="details" placeholder="Enter the product's specifications split by '<>'" rows="4" required></textarea>
        </div>
        <h5>Is It Cheap Or Expensive?</h5>
        <div class="form-group">
            <input type="number" class="form-control" name="price" aria-describedby="price" placeholder="Enter the product's price in $" required step=".01">
        </div>
        <h5>When Will It Be At My Door?</h5>
        <div class="form-group">
            <input type="number" class="form-control" name="delivery_time" aria-describedby="delivery_time" placeholder="Enter the product's delivery time in days" required>
        </div>
        <h5>Do I Get A Discount?</h5>
        <div class="form-group">
            <input type="number" class="form-control" name="discount" aria-describedby="discount" placeholder="Enter the product's discount in $" required step=".01" value="0">
        </div>
        <h5>Whats The Department?</h5>
        <div class="form-group">
            <select class="form-control" name="department">
                <option value="m">Male</option>
                <option value="f">Female</option>
                <option value="u">Uni Sex</option>
            </select>
        </div>
        <h5>Whats The Category?</h5>
        <div class="form-group">
            <select class="form-control" name="category" id="categorySelect">
                <option value="shoes">Shoes</option>
                <option value="clothing">Clothing</option>
                <option value="accessories">Accessories</option>
            </select>
        </div>
        <h5>Whats The Type?</h5>
        <div class="form-group">
            <select class="form-control" name="type" id="typeSelect">
                <option value="basketball">Basketball</option>
                <option value="training">Training</option>
                <option value="football">Football</option>
                <option value="walking">Walking</option>
                <option value="slides">Slides</option>
            </select>
        </div>
        <h5>Whats The Brand?</h5>
        <div class="form-group">
            <input type="text" class="form-control" name="brand" aria-describedby="brand" placeholder="Enter the product's brand" required>
        </div>
        <h5>Last But Not Least The Images :)</h5>
        <div class="form-group" id="imageDragContainer">
            <label>Choose the product's image, or just drag it here :)</label>
            <input type="file" accept=".jpg,.png,.gif" class="form-control-file" name="image" required>
        </div>
        <div class="form-group" id="bannerDragContainer">
            <label>Choose the product's banner, or just drag it here :)</label>
            <input type="file" accept=".jpg,.png,.gif" class="form-control-file" name="banner" required>
        </div>
        <button type="submit" class="btn btn-warning mb-1" name="create">Add Product</button>
        <a class="btn btn-danger" href="manageAllProducts.php">Cancel</a>
    </form>

    <?php include('footer.php') ?>
</body>

<script>
$(document).ready(function () {
    $("#categorySelect").change(function () {
        var val = $(this).val();
        if (val == "shoes") {
            $("#typeSelect").html("<option value='basketball'>Basketball</option><option value='training'>Training</option><option value='football'>Football</option><option value='walking'>Walking</option><option value='slides'>Slides</option>");
        } else if (val == "clothing") {
            $("#typeSelect").html("<option value='pants'>Pants</option><option value='hoodies'>Hoodies</option><option value='jackets'>Jackets</option><option value='socks'>Socks</option><option value='polos'>Polos</option><option value='shorts'>Shorts</option><option value='suits'>Suits</option><option value='tshirts'>T-Shirts</option>");
        } else if (val == "accessories") {
            $("#typeSelect").html("<option value='bags'>Bags</option><option value='hats'>Hats</option><option value='gloves'>Gloves</option><option value='sunglasses'>Sunglasses</option><option value='necklaces'>Necklaces</option>");
        }
    });
});
</script>

</html>