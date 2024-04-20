<?php

include 'server/connection.php';

$query = "SELECT * FROM orders";
$result = mysqli_query($conn, $query);

$orders = array();

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}

$conn->close();

$orders_json = json_encode($orders);

header('Content-Type: application/json');
echo $orders_json;



?>