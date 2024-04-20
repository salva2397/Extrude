<?php

include('server/connection.php');
if(isset($_POST['id'])) {
    $productId = $_POST['id'];

    // Prepara e esegui la query per eliminare il prodotto dal database
    $sql = "DELETE FROM products WHERE product_id = $productId";

    if ($conn->query($sql) === TRUE) {
        echo "Prodotto eliminato con successo";
    } else {
        echo "Errore durante l'eliminazione del prodotto: " . $conn->error;
    }
} else {
    echo "ID del prodotto non ricevuto";
}

// Chiudi la connessione al database
$conn->close();
?>