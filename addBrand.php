<?php
    include "includes/validateAdminAuth.php";

    if(isset($_POST["create"])){
        include "includes/config.php";

        $name = str_replace('\'', '', $_POST["name"]);
        $link = str_replace('\'', '', $_POST["link"]);
        $local = isset($_POST["local"]);
        $navbar = isset($_POST["navbar"]);
        $footer = isset($_POST["footer"]);
        
        $sql = "INSERT INTO brands(name,link,local,display_navbar,display_footer) VALUE ('$name','$link','$local','$navbar','$footer')";
        $result = mysqli_query($db, $sql);
        if($result){
            header("location:manageAllBrands.php");
            die();
        }else {
            header("location:addBrand.php?error=0");
            die();
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
    <h2>Expanding With Brands Huh?</h2>
    <br>
    <br>
    <br>
    <form method="POST" action="addBrand.php" enctype="multipart/form-data">
        <h5>Lets Start With The Name</h5>
        <div class="form-group">
            <input type="text" class="form-control" name="name" aria-describedby="name" placeholder="Enter the brand's name" required>
        </div>
        <h5>What About Their Page?</h5>
        <div class="form-group">
            <input type="text" class="form-control" name="link" aria-describedby="link" placeholder="Enter the brand's website" required>
        </div>
        <div class="form-check" style="font-size:18px;">
            <input class="form-check-input mt-2" type="checkbox" name="local" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">Is This A Local Brand?</label>
        </div>
        <div class="form-check" style="font-size:18px;">
            <input class="form-check-input mt-2" type="checkbox" name="navbar" id="flexCheckDefault2">
            <label class="form-check-label" for="flexCheckDefault2">Display In Nav Bar?</label>
        </div>
        <div class="form-check" style="font-size:18px;">
            <input class="form-check-input mt-2" type="checkbox" name="footer" id="flexCheckDefault3">
            <label class="form-check-label" for="flexCheckDefault3">Display In Footer?</label>
        </div>
        <br>
        <button type="submit" class="btn btn-warning mb-1" name="create">Add Brand</button>
        <?php echo "<a class='btn btn-danger' href='manageAllBrands.php'>Cancel</a>"; ?>
    </form>

    <?php include('footer.php') ?>
</body>

</html>