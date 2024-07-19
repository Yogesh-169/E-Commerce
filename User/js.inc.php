<!-- jQuery-V1.12.4 -->
<script src="js/vendor/jquery-1.12.4.min.js"></script>
<!-- Popper js -->
<script src="js/vendor/popper.min.js"></script>
<!-- Bootstrap V4.1.3 Fremwork js -->
<script src="js/bootstrap.min.js"></script>
<!-- Ajax Mail js -->
<script src="js/ajax-mail.js"></script>
<!-- Meanmenu js -->
<script src="js/jquery.meanmenu.min.js"></script>
<!-- Wow.min js -->
<script src="js/wow.min.js"></script>
<!-- Slick Carousel js -->
<script src="js/slick.min.js"></script>
<!-- Owl Carousel-2 js -->
<script src="js/owl.carousel.min.js"></script>
<!-- Magnific popup js -->
<script src="js/jquery.magnific-popup.min.js"></script>
<!-- Isotope js -->
<script src="js/isotope.pkgd.min.js"></script>
<!-- Imagesloaded js -->
<script src="js/imagesloaded.pkgd.min.js"></script>
<!-- Mixitup js -->
<script src="js/jquery.mixitup.min.js"></script>
<!-- Countdown -->
<script src="js/jquery.countdown.min.js"></script>
<!-- Counterup -->
<script src="js/jquery.counterup.min.js"></script>
<!-- Waypoints -->
<script src="js/waypoints.min.js"></script>
<!-- Barrating -->
<script src="js/jquery.barrating.min.js"></script>
<!-- Jquery-ui -->
<script src="js/jquery-ui.min.js"></script>
<!-- Venobox -->
<script src="js/venobox.min.js"></script>
<!-- Nice Select js -->
<script src="js/jquery.nice-select.min.js"></script>
<!-- ScrollUp js -->
<script src="js/scrollUp.min.js"></script>
<!-- Main/Activator js -->
<script src="js/main.js"></script>
<script src="js/jquery.session.js"></script>
<script>
$(document).ready(function() {
    // console.log("Hello")
    if ($.session.get('totalamount') != 0) {
        var a = ($.session.get('totalamount'));
        // var b = a;
        $("#totalamtt").html(a);
        // b = b * 0.15;
        // $("#taxamt").html("Rs. ".concat(b.toFixed(2)));
        a = Number(a)  + 50;
        $("#total").html("Rs. ".concat(a));
        $("#totAmount").val(a);
        $("#tot").val(a);



    } else {
        var a = $("#totalamtt").text();
        console.log(a);
        // var b = a;
        // b = b * 0.15;
        // b= Math.round(b, 2);
        // $("#taxamt").html("Rs. ".concat(b.toFixed(2)));
        a = Number(a) + 50;
        // console.log(a);
        $("#total").text("Rs. ".concat(a));
        $("#totAmount").val(a);
        $("#tot").val(a);
    }
});
</script>

<script>
        $(document).ready(function() {
            $.session.set('totalamount', 0);
            // location.assign("cart.php");
        });
</script>