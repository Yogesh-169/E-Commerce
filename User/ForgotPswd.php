
<?php
ob_start();
require_once('top.php');
//index.php

//error_reporting(E_ALL);



if (isset($_SESSION["user_id"])) {
	header("location:index.php");
}

// include('function.php');

$connect = new PDO("mysql:host=localhost; dbname=ecomm", "root", "");

$message = '';
$error_user_name = '';
$error_user_email = '';
$error_user_password = '';
$error_user_Cpassword = '';
$user_name = '';
$user_email = '';
$user_password = '';
$user_Cpassword = '';

if (isset($_POST["register"])) {


	if (empty($_POST["user_email"])) {
		$error_user_email = '<label class="text-danger">Enter Email Address</label>';
	} else {
		$user_email = trim($_POST["user_email"]);
		if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
			$error_user_email = '<label class="text-danger">Enter Valid Email Address</label>';
		}
	}

	if (empty($_POST["user_password"])) {
		$error_user_password = '<label class="text-danger">Enter Password</label>';
	} else {
		$user_password = trim($_POST["user_password"]);
		//$user_password = password_hash($user_password, PASSWORD_DEFAULT);
	}
	if (empty($_POST["user_Cpassword"])) {
		$error_user_Cpassword = '<label class="text-danger">Enter Confirm Password</label>';
	} else {
		$user_Cpassword = trim($_POST["user_Cpassword"]);
		//$user_Cpassword = password_hash($user_Cpassword, PASSWORD_DEFAULT);
	}

	if ($error_user_email == '' && $error_user_password == '') {
		$user_activation_code = md5(rand());

		$user_otp = rand(100000, 999999);

		$query = "update users set activate_User = '" . $user_activation_code . "',user_Otp='" . $user_otp . "' WHERE email = '" . $user_email . "' ";
		$statement = $connect->prepare($query);

		$statement->execute();

		if ($statement->rowCount() == 0) {
			$message = '<label class="text-danger">Email Not Found</label>';
		} else {

			$receiver = $user_email;
			$subject = "Verification code for Verify Your Email Address";
			// $body = "Hi, there...This is a test email send from Localhost.";
			date_default_timezone_set("Asia/Kolkata");
			$body = $user_otp . " is OTP for LIMUPA SHOPPING SYSTEM - Password Change, valid for Single Session Only. Please do not share OTP with Anyone. Generated at( ". date("d-m-Y  h:i:s A") ." )
			";
			$sender = "From:yogeshahir0000@gmail.com";
			// if (mail($receiver, $subject, $body, $sender)) {
			// 	echo "Email sent successfully to $receiver";
			// } else {
			// 	echo "Sorry, failed while sending mail!";
			// }
				// echo $receiver."<br>";
				// echo $subject."<br>";
				// echo $body."<br>";
				// echo $sender."<br>";
			//var_dump(mail($receiver, $subject, $body, $sender));
			if (mail($receiver, $subject, $body, $sender)) {
				echo '<script>alert("Please Check Your Email for Verification Code")</script>';
				$_SESSION['user_pass'] = $user_Cpassword;
				echo $_SESSION['user_pass'];
				header('location:email_verify.php?code=' . $user_activation_code);
			} else {
				//$message = $mail->ErrorInfo;
				echo "Mail not Send..";
			}
		}
	}
}


?>
<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="http://code.jquery.com/jquery.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
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
<body>
	<br />
	<div class="container">
		
		<br />
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Forgot Password</h3>
			</div>
			<div class="panel-body">
				<?php echo $message; ?>
				<form onsubmit="return validateForm();" method="post" >
					<!-- <div class="form-group">
						<label>Enter Your Name</label>
						<input type="text" name="user_name" class="form-control" />
						
					</div> -->
					<div class="form-group">
						<label>Enter Your Email</label>
						<input type="text" name="user_email" class="form-control" />
						<?php echo $error_user_email; ?>
					</div>
					<div class="form-group">
						<label>Enter Your Password</label>
						<input type="password" name="user_password" id="pswd" class="form-control" />
						<?php echo $error_user_password; ?>
					</div>
					<div class="form-group">
						<label>Confirm Your Password</label>
						<input type="password" name="user_Cpassword" id="cnfp" class="form-control" />
						<?php echo $error_user_Cpassword ?>
					</div>
					<div class="form-group">
						<input type="submit" name="register" class="btn btn-success" value="Click to Change Password" />&nbsp;&nbsp;&nbsp;
						<!-- <a href="login.php">Login</a> -->
					</div>
					<span id = "message" style="color:red"> </span> <br><br>
				</form>
			</div>
		</div>
	</div>
	<br />
	<br />
<?php
require_once('footer.php');
ob_end_flush();
?>
</body>

</html>