<?php
// Avvia la sessione
session_start();

// Includi il file di connessione al database
include('server/connection.php');

// Controlla se l'utente è loggato
if (!isset($_SESSION['user_id'])) {
    // L'utente non è loggato, reindirizza ad una pagina di login o esegui altre azioni di gestione
    header("Location: login.php");
    exit(); // Assicurati di uscire dallo script dopo un reindirizzamento per evitare l'esecuzione di ulteriori codice
}

$user_id = $_SESSION['user_id'];

// Query per ottenere tutti gli ordini dell'utente corrente con i dettagli
$sql = "SELECT * FROM orders WHERE customer_id = $user_id";

$result = $conn->query($sql);
?>



















<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ex-Rude</title>
    
    <!-- Bootstrap stylesheet-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Jquery reference-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    
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

    <div class="user-wrapper">
      <div class="user-sidebar">
        <h2>USER</h2>
        <ul>
          <li><a href="#" onclick="showContent('MyOrders')"><i class="fas fa-home"></i>My Orders</a></li>
          <li><a href="#" onclick="showContent('ModifyInformation')"><i class="fas fa-home"></i>Modify information</a></li>
        </ul>
      </div>
      <div class="user-main-content" id="user-mainContent">
        <!-- Il contenuto verrà visualizzato qui -->
      </div>
    </div>
  

    <script>
      function showContent(contentType) {
        // Rimuovi la classe "active" da tutti gli elementi della sidebar
        $('.user-sidebar ul li').removeClass('active');
        
        // Aggiungi la classe "active" all'elemento cliccato
        $(event.target).parent().addClass('active');
        
        // Ottieni il contenuto corrispondente al tipo di contenuto selezionato
        let content = getContent(contentType);
        
        // Aggiorna il contenuto del div main-content
        $('#user-mainContent').html(content);
      }
  
      function getContent(contentType) {
        // Qui puoi implementare la logica per ottenere il contenuto in base al tipo di contenuto selezionato
        // Ad esempio, puoi fare una chiamata AJAX per ottenere dati dinamici
        // In questo esempio, fornisco solo una rappresentazione statica
        switch (contentType) {
          case 'MyOrders':
            $.ajax({
                url: 'getuserorder.php', // Il percorso del file PHP che restituisce i dettagli degli ordini
                type: 'GET',
                success: function(response) {
                    $('#user-mainContent').html(response); // Inserisce la risposta (la tabella degli ordini) nel div principale
                },
                error: function(xhr, status, error) {
                    console.error(error); // Gestione degli errori
                }
            });
            break;
          case 'ModifyInformation':
            $.ajax({
                url: 'get_us.php', // Il percorso del file PHP che restituisce i dettagli degli ordini
                type: 'GET',
                success: function(response) {
                    $('#user-mainContent').html(response); // Inserisce la risposta (la tabella degli ordini) nel div principale
                },
                error: function(xhr, status, error) {
                    console.error(error); // Gestione degli errori
                }
            });
            break;
        }
      }




      










    </script>
</body>