<?php
include "includes/utils.php";
if(is_session_started() === FALSE){
    session_start();
}
?>
<link href="css/header.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/c530224477.js" crossorigin="anonymous"></script>

<div class="nav-desktop">
<div class="navbar-head">
    <div class="imgcontainer">
        <a href="index.php"><img src="imgs/logo.png"></a>
    </div>
    <div class="rightcontainer">
        <div class="btn-group" id="currencyDropdownMenu">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="imgs/flags/us.png">
                US, USD
            </button>

            <ul class="dropdown-menu">
                <li>
                    <a href="#" title="Select USD Currency"><img src="imgs/flags/us.png">US, USD</a>
                </li>
                <li>
                    <a href="#" title="Select LBP Currency"><img src="imgs/flags/lb.png">LB, LBP</a>
                </li>
            </ul>
        </div>

        <a href="help.php">Help</a>
        <div class="vl"></div>
        <a href="panel.php">
            <i class="fas fa-user-alt"></i>
        </a>
    </div>
</div>
<nav class="navbar navbar-expand-sm navbar-light bg-white">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link px-4" href="index.php">Home</a>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link px-4" href="#" id="navbarDropdown" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Women
        </a>
        <div class="dropdown-menu" style="width:600px" aria-labelledby="navbarDropdown">
			<div class="container container-sm">
				<div class="row">
					<div class="col-sm-4">
						<a class="dropdown-item headeritem" href="#">Shoes</a>
						<a class="dropdown-item" href="products.php?gender=w&category=shoes&type=basketball">Basketball</a>
						<a class="dropdown-item" href="products.php?gender=w&category=shoes&type=training">Training</a>
                        <a class="dropdown-item" href="products.php?gender=w&category=shoes&type=football">Football</a>
						<a class="dropdown-item" href="products.php?gender=w&category=shoes&type=walking">Walking</a>
                        <a class="dropdown-item" href="products.php?gender=w&category=shoes&type=slides">Slides</a>
                        <a class="dropdown-item" href="products.php?gender=w&category=shoes&type=all">All Shoes</a>
					</div>
					<div class="col-sm-4">
						<a class="dropdown-item headeritem" href="#">Clothing</a>
						<a class="dropdown-item" href="products.php?gender=w&category=clothing&type=pants">Pants</a>
						<a class="dropdown-item" href="products.php?gender=w&category=clothing&type=hoodies">Hoodies</a>
                        <a class="dropdown-item" href="products.php?gender=w&category=clothing&type=jackets">Jackets</a>
                        <a class="dropdown-item" href="products.php?gender=w&category=clothing&type=socks">Socks</a>
                        <a class="dropdown-item" href="products.php?gender=w&category=clothing&type=polos">Polos</a>
                        <a class="dropdown-item" href="products.php?gender=w&category=clothing&type=shorts">Shorts</a>
                        <a class="dropdown-item" href="products.php?gender=w&category=clothing&type=suits">Suits</a>
                        <a class="dropdown-item" href="products.php?gender=w&category=clothing&type=tshirts">T-Shirts</a>
                        <a class="dropdown-item" href="products.php?gender=w&category=clothing&type=all">All Clothing</a>
					</div>
					<div class="col-sm-4">
						<a class="dropdown-item headeritem" href="#">Accessories</a>
						<a class="dropdown-item" href="products.php?gender=w&category=accessories&type=bags">Bags</a>
						<a class="dropdown-item" href="products.php?gender=w&category=accessories&type=hats">Hats</a>
                        <a class="dropdown-item" href="products.php?gender=w&category=accessories&type=gloves">Gloves</a>
                        <a class="dropdown-item" href="products.php?gender=w&category=accessories&type=sunglasses">Sunglasses</a>
                        <a class="dropdown-item" href="products.php?gender=w&category=accessories&type=necklaces">Necklaces</a>
                        <a class="dropdown-item" href="products.php?gender=w&category=accessories&type=all">All Accessories</a>
					</div>					
				</div>
			</div>
        </li>
        <li class="nav-item dropdown active">
        <a class="nav-link px-4" href="#" id="navbarDropdown" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Men
        </a>
        <div class="dropdown-menu" style="width:600px" aria-labelledby="navbarDropdown">
			<div class="container container-sm">
				<div class="row">
					<div class="col-sm-4">
						<a class="dropdown-item headeritem" href="#">Shoes</a>
						<a class="dropdown-item" href="products.php?gender=m&category=shoes&type=basketball">Basketball</a>
						<a class="dropdown-item" href="products.php?gender=m&category=shoes&type=training">Training</a>
                        <a class="dropdown-item" href="products.php?gender=m&category=shoes&type=football">Football</a>
						<a class="dropdown-item" href="products.php?gender=m&category=shoes&type=walking">Walking</a>
                        <a class="dropdown-item" href="products.php?gender=m&category=shoes&type=slides">Slides</a>
                        <a class="dropdown-item" href="products.php?gender=m&category=shoes&type=all">All Shoes</a>
					</div>
					<div class="col-sm-4">
						<a class="dropdown-item headeritem" href="#">Clothing</a>
						<a class="dropdown-item" href="products.php?gender=m&category=clothing&type=pants">Pants</a>
						<a class="dropdown-item" href="products.php?gender=m&category=clothing&type=hoodies">Hoodies</a>
                        <a class="dropdown-item" href="products.php?gender=m&category=clothing&type=jackets">Jackets</a>
                        <a class="dropdown-item" href="products.php?gender=m&category=clothing&type=socks">Socks</a>
                        <a class="dropdown-item" href="products.php?gender=m&category=clothing&type=polos">Polos</a>
                        <a class="dropdown-item" href="products.php?gender=m&category=clothing&type=shorts">Shorts</a>
                        <a class="dropdown-item" href="products.php?gender=m&category=clothing&type=suits">Suits</a>
                        <a class="dropdown-item" href="products.php?gender=m&category=clothing&type=tshirts">T-Shirts</a>
                        <a class="dropdown-item" href="products.php?gender=m&category=clothing&type=all">All Clothing</a>
					</div>
					<div class="col-sm-4">
						<a class="dropdown-item headeritem" href="#">Accessories</a>
						<a class="dropdown-item" href="products.php?gender=m&category=accessories&type=bags">Bags</a>
						<a class="dropdown-item" href="products.php?gender=m&category=accessories&type=hats">Hats</a>
                        <a class="dropdown-item" href="products.php?gender=m&category=accessories&type=gloves">Gloves</a>
                        <a class="dropdown-item" href="products.php?gender=m&category=accessories&type=sunglasses">Sunglasses</a>
                        <a class="dropdown-item" href="products.php?gender=m&category=accessories&type=necklaces">Necklaces</a>
                        <a class="dropdown-item" href="products.php?gender=m&category=accessories&type=all">All Accessories</a>
					</div>					
				</div>
			</div>
        </li>
        <li class="nav-item dropdown active">
        <a class="nav-link px-4" href="#" id="navbarDropdown" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Brands
        </a>
        <div class="dropdown-menu" style="width:400px" aria-labelledby="navbarDropdown">
			<div class="container container-sm">
				<div class="row">
                    <?php
                        include 'includes/config.php';
                        
                        $sql = "SELECT name,link FROM brands WHERE local='0' AND display_navbar='1'";
                        $result = mysqli_query($db, $sql);

                        if($result){
                            if(mysqli_num_rows($result) > 0){
                                echo "<div class='col-sm-6'>";
                                echo "<a class='dropdown-item headeritem' href='#'>Public Brands</a>";
                                while($row = mysqli_fetch_assoc($result)){
                                    $headername = $row["name"];
                                    $headerlink = $row["link"];
                                    echo "<a class='dropdown-item' href='$headerlink' target='_blank' rel='noopener noreferrer'>$headername</a>";
                                }
                                echo "</div>";
                            }else {
                            //No Public Brands To Display
                            }
                        }

                        $sql = "SELECT name,link FROM brands WHERE local='1' AND display_navbar='1'";
                        $result = mysqli_query($db, $sql);

                        if($result){
                            if(mysqli_num_rows($result) > 0){
                                echo "<div class='col-sm-6'>";
                                echo "<a class='dropdown-item headeritem' href='#'>Local Brands</a>";
                                while($row = mysqli_fetch_assoc($result)){
                                    $headername = $row["name"];
                                    $headerlink = $row["link"];
                                    echo "<a class='dropdown-item' href='$headerlink' target='_blank' rel='noopener noreferrer'>$headername</a>";
                                }
                                echo "</div>";
                            }else {
                            //No Local Brands To Display
                            }
                        }
                    ?>				
				</div>
			</div>
        </li>
        <li class="nav-item active">
            <a class="nav-link px-4 saleitem" href="products.php?sale=DESC">Sale</a>
        </li>
    </ul>
    <div class="my-2 my-lg-0 rightitems">
        <a class="px-3 text-reset" href="showAllFavorites.php" style="text-decoration: none;">
            <i class="far fa-heart"></i>
        </a>
        <a href="cart.php" class="text-reset" style="text-decoration: none;">
            <?php 
                if(isset($_SESSION['userID'])){
                    include 'includes/config.php';
                    $headeruserid = $_SESSION['userID'];
                    $sql = "SELECT item_id,`user_id` FROM cart_items,cart WHERE cart_items.cart_id=cart.cart_id AND `user_id`=$headeruserid LIMIT 1";
                    $result = mysqli_query($db, $sql);
                    if($result){
                        if(mysqli_num_rows($result) > 0){
                            ?>
                            <span class="fa-stack">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <i class="fa-solid fa-circle fa-stack-1x mt-1" style='color:red; font-size:10px'></i>
                            </span>
                        <?php }else {
                            ?>
                            <i class="fa-solid fa-cart-shopping"></i>
                        <?php }
                    }   
                }else {
            ?>
            <i class="fa-solid fa-cart-shopping"></i>
            <?php } ?>
        </a>
    </div>
  </div>
</nav>
</div>

<div class="nav-mobile">
    <div class="mobile-navbar">
        <div id="mySidenav" class="sidenav">
            <a class="closebtn" onclick="closeNav()">&times;</a>
            <a href="index.php" onclick="closeNav()">Home</a>
            <a onclick="openWomenChildNav()">
                <div class="nav-item">
                    <span>Women</span>
                    <span class="left-arrow">&rsaquo;</span>
                </div>
            </a>
            <a onclick="openMenChildNav()">
                <div class="nav-item">
                    <span>Men</span>
                    <span class="left-arrow">&rsaquo;</span>
                </div>
            </a>
            <a onclick="closeNav()">Brands</a>
            <a href="#" class="sale" onclick="closeNav()">Sale</a>
            
            <div class="account">
                <?php 
                
                    if (isset($_SESSION['username'])) {
                        $user_id = $_SESSION['userID'];

                        $file = "images/users/" . $user_id . "/logo.jpg";
                
                        if(!file_exists($file)){//Deletes the image if it exists
                            $file = "images/users/" . $user_id . "/logo.png";
                            if(!file_exists($file)){//Deletes the image if it exists
                                $file = "images/users/" . $user_id . "/logo.gif";
                                if(!file_exists($file)){//Deletes the image if it exists
                                    $file = "images/users/default.png";
                                }
                            }
                        }
                        echo "<p style='margin-left: 20px; text-align: start'>My Account</p>";
                        echo "<a href='panel.php' style='border-bottom: 0'><img src='$file' width='50px' height='50px'></a>";
                    } else {
                        echo "<p>My Account</p>";
                        echo "<a href='login.php' style='border-bottom: 0'><button class='btn black'>Login</button></a>";
                        echo "<a href='signup.php' style='border-bottom: 0; padding-top: 0'><button class='btn trans'>Signup</button></a>";
                    }
                
                ?>
            </div>

            <p class="coun-curr">Delivery Country & Currency</p>
            <div class="btn-group" id="currencyDropdownMenu2">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="imgs/flags/us.png">
                    US, USD
                </button>

                <ul class="dropdown-menu" data-toggle="modal" data-target="#exampleModalLong">
                    <li>
                        <a href="#" title="Select USD Currency"><img src="imgs/flags/us.png">US, USD</a>
                    </li>
                    <li>
                        <a href="#" title="Select LBP Currency"><img src="imgs/flags/lb.png">LB, LBP</a>
                    </li>
                </ul>
            </div>

            
        </div>

        <div id="mySidenav-women-child" class="sidenav">
            <a href="#" class="closebtn" onclick="closeWomenChildNav()">&lsaquo;</a>
            <p class="title">Shoes</p>
            <a href="products.php?gender=w&category=shoes&type=basketball" onclick="closeNav(); closeWomenChildNav()">Basketball</a>
            <a href="products.php?gender=w&category=shoes&type=training" class="category-item" onclick="closeNav(); closeWomenChildNav()">Training</a>
            <a href="products.php?gender=w&category=shoes&type=football" class="category-item" onclick="closeNav(); closeWomenChildNav()">Football</a>
            <a href="products.php?gender=w&category=shoes&type=walking" class="category-item" onclick="closeNav(); closeWomenChildNav()">Walking</a>
            <a href="products.php?gender=w&category=shoes&type=slides" class="category-item" onclick="closeNav(); closeWomenChildNav()">Slides</a>
            <a href="products.php?gender=w&category=shoes&type=all" class="category-item" onclick="closeNav(); closeWomenChildNav()">All Shoes</a>

            <p class="title1">Clothing</p>
            <a href="products.php?gender=w&category=clothing&type=pants" (click)="closeNav(); closeWomenChildNav()">Pants</a>
            <a href="products.php?gender=w&category=clothing&type=hoodies" class="category-item" onclick="closeNav(); closeWomenChildNav()">Hoodies</a>
            <a href="products.php?gender=w&category=clothing&type=jackets" class="category-item" onclick="closeNav(); closeWomenChildNav()">Jackets</a>
            <a href="products.php?gender=w&category=clothing&type=socks" class="category-item" onclick="closeNav(); closeWomenChildNav()">Socks</a>
            <a href="products.php?gender=w&category=clothing&type=polos" class="category-item" onclick="closeNav(); closeWomenChildNav()">Polos</a>
            <a href="products.php?gender=w&category=clothing&type=shorts" class="category-item" onclick="closeNav(); closeWomenChildNav()">Shorts</a>
            <a href="products.php?gender=w&category=clothing&type=suits" class="category-item" onclick="closeNav(); closeWomenChildNav()">Suits</a>
            <a href="products.php?gender=w&category=clothing&type=t-shirts" class="category-item" onclick="closeNav(); closeWomenChildNav()">T-Shirts</a>
            <a href="products.php?gender=w&category=clothing&type=all" class="category-item" onclick="closeNav(); closeWomenChildNav()">All Clothing</a>

            <p class="title1">Accessories</p>
            <a href="products.php?gender=w&category=accessories&type=bags" onclick="closeNav(); closeWomenChildNav()">Bags</a>
            <a href="products.php?gender=w&category=accessories&type=hats" class="category-item" onclick="closeNav(); closeWomenChildNav()">Hats</a>
            <a href="products.php?gender=w&category=accessories&type=gloves" class="category-item" onclick="closeNav(); closeWomenChildNav()">Gloves</a>
            <a href="products.php?gender=w&category=accessories&type=sunglasses" class="category-item" onclick="closeNav(); closeWomenChildNav()">Sunglasses</a>
            <a href="products.php?gender=w&category=accessories&type=necklaces" class="category-item" onclick="closeNav(); closeWomenChildNav()">Necklaces</a>
            <a href="products.php?gender=w&category=accessories&type=all" class="category-item" onclick="closeNav(); closeWomenChildNav()">All Accessories</a>
        </div>

        <div id="mySidenav-men-child" class="sidenav">
            <a href="#" class="closebtn" onclick="closeMenChildNav()">&lsaquo;</a>
            <p class="title">Shoes</p>
            <a href="products.php?gender=m&category=shoes&type=basketball" onclick="closeNav(); closeMenChildNav()">Basketball</a>
            <a href="products.php?gender=m&category=shoes&type=training" class="category-item" onclick="closeNav(); closeMenChildNav()">Training</a>
            <a href="products.php?gender=m&category=shoes&type=football" class="category-item" onclick="closeNav(); closeMenChildNav()">Football</a>
            <a href="products.php?gender=m&category=shoes&type=walking" class="category-item" onclick="closeNav(); closeMenChildNav()">Walking</a>
            <a href="products.php?gender=m&category=shoes&type=slides" class="category-item" onclick)="closeNav(); closeMenChildNav()">Slides</a>
            <a href="products.php?gender=m&category=shoes&type=all" class="category-item" onclick="closeNav(); closeMenChildNav()">All Shoes</a>

            <p class="title1">Clothing</p>
            <a href="products.php?gender=m&category=clothing&type=pants" onclick="closeNav(); closeMenChildNav()">Pants</a>
            <a href="products.php?gender=m&category=clothing&type=hoodies" class="category-item" onclick="closeNav(); closeMenChildNav()">Hoodies</a>
            <a href="products.php?gender=m&category=clothing&type=jackets" class="category-item" onclick="closeNav(); closeMenChildNav()">Jackets</a>
            <a href="products.php?gender=m&category=clothing&type=socks" class="category-item" onclick="closeNav(); closeMenChildNav()">Socks</a>
            <a href="products.php?gender=m&category=clothing&type=polos" class="category-item" onclick="closeNav(); closeMenChildNav()">Polos</a>
            <a href="products.php?gender=m&category=clothing&type=shorts" class="category-item" onclick="closeNav(); closeMenChildNav()">Shorts</a>
            <a href="products.php?gender=m&category=clothing&type=suits" class="category-item" onclick="closeNav(); closeMenChildNav()">Suits</a>
            <a href="products.php?gender=m&category=clothing&type=t-shirts" class="category-item" onclick="closeNav(); closeMenChildNav()">T-Shirts</a>
            <a href="products.php?gender=m&category=clothing&type=all" class="category-item" onclick="closeNav(); closeMenChildNav()">All Clothing</a>

            <p class="title1">Accessories</p>
            <a href="products.php?gender=m&category=accessories&type=bags" onclick="closeNav(); closeMenChildNav()">Bags</a>
            <a href="products.php?gender=m&category=accessories&type=hats" class="category-item" onclick="closeNav(); closeMenChildNav()">Hats</a>
            <a href="products.php?gender=m&category=accessories&type=gloves" class="category-item" onclick="closeNav(); closeMenChildNav()">Gloves</a>
            <a href="products.php?gender=m&category=accessories&type=sunglasses" class="category-item" onclick="closeNav(); closeMenChildNav()">Sunglasses</a>
            <a href="products.php?gender=m&category=accessories&type=all" class="category-item" onclick="closeNav(); closeMenChildNav()">All Accessories</a>
        </div>
        
        <div class="top-navbar">
            <span class="open-btn" onclick="openNav()">&#9776;</span>

            <div class="logo-container">
            <a href="index.php"><img class="logo" src="imgs/logo.png" alt="logo"></a>
            </div>

            <div class="cart-fav">
            <!-- <a href="#"><i class="fa fa-shopping-bag"></i></a> -->
            <a href="cart.php" class="text-reset" style="text-decoration: none;">
            <?php 
                if(isset($_SESSION['userID'])){
                    include 'includes/config.php';
                    $headeruserid = $_SESSION['userID'];
                    $sql = "SELECT item_id,`user_id` FROM cart_items,cart WHERE cart_items.cart_id=cart.cart_id AND `user_id`=$headeruserid LIMIT 1";
                    $result = mysqli_query($db, $sql);
                    if($result){
                        if(mysqli_num_rows($result) > 0){
                            ?>
                            <span class="fa-stack">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <i class="fa-solid fa-circle fa-stack-1x mt-1" style='color:red; font-size:10px'></i>
                            </span>
                        <?php }else {
                            ?>
                            <i class="fa-solid fa-cart-shopping"></i>
                        <?php }
                    }   
                }else {
            ?>
            <i class="fa-solid fa-cart-shopping"></i>
            <?php } ?>
        </a>
        <a class="px-2 text-reset" href="showAllFavorites.php" style="text-decoration: none;">
            <i class="far fa-heart"></i>
        </a>
            </div>
        </div>
    </div>
</div>

<script>
if (typeof(Storage) !== "undefined") {
    if (localStorage.currentCurrency && localStorage.currentCurrencyImage) {
        var element = document.getElementById("currencyDropdownMenu");
        var element2 = document.getElementById("currencyDropdownMenu2");
        $(element).find('.dropdown-toggle').html(localStorage.currentCurrencyImage + localStorage.currentCurrency);
        $(element2).find('.dropdown-toggle').html(localStorage.currentCurrencyImage + localStorage.currentCurrency);
    }else {
        localStorage.currentCurrency = "US, USD";
        localStorage.currentCurrencyImage = "<img src='imgs/flags/us.png'>";
    }
}

$(".dropdown-menu li a").click(function () {
    var selText = $(this).text();
    var imgSource = $(this).find('img').attr('src');
    var img = '<img src="' + imgSource + '"/>';        
    $(this).parents('.btn-group').find('.dropdown-toggle').html(img + selText);
    if (typeof(Storage) !== "undefined") {
        localStorage.currentCurrency = selText;
        localStorage.currentCurrencyImage = img;
        location.reload();
    }
});

document.addEventListener("DOMContentLoaded", function(){
    if (window.innerWidth > 992) {
        let timer = null;
        document.querySelectorAll('.navbar .nav-item').forEach(function(everyitem){
            everyitem.addEventListener('mouseover', function(e){
                let el_link = this.querySelector('a[data-bs-toggle]');
                if(el_link != null){
                    let nextEl = el_link.nextElementSibling;
                    el_link.classList.add('show');
                    nextEl.classList.add('show');
                }
            });
            everyitem.addEventListener('mouseleave', function(e){
                let el_link = this.querySelector('a[data-bs-toggle]');
                if(el_link != null){
                    let nextEl = el_link.nextElementSibling;
                    el_link.classList.remove('show');
                    nextEl.classList.remove('show');
                }
            })
        });
    }
}); 

function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "";
}

function openWomenChildNav() {
    document.getElementById("mySidenav-women-child").style.width = "250px";
}

function closeWomenChildNav() {
    document.getElementById("mySidenav-women-child").style.width = "";
}

function openMenChildNav() {
    document.getElementById("mySidenav-men-child").style.width = "250px";
}

function closeMenChildNav() {
    document.getElementById("mySidenav-men-child").style.width = "";
}

</script>