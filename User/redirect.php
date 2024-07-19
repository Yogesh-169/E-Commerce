<?php
session_start();
echo $_SESSION['TID'];
echo "<br>";
echo "<pre>";
print_r($_REQUEST);
// echo $_SESSION['tamt'];


if ($_REQUEST['payment_status'] == 'Credit') {
    // echo "successfull payment";
    // 1 Insert for Order_Master Table
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ecomm";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $currentdate = date("Y/m/d");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // $subcategory = $_GET['subcat'];\
    $userid =  $_SESSION['Client_id'];
    $amt = $_SESSION['totalamount'];
    echo $amt."<br>";
    echo $userid ."<br>";
    $status = $_REQUEST['payment_status'];
    $sql = "INSERT INTO order_master(customer_Id,total_Amount,payment_Type,currentdate) values($userid,$amt,'" . $status . "','" . $currentdate . "')";
    
    echo $sql;
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        echo $last_id;
        $userid = $_SESSION['Client_id'];
		

        $sql1 = "SELECT cart_item.quantity,product.id,product.name,product.price,product.mrp from product,cart_item where product.id=cart_item.product_Id AND cart_item.userid=$userid ";
        // echo $sql;
        $result = $conn->query($sql1);
        if ($result->num_rows > 0) {
            // output data of each row
            // var_dump($result);
            // die();
            while ($row1 = $result->fetch_assoc()) {
                $proid = $row1['id'];
                $qty = $row1['quantity'];
                $pri = $row1['mrp'];
                

                    $sql2 = "INSERT INTO order_detail(order_Id ,product_Id,quantity,product_Price) values($last_id,$proid,$qty,$pri)";
                    // echo $sql2;die();
                
                if ($conn->query($sql2) === TRUE) {
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            $sql3 = "DELETE FROM cart_item WHERE userid=$userid";
            if ($conn->query($sql3) === TRUE) {
                header("location:success_payment.php?orderid=$last_id");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // 2 Multiple Entries for Order_Detail(Loop).
    // 3 Delete Cart of this user.
    // 4 Generate PDF and then send email with attachment.
} else {
    echo "payment failed";
}