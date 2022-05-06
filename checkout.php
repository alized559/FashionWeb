<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion | Checkout</title>

    <link href="css/checkout.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c530224477.js" crossorigin="anonymous"></script>

</head>
<body>
    <div class="navbar">
        <div class="help">
            <p>Need Help? <a href="help.php"><u>Chat with us now</u></a></p>
        </div>

        <div class="logo">
            <a href="index.php"><img src="imgs/logo.png"></a>
        </div>

        <div class="secure-checkout">
            <i class="fa fa-lock" style="margin: 4px 5px 0 0;"></i>
            <p>Secure Checkout</p>
        </div>
    </div>

    <div class="title">
        <h1>Checkout</h1>
    </div>

    <div class="checkout">
        <div class="box">
            <div class="leftside">
                <img src="imgs/back.png" alt="Checkout Image">
            </div>

            <div class="rightside">
                <form action="checkout.php">
                    <div class="slideshow-container">
                        <div class="mySlides">
                            <h3>Your Information</h3>

                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input type="text" class="form-control" id="fullname" aria-describedby="fullnameHelp" placeholder="Enter your fullname">
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" aria-describedby="addressHelp" placeholder="City, House, Floor, Street Address">
                            </div>

                            <div class="form-group" id="country">
                                <select class="form-control" id="country">
                                    <option>United States</option>
                                    <option>Lebanon</option>
                                </select>
                            </div>

                            <div class="mobile-number">
                                <div class="form-group" style="width: 100%; margin-right: 20px">
                                    <label for="countryCode">Country Code</label>
                                    <select class="form-control" id="countryCode">
                                        <option>(+961) Lebanon</option>
                                        <option>(+1) United States</option>
                                    </select>
                                </div>

                                <div class="form-group" style="width: 100%;">
                                    <label for="number">Mobile Number</label>
                                    <input type="text" class="form-control" id="number" aria-describedby="numberHelp" placeholder="3 908070">
                                </div>
                            </div>

                            <br>

                            <input type="button" value="Next" class="btn next" id="dot" onclick="currentSlide(2)" style="width: 100%; background-color: black; color: white; height: 45px; border-radius: 10px"/>
                        </div>

                        <div class="mySlides">
                            <h3>Payment Information</h3>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
                                <label class="form-check-label" for="inlineRadio1">Cash On Delivery</label>
                            </div>

                            <p class="delivery-name">DHL will deliver your order and you will pay on delivery.</p>

                            <p>
                                Production & Shipping may take up to 10 − 14 days. Designers do their best to craft your items earlier.
                                Every item is handmade and customized to fit your every need. 100% refund and exchange guaranteed
                                within 14 days of receiving item. For more information, please read our policy.
                            </p>

                            <div class="slide-btns">
                                <input type="button" value="Next" class="btn next" id="dot" onclick="currentSlide(3)" style="width: 100%; background-color: black; color: white; height: 45px; border-radius: 10px"/>
                                <input type="button" value="Back" class="btn back" id="dot" onclick="currentSlide(1)" style="width: 100%; background-color: white; color: black; height: 45px; border-radius: 10px; margin-top: 10px; border: 1px solid black"/>
                            </div>
                        </div>

                        <div class="mySlides">
                            <div class="column">

                                <!-- info from inputs in first and second slides -->

                                <h5>Shipping Contact Info</h5>
                                <p>
                                    Ali Zein Al Dine<br>
                                    alized559@gmail.com<br>
                                    (+961) 70156042
                                </p>
                            </div>

                            <div class="column">
                                <h5>Delivery Address</h5>
                                <p>
                                    Beirut...<br>
                                    Lebanon
                                </p>
                            </div>

                            <div>
                                <h5>Payment Method</h5>
                                <p>
                                    Cash On Delivery
                                </p>
                            </div>

                            <div class="slide-btns">
                                <button class="btn next" id="dot" style="width: 100%; background-color: black; color: white; height: 45px; border-radius: 10px">Pay On Delivery</button>
                                <input type="button" value="Back" class="btn back" id="dot" onclick="currentSlide(2)" style="width: 100%; background-color: white; color: black; height: 45px; border-radius: 10px; margin-top: 10px; border: 1px solid black"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="summary">
            <h3>Summary</h3>

            <div class="vertical-line"></div>

            <div class="summary-info">
                <div class="name-size">
                    Black Colonial Shirt<br>
                    <span>Size: 42, (Aqua)</span>
                </div>
                <span>20$</span>
            </div>

            <div class="summary-info">
                <div class="name-size">
                    Black Colonial Shirt<br>
                    <span>Size: 42, (Aqua)</span>
                </div>
                <span>20$</span>
            </div>

            <div class="summary-info">
                <div class="name-size">
                    Black Colonial Shirt<br>
                    <span>Size: 42, (Aqua)</span>
                </div>
                <span>20$</span>
            </div>

            <div class="vertical-line1"></div>

            <div class="price-info">
                Subtotal
                <span>222$</span>
            </div>

            <div class="vertical-line1"></div>

            <p class="final-price">200$</p>
        </div>

    </div>
</body>

<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
    }
</script>
</html>