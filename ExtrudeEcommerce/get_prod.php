<?php

// Includi il file di connessione al database
include('server/connection.php');

// Prepara e esegui la query per selezionare tutti i prodotti
$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();

// Ottieni i risultati della query
$products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Chiudi la connessione al database
$stmt->close();
$conn->close();


header('Content-Type: application/json');

// Restituisci i dati dei prodotti come JSON
echo json_encode($products);

?>
