<?php

include 'server/connection.php';

$query = "SELECT * FROM customers";
$result = mysqli_query($conn, $query);

$users = array();

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

$conn->close();

$users_json = json_encode($users);

header('Content-Type: application/json');
echo $users_json;



?>