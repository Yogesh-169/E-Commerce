<?php
include_once('connection.inc.php');
$name=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$psw=$_POST['psw'];
$date=date("Y/m/d");
$name=$name." ".$lname;
$select = mysqli_query($con, "SELECT * FROM users WHERE email = '".$email."'");
if(mysqli_num_rows($select)) {
  echo "<SCRIPT> //not showing me this
  alert('Email Already Exist !!')
  window.location.replace('login-register.php');
</SCRIPT>";
}
else{
  $sql="insert into users(name,password,email,added_on) values('$name','$psw','$email','$date')";
  if (mysqli_query($con, $sql)) {
      //header('location:login-register.php');
      echo "<SCRIPT> //not showing me this
      alert('Registered SuccessFull !!')
      window.location.replace('login-register.php');
  </SCRIPT>";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
    
    mysqli_close($con);
}
?>