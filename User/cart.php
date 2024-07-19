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
        $sql2 = "Select count(product_Id) as countpro from cart_item where product_Id= $proid";
        $result = $con->query($sql2);
        // var_dump($result);

        $countval = $result->fetch_assoc();
        // var_dump($countval);
        if ($countval['countpro'] > 0) {

            $sql = "UPDATE cart_item SET quantity = quantity + 1 WHERE product_Id = $proid";
            // echo "New record created successfully";
        } else if ($countval['countpro'] == 0) {
            $sql = "INSERT INTO cart_item(product_Id,quantity,created_Date,userid ) VALUES ($proid,$qty,'" . $currentdate . "',$userid)";
        } else {

            echo "Error: " . $sql . "<br>" . $con->error;
        }


        if ($con->query($sql) === TRUE) {
            // echo "New record created successfully";
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
                <li><a href="index.php">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!--Shopping Cart Area Strat-->
<div class="Shopping-cart-area pt-60 pb-60">
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
                                    <th class="li-product-quantity">Quantity</th>
                                    <th class="li-product-subtotal">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($_SESSION['Client_id'])) {
                                    
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
                            <tr>
                                                <!-- <td class="li-product-remove" ><a href="#"  ><i class="fa fa-times" id="deletbtn" data-id=""></i></a>
                                                </td> -->
                                                <td><a class="delet-btn" title="Delete Item" data-id="<?php echo $row1['cart_Id']?>"><i class="fa fa-times" id="deletbtn" data-id=""></i></a></td>
                                                <td class="li-product-thumbnail"><a href="product.php?id=<?php echo $row1['id']?>"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row1['image']?>" alt="Li's Product Image"></a></td>
                                                <td class="li-product-name"><a href="product.php?id=<?php echo $row1['id']?>"><?php echo $row1['name']?></a></td>
                                                <td class="li-product-price"><span class="amount">Rs. <?php echo $row1['price']?></span></td>
                                                <td class="quantity">
                                                    <label></label>
                                                    <div class="cart-plus-minus">
                                                        <!-- <input class="cart-plus-minus-box" value="" type="text">
                                                        <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                        <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div> -->
                                                        <?php $a = $row1['cart_Id']; ?>
                                                        <?php $b = $row1['price']; ?>
                                                       <?php $counter = $counter + ( $row1['quantity'] * $row1['price']); ?>
                                                        <div class="increase-btn dec qtybutton btn" data-id=<?php echo $a ?> data-price=<?php echo $b ?>>-</div>
                                                        <input class="qty-input cart-plus-minus-box" type="text" name="qtybutton" value="<?php echo $row1['quantity']; ?>" readonly />
                                                        <?php $_SESSION['totalamount'] = $counter?>
                                                        <div class="increase-btn inc qtybutton btn" data-id=<?php echo $a ?> data-price=<?php echo $b ?>>+</div>
                                                    </div>
                                                </td>
                                                <td class="product-subtotal" ><span class="amount" id="totalprice<?php echo $row1['cart_Id']?>">Rs. <?php echo $row1['quantity'] * $row1['price'] ?></span></td>
                                </tr>
                                <?php       
                                       }
                                }
                            }else{

                                }
                            }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="coupon-all">
                               
                                <!-- <div class="coupon2">
                                    <input class="button" name="update_cart" value="Update cart" type="submit">
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <?php
                             if($counter>0)
                             {
                                 ?>
                            
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <h2>Cart totals</h2>
                                <ul>
                                    <li>Subtotal <span id="totalamount12">Rs.<?php echo $counter?></span></li>
                                    <li>Shipping <span id="totalamount1">Rs.50</span></li>
                                    <li>Total <span id="totalamt">Rs. <?php echo $counter + 50 ?></span></li>
                                </ul>
                              
                                <a href="checkout.php">Proceed to checkout</a>
                            </div>
                        </div>
                    </div>
                    <?php }   
                                ?>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Shopping Cart Area End-->

<?php


include_once('js.inc.php');
include_once('footer.php');
?>