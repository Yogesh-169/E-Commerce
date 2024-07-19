<?php
include_once('top.php');
include_once('connection.inc.php');
?>
<script>  
function verifyPassword() {  
    //alert("Inside Verify Password");
  var pw = document.getElementById("pswd").value;  
  //check empty password field  
  if(pw == "") {  
     document.getElementById("message").innerHTML = "**Fill the password please!";  
     return false;  
  }  
   
 //minimum password length validation  
  if(pw.length < 8) {  
     document.getElementById("message").innerHTML = "**Password length must be atleast 8 characters";  
     return false;  
  }  
  
//maximum length of password validation  
  if(pw.length > 15) {  
     document.getElementById("message").innerHTML = "**Password length must not exceed 15 characters";  
     return false;  
  } else {  
     //alert("Password is correct");  
     return true;
  }  
}  
</script>
<script>  
function matchPassword() {  
    //alert("Inside Match Password");
  var pw1 = document.getElementById("pswd").value;  
  var pw2 = document.getElementById("cnfp").value; 
  if(pw1 != pw2)  
  {   
    document.getElementById("message").innerHTML ="Passwords did not match";  
    return false;
  } else {  
    // alert("Password created successfully");  
    return true;
  }  
}  

function validateForm() {
    //alert("Inside Validate Form");
    var isFormValid = true;
    isFormValid &= verifyPassword();
    isFormValid &= matchPassword();
    return isFormValid? true:false;
}
</script> 
<bodY> 
  <!-- Begin Login Content Area -->
  <div class="page-section mb-60">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                        <!-- Login Form s-->
                        <form action="Logincheck.php" method="post">
                            <div class="login-form">
                                <h4 class="login-title">Login</h4>
                                <div class="row">
                                    <div class="col-md-12 col-12 mb-20">
                                        <label>Email Address*</label>
                                        <input class="mb-0" type="email" required placeholder="Email Address" name="uname">
                                    </div>
                                    <div class="col-12 mb-20">
                                        <label>Password</label>
                                        <input class="mb-0" type="password" required placeholder="Password" name="password">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                            <input type="checkbox" id="remember_me">
                                            <label for="remember_me">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                        <a href="ForgotPswd.php"> Forgotten pasward?</a>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="register-button mt-0" name="submit">Login</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                        <form action="RegisterCheck.php"  onsubmit="return validateForm();" method="post">
                            <div class="login-form">
                                <h4 class="login-title">Register</h4>
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-20"> 
                                        <label>First Name</label>
                                        <input class="mb-0" type="text" required placeholder="First Name" name='fname'>
                                    </div>
                                    <div class="col-md-6 col-12 mb-20">
                                        <label>Last Name</label>
                                        <input class="mb-0" type="text" required placeholder="Last Name" name='lname'>
                                    </div>
                                    <div class="col-md-12 mb-20">
                                        <label>Email Address*</label>
                                        <input class="mb-0" type="email" required placeholder="Email Address" name='email'>
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Password</label>
                                        <input class="mb-0" type="password" required placeholder="Password" name="psw" id="pswd">
                                    </div>
                                    <div class="col-md-6 mb-20">
                                        <label>Confirm Password</label>
                                        <input class="mb-0" type="password" required placeholder="Confirm Password" name="cnfp" id="cnfp">
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="register-button mt-0">Register</button>
                                    </div>
                                    <span id = "message" style="color:red"> </span> <br><br>  
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
        <!-- Login Content Area End Here -->
        <?php
        include_once('js.inc.php');
        include_once('footer.php');
        ?>