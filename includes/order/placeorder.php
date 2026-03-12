<?php
session_start();
include "../config/db.php";

$user_id = $_SESSION['user_id'];
$total = 0;

foreach($_SESSION['cart'] as $book){
    $total += 1; // example price logic
}

$conn->query("INSERT INTO orders(user_id,total_amount)
              VALUES('$user_id','$total')");

$order_id = $conn->insert_id;

foreach($_SESSION['cart'] as $book){
    $conn->query("INSERT INTO order_items(order_id,book_id,quantity)
                  VALUES('$order_id','$book',1)");
}

unset($_SESSION['cart']);
echo "Order placed successfully";
?>