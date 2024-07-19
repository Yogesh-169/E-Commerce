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

$sql="select order_detail.order_Detail_Id,order_detail.order_Id,product.name,order_detail.quantity,order_detail.product_Price,order_master.currentdate FROM order_master,order_detail,product where order_detail.order_Id=order_master.order_Id AND order_detail.product_Id=product.id GROUP BY(order_detail.order_Detail_Id);";
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
				   <h4 class="box-title">Order Details </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th>Order_Detail_ID</th>
							   <th>Order ~Id</th>
							   <th>Name</th>
							   <th>Quantity</th>
							   <th>Product Price</th>
							   <th>Date</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
						
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   
							   <td><?php echo $row['order_Detail_Id']?></td>
							   <td><?php echo $row['order_Id']?></td>
							   <td><?php echo $row['name']?></td>
							   <td><?php echo $row['quantity']?></td>
							   <td><?php echo $row['product_Price']?></td>
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


</body>


</html>