<?php
require('connection.inc.php');
require('functions.inc.php');
if(isset($_POST['submit']))
{
	$username=get_safe_value($con,$_POST['uname']);
	$password=get_safe_value($con,$_POST['password']);

    if (empty($username)) {
		header("Location: login-register.php?error=User Name is required");
	    exit();
	}else if(empty($password)){
        header("Location: login-register.php?error=Password is required");
	    exit();
	}else{

	$sql="select * from users where email='$username' and password='$password'";
    
	$res=mysqli_query($con,$sql);
	$count=mysqli_num_rows($res);
    $row = mysqli_fetch_assoc($res);
	if($count>0)
    {
		$_SESSION['Client_LOGIN']='yes';
		$_SESSION['Client_USERNAME']=$row['name'];
		$_SESSION['Client_id']=$row['id'];
		header('location:index.php');
		die();
	}
    else
    {
		header("Location: login-register.php?error=Incorect User name or password");
		        exit();	
	}
    }
}
?>