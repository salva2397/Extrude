<?php

include('server/connection.php');

if(isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Esegui una query per ottenere i dettagli del prodotto
    $sql = "SELECT * FROM products WHERE product_id = $productId";
    $result = $conn->query($sql);

    // Verifica se la query ha restituito dei risultati
    if ($result->num_rows > 0) {
        // Estrai i dati del prodotto
        $product = $result->fetch_assoc();
        $productName = $product['name'];
        $productDescription = $product['description'];
        $productPrice = $product['price'];
        $productStockQuantity = $product['stock_quantity'];
        $productCategory = $product['category'];
        $productImageUrl = $product['image_url'];
        $finalproductImageUrl = "img/products/" . $productImageUrl;

        // E così via per altri campi, se necessario
    } else {
        // Gestione dell'errore se il prodotto non è stato trovato
        echo "Errore: Prodotto non trovato.";
        exit();
    }
} else {
    // Gestione dell'errore se l'ID del prodotto non è stato fornito
    echo "Errore: ID del prodotto non fornito.";
    exit();
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stockQuantity = $_POST['stock_quantity'];
    $category = $_POST['category'];

    if ($_FILES['image']['size'] > 0) {
        $targetDirectory = "img/products/";
        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $productImageUrl = basename($_FILES["image"]["name"]);
        } else {
            echo "Errore durante il caricamento del file.";
        }
    }


    $sqlUpdate = "UPDATE products SET 
                          name='$name', 
                          description='$description', 
                          price=$price, 
                          stock_quantity=$stockQuantity,
                          image_url='$productImageUrl',
                          category='$category'
                          WHERE product_id=$productId";

    if ($conn->query($sqlUpdate) === TRUE) {
       echo "Le informazioni del prodotto sono state aggiornate con successo.";
    } else {
       echo "Errore durante l'aggiornamento delle informazioni del prodotto: " . $conn->error;
    }   
}






?>














<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ex-Rude</title>
    
    <!-- Bootstrap stylesheet-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    
    <!-- Main stylesheet -->
    <link rel="stylesheet" href="css/main.css">
    
    <!-- Google Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
            
</head>

<body>

    <header class="header p-3 position-absolute start-0 top-0 end-0">
        <div class="d-flex justify-content-between align-items-center">
            <a href="/" class="text-decoration-none text-white fs-5 fw-bold">
                <img src="img/imm1.png" alt="Logo Ex-Rude" class="logo-img"> EX-RUDE
            </a>
        </div>
    </header>


    
    <form action="" method="POST" id="modifyProductform" enctype="multipart/form-data">
       <div>
          <label class="text-white" for="name">Nome Prodotto:</label>
          <input type="text" id="name" name="name" value="<?php echo  $productName; ?>">
      </div>
      <div>
          <label class="text-white" for="description">Descrizione Prodotto:</label>
          <textarea id="description" name="description"><?php echo  $productDescription; ?></textarea>
      </div>

      <div>
          <label class="text-white" for="price">Prezzo Prodotto:</label>
          <input type="number" id="price" name="price" value="<?php echo  $productPrice; ?>">
      </div>
      <div>
          <label class="text-white" for="stock_quantity">Quantità:</label>
          <input type="number" id="stock_quantity" name="stock_quantity" value="<?php echo  $productStockQuantity; ?>">
      </div>
      <div>
          <label class="text-white" for="scategory">Categoria:</label>
          <input type="text" id="category" name="category" value="<?php echo  $productCategory; ?>">
      </div>
      <div>
          <label class="text-white" for="image">Immagine:</label>
          <input type="file" id="image" name="image">
      </div>
      <img src="<?php echo $finalproductImageUrl;?>" width="50px" height="50px">
      <button type="submit">Modifica Prodotto</button>
   </form>

</body>
</html>

