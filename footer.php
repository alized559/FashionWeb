<?php
if(isset($sticky) && $sticky){
    echo "<footer class='text-center fixed-bottom text-lg-start bg-white'>";
}else {
    echo "<footer class='text-center text-lg-start bg-white'>";
} 
?>
<div class="container text-center text-md-start mt-5">
    <div class="row mt-3">
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <h6 class="footer-head"><i class="fas fa-gem"></i> FASHION</h6>
            <hr>
            <p>This is a fashion store where you can find all your needs at one place</p>
        </div>
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <h6 class="footer-head">Brands</h6>
            <hr>
            <a href="#" class="text-reset">Nike Sports</a>
            <br>
            <a href="#" class="text-reset">Adidas</a>
            <br>
            <a href="#" class="text-reset">Gucci</a>
        </div>
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <h6 class="footer-head">Social Media</h6>
            <hr>
            <a href="#" class="text-reset">Facebook <i class="fab fa-facebook-f"></i></a>
            <br>
            <a href="#" class="text-reset">Instragram <i class="fab fa-instagram"></i></a> 
            <br>
            <a href="#" class="text-reset">Twitter <i class="fab fa-twitter"></i></a>
        </div>
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <h6 class="footer-head">Contact</h6>
            <hr>
            <a href="mailto:info@fashion.com" class="text-reset"><i class="fas fa-envelope me-3"></i> info@fashion.com</a>
            <p><i class="fas fa-phone me-3"></i> +961 05 123 233</p>
        </div>
    </div>
</div>
<div class="text-center p-4 copyrighttext" style="background-color: #8567FF">
    Copyright © 2022
    <a class="text-reset fw-bold" style="color: white;" href="#">fashion.com</a>
</div>
</footer>

<script>

const ConversionRates = {
        "LB, LBP": 26000
    };

const currentCurrency = localStorage.currentCurrency;

$(function() {

    if(currentCurrency == "LB, LBP"){
        const elements = document.querySelectorAll(
            '.price, .price2, del, .amount, .total-amount'
        );
        for (const element of elements) {
            var text = element.innerHTML;
            if(text.includes("$")){
                var usdPrice = text.replace("$", "");
                if(!isNaN(usdPrice)){
                    var price = parseFloat(usdPrice);
                    var converted = price * ConversionRates[currentCurrency];
                    element.innerHTML = formatMoney("LBP", converted);
                }
            }
        }
    }
});

function formatMoney(currency, amount) {
    return currency + " " + (Math.round(amount * 100) / 100).toLocaleString();
}

</script>

<!--<script>
    $(document).ready(function() {
        setInterval(function() {
            var docHeight = $(window).height();
            var footerHeight = $('footer').height();
            var footerTop = $('footer').position().top + footerHeight;
            var marginTop = (docHeight - footerTop + 10);

            if (footerTop < docHeight)
                $('footer').css('margin-top', marginTop + 'px'); // padding of 30 on footer
            else
                $('footer').css('margin-top', '0px');
            // console.log("docheight: " + docHeight + "\n" + "footerheight: " + footerHeight + "\n" + "footertop: " + footerTop + "\n" + "new docheight: " + $(window).height() + "\n" + "margintop: " + marginTop);
        }, 250);
    });
</script>-->