<?php
// Verifica se il modulo di registrazione è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati dalla form di registrazione
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $address = $_POST['address'];
    $telephone = $_POST['telephone'];


    // Connessione al database (assumendo che tu abbia un file di connessione)
    include 'server/connection.php';

    // Query SQL per inserire un nuovo utente nel database
    $insertQuery = "INSERT INTO customers (first_name, last_name, email, address, password, telephone) VALUES ('$name', '$surname',  '$email', '$address','$password', '$telephone')";
    
    // Esegui la query
    if (mysqli_query($conn, $insertQuery)) {
        echo "Registrazione completata con successo!";
    } else {
        echo "Errore durante la registrazione: " . mysqli_error($conn);
    }

    // Chiudi la connessione al database
    mysqli_close($conn);
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

    <div class="registration">
        <h2>Sign in</h2>
        <form action="" method="post">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
    
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>

            <label for="name">Surname</label>
            <input type="text" id="surname" name="surname" required>

            <label for="name">Address</label>
            <input type="text" id="address" name="address" required>

            <label for="name">Telephone</label>
            <input type="text" id="telephone" name="telephone" required>
    
            <button type="submit">Sign In</button>
        </form>
        <p style="font-size: 14px;">Are you altready registered? <a href="login.html">Log in</a></p>
    </div>
    
</body>
</html>