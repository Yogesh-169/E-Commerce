<?php
include_once('top.php');
?>
<!-- <script>
 function Validate()
        {
            var y = document.form1.phone.value;
        
           if(isNaN(y)||y.indexOf(" ")!=-1)
           {
              alert("Enter numeric value")
              return false; 
           }
           if (y.length<10)
           {
                alert("enter 10 characters");
                return false;
           }
           if (y.length>10)
           {
                alert("enter 10 characters");
                return false;
           } -->
        <!-- //    if (y.charAt(0)!="9")
        //    {
        //         alert("it should start with 9 ");
        //         return false
        //    }
        }
// function validateForm() {
//     //alert("Inside Validate Form");
//     var isFormValid = true;
//     isFormValid &= Validate();
//     isFormValid &= matchPassword();
//     return isFormValid? true:false;
    
// } -->
<!-- </script> -->


            <!-- Begin Li's Breadcrumb Area -->
            <div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li class="active">Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Li's Breadcrumb Area End Here -->
            <!--Checkout Area Strat-->
            <div class="checkout-area pt-60 pb-30">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="coupon-accordion">
                                <!--Accordion Start-->
                                <h3>Returning customer? <span id="showlogin"><a href="login-register.php">Click here to login</a></span></h3>
                                <div id="checkout-login" class="coupon-content">
                                    <div class="coupon-info">
                                        <p class="coupon-text">Quisque gravida turpis sit amet nulla posuere lacinia. Cras sed est sit amet ipsum luctus.</p>
                                        
                                    </div>
                                </div>
                                <!--Accordion End-->
                                <!--Accordion Start-->
                                <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                                <div id="checkout_coupon" class="coupon-checkout-content">
                                    <div class="coupon-info">
                                        <form action="#">
                                            <p class="checkout-coupon">
                                                <input placeholder="Coupon code" type="text">
                                                <input value="Apply Coupon" type="submit">
                                            </p>
                                        </form>
                                    </div>
                                </div>
                                <!--Accordion End-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <form action="payment.php" name="form1" onsubmit="return validateForm();" method="POST">
                                <div class="checkbox-form">
                                    <h3>Billing Details</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="country-select clearfix">
                                                <label>Country <span class="required">*</span></label>
                                                <select class="nice-select wide" name="country">
                                                  <option data-display="Bangladesh">Bangladesh</option>
                                                  <option value="uk">India</option>
                                                  <option value="uk">London</option>
                                                  <option value="rou">Romania</option>
                                                  <option value="fr">French</option>
                                                  <option value="de">Germany</option>
                                                  <option value="aus">Australia</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>First Name <span class="required" >*</span></label>
                                                <input placeholder="Name" required type="text" name="name">
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Email Address</label>
                                                <input placeholder="Email" required type="text" name="email">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Address <span class="required" >*</span></label>
                                                <input placeholder="Address" required type="text" name="address">
                                            </div>
                                        </div>
                                     
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>phone number <span class="required" >*</span></label>
                                                <input type="text" required name="phone" maxlength="10" minlength="10">
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>State  <span class="required">*</span></label>
                                                <input placeholder="" type="text" name="state">
                                                <input type="hidden" name="total" value="" id="tot">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Postal Code<span class="required">*</span></label>
                                                <input placeholder="Postal Code" required type="text" name ="pcode">
                                            </div>
                                        </div>
                                    </div>
                         
                                </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="your-order">
                                <h3>Your order</h3>
                                <div class="your-order-table table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="cart-product-name">Product</th>
                                                <th class="cart-product-total">Quantity</th>
                                                <th class="cart-product-total">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                            if (isset($_SESSION['Client_id']) && isset($_SESSION['totalamount'])) {
                                    
                                if ($con->connect_error) {
                                    die("Connection failed: " . $con->connect_error);
                                }
                                $userid = $_SESSION['Client_id'];
                                $sql = "SELECT cart_Item.cart_Id,cart_Item.quantity,product.id,product.name,product.price from product,cart_Item where product.id=cart_Item.product_Id AND cart_Item.userid=$userid";
                                $result = $con->query($sql);
                                // echo $result->num_rows;
                                if ($result->num_rows > 0 ) {
                                   
                                    while ($row1 = $result->fetch_assoc()) {
                                       
                                       if($row1['cart_Id']!=NULL){
                                        //    prx($row1);
                            ?>
                                            <tr class="cart_item">
                                              <td class="cart-product-name"> <?php echo  $row1['name'] ?></td>
                                              <td><strong class="product-quantity"><?php echo $row1['quantity'] ?></strong></td>
                                              <td class="cart-product-total"><span class="amount">Rs. <?php echo  $row1['price'] * $row1['quantity']?></span></td>  
                                            </tr>
                             <?php       
                                       }
                                }
                            }else{

                                }
                            }
                        
                                ?>
                                        </tbody>
                                        <tfoot>
                                            <tr class="cart-subtotal">
                                                <th><b>Cart Subtotal</b></th>
                                                <td></td>
                                                <td><span>Rs. <span id="totalamtt"><?php echo $_SESSION['totalamount']?></span></span></td>
                                            </tr>
                                            <tr class="cart-subtotal">
                                                <th><b>Shipping cost</b></th>
                                                <td></td>
                                                <td><span id="amount">Rs. 50</span></td>
                                            </tr>
                                            <tr class="order-total">
                                                <th><b>Order Total</b></th>
                                                <td></td>
                                                <td><strong><span id="total"></span></strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="payment-method">
                                    <div class="payment-accordion">
                                        <div id="accordion">
                                          <div class="card">
                                            <div class="card-header" id="#payment-1">
                                              <h5 class="panel-title">
                                                <a class="" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                  Direct Bank Transfer.
                                                </a>
                                              </h5>
                                            </div>
                                            <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                              <div class="card-body">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="card">
                                            <div class="card-header" id="#payment-2">
                                              <h5 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                  Cheque Payment
                                                </a>
                                              </h5>
                                            </div>
                                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                              <div class="card-body">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="card">
                                            <div class="card-header" id="#payment-3">
                                              <h5 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                  PayPal
                                                </a>
                                              </h5>
                                            </div>
                                            <div id="collapseThree" class="collapse" data-parent="#accordion">
                                              <div class="card-body">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="order-button-payment">
                                            <input value="Place order" type="submit" >
                                            
                                        </div>
                            </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Checkout Area End-->
<?php
include_once('js.inc.php');
include_once('footer.php');
?>