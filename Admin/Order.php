<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Dashboard Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/normalize.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/themify-icons.css">
      <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
      <link rel="stylesheet" href="assets/css/flag-icon.min.css">
      <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
   </head>
   <body>
<?php
ob_start();
include_once('connection.inc.php');
include_once('top.inc.php');
include_once('functions.inc.php');
$sql="select order_master.order_Id,users.name,order_master.total_Amount,order_master.payment_Type,order_master.currentdate from order_master,users WHERE order_master.customer_Id=users.id ";
$res=mysqli_query($con,$sql);
?>
<div class="app-main__outer">
<div class="app-main__inner">
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Order Master </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							
							   <th>Order ID</th>
							   <th>Customer ID</th>
							   <th>Total Amount</th>
							   <th>Payment Type</th>
							   <th>Date</th>
                                <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td><?php echo $row['order_Id']?></td>
							   <td><?php echo $row['name']?></td>
							   <td><?php echo $row['total_Amount']?></td>
							   <td><?php echo $row['payment_Type']?></td>
							   <td><?php echo $row['currentdate']?></td>
							  <td></td>
							</tr>
							<?php } ?>
						 </tbody>
					  </table>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
</div>
<?php
require('footer.inc.php');
require_once('js.inc.php');
ob_end_flush();
?>
</div>
<script type="text/javascript" src="./assets/scripts/main.d810cf0ae7f39f28f336.js"></script>

</body>


</html>