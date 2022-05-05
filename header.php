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

<div class="navbar-head">
    <div class="imgcontainer">
        <img src="imgs/logo.png">
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
<nav class="navbar navbar-expand-lg navbar-light bg-white">
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
            <a class="nav-link px-4 saleitem" href="#">Sale</a>
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


<script>
if (typeof(Storage) !== "undefined") {
    if (localStorage.currentCurrency && localStorage.currentCurrencyImage) {
        var element = document.getElementById("currencyDropdownMenu");
        $(element).find('.dropdown-toggle').html(localStorage.currentCurrencyImage + localStorage.currentCurrency);
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

</script>