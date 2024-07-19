<?php
include_once('connection.inc.php');
if ($_GET['action'] == 'updatecart') {


    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $dbname = "fashion_ecommerce";

    // // Create connection
    // $con = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    $cartId = $_GET['cartid'];
    $qtyval = $_GET['qty'];
    // echo $cartId;
    // echo $qtyval;
    $sql = "update cart_item set quantity=$qtyval where cart_Id=$cartId";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo true;
    } else {
        echo false;
    }
    $con->close();
}



if ($_GET['action'] == 'deletelist') {


   if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    $listId = $_GET['listid'];

    $sql = "delete from wishlist where list_Id=$listId";
    $result = mysqli_query($con, $sql);
    if ($result == 1) {
        echo true;
    } else {
        echo false;
    }
    $con->close();
}
if ($_GET['action'] == 'deletecart') {


    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $dbname = "fashion_ecommerce";

    // // Create connection
    // $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    $cartId = $_GET['cartid'];
    // $qtyval = $_GET['qty'];
    // echo $cartId;
    // echo $qtyval;
    $sql = "delete from cart_item where cart_Id=$cartId";
    $result = mysqli_query($con, $sql);
    if ($result == 1) {
        echo true;
    } else {
        echo false;
    }
    $con->close();
}
// if ($action == "search") {
//     $searchtext = $_GET["searchQuery"];
//     $sql = "select * from product where name like $searchText ";
//     $result = mysqli_query($con, $sql);
//     if ($stmt->rowCount() > 0) {
//         $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     } else {
//         $results = [];
//     }
//     return $results;
//     $con->close();
// }
if ($_GET['action'] == 'selectcart') {
    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $dbname = "fashion_ecommerce";

    // // Create connection
    // $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    // $cartId = $_GET['cartid'];
    // $qtyval = $_GET['qty'];
    // echo $cartId;
    // echo $qtyval;
    $sql = "SELECT sum(cart_item.quantity*product.price) as total from product, cart_item where cart_item.product_Id= product.id;";
    $result = mysqli_query($con, $sql);
    $row = $result->fetch_assoc();
    // echo $row['total'];

    if ($row['total'] > 0) {

        echo  $row['total'];
    } else {
        echo $row['total'];
    }
    $con->close();
}