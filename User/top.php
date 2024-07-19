<?php
$counter = 0;
require_once('connection.inc.php');
require_once('functions.inc.php');
require('add_to_cart.inc.php');

$cat_res=mysqli_query($con,"select * from categories where status=1 order by categories");
$cat_arr=array();
while($row=mysqli_fetch_assoc($cat_res))
{
    $cat_arr[]=$row;
}
$obj=new add_to_cart();
$totalProduct=$obj->totalProduct();
?>
<!doctype html>
<html class="no-js" lang="zxx">

<!-- index28:48-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ecom Website</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
    <!-- Material Design Iconic Font-V2.2.0 -->
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Font Awesome Stars-->
    <link rel="stylesheet" href="css/fontawesome-stars.css">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="css/meanmenu.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="css/slick.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- Jquery-ui CSS -->
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <!-- Venobox CSS -->
    <link rel="stylesheet" href="css/venobox.css">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="css/nice-select.css">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- Bootstrap V4.1.3 Fremwork CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Helper CSS -->
    <link rel="stylesheet" href="css/helper.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Modernizr js -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
   
</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Begin Body Wrapper -->
    <div class="body-wrapper">
        <!-- Begin Header Area -->
        <header>
            <!-- Begin Header Top Area -->
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <!-- Begin Header Top Left Area -->
                        <div class="col-lg-3 col-md-4">
                            <div class="header-top-left">
                                <ul class="phone-wrap">
                                    <li><span>Telephone Enquiry:</span><a href="#">+916353132324</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Header Top Left Area End Here -->
                        <!-- Begin Header Top Right Area -->
                        <div class="col-lg-9 col-md-8">
                            <div class="header-top-right">
                                <ul class="ht-menu">
                                
                                    <!-- Begin Login/SignUp Area -->
                                    <li>
                                        <span class="currency-selector-wrapper">
                                            <?php
                                        if(isset($_SESSION['Client_USERNAME']))
                                        {
                                        echo "Welcome,  ".$_SESSION['Client_USERNAME'];
                                        }
                                        else
                                        {
                                            ?>
                                        <a href="login-register.php">Login/SignUP</a>
                                    <?php } ?>
                                    </span>
                                        
                                    </li>
                                    <!-- Currency Login/SignUp End Here -->
                                    <!-- Begin Language Area -->
                                    <li>
                                        <span class="language-selector-wrapper"><a href="#">MyAccount</a></span>
                                       
                                    </li>
                                    <?php
                                        if(isset($_SESSION['Client_USERNAME']))
                                        {
                                    ?>
                                    <li>
                                        <span class="language-selector-wrapper"><a href="logout.php">Log Out</a></span>
                                       
                                    </li>
                                        <?php
                                        }
                                        ?>
                                    <!-- Language Area End Here -->
                                </ul>
                            </div>
                        </div>
                        <!-- Header Top Right Area End Here -->
                    </div>
                </div>
            </div>
            <!-- Header Top Area End Here -->
            <!-- Begin Header Middle Area -->
            <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
                <div class="container">
                    <div class="row">
                        <!-- Begin Header Logo Area -->
                        <div class="col-lg-3">
                            <div class="logo pb-sm-30 pb-xs-30">
                                <a href="index.php">
                                    <img src="images/menu/logo/1.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <!-- Header Logo Area End Here -->
                        <!-- Begin Header Middle Right Area -->
                        <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                            <!-- Begin Header Middle Searchbox Area -->
                            <form action="#" class="hm-searchbox">
                                <select class="nice-select select-search-category">
                                       
                                <option>All</option> 
                                <?php
                                    foreach($cat_arr as $list){
                                ?>
                                    <option><a href="categories.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a></option>
                                <?php
                                 }
                                ?>                        
                                        
                                    </select>
                                <input type="text" name="searchQuery" placeholder="Enter your search key ...">
                                <button class="li-btn" id="searchinput" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                            <!-- Header Middle Searchbox Area End Here -->
                            <!-- Begin Header Middle Right Area -->
                            <?php
                        if (isset($_SESSION['Client_USERNAME'])) {
                            // $servername = "localhost";
                            // $username = "root";
                            // $password = "";
                            // $dbname = "fashion_ecommerce";

                            // Create connection
                            // $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($con->connect_error) {
                                die("Connection failed: " . $con->connect_error);
                            }
                            $userId = $_SESSION['Client_id'];

                            $sql = "SELECT count(cart_Id) as ccount , sum(product.price * cart_Item.quantity) as pricesum FROM cart_item,product where product.id=cart_Item.product_Id AND userid=$userId";
                            $result = $con->query($sql);
                            $sql1 = "SELECT count(list_Id) as idcount FROM wishlist where userid=$userId";
                            $result1 = $con->query($sql1);
                            // echo $sql1;
                            // var_dump($result1);
                            // die();

                        ?>
                            <div class="header-middle-right">
                           
                                <ul class="hm-menu">
                                    <!-- Begin Header Middle Wishlist Area -->
                                    <?php if ($result1->num_rows > 0) {
                                // output data of each row
                                while ($row1 = $result1->fetch_assoc()) {
                            ?>
                                    <li class="hm-wishlist">
                                        <a href="wishlist.php">
                                            <span class="cart-item-count wishlist-item-count"><?php echo $row1['idcount']?></span>
                                            <i class="fa fa-heart-o"></i>
                                        </a>
                                    </li>
                                    <?php
                                }
                            }

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row2 = $result->fetch_assoc()) {
                                ?>
                                    <!-- Header Middle Wishlist Area End Here -->
                                    <!-- Begin Header Mini Cart Area -->
                                    <li class="hm-minicart">
                                        <div class="hm-minicart-trigger">
                                            
                                            <span class="item-icon"> <span class="cart-item-count wishlist-item-count"><?php echo $row2['ccount']?></span></span>
                                            <span class="item-text"></span>
                                        </div>
                                        <span></span>
                                        <div class="minicart">
                                            <ul class="minicart-product-list">
                                            <?php
                          
                                }
                            }if (isset($_SESSION['Client_id'])) {
                                    
                                if ($con->connect_error) {
                                    die("Connection failed: " . $con->connect_error);
                                }
                                
                        
                                $userid = $_SESSION['Client_id'];
                                $sql = "SELECT cart_item.cart_Id, sum(cart_item.quantity) as quantity, product.image, product.id, product.name, product.price FROM product, cart_item WHERE product.id = cart_Item.product_Id AND cart_Item.userid =$userid GROUP BY(cart_item.product_Id)";
                               
                                $result = $con->query($sql);
                                // echo $result->num_rows;
                                if ($result->num_rows > 0 ) {
                                   
                                    while ($row1 = $result->fetch_assoc()) {
                                       if($row1['cart_Id']!=NULL){
                                        //    prx($row1);
                            ?>
                       
                                            <li>
                                                    <a href="product.php" class="minicart-product-image">
                                                        <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row1['image']?>" alt="cart products">
                                                    </a>
                                                    <div class="minicart-product-details">
                                                        <h6><a href="product.php?id=<?php echo $row1['id']?>"><?php echo $row1['name']?></a></h6>
                                                        <strong><span>Rs. <?php echo  $row1['price']?> x <?php echo $row1['quantity'] ?></span></strong>
                                                    </div>
                                                    <button class="close" title="Remove">
                                                    <a class="delet-btn" title="Delete Item" data-id="<?php echo $row1['cart_Id']?>"><i class="fa fa-times" id="deletbtn" data-id=""></i></a>
                                                        </button>
                                                        <?php $counter = $counter + ( $row1['quantity'] * $row1['price']); ?>
                                                        <?php $_SESSION['totalamount'] = $counter?>
                                            </li>
                                            <?php       
                                       }
                                }
                            }else{

                                }
                            }
                                ?>
                                            </ul>
                                          
                                            <p class="minicart-total">SUBTOTAL: <span id="totalamount">Rs.<?php echo $counter?></span></p>
                                            <div class="minicart-button">
                                               
                                                    <a href="cart.php" class="li-button li-button-fullwidth li-button-dark">
                                                    <span>View Full Cart</span>
                                                </a>
                                                <a href="checkout.php" class="li-button li-button-fullwidth">
                                                    <span>Checkout</span>
                                                </a> 
                                            </div>
                                            
                                        </div>
                                    </li>
                                    <!-- Header Mini Cart Area End Here -->
                                </ul>
                                <?php
                                                }
                                                ?>
                            </div>
                            <!-- Header Middle Right Area End Here -->
                        </div>
                        <!-- Header Middle Right Area End Here -->
                    </div>
                </div>
            </div>
            <!-- Header Middle Area End Here -->
            <!-- Begin Header Bottom Area -->
            <div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Begin Header Bottom Menu Area -->
                            <div class="hb-menu">
                                <nav>
                                    <ul>
                                        <li class="dropdown-holder"><a href="index.php">Home</a>
                                            
                                        </li>
                                        <?php
                                                    foreach($cat_arr as $list){
                                        ?>
                                                         <li><a href="categories.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a></li>
                                                        <?php

                                                    }
                                            ?>
                        
                                           
                                        </li>
                                      
                                        <li><a href="contact.php">Contact</a></li>
                                    </ul>
                                </nav>
                                
                            </div>
                            <!-- Header Bottom Menu Area End Here -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header Bottom Area End Here -->
            <!-- Begin Mobile Menu Area -->
            <div class="mobile-menu-area d-lg-none d-xl-none col-12">
                <div class="container">
                    <div class="row">
                        <div class="mobile-menu">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area End Here -->
        </header>