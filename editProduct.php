<?php
    include "includes/validateAdminAuth.php";
    include "includes/config.php";
    if(isset($_POST["edit"])){

        $prodID = $_POST["id"];
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

        $sql = "UPDATE products SET name='$name', description='$description', details='$details', price='$price', delivery_time='$delivery_time', discount='$discount', department='$department', category='$category', type='$type', brand='$brand' WHERE prod_id='$prodID'";
        $result = mysqli_query($db, $sql);
        if($result){
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
            header("location:editProduct.php?error=0");
            die();
        }

    }else if(isset($_POST["delete"])){
        include "includes/utils.php";
        $prodID = $_POST["id"];
        $sql = "DELETE FROM products WHERE prod_id='$prodID'";
        $result = mysqli_query($db, $sql);
        if($result){
            $file = "images/products/$prodID/";
            if(file_exists($file)){//Deletes the image if it exists
                rrmdir($file);
            }
            $sql = "DELETE FROM product_items WHERE product_id='$prodID'";
            $result = mysqli_query($db, $sql);
            $sql = "DELETE FROM favorites WHERE product_id='$prodID'";
            $result = mysqli_query($db, $sql);
            $sql = "DELETE FROM reviews WHERE product_id='$prodID'";
            $result = mysqli_query($db, $sql);
        }else {
            
        }
        header("location:manageAllProducts.php");
        die();
    }else if(isset($_GET['id'])){
        $id = $_GET['id'];
        $name = "";
        $description = "";
        $details = "";
        $price = 0;
        $delivery_time = 0;
        $discount = 0;
        $department = "m";
        $category = "shoes";
        $type = "basketball";
        $brand = "Local Brand";

        $sql = "SELECT * FROM products WHERE prod_id='$id'";
        $result = mysqli_query($db, $sql);
        if($result){
            if(mysqli_num_rows($result) == 1){
                while($row = mysqli_fetch_assoc($result)){
                    $name = $row["name"];
                    $description = $row["description"];
                    $details = $row["details"];
                    $price = $row["price"];
                    $delivery_time = $row["delivery_time"];
                    $discount = $row["discount"];
                    $department = $row["department"];
                    $category = $row["category"];
                    $type = $row["type"];
                    $brand = $row["brand"];
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
    <title>Fashion | Edit Product</title>
    <link href="css/addProduct.css" rel="stylesheet" media="screen">

    <?php include('header.php') ?>
</head>
<body>
    <h2>Editing A Product, Again! Huh?</h2>
    <br>
    <br>
    <br>
    <form method="POST" action="editProduct.php" enctype="multipart/form-data">
        <h5>Lets Start With The Name</h5>
        <div class="form-group">
            <input type="text" class="form-control" name="name" aria-describedby="name" placeholder="Enter the product's name" required value="<?= $name ?>">
        </div>
        <h5>What Is It About This Product?</h5>
        <div class="form-group">
            <textarea class="form-control" name="description" aria-describedby="description" placeholder="Enter the product's description" rows="4" required><?= $description ?></textarea>
        </div>
        <h5>You Some More Details?</h5>
        <div class="form-group">
            <textarea class="form-control" name="details" aria-describedby="details" placeholder="Enter the product's specifications split by '<>'" rows="4" required><?= $details ?></textarea>
        </div>
        <h5>Is It Cheap Or Expensive?</h5>
        <div class="form-group">
            <input type="number" class="form-control" name="price" aria-describedby="price" placeholder="Enter the product's price in $" required step=".01" value="<?= $price ?>">
        </div>
        <h5>When Will It Be At My Door?</h5>
        <div class="form-group">
            <input type="number" class="form-control" name="delivery_time" aria-describedby="delivery_time" placeholder="Enter the product's delivery time in days" required value="<?= $delivery_time ?>">
        </div>
        <h5>Do I Get A Discount?</h5>
        <div class="form-group">
            <input type="number" class="form-control" name="discount" aria-describedby="discount" placeholder="Enter the product's discount in $" required step=".01" value="<?= $discount ?>">
        </div>
        <h5>Whats The Department?</h5>
        <div class="form-group">
            <select class="form-control" name="department">
                <option value="m"<?=$department == 'm' ? ' selected="selected"' : '';?>>Male</option>
                <option value="f"<?=$department == 'f' ? ' selected="selected"' : '';?>>Female</option>
                <option value="u"<?=$department == 'u' ? ' selected="selected"' : '';?>>Uni Sex</option>
            </select>
        </div>
        <h5>Whats The Category?</h5>
        <div class="form-group">
            <select class="form-control" name="category" id="categorySelect">
                <option value="shoes"<?=$category == 'shoes' ? ' selected="selected"' : '';?>>Shoes</option>
                <option value="clothing"<?=$category == 'clothing' ? ' selected="selected"' : '';?>>Clothing</option>
                <option value="accessories"<?=$category == 'accessories' ? ' selected="selected"' : '';?>>Accessories</option>
            </select>
        </div>
        <h5>Whats The Type?</h5>
        <div class="form-group">
            <select class="form-control" name="type" id="typeSelect">
                <option value="basketball"<?=$type == 'basketball' ? ' selected="selected"' : '';?>>Basketball</option>
                <option value="training"<?=$type == 'training' ? ' selected="selected"' : '';?>>Training</option>
                <option value="football"<?=$type == 'football' ? ' selected="selected"' : '';?>>Football</option>
                <option value="walking"<?=$type == 'walking' ? ' selected="selected"' : '';?>>Walking</option>
                <option value="slides"<?=$type == 'slides' ? ' selected="selected"' : '';?>>Slides</option>
            </select>
        </div>
        <h5>Whats The Brand?</h5>
        <div class="form-group">
            <input type="text" class="form-control" name="brand" aria-describedby="brand" placeholder="Enter the product's brand" required value="<?= $brand ?>">
        </div>
        <h5>Last But Not Least The Images :)</h5>
        <div class="form-group">
            <label>Choose the product's image</label>
            <input type="file" accept=".jpg,.png,.gif" class="form-control-file" name="image">
        </div>
        <div class="form-group">
            <label>Choose the product's banner</label>
            <input type="file" accept=".jpg,.png,.gif" class="form-control-file" name="banner">
        </div>
        <?php echo "<input type='hidden' name='id' value='$id'>"; ?>
        <button type="submit" class="btn btn-warning mb-1" name="edit">Save Product</button>
        <button type="submit" class="btn btn-danger mb-1" name="delete">Delete Product</button>
        <a class="btn btn-primary" href="manageAllProducts.php">Cancel</a>
    </form>

    <?php include('footer.php') ?>
</body>

<script>
$(document).ready(function () {
    let changedFirst = false;
    var type = "<?php echo $type; ?>";
    $("#categorySelect").change(function () {
        var val = $(this).val();
        if (changedFirst) {
            if (val == "shoes") {
                $("#typeSelect").html("<option value='basketball'>Basketball</option><option value='training'>Training</option><option value='football'>Football</option><option value='walking'>Walking</option><option value='slides'>Slides</option>");
            } else if (val == "clothing") {
                $("#typeSelect").html("<option value='pants'>Pants</option><option value='hoodies'>Hoodies</option><option value='jackets'>Jackets</option><option value='socks'>Socks</option><option value='polos'>Polos</option><option value='shorts'>Shorts</option><option value='suits'>Suits</option><option value='tshirts'>T-Shirts</option>");
            } else if (val == "accessories") {
                $("#typeSelect").html("<option value='bags'>Bags</option><option value='hats'>Hats</option><option value='gloves'>Gloves</option><option value='sunglasses'>Sunglasses</option><option value='necklaces'>Necklaces</option>");
            }
        }else {
            changedFirst = true;
            if (val == "shoes") {
                $("#typeSelect").html("<option value='basketball'" + (type == "basketball" ? " selected='selected'" : "") + ">Basketball</option><option value='training'" + (type == "training" ? " selected='selected'" : "") + ">Training</option><option value='football'" + (type == "football" ? " selected='selected'" : "") + ">Football</option><option value='walking'" + (type == "walking" ? " selected='selected'" : "") + ">Walking</option><option value='slides'" + (type == "slides" ? " selected='selected'" : "") + ">Slides</option>");
            } else if (val == "clothing") {
                $("#typeSelect").html("<option value='pants'" + (type == "pants" ? " selected='selected'" : "") + ">Pants</option><option value='hoodies'" + (type == "hoodies" ? " selected='selected'" : "") + ">Hoodies</option><option value='jackets'" + (type == "jackets" ? " selected='selected'" : "") + ">Jackets</option><option value='socks'" + (type == "socks" ? " selected='selected'" : "") + ">Socks</option><option value='polos'" + (type == "polos" ? " selected='selected'" : "") + ">Polos</option><option value='shorts'" + (type == "shorts" ? " selected='selected'" : "") + ">Shorts</option><option value='suits'" + (type == "suits" ? " selected='selected'" : "") + ">Suits</option><option value='tshirts'" + (type == "tshirts" ? " selected='selected'" : "") + ">T-Shirts</option>");
            } else if (val == "accessories") {
                $("#typeSelect").html("<option value='bags'" + (type == "bags" ? " selected='selected'" : "") + ">Bags</option><option value='hats'" + (type == "hats" ? " selected='selected'" : "") + ">Hats</option><option value='gloves'" + (type == "gloves" ? " selected='selected'" : "") + ">Gloves</option><option value='sunglasses'" + (type == "sunglasses" ? " selected='selected'" : "") + ">Sunglasses</option><option value='necklaces'" + (type == "necklaces" ? " selected='selected'" : "") + ">Necklaces</option>");
            }
        }
    });

    $("#categorySelect").trigger('change');

});
</script>

</html>