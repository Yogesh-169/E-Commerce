<?php
require('connection.inc.php');
require('functions.inc.php');
if(isset($_POST['submit']))
{
	$username=get_safe_value($con,$_POST['uname']);
	$password=get_safe_value($con,$_POST['password']);

    if (empty($username)) {
		header("Location: login.php?error=User Name is required");
	    exit();
	}else if(empty($password)){
        header("Location: login.php?error=Password is required");
	    exit();
	}else{

	$sql="select * from admin_users where username='$username' and password='$password'";
    
	$res=mysqli_query($con,$sql);
	$count=mysqli_num_rows($res);
	if($count>0)
    {
		$_SESSION['ADMIN_LOGIN']='yes';
		$_SESSION['ADMIN_USERNAME']=$username;
		header('location:Dashboard.php');
		die();
	}
    else
    {
		header("Location: login.php?error=Incorect User name or password");
		        exit();	
	}
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>



    <div class="panda">
        <div class="ear"></div>
        <div class="face">
            <div class="eye-shade"></div>
            <div class="eye-white">
                <div class="eye-ball"></div>
            </div>
            <div class="eye-shade rgt"></div>
            <div class="eye-white rgt">
                <div class="eye-ball"></div>
            </div>
            <div class="nose"></div>
            <div class="mouth"></div>
        </div>
        <div class="body"> </div>
        <div class="foot">
            <div class="finger"></div>
        </div>
        <div class="foot rgt">
            <div class="finger"></div>
        </div>
    </div>
    <?php if (isset($_GET['error'])) { 
            //echo '<script>alert("Incorrect Username and Password")</script>';
            echo '<form method="post"  class="wrong-entry">';

            }
            else{
                echo '<form method=post>';
            }?>
    
        <div class="hand"></div>
        <div class="hand rgt"></div>
        
           
        <h1>Admin Login</h1>
        <div class="form-group">
            <input required="required" class="form-control" name="uname"/>
            <label class="form-label">Username    </label>
        </div>
        <div class="form-group">
            <input id="password" type="password" required="required" class="form-control" name="password"/>
            <label class="form-label">Password</label>
            <p class="alert">Invalid Credentials..!!</p>
           
            <input type="Submit" name="submit" class="btn" Value ="Login"> </input>
        </div>
    </form>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script id="rendered-js">
        $('#password').focusin(function() {
            $('form').addClass('up');
        });
        $('#password').focusout(function() {
            $('form').removeClass('up');
        });

        // Panda Eye move
        $(document).on("mousemove", function(event) {
            var dw = $(document).width() / 15;
            var dh = $(document).height() / 15;
            var x = event.pageX / dw;
            var y = event.pageY / dh;
            $('.eye-ball').css({
                width: x,
                height: y
            });

        });

        // validation


        $('.btn').click(function() {
            $('form').addClass('wrong-entry');
            setTimeout(function() {
                $('form').removeClass('wrong-entry');
            }, 3000);
           });
        
    </script>
    
</body>
</html>