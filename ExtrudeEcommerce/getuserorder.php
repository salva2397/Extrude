<?php
session_start();

include('server/connection.php');

if (!isset($_SESSION['user_id'])) {
    exit('Unauthorized access'); // Se l'utente non è loggato, interrompi l'esecuzione del file
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM orders WHERE customer_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table class="table"><thead><tr><th scope="col" class="text-white">Order ID</th><th scope="col" class="text-white">Order Date</th><th scope="col" class="text-white">Total Amount</th></tr></thead><tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr><td class="text-white">' . $row["order_id"] . '</td><td class="text-white">' . $row["order_date"] . '</td><td class="text-white">' . $row["total_amount"] . '</td></tr>';

    }
    echo '</tbody></table>';
} else {
    echo '<p>No orders found.</p>';
}
?>