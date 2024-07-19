<?php
require('connection.inc.php');
require('functions.inc.php');
if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_USERNAME']!='')
{

} 
else
{
    header('location:login.php');
	die();
}
?>