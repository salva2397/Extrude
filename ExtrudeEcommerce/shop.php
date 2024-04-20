<?php
session_start(); // Avvia la sessione

// Inizializza $_SESSION['cart'] se non è già presente
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Gestisci l'aggiunta di un prodotto al carrello se è stato inviato tramite il metodo POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image_url = $_POST['image_url'];

    // Aggiungi il prodotto al carrello
    $product = array(
        'product_id' => $product_id,
        'name' => $name,
        'price' => $price,
        'quantity' => $quantity,
        'image_url' => $image_url
    );
    array_push($_SESSION['cart'], $product);
}
?>









<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
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
    <!--::header part start::-->
    <header class="header p-3 position-absolute start-0 top-0 end-0">
        <div class="d-flex justify-content-between align-items-center">
            <a href="/" class="text-decoration-none text-white fs-5 fw-bold">
                <img src="img/imm1.png" alt="Logo Ex-Rude" class="logo-img"> EX-RUDE
            </a>

            <div>
                <a href="login.html">
                    <button class="login-button btn rounded-pill fw-bold" type="button">
                        Log in
                    </button>
                  </a>
                  <a href="registration.html">
                    <button class="register-button btn rounded-pill fw-bold" type="button">
                        Register
                    </button>
                  </a>
            </div>
        </div>
    </header>
    <!-- Header part end-->


    <!-- Body start-->




   <aside class="filter-section">
      <h2>Filtra Prodotti</h2>
      <label for="max_price">Prezzo Massimo:</label>
      <input type="number" id="max_price" name="max_price">
      <button id="filter_button">Filter by price</button>
      <div class="checkboxes">
          <input type="checkbox" id="category_toy" name="category[]" value="Toy">
          <label class="category-label" for="category_toy">Toy</label>
      </div>
      <div>
          <input type="checkbox" id="category_pla" name="category[]" value="PLA">
          <label class="category-label" for="category_pla">PLA</label>
      </div>
      <div>
          <input type="checkbox" id="category_flowerpot" name="category[]" value="Flowerpot">
          <label class="category-label" for="category_flowerpot">Flowerpot</label>
      </div>
      <button id="filter_button_category">Filter by category</button>
   </aside>


    <section id="shop-product-section" class="shop-product-section">
    <div class="container">
        <div class="row">
            <?php include('server/get_products.php'); ?>
            <?php $count = 0; ?>
            <?php while ($row = $products->fetch_assoc()) { ?>
                <?php if ($count % 3 == 0) { ?>
                    </div>
                    <div class="row">
                <?php } ?>
                <div class="col-lg-4">
                    <div class="single_product_item">
                        <img src="img/products/<?php echo $row['image_url']; ?>" alt="" class="product-img">
                        <div class="single_product_text">
                            <h4 class="text-white"><?php echo $row['name']; ?></h4>
                            <h3 class="text-white"><?php echo $row['price']; ?></h3>

                            <form action="" method="post"> 
                            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                            <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                            <input type="hidden" name="quantity" value="1" type="number"; ?>">
                            <input type="hidden" name="image_url" value="<?php echo $row['image_url']; ?>">
                            <button type="submit" formmethod="post" name="add_to_cart" class="add_cart_button">Add to Cart <i class="ti-heart"></i></button>
                            </form>


                        </div>
                    </div>
                </div>
                <?php $count++; ?>
            <?php } ?>
        </div>
    </div>
   </section>



   <script>
     document.getElementById('filter_button').addEventListener('click', function() {
        // Ottieni il valore del prezzo massimo inserito dall'utente
        var maxPrice = document.getElementById('max_price').value;

        // Effettua una richiesta AJAX per filtrare i prodotti
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'filter_products.php?max_price=' + maxPrice, true);
        xhr.onload = function() {
            if (xhr.status == 200) {
                // Aggiorna la sezione dei prodotti con i risultati filtrati
                document.getElementById('shop-product-section').innerHTML = xhr.responseText;
            } else {
                console.error('Errore durante la richiesta AJAX');
            }
        };
        xhr.send();
     });






    document.getElementById('filter_button_category').addEventListener('click', function() {
    // Ottieni le categorie selezionate dall'utente
       var selectedCategories = [];
       var checkboxes = document.getElementsByName('category[]');
       checkboxes.forEach(function(checkbox) {
           if (checkbox.checked) {
               selectedCategories.push(checkbox.value);
            }
        });

    // Effettua una richiesta AJAX per filtrare i prodotti
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'filter_products_category.php?category=' + selectedCategories.join(','), true);
        xhr.onload = function() {
           if (xhr.status == 200) {
            // Aggiorna la sezione dei prodotti con i risultati filtrati
               document.getElementById('shop-product-section').innerHTML = xhr.responseText;
            } else {
               console.error('Errore durante la richiesta AJAX');
            }
        };
        xhr.send();
    });

   </script>

























    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    
</body>

</html>