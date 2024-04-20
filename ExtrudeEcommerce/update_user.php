<?php
session_start();

include('server/connection.php');

if (!isset($_SESSION['user_id'])) {
    exit('Unauthorized access');
}

$user_id = $_SESSION['user_id'];

// Verifica se sono stati inviati i dati del form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ottieni i dati inviati dal form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $telephone = $_POST['telephone'];
    
    // Prepara la query per aggiornare i dati dell'utente nel database
    $sql = "UPDATE customers SET first_name='$first_name', last_name='$last_name', email='$email', address='$address', telephone='$telephone' WHERE customer_id=$user_id";
    
    // Esegui la query di aggiornamento
    if ($conn->query($sql) === TRUE) {
        // Messaggio di conferma
        $_SESSION['success_message'] = "User information updated successfully";
    } else {
        // Messaggio di errore
        $_SESSION['error_message'] = "Error updating user information: " . $conn->error;
    }
    
    // Chiudi la connessione al database
    $conn->close();
}

// Reindirizza l'utente alla pagina userdash.php
header("Location: userdash.php");
exit();
?>
