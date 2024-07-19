<?php
include_once('top.php');
$counter=0;
?>
<?php


    if (isset($_GET['proid']) && isset($_SESSION['Client_id'])) {

     
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        $proid = $_GET['proid'];
        $userid = $_SESSION['Client_id'];
        
        $qty = 1;
        $currentdate = date("Y/m/d");

        // Select Query to check whether item exists or not if exists update else insert.
        $sql2 = "Select count(product_Id) as countpro from wishlist where product_Id= $proid";
        $result = $con->query($sql2);
        // var_dump($result);

        $countval = $result->fetch_assoc();
        // var_dump($countval);
        
        if ($countval['countpro'] > 0) {

            // $sql = "UPDATE cart_item SET quantity = quantity + 1 WHERE product_Id = $proid";
            // echo "New record created successfully";
        } else if ($countval['countpro'] == 0) {
            
            $sql = "INSERT INTO wishlist(product_Id,created_Date,userid ) VALUES ($proid,'" . $currentdate . "',$userid)";
            if ($con->query($sql) === TRUE) {
                // echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {

            echo "Error: " . $sql . "<br>" . $con->error;
        }

        // $con->close();
    }

?>
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">Wishlist</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!--Wishlist Area Strat-->
<div class="wishlist-area pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="#">
                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="li-product-remove">remove</th>
                                    <th class="li-product-thumbnail">images</th>
                                    <th class="cart-product-name">Product</th>
                                    <th class="li-product-price">Unit Price</th>
                           
                                    <th class="li-product-add-cart">add to cart</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($_SESSION['Client_id'])) {
                                    
                                if ($con->connect_error) {
                                    die("Connection failed: " . $con->connect_error);
                                }
                                
                        
                                $userid = $_SESSION['Client_id'];
                                $sql = "SELECT wishlist.list_id, product.id,product.image, product.name, product.price FROM product, wishlist WHERE product.id = wishlist.product_Id AND wishlist.userid =$userid";
                               
                                $result = $con->query($sql);
                                // echo $result->num_rows;
                                if ($result->num_rows > 0 ) {
                                   
                                    while ($row1 = $result->fetch_assoc()) {
                                    //    if($row1['cart_Id']!=NULL){
                                        //    prx($row1);
                            ?>
                                <tr>
                                    <td class="li-product-remove"><a id="deletebtn1" class="delet-btn"  data-id="<?php echo $row1['list_id']?>"><i class="fa fa-times" ></i></a></td>
                                    <td class="li-product-thumbnail">
                                        <a href="product.php?id=<?php echo $row1['id']?>"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row1['image']?>" alt=""></a>
                                    </td>
                                    <td class="li-product-name"><a href="product.php?id=<?php echo $row1['id']?>"><?php echo $row1['name']?></a></td>
                                    <td class="li-product-price"><span class="amount">Rs. <?php echo $row1['price']?></span></td>
                                    <td class="li-product-add-cart"><a href="cart.php?proid=<?php echo $row1['id']?>">add to cart</a></td>
                                </tr>
                                <?php       
                                    //    }
                                }
                            }else{

                                }
                            }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Wishlist Area End-->

<!-- Begin Modal Area -->
<div class="modal fade open-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Begin Modal Image Area -->
                    <div class="col-md-5">
                        <!-- Begin Modal Tab Content Area -->
                        <div class="tab-content product-details-large myTabContent">
                            <div class="tab-pane fade show active" id="single-slide1" role="tabpanel" aria-labelledby="single-slide-tab-1">
                                <!--Single Product Image Start-->
                                <div class="single-product-img img-full">
                                    <img src="images/product/large-size/1.jpg" alt="">
                                </div>
                                <!--Single Product Image End-->
                            </div>
                            <div class="tab-pane fade" id="single-slide2" role="tabpanel" aria-labelledby="single-slide-tab-2">
                                <!--Single Product Image Start-->
                                <div class="single-product-img img-full">
                                    <img src="images/product/large-size/2.jpg" alt="">
                                </div>
                                <!--Single Product Image End-->
                            </div>
                            <div class="tab-pane fade" id="single-slide3" role="tabpanel" aria-labelledby="single-slide-tab-3">
                                <!--Single Product Image Start-->
                                <div class="single-product-img img-full">
                                    <img src="images/product/large-size/3.jpg" alt="">
                                </div>
                                <!--Single Product Image End-->
                            </div>
                            <div class="tab-pane fade" id="single-slide4" role="tabpanel" aria-labelledby="single-slide-tab-4">
                                <!--Single Product Image Start-->
                                <div class="single-product-img img-full">
                                    <img src="images/product/large-size/4.jpg" alt="">
                                </div>
                                <!--Single Product Image End-->
                            </div>
                            <div class="tab-pane fade" id="single-slide5" role="tabpanel" aria-labelledby="single-slide-tab-4">
                                <!--Single Product Image Start-->
                                <div class="single-product-img img-full">
                                    <img src="images/product/large-size/5.jpg" alt="">
                                </div>
                                <!--Single Product Image End-->
                            </div>
                            <div class="tab-pane fade" id="single-slide6" role="tabpanel" aria-labelledby="single-slide-tab-4">
                                <!--Single Product Image Start-->
                                <div class="single-product-img img-full">
                                    <img src="images/product/large-size/6.jpg" alt="">
                                </div>
                                <!--Single Product Image End-->
                            </div>
                        </div>
                        <!-- Modal Tab Content Area End Here -->
                        <!-- Begin Modal Tab Menu Area -->
                        <div class="single-product-menu">
                            <div class="nav single-slide-menu owl-carousel" role="tablist">
                                <div class="single-tab-menu img-full">
                                    <a class="active" data-toggle="tab" id="single-slide-tab-1" href="#single-slide1"><img src="images/product/small-size/1.jpg" alt=""></a>
                                </div>
                                <div class="single-tab-menu img-full">
                                    <a data-toggle="tab" id="single-slide-tab-2" href="#single-slide2"><img src="images/product/small-size/2.jpg" alt=""></a>
                                </div>
                                <div class="single-tab-menu img-full">
                                    <a data-toggle="tab" id="single-slide-tab-3" href="#single-slide3"><img src="images/product/small-size/3.jpg" alt=""></a>
                                </div>
                                <div class="single-tab-menu img-full">
                                    <a data-toggle="tab" id="single-slide-tab-4" href="#single-slide4"><img src="images/product/small-size/4.jpg" alt=""></a>
                                </div>
                                <div class="single-tab-menu img-full">
                                    <a data-toggle="tab" id="single-slide-tab-5" href="#single-slide5"><img src="images/product/small-size/5.jpg" alt=""></a>
                                </div>
                                <div class="single-tab-menu img-full">
                                    <a data-toggle="tab" id="single-slide-tab-6" href="#single-slide6"><img src="images/product/small-size/6.jpg" alt=""></a>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Tab Menu End Here -->
                    </div>
                    <!-- Modal Image Area End Here -->
                    <!-- Begin Modal Content Area -->
                    <div class="col-md-7">
                        <div class="modal-product-info">
                            <h2>Accusantium dolorem1</h2>
                            <div class="modal-product-price">
                                <span class="new-price">$46.80</span>
                            </div>
                            <div class="cart-description">
                                <p>Vector graphic, format: svg. Download for personal, private and non-commercial use.</p>
                            </div>
                            <div class="quantity">
                                <input class="input-text qty text" step="1" min="1" max="200" name="quantity" value="1" title="Qty" size="4" type="number">
                            </div>
                        </div>
                    </div>
                    <!-- Modal Content Area End Here -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once('footer.php');
include_once('js.inc.php');
?>