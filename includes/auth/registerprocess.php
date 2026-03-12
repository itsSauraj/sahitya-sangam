<?php
include "../config/db.php";

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users(name,email,password)
        VALUES('$name','$email','$password')";

if($conn->query($sql)){
    header("Location: ../login.php");
}else{
    echo "Error: " . $conn->error;
}
?>