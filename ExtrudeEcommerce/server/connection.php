<?php

$passw = "mongiello";

$conn = mysqli_connect("127.0.0.1", "root", $passw,  "ecommerce_db");

// Check connection
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
?>