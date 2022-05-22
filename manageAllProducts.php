<?php

    include "includes/validateAdminAuth.php";  
    include "includes/config.php";
    
    $isFirstItem = true;

    $prodsql = "";

    function AddToSQL($sql){
        global $isFirstItem;
        global $prodsql;
        if($isFirstItem){
            $isFirstItem = false;
            $prodsql = $prodsql . "WHERE " . $sql . " ";
        }else {
            $prodsql = $prodsql . "AND $sql ";
        }
    }

    $orderBy = "";
    $isFirstOrderItem = true;

    function AddToSQLOrder($sql){
        global $isFirstOrderItem;
        global $orderBy;
        if($isFirstOrderItem){
            $isFirstOrderItem = false;
            $orderBy = "ORDER BY " . $sql . " ";
        }else {
            $orderBy = $orderBy . ", $sql ";
        }
    }

    $gender = $_GET['gender'] ?? "none";
    $gender = str_replace("w", "f", $gender);
    $category = $_GET['category'] ?? "none";
    $type = $_GET['type'] ?? "none";
    $brand = $_GET['brand'] ?? "none";
    $price = $_GET['price'] ?? "none";
    $sale = $_GET['sale'] ?? "none";
    $name = $_GET['name'] ?? "none";

    if($sale == "none" && $gender == "none" && $category == "none" && $type == "none" && $brand  == "none" && $price  == "none" && $name == "none"){
        $prodsql = "SELECT prod_id,name,price,discount,brand FROM products";
    }else {
        $prodsql = "SELECT prod_id,name,price,discount,brand FROM products ";
        $isFirstItem = true;
        if($gender != "none"){
            AddToSQL("(department='$gender' OR department='u')");
        }
        if($category != "none"){
            AddToSQL("category='$category'");
        }
        if($type != "none"){
            if($type != "all"){
                AddToSQL("type='$type'");
            }
        }
        if($brand != "none"){
            AddToSQL("brand='$brand'");
        }
        if($price != "none"){
            AddToSQLOrder("price $price");
        }
        if($sale != "none"){
            AddToSQL("discount > 0");
            AddToSQLOrder("discount $sale");
        }
        if($name != "none"){
            AddToSQL("name LIKE '%$name%'");
        }
    }

    $prodsql = $prodsql . $orderBy;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion | Manage Products</title>
    <link href="css/products.css" rel="stylesheet" media="screen">
    
    <?php include('header.php') ?>
</head>
<body>
    <div class="flexbox">
        <div class="filter" id="desktop">
            <div class="filter-header1">
                <a onclick="controlFilter('collapseFilter1')" style="text-decoration: none;" data-toggle="collapse" href="#collapseFilter1">
                    <i id="collapseFilter1Icon" class="fa fa-chevron-down"></i>
                    By Brand
                </a>
            </div>
            <div class="filter-child collapse" id="collapseFilter1">
                <?php
                    $sql = "SELECT name FROM brands";
                    $result = mysqli_query($db, $sql);

                    if($result){
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $bname = $row["name"];

                                echo "<div>";
                                echo "<a href='manageAllProducts.php?gender=$gender&category=$category&type=$type&brand=$bname&price=$price&sale=$sale&name=$name'>";
                                echo "$bname";
                                echo "</a></div>";
                            }
                        }else {
                        //No Brands
                        }
                        echo "<div>";
                        echo "<a href='manageAllProducts.php?gender=$gender&category=$category&type=$type&brand=none&price=$price&sale=$sale&name=$name'>";
                        echo "No Filter";
                        echo "</a></div>";
                    }
                ?>
            </div>

            <div class="filter-header">
                <a onclick="controlFilter('collapseFilter2')" style="text-decoration: none;" data-toggle="collapse" href="#collapseFilter2">
                    <i id="collapseFilter2Icon" class="fa fa-chevron-down"></i>
                    By Sale
                </a>
            </div>
            <div class="filter-child collapse" id="collapseFilter2">
                <?php
                    echo "<div>";
                    echo "<a href='manageAllProducts.php?gender=$gender&category=$category&type=$type&brand=$brand&price=$price&sale=ASC&name=$name'>";
                    echo "Ascending";
                    echo "</a></div>";

                    echo "<div>";
                    echo "<a href='manageAllProducts.php?gender=$gender&category=$category&type=$type&brand=$brand&price=$price&sale=DESC&name=$name'>";
                    echo "Descending";
                    echo "</a></div>";

                    echo "<div>";
                    echo "<a href='manageAllProducts.php?gender=$gender&category=$category&type=$type&brand=$brand&price=$price&sale=none&name=$name'>";
                    echo "No Filter";
                    echo "</a></div>";
                ?>
            </div>

            <div class="filter-header">
                <a onclick="controlFilter('collapseFilter3')" style="text-decoration: none;" data-toggle="collapse" href="#collapseFilter3">
                    <i id="collapseFilter3Icon" class="fa fa-chevron-down"></i>
                    By Price
                </a>
            </div>
            <div class="filter-child collapse" id="collapseFilter3">
                <?php
                    echo "<div>";
                    echo "<a href='manageAllProducts.php?gender=$gender&category=$category&type=$type&brand=$brand&price=ASC&sale=$sale&name=$name'>";
                    echo "Ascending";
                    echo "</a></div>";

                    echo "<div>";
                    echo "<a href='manageAllProducts.php?gender=$gender&category=$category&type=$type&brand=$brand&price=DESC&sale=$sale&name=$name'>";
                    echo "Descending";
                    echo "</a></div>";

                    echo "<div>";
                    echo "<a href='manageAllProducts.php?gender=$gender&category=$category&type=$type&brand=$brand&price=none&sale=$sale&name=$name'>";
                    echo "No Filter";
                    echo "</a></div>";
                ?>
            </div>
            <div class="filter-header">
                <a onclick="controlFilter('collapseFilter4')" style="text-decoration: none;" data-toggle="collapse" href="#collapseFilter4">
                    <i id="collapseFilter4Icon" class="fa fa-chevron-down"></i>
                    By Name
                </a>
            </div>
            <div class="filter-child collapse" id="collapseFilter4">
                <form method="GET" action="manageAllProducts.php">

                    <div class="input-group">
                        <div class="form-outline">
                            <input type="search" name="name" class="form-control" />
                        </div>
                        <button type="submit" class="btn btn-primary mt-1">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>

                    <?php 
                        echo "<input type='hidden' name='gender' value='$gender'>"; 
                        echo "<input type='hidden' name='category' value='$category'>"; 
                        echo "<input type='hidden' name='type' value='$type'>"; 
                        echo "<input type='hidden' name='brand' value='$brand'>"; 
                        echo "<input type='hidden' name='price' value='$price'>"; 
                        echo "<input type='hidden' name='sale' value='$sale'>"; 
                    ?>
                </form>
                <?php

                    echo "<div>";
                    echo "<a href='manageAllProducts.php?gender=$gender&category=$category&type=$type&brand=$brand&price=$price&sale=$sale&name=none'>";
                    echo "No Filter";
                    echo "</a></div>";
                ?>
            </div>
            <div class="extra-link mt-2">
                <a href="manageAllProducts.php">
                    Remove All Filters
                </a>
            </div>
        </div>

        <div class="filter-mobile" id="mobile">
            <button class="btn" data-toggle="modal" data-target="#modal">Filter</button>
        </div>

        <div class="modal fade" id="modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="filter-on-mobile">
                                <div class="filter-header1">
                                    <a onclick="controlMobileFilter('collapseFilter1')" style="text-decoration: none;" data-toggle="collapse" href="#collapseFilter1">
                                        <i id="collapseFilter1MobileIcon" class="fa fa-chevron-down"></i>
                                        By Brand
                                    </a>
                                </div>
                                <div class="filter-child collapse" id="collapseFilter1">
                                <?php
                                    $sql = "SELECT name FROM brands";
                                    $result = mysqli_query($db, $sql);

                                    if($result){
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_assoc($result)){
                                                $bname = $row["name"];

                                                echo "<div>";
                                                echo "<a href='manageAllProducts.php?gender=$gender&category=$category&type=$type&brand=$bname&price=$price&sale=$sale&name=$name'>";
                                                echo "$bname";
                                                echo "</a></div>";
                                            }
                                        }else {
                                        //No Brands
                                        }
                                        echo "<div>";
                                        echo "<a href='manageAllProducts.php?gender=$gender&category=$category&type=$type&brand=none&price=$price&sale=$sale&name=$name'>";
                                        echo "No Filter";
                                        echo "</a></div>";
                                    }
                                ?>
                                </div>

                                <div class="filter-header">
                                    <a onclick="controlMobileFilter('collapseFilter2')" style="text-decoration: none;" data-toggle="collapse" href="#collapseFilter2">
                                        <i id="collapseFilter2MobileIcon" class="fa fa-chevron-down"></i>
                                        By Sale
                                    </a>
                                </div>
                                <div class="filter-child collapse" id="collapseFilter2">
                                <?php
                                    echo "<div>";
                                    echo "<a href='manageAllProducts.php?gender=$gender&category=$category&type=$type&brand=$brand&price=$price&sale=ASC&name=$name'>";
                                    echo "Ascending";
                                    echo "</a></div>";

                                    echo "<div>";
                                    echo "<a href='manageAllProducts.php?gender=$gender&category=$category&type=$type&brand=$brand&price=$price&sale=DESC&name=$name'>";
                                    echo "Descending";
                                    echo "</a></div>";

                                    echo "<div>";
                                    echo "<a href='manageAllProducts.phpp?gender=$gender&category=$category&type=$type&brand=$brand&price=$price&sale=none&name=$name'>";
                                    echo "No Filter";
                                    echo "</a></div>";
                                ?>
                                </div>

                                <div class="filter-header">
                                    <a onclick="controlMobileFilter('collapseFilter3')" style="text-decoration: none;" data-toggle="collapse" href="#collapseFilter3">
                                        <i id="collapseFilter3MobileIcon" class="fa fa-chevron-down"></i>
                                        By Price
                                    </a>
                                </div>
                                <div class="filter-child collapse" id="collapseFilter3">
                                    <?php
                                        echo "<div>";
                                        echo "<a href='manageAllProducts.php?gender=$gender&category=$category&type=$type&brand=$brand&price=ASC&sale=$sale&name=$name'>";
                                        echo "Ascending";
                                        echo "</a></div>";

                                        echo "<div>";
                                        echo "<a href='manageAllProducts.php?gender=$gender&category=$category&type=$type&brand=$brand&price=DESC&sale=$sale&name=$name'>";
                                        echo "Descending";
                                        echo "</a></div>";

                                        echo "<div>";
                                        echo "<a href='manageAllProducts.php?gender=$gender&category=$category&type=$type&brand=$brand&price=none&sale=$sale&name=$name'>";
                                        echo "No Filter";
                                        echo "</a></div>";
                                    ?>
                                </div>

                                <div class="filter-header">
                                    <a onclick="controlMobileFilter('collapseFilter4')" style="text-decoration: none;" data-toggle="collapse" href="#collapseFilter4">
                                        <i id="collapseFilter4MobileIcon" class="fa fa-chevron-down"></i>
                                        By Name
                                    </a>
                                </div>
                                <div class="filter-child collapse" id="collapseFilter4">
                                    <form method="GET" action="manageAllProducts.php">

                                        <div class="input-group">
                                            <div class="form-outline">
                                                <input type="search" name="name" class="form-control" />
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-1">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>

                                        <?php 
                                            echo "<input type='hidden' name='gender' value='$gender'>"; 
                                            echo "<input type='hidden' name='category' value='$category'>"; 
                                            echo "<input type='hidden' name='type' value='$type'>"; 
                                            echo "<input type='hidden' name='brand' value='$brand'>"; 
                                            echo "<input type='hidden' name='price' value='$price'>"; 
                                            echo "<input type='hidden' name='sale' value='$sale'>"; 
                                        ?>
                                    </form>
                                    <?php

                                        echo "<div>";
                                        echo "<a href='manageAllProducts.php?gender=$gender&category=$category&type=$type&brand=$brand&price=$price&sale=$sale&name=none'>";
                                        echo "No Filter";
                                        echo "</a></div>";
                                    ?>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <h5>Admin Tools</h5>
            <div class="admin-tools">
                <a href="addProduct.php" class="btn btn-warning">Add Product</a>
            <div>
            <br>
            <div class="row">
                <?php
                    
                    $result = mysqli_query($db, $prodsql);

                    if($result){
                        if(mysqli_num_rows($result) > 0){
                          while($row = mysqli_fetch_assoc($result)){
                            $id = $row["prod_id"];
                            $name = $row["name"];
                            $price = $row["price"];
                            $discount = $row["discount"];
                            $brand = $row["brand"];
                
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
                            
                            echo "<div class='col'>";
                            echo "<a href='viewProduct.php?id=$id' class='btn btn-primary mb-1'>View Product</a>";
                            echo "<a href='viewProductItems.php?id=$id' class='btn btn-primary ml-2 mb-1'>View Items</a>";
                            echo "<a href='editProduct.php?id=$id' style='text-decoration: none; color: black'>";
                            echo "<div class='product'>";
                            echo "<div class='image-container'>";
                            echo "<img src='$file'>";
                            echo "</div>";
                            echo "<p>$name";
                                echo "<br>";
                                echo "<span class='color'>$brand</span>";
                                echo "<br>";
                                if($discount > 0){
                                    $newprice = $price - $discount;
                                    echo "<span class='sale'>";
                                    echo "<span><del>$price$</del> <span class='price2'>$newprice$</span></span>";
                                    echo "<button class='btn'>On Sale</button>";
                                    echo "</span>";
                                }else {
                                    echo "<span class='price2'>$price$</span>";
                                }
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