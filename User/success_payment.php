

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
                                $orderid = $_GET['orderid'];
                                $sql = "SELECT  product.image,order_detail.quantity, product.id, product.name, product.price, product.mrp FROM product, order_detail WHERE product.id = order_detail.product_Id AND order_detail.order_Id = (select order_master.order_Id from order_master where order_master.order_Id=$orderid AND customer_Id=$userid) GROUP by (order_detail.product_Id);";
                               
                                $result = $con->query($sql);
                                // echo $result->num_rows;
                                // echo $result;
                                if ($result->num_rows > 0 ) {
                                   
                                    while ($row1 = $result->fetch_assoc()) {
                                        // var_dump($row1);
                                       if($row1['id']!=NULL){
                                        //    prx($row1);
                            ?>
                            <tr>
                                                <!-- <td class="li-product-remove" ><a href="#"  ><i class="fa fa-times" id="deletbtn" data-id=""></i></a>
                                                </td> -->
                                                <td class="li-product-thumbnail"><a href="product.php?id=<?php echo $row1['id']?>"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row1['image']?>" alt="Li's Product Image"></a></td>
                                                <td class="li-product-name"><a href="product.php?id=<?php echo $row1['id']?>"><?php echo $row1['name']?></a></td>
                                                <td class="li-product-price"><span class="amount">Rs. <?php echo $row1['price']?></span></td>
                                                <td class="quantity">
                                                    <label></label>
                                                    <div class="cart-plus-minus">
                                                        <!-- <input class="cart-plus-minus-box" value="" type="text">
                                                        <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                        <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div> -->
                                                        <?php $b = $row1['price']; ?>
                                                       <?php $counter = $counter + ( $row1['quantity'] * $row1['price']); ?>
                                                        <input class="qty-input cart-plus-minus-box" type="text" name="qtybutton" value="<?php echo $row1['quantity']; ?>" readonly />
                                                        <?php $_SESSION['totalamount'] = $counter?>
                                                    </div>
                                                </td>
                                                <td class="product-subtotal" ><span class="amount" id="totalprice">Rs. <?php echo $row1['quantity'] * $row1['price'] ?></span></td>
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
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <h2>Order Summary</h2>
                                <ul>
                                    <li>Subtotal <span id="totalamount">Rs.<?php echo $counter?></span></li>
                                    <li>Shipping <span id="totalamount">Rs.50</span></li>
                                    <li>Total <span id="totalamt">Rs. <?php echo $counter + 50 ?></span></li>
                                </ul>
                               
                            </div>
                            
                        </div>
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                               
                            <h2>Order Summary</h2>
                            <?php
                    if (isset($_SESSION['Client_id'])) {
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "ecomm";

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        // $subcategory = $_GET['subcat'];\
                        $orderid = $_GET['orderid'];
                        $userid = $_SESSION['Client_id'];
                        $sql =
                            "SELECT order_master.currentdate,users.name,count(product.id) as count1,product.Name FROM product, order_detail,users,order_master WHERE product.id = order_detail.order_Id AND order_detail.order_Id = (select order_master.order_Id from order_master where order_master.order_Id=$orderid AND customer_Id=$userid) AND users.id = $userid and order_master.order_Id=$orderid;";
                        // echo $sql;
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            // var_dump($result);
                            // die();
                            if ($row1 = $result->fetch_assoc()) {
                                $num = $row1['count1'];

                    ?>
                                <div class="card border-success" style="height: 296px;">
                                    <h2 class=" card-header">Order Summary</h2>
                                    <div class="card-body text-success" style="padding:0.6rem">
                                        <h1 class="card-title">Hey <?php echo $row1['name'] ?>,</h1><br>
                                        <!-- <span class="flag"><img src="assets/images/india.png" alt="united-states" /></span> -->
                                        <span class="card-title" style="font-size: 20px;"><img src=" images/Success-icon-23186.png" width="55px" height="45px"> Your Order is Confirmed !!
                                            <!-- <h2 class="card-title">Your Order is Confirmed !!</h2> -->
                                        </span>


                                        <p class="card-text" style="font-size: 20px;">Thanks for Shopping from Fashion E-Commerce, Your <b> <?php echo $row1['name'] ?> </b> <?php echo $num > 1 ? "and $num More Items " : ""; ?> has been Shipped to you and we have send you an E-mail of Your Invoice.</p>
                                        <p class="card-text" style="font-size: 20px;">Order Id : #<?php echo str_replace("-", "", $row1['currentdate']) ?>-<?php echo $orderid ?> <a href="index.php" class="btn btn-primary" style="font-size: 15px;margin-left: 480px;">Shop More</a></p>

                                    </div>
                               </div>
                </div>
    <?php
                            }
                        }
                    }
    ?>
                            </div>
                            
                        </div>
                    </div>
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