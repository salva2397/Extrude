<?php

include 'server/connection.php';

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Recupera le categorie selezionate dal parametro GET
$categories = isset($_GET['category']) ? (array)$_GET['category'] : array();

// Costruisci la query SQL per filtrare i prodotti in base alle categorie selezionate
$categoryString = implode("','", $categories); // Converte l'array in una stringa separata da virgole
$sql = "SELECT * FROM products";

// Aggiungi la clausola WHERE solo se sono state selezionate delle categorie
if (!empty($categories)) {
    $sql .= " WHERE category IN ('$categoryString')";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output dei risultati come HTML
    echo "<div class='row'>";
    while($row = $result->fetch_assoc()) {
        echo "<div class='col-lg-4'>
                <div class='single_product_item'>
                    <img src='img/products/{$row['image_url']}' alt='' class='product-img'>
                    <div class='single_product_text'>
                        <h4 class='text-white'>{$row['name']}</h4>
                        <h3 class='text-white'>{$row['price']}</h3>
                        <form action='' method='post'> 
                            <input type='hidden' name='product_id' value='{$row['product_id']}'>
                            <input type='hidden' name='name' value='{$row['name']}'>
                            <input type='hidden' name='price' value='{$row['price']}'>
                            <input type='hidden' name='quantity' value='1'>
                            <input type='hidden' name='image_url' value='{$row['image_url']}'>
                            <button type='submit' formmethod='post' name='add_to_cart' class='add_cart_button'>Add to Cart <i class='ti-heart'></i></button>
                        </form>
                    </div>
                </div>
              </div>";
    }
    echo "</div>"; // Chiudi la riga dopo aver ciclato i prodotti
} else {
    echo "Nessun risultato trovato.";
}

// Chiudi la connessione al database
$conn->close();
?>
