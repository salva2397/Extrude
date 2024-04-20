<?php

include 'server/connection.php';

// Controlla se sono stati inviati dati tramite POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ricevi i dati inviati dal form
    $product_id = $_POST['product_id'];
    $product_name = $_POST['name'];
    $product_description = $_POST['description'];
    $product_price = $_POST['price'];
    $product_stock_quantity = $_POST['stock_quantity'];
    $product_category = $_POST['category'];
    $product_image_url = $_POST['image_url'];
    // Ricevi gli altri campi del form

    // Sanitizza i dati per prevenire SQL injection
    // Ad esempio, potresti utilizzare mysqli_real_escape_string per ogni campo

    // Controlla se i dati sono stati inviati correttamente
    if (empty($product_id) || empty($product_name) || empty($product_description) || empty($product_price) || empty($product_stock_quantity) || empty($product_image_url)) {
        echo json_encode(array("status" => "error", "message" => "Tutti i campi sono obbligatori."));
        exit;
    }

    // Controlla la connessione
    if ($conn->connect_error) {
        echo json_encode(array("status" => "error", "message" => "Connessione al database fallita: " . $conn->connect_error));
        exit;
    }

    // Prepara la query di inserimento
    $sql = "INSERT INTO products (product_id, name, description, price, stock_quantity, image_url, category)
    VALUES ('$product_id', '$product_name', '$product_description', '$product_price', '$product_stock_quantity', '$product_image_url', '$product_category')";

    // Esegui la query di inserimento
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert(\"Prodotto inserito con successo\");</script>";
    } else {
        echo "<script>alert(\"Errore nell'inserimento\");</script>";
    }

    // Chiudi la connessione al database
    $conn->close();
} else {
    // Se non sono stati inviati dati tramite POST, mostra un messaggio di errore
    echo json_encode(array("status" => "error", "message" => "Errore: Nessun dato inviato."));
}

header("Location: admindash.php");
exit;

?>
