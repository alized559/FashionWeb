<?php
    include "includes/config.php";
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion | Products</title>
    <link href="css/products.css" rel="stylesheet" media="screen">
    <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">
    
    <?php include('header.php') ?>
</head>
<body>
    <div class="flexbox">
        <div class="filter" id="desktop">
            <form>
                <div class="filter-header1">
                    <a onclick="controlFilter('collapseFilter1')" style="text-decoration: none;" data-toggle="collapse" href="#collapseFilter1">
                        <i id="collapseFilter1Icon" class="fa fa-chevron-down"></i>
                        By Brand
                    </a>
                </div>
                <div class="filter-child collapse" id="collapseFilter1">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="check">
                        <label class="form-check-label" for="check">Nike</label>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="check">
                        <label class="form-check-label" for="check">Adidas</label>
                    </div>
                </div>

                <div class="filter-header">
                    <a onclick="controlFilter('collapseFilter2')" style="text-decoration: none;" data-toggle="collapse" href="#collapseFilter2">
                        <i id="collapseFilter2Icon" class="fa fa-chevron-down"></i>
                        By Name
                    </a>
                </div>
                <div class="filter-child collapse" id="collapseFilter2">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="check">
                        <label class="form-check-label" for="check">Nike</label>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="check">
                        <label class="form-check-label" for="check">Adidas</label>
                    </div>
                </div>

                <div class="filter-header">
                    <a onclick="controlFilter('collapseFilter3')" style="text-decoration: none;" data-toggle="collapse" href="#collapseFilter3">
                        <i id="collapseFilter3Icon" class="fa fa-chevron-down"></i>
                        By Price
                    </a>
                </div>
                <div class="filter-child collapse" id="collapseFilter3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="check">
                        <label class="form-check-label" for="check">Ascending</label>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="check">
                        <label class="form-check-label" for="check">Descending</label>
                    </div>
                </div>
            </form>
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
                            <form>
                                <div class="filter-header1">
                                    <a onclick="controlMobileFilter('collapseFilter1')" style="text-decoration: none;" data-toggle="collapse" href="#collapseFilter1">
                                        <i id="collapseFilter1MobileIcon" class="fa fa-chevron-down"></i>
                                        By Brand
                                    </a>
                                </div>
                                <div class="filter-child collapse" id="collapseFilter1">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="check">
                                        <label class="form-check-label" for="check">Nike</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="check">
                                        <label class="form-check-label" for="check">Adidas</label>
                                    </div>
                                </div>

                                <div class="filter-header">
                                    <a onclick="controlMobileFilter('collapseFilter2')" style="text-decoration: none;" data-toggle="collapse" href="#collapseFilter2">
                                        <i id="collapseFilter2MobileIcon" class="fa fa-chevron-down"></i>
                                        By Name
                                    </a>
                                </div>
                                <div class="filter-child collapse" id="collapseFilter2">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="check">
                                        <label class="form-check-label" for="check">Nike</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="check">
                                        <label class="form-check-label" for="check">Adidas</label>
                                    </div>
                                </div>

                                <div class="filter-header">
                                    <a onclick="controlMobileFilter('collapseFilter3')" style="text-decoration: none;" data-toggle="collapse" href="#collapseFilter3">
                                        <i id="collapseFilter3MobileIcon" class="fa fa-chevron-down"></i>
                                        By Price
                                    </a>
                                </div>
                                <div class="filter-child collapse" id="collapseFilter3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="check">
                                        <label class="form-check-label" for="check">Ascending</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="check">
                                        <label class="form-check-label" for="check">Descending</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <?php
                    $gender = $_GET['gender'];
                    if ($gender === 'w') {
                        $gender = 'f';
                    }
                    $category = $_GET['category'];
                    $type = $_GET['type'];
                    $sql = "SELECT prod_id,name,price,discount,brand FROM products WHERE department='$gender' AND category='$category' AND type='$type'";
                    $result = mysqli_query($db, $sql);

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
                                echo "<a href='viewProduct.php?id=$id' style='text-decoration: none; color: black'>";
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
                                                    echo "<span><del>$price$</del> $newprice$</span>";
                                                    echo "<button class='btn'>On Sale</button>";
                                                echo "</span>";
                                            }else {
                                                echo "$price$";
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
                <!--<div class="col">
                    <a href="#" style="text-decoration: none; color: black">
                        <div class="product">
                            <div class="image-container">
                                <img src="imgs/clothes-test.png">
                            </div>
                            <p>Women’s High-Rise Woven Pants
                            <br>
                            <span class="color">2 Colors</span>
                            <br>
                            70$
                        </div>
                    </a>
                </div>-->
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