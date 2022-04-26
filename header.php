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
                <li class="dropdown-header">Choose A Currency</li>
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
        <a class="nav-link px-4" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Women
        </a>
        <div class="dropdown-menu" style="width:600px" aria-labelledby="navbarDropdown">
			<div class="container container-sm">
				<div class="row">
					<div class="col-sm-4">
						<a class="dropdown-item headeritem" href="#">Shoes</a>
						<a class="dropdown-item" href="#">Basketball</a>
						<a class="dropdown-item" href="#">Training</a>
                        <a class="dropdown-item" href="#">Football</a>
						<a class="dropdown-item" href="#">Walking</a>
                        <a class="dropdown-item" href="#">Slides</a>
                        <a class="dropdown-item" href="#">All Shoes</a>
					</div>
					<div class="col-sm-4">
						<a class="dropdown-item headeritem" href="#">Clothing</a>
						<a class="dropdown-item" href="#">Pants</a>
						<a class="dropdown-item" href="#">Hoodies</a>
                        <a class="dropdown-item" href="#">Jackets</a>
                        <a class="dropdown-item" href="#">Socks</a>
                        <a class="dropdown-item" href="#">Polos</a>
                        <a class="dropdown-item" href="#">Shorts</a>
                        <a class="dropdown-item" href="#">Suits</a>
                        <a class="dropdown-item" href="#">T-Shirts</a>
                        <a class="dropdown-item" href="#">All Clothing</a>
					</div>
					<div class="col-sm-4">
						<a class="dropdown-item headeritem" href="#">Accessories</a>
						<a class="dropdown-item" href="#">Bags</a>
						<a class="dropdown-item" href="#">Hats</a>
                        <a class="dropdown-item" href="#">Gloves</a>
                        <a class="dropdown-item" href="#">Sunglasses</a>
                        <a class="dropdown-item" href="#">Necklaces</a>
                        <a class="dropdown-item" href="#">All Accessories</a>
					</div>					
				</div>
			</div>
        </li>
        <li class="nav-item dropdown active">
        <a class="nav-link px-4" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Men
        </a>
        <div class="dropdown-menu" style="width:600px" aria-labelledby="navbarDropdown">
			<div class="container container-sm">
				<div class="row">
					<div class="col-sm-4">
						<a class="dropdown-item headeritem" href="#">Shoes</a>
						<a class="dropdown-item" href="#">Basketball</a>
						<a class="dropdown-item" href="#">Training</a>
                        <a class="dropdown-item" href="#">Football</a>
						<a class="dropdown-item" href="#">Walking</a>
                        <a class="dropdown-item" href="#">Slides</a>
                        <a class="dropdown-item" href="#">All Shoes</a>
					</div>
					<div class="col-sm-4">
						<a class="dropdown-item headeritem" href="#">Clothing</a>
						<a class="dropdown-item" href="#">Pants</a>
						<a class="dropdown-item" href="#">Hoodies</a>
                        <a class="dropdown-item" href="#">Jackets</a>
                        <a class="dropdown-item" href="#">Socks</a>
                        <a class="dropdown-item" href="#">Polos</a>
                        <a class="dropdown-item" href="#">Shorts</a>
                        <a class="dropdown-item" href="#">Suits</a>
                        <a class="dropdown-item" href="#">T-Shirts</a>
                        <a class="dropdown-item" href="#">All Clothing</a>
					</div>
					<div class="col-sm-4">
						<a class="dropdown-item headeritem" href="#">Accessories</a>
						<a class="dropdown-item" href="#">Bags</a>
						<a class="dropdown-item" href="#">Hats</a>
                        <a class="dropdown-item" href="#">Gloves</a>
                        <a class="dropdown-item" href="#">Sunglasses</a>
                        <a class="dropdown-item" href="#">Necklaces</a>
                        <a class="dropdown-item" href="#">All Accessories</a>
					</div>					
				</div>
			</div>
        </li>
        <li class="nav-item dropdown active">
        <a class="nav-link px-4" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Brands
        </a>
        <div class="dropdown-menu" style="width:400px" aria-labelledby="navbarDropdown">
			<div class="container container-sm">
				<div class="row">
					<div class="col-sm-6">
						<a class="dropdown-item headeritem" href="#">Local Brands</a>
						<a class="dropdown-item" href="#">Hoda Store</a>
                        <a class="dropdown-item" href="#">Big Sale</a>
					</div>
					<div class="col-sm-6">
						<a class="dropdown-item headeritem" href="#">Public Brands</a>
						<a class="dropdown-item" href="#">Gucci</a>
						<a class="dropdown-item" href="#">Adidas</a>
                        <a class="dropdown-item" href="#">Nike</a>
					</div>					
				</div>
			</div>
        </li>
        <li class="nav-item active">
            <a class="nav-link px-4 saleitem" href="#">Sale</a>
        </li>
    </ul>
    <div class="my-2 my-lg-0 rightitems">
        <a class="px-3 text-reset" href="showMyLikes.php">
            <i class="far fa-heart"></i>
        </a>
        <a href="cart.php" class="text-reset">
            <i class="fa-solid fa-cart-shopping"></i>
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
    }
});
</script>