<?php
// Verifica se il modulo di registrazione è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati dalla form di registrazione
    $email = $_POST['email'];
    $password = $_POST['password'];




    // Connessione al database (assumendo che tu abbia un file di connessione)
    include 'server/connection.php';


    $query = "SELECT * FROM Admin WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $db_passw = $row['password'];

        // Verifica la password
        if ($password === $db_passw) {
            // Login avvenuto con successo, puoi reindirizzare l'utente a una pagina protetta
            // Ad esempio:
            header("Location: admindash.html");
            exit();
        } else {
            // Password non corretta
            $loginError = "Password non corretta.";
        }
    } else {
        // Utente non trovato
        $loginError = "Utente non trovato.";
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

    <div class="adminlogin">
        <h2>Admin Login</h2>
        <form action="#" method="post">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
    
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
    
            <button type="submit">Login</button>
        </form>
    </div>
    
</body>
</html>