<?php
// Includi il file di connessione al database o qualsiasi altra dipendenza necessaria
include('server/connection.php');

// Inizializza la variabile per il messaggio di errore
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se è stata inviata l'email
    if (isset($_POST['email'])) {
        // Pulisci l'email inviata dal form
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        // Verifica se l'email esiste nel database
        $query = "SELECT * FROM customers WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            // Genera un token univoco
            $token = bin2hex(random_bytes(32)); // Questo genera un token di 64 caratteri esadecimali
            
            // Salva il token nel database insieme all'email dell'utente
            $update_query = "UPDATE customers SET reset_token = '$token' WHERE email = '$email'";
            mysqli_query($conn, $update_query);


            $smtp_server = 'localhost'; // Indirizzo del server SMTP (localhost se MailHog è in esecuzione localmente)
            $smtp_username = null; // Non è richiesta l'autenticazione per MailHog
            $smtp_password = null; // Non è richiesta l'autenticazione per MailHog
            $smtp_port = 1025; // Porta SMTP di default di MailHog

            // Invia un'email all'utente con un link per il recupero password
            $reset_link = "http://localhost/reset_password.php?token=$token";
            $to = $email;
            $subject = "Password Reset Request";
            $message = "Per reimpostare la tua password, visita il seguente link: $reset_link";
            $headers = "From: your_email@example.com" . "\r\n" .
                       "Reply-To: your_email@example.com" . "\r\n" .
                       "X-Mailer: PHP/" . phpversion();

            if (mail($to, $subject, $message, $headers)) {
                // Email inviata con successo
                $success_message = "Un'email con le istruzioni per il recupero password è stata inviata all'indirizzo $email";
            } else {
                // Errore nell'invio dell'email
                $error = "Si è verificato un errore durante l'invio dell'email. Riprova più tardi.";
            }
        } else {
            // Nessun utente trovato con l'email specificata
            $error = "Nessun account trovato con l'email specificata.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery</title>
    <!-- Aggiungi eventuali fogli di stile o script JavaScript qui -->
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
        }
        form {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        form label {
            display: block;
            margin-bottom: 10px;
        }
        form input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: none;
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
            box-sizing: border-box;
        }
        form button[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        form button[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
        .success {
            color: green;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Password Recovery</h2>
        <?php if (!empty($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } elseif (isset($success_message)) { ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php } ?>
        <form action="" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>

