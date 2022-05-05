<?php
    include "includes/validateAdminAuth.php";

    include "includes/config.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion | Manage Brands</title>
    <link href="css/brands.css" rel="stylesheet" media="screen">

    <?php include('header.php') ?>
</head>
<body>
    <div class="flexbox">
        <div class="container-fluid">
            <h5>Admin Tools</h5>
            <div class="admin-tools">
                <a href="addBrand.php" class="btn btn-warning">Add Brand</a>
            <div>
            <br>
            <div class="brands-flex">
                <?php
                    $sql = "SELECT brand_id,name,link FROM brands";
                    $result = mysqli_query($db, $sql);

                    if($result){
                        if(mysqli_num_rows($result) > 0){
                          while($row = mysqli_fetch_assoc($result)){
                            $id = $row["brand_id"];
                            $name = $row["name"];
                            $link = $row["link"];

                            echo "<a class='text-reset' href='editBrand.php?id=$id' style='text-decoration:none;'>";
                            echo "<div class='brand-items'>";
                            echo "<h5>$name • $link</h5>";
                            echo "</div>";
                            echo "</a>";
                          }
                        }else {
                          //No Brands
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <?php include('footer.php') ?>
</body>

<script>
    function controlFilter(id) {
        if($('#' + id).is('.collapse:not(.show)')) {
            document.getElementById(id + 'Icon').className = "fa fa-chevron-up";
        } else if ($('#' + id).is('.collapse:not(.hidden)')) {
            document.getElementById(id + 'Icon').className = "fa fa-chevron-down";
        }
    }

    function controlMobileFilter(id) {
        if($('#' + id).is('.collapse:not(.show)')) {
            document.getElementById(id + 'MobileIcon').className = "fa fa-chevron-up";
        } else if ($('#' + id).is('.collapse:not(.hidden)')) {
            document.getElementById(id + 'MobileIcon').className = "fa fa-chevron-down";
        }
    }

    $(window).resize(function() {
        if ($(window).width() >= 700) {
            if ($('#modal').hasClass('show')) {
                $('#modal').modal('toggle');   
            }
        }
    });

</script>

</html>