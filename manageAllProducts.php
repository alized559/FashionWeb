<?php
    include "includes/validateAdminAuth.php";
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
            <h5>Admin Tools</h5>
            <div class="admin-tools">
                <a href="addProduct.php" class="btn btn-warning">Add Product</a>
            <div>
            <br>
            <div class="row">
                <div class="col">
                    <a href="editProduct.php" class="btn btn-primary">Edit Product</a>
                    <a href="deleteProduct.php" class="btn btn-danger">Delete Product</a>
                    <br>
                    <br>
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
                </div>

                <div class="col">
                    <a href="editProduct.php" class="btn btn-primary">Edit Product</a>
                    <a href="deleteProduct.php" class="btn btn-danger">Delete Product</a>
                    <br>
                    <br>
                    <a href="#" style="text-decoration: none; color: black">
                        <div class="product">
                            <div class="image-container">
                                <img src="imgs/clothes-test.png">
                            </div>
                            <p>
                                Women’s High-Rise Woven Pants
                                <br>
                                <span class="color">2 Colors</span>
                                <br>
                                <span class="sale">
                                    <span><del>70$</del> 50$</span>
                                    <button class="btn">On Sale</button>
                                </span>
                            </p>
                        </div>
                    </a>
                </div>
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

    function EditProduct(){
        alert("test");
    }

</script>

</html>