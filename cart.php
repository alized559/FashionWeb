<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion | Cart</title>

    <link href="css/cart.css" rel="stylesheet" media="screen">

    <?php include "header.php"; ?>
</head>
<body>
    <div class="cart">
        <div class="cart-container">
            <div class="header">
                <h3 class="heading">Shopping Cart</h3>
                <h5 class="action">Remove all</h5>
            </div>

            <div class="cart-items">
                <div class="image-box">
                    <img src="imgs/9.png" style="height: 150px;" alt="Product Cart Image"/>
                </div>

                <div class="about">
                    <h1 class="title">Nike Zoom Freak 3</h1>
                    <h3 class="subtitle">Aqua</h3>
                    <h3 class="subtitle">Size: 33.5</h3>
                </div>

                <div class="counter">
                    <div class="btn">-</div>
                    <div class="count">2</div>
                    <div class="btn">+</div>
                </div>

                <div class="prices">
                    <div class="amount">$70</div>
                    <div class="remove"><u>Remove</u></div>
                </div>
            </div>

            <div class="cart-items">
                <div class="image-box">
                    <img src="imgs/14.png" style="height: 150px;" alt="Product Cart Image"/>
                </div>

                <div class="about">
                    <h1 class="title">Nike Zoom Freak 3</h1>
                    <h3 class="subtitle">Pink</h3>
                    <h3 class="subtitle">Size: 43</h3>
                </div>

                <div class="counter">
                    <div class="btn">-</div>
                    <div class="count">1</div>
                    <div class="btn">+</div>
                </div>

                <div class="prices">
                    <div class="amount">$90</div>
                    <div class="remove"><u>Remove</u></div>
                </div>
            </div>

            <div class="vertical-line"></div>
            <div class="checkout">
                <div class="total">
                    <div>
                        <div class="Subtotal">Sub-Total</div>
                        <div class="items">2 items</div>
                    </div>

                    <div class="total-amount">$160</div>
                </div>

                <button class="button">Checkout</button>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>
</body>
</html>