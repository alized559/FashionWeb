<?php
    include "includes/validateAdminAuth.php";
    include "includes/config.php";
    if(isset($_POST["edit"])){

        $id = $_POST["id"];
        $name = str_replace('\'', '', $_POST["name"]);
        $link = str_replace('\'', '', $_POST["link"]);
        $local = isset($_POST["local"]);
        $navbar = isset($_POST["navbar"]);
        $footer = isset($_POST["footer"]);

        $sql = "UPDATE brands SET name='$name', link='$link', local='$local', display_navbar='$navbar', display_footer='$footer' WHERE brand_id='$id'";
        $result = mysqli_query($db, $sql);
        if($result){
            header("location:manageAllBrands.php");
            die();
        }else {
            header("location:editBrand.php?error=0");
            die();
        }

    }else if(isset($_POST["delete"])){
        $id = $_POST["id"];
        $sql = "DELETE FROM brands WHERE brand_id='$id'";
        $result = mysqli_query($db, $sql);
        header("location:manageAllBrands.php");
        die();
    }else if(isset($_GET['id'])){
        $id = $_GET['id'];
        $name = "";
        $link = "";
        $local = 0;
        $navbar = 0;
        $footer = 0;

        $sql = "SELECT * FROM brands WHERE brand_id='$id'";
        $result = mysqli_query($db, $sql);
        if($result){
            if(mysqli_num_rows($result) == 1){
                while($row = mysqli_fetch_assoc($result)){
                    $name = $row["name"];
                    $link = $row["link"];
                    $local = $row["local"];
                    $navbar = $row["display_navbar"];
                    $footer = $row["display_footer"];
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
    <title>Fashion | New Brand</title>
    <link href="css/addProduct.css" rel="stylesheet" media="screen">

    <?php include('header.php') ?>
</head>
<body>
    <h2>Exploring Brands, Again! Huh?</h2>
    <br>
    <br>
    <br>
    <form method="POST" action="editBrand.php" enctype="multipart/form-data">
        <h5>Lets Start With The Name</h5>
        <div class="form-group">
            <input type="text" class="form-control" name="name" aria-describedby="name" placeholder="Enter the brand's name" required value="<?= $name ?>">
        </div>
        <h5>What About Their Page?</h5>
        <div class="form-group">
            <input type="text" class="form-control" name="link" aria-describedby="link" placeholder="Enter the brand's website" required value="<?= $link ?>">
        </div>
        <div class="form-check" style="font-size:18px;">
            <input class="form-check-input mt-2" type="checkbox" value="" name="local" id="flexCheckDefault" <?php echo ($local == 1 ? "checked" : ""); ?>>
            <label class="form-check-label" for="flexCheckDefault">Is This A Local Brand?</label>
        </div>
        <div class="form-check" style="font-size:18px;">
            <input class="form-check-input mt-2" type="checkbox" value="" name="navbar" id="flexCheckDefault2" <?php echo ($navbar == 1 ? "checked" : ""); ?>>
            <label class="form-check-label" for="flexCheckDefault2">Display In Nav Bar?</label>
        </div>
        <div class="form-check" style="font-size:18px;">
            <input class="form-check-input mt-2" type="checkbox" value="" name="footer" id="flexCheckDefault3" <?php echo ($footer == 1 ? "checked" : ""); ?>>
            <label class="form-check-label" for="flexCheckDefault3">Display In Footer?</label>
        </div>
        <br>
        <?php echo "<input type='hidden' name='id' value='$id'>"; ?>
        <button type="submit" class="btn btn-warning mb-1" name="edit">Save Brand</button>
        <button type="submit" class="btn btn-danger mb-1" name="delete">Delete Brand</button>
        <?php echo "<a class='btn btn-primary' href='manageAllBrands.php'>Cancel</a>"; ?>
    </form>

    <?php include('footer.php') ?>
</body>

</html>