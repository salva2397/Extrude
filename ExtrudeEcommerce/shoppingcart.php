<?php
// Avvia la sessione
session_start();

include('server/connection.php');

// Controlla se l'utente è loggato
if (!isset($_SESSION['user_id'])) {
    // L'utente non è loggato, reindirizza ad una pagina di login o esegui altre azioni di gestione
    header("Location: login.php");
    exit(); // Assicurati di uscire dallo script dopo un reindirizzamento per evitare l'esecuzione di ulteriori codice
}

$userName = $_SESSION['first_name'];
$userSurname = $_SESSION['last_name'];
$userAddress = $_SESSION['address'];
$email = $_SESSION['email'];

$confirmation_message = ""; // Inizializza la variabile del messaggio di conferma

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica che il carrello non sia vuoto
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $customer_id = $_SESSION['user_id'];
        $order_date = date("Y-m-d H:i:s");
        $total = 0;

        // Calcola il totale dell'ordine
        foreach ($_SESSION['cart'] as $product) {
            $total += $product['price'] * $product['quantity'];
        }

        // Inserisci l'ordine nel database
        $sql_order = "INSERT INTO orders (customer_id, order_date, total_amount) VALUES ('$customer_id', '$order_date', '$total')";
        if ($conn->query($sql_order) === TRUE) {
            $order_id = $conn->insert_id;

            // Inserisci i dettagli dell'ordine nella tabella order_details
            foreach ($_SESSION['cart'] as $product) {
                $product_id = $product['product_id'];
                $quantity = $product['quantity'];
                $price = $product['price'];

                $sql_details = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', '$quantity', '$price')";
                $conn->query($sql_details);
            }

            $_SESSION['cart'] = array();

            // Svuota il carrello dopo aver completato l'ordine
            $confirmation_message = 'Order placed successfully!'; // Imposta il messaggio di conferma
        } else {
            $confirmation_message = "Error: " . $sql_order . "<br>" . $conn->error; // Imposta un messaggio di errore
        }
    } else {
        $confirmation_message = 'Your cart is empty.'; // Imposta il messaggio se il carrello è vuoto
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


    <div class="card-body">
        <div class="col-md-5">
            <div class="card-header">
                <h2 class="card-title">Checkout</h2>
                <p class="card-text">SHIPPING DETAILS</p>
                <hr class="my-0">
            </div>
            <div class="carddiv">
                <div>
                    <div>
                        <p><b><?php echo $userName . " " . $userSurname . ", " . $userAddress; ?></b></p>
                    </div>
                    <div>
                        <p><b><?php echo $email; ?></b> </p>
                    </div>
                </div>
                <div>
                    <form action="#" method="post">
                        <label for="cardnumber">Card Number:</label>
                        <input type="text" id="cardnumber" name="cardnumber" required placeholder="**** **** **** ****" maxlength="19">

                        <label for="cardname">Name on card:</label>
                        <input type="text" id="cardname" name="cardname" required maxlength="35">

                        <label for="expire">Expire</label>
                        <input type="text" id="expire" name="expire" required placeholder="MM/AA" maxlength="5">

                        <label for="cvcode">CVC Code</label>
                        <input type="text" id="cvcode" name="cvcode" required maxlength="3">

                        <button type="submit">Submit Order</button>
                    </form>
                </div>
                <div class="card-summary">
                    <div>
                        <p class="card-text text-white">YOUR ORDER</p>
                    </div>
                    <div class="cart-products-detail">
                        <?php
                        if (isset($confirmation_message)) {
                            echo "<p>$confirmation_message</p>"; // Stampa il messaggio di conferma o di errore
                        }
                        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $product) {
                                echo '<div class="product-cart-item">';
                                echo '<img class="img-fluid" src="img/products/' . $product['image_url'] . '" width="50" height="50">';
                                echo '<p>Name: ' . $product['name'] . '</p>';
                                echo '<p>Price: ' . $product['price'] . '</p>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>Your cart is empty.</p>';
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
