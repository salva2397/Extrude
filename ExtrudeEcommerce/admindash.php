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

    <div class="wrapper">
      <div class="sidebar">
        <h2>ADMIN</h2>
        <ul>
          <li><a href="#" onclick="showContent('Orders')"><i class="fas fa-home"></i>Orders</a></li>
          <li><a href="#" onclick="showContent('Users')"><i class="fas fa-home"></i>Users</a></li>
          <li><a href="#" onclick="showContent('AddProducts')"><i class="fas fa-home"></i>Add products</a></li>
          <li><a href="#" onclick="showContent('DeleteOrModifyProducts')"><i class="fas fa-home"></i>Delete\modify products</a></li>
        </ul>
      </div>
      <div id="message"></div>
      <div class="main-content" id="mainContent">
        <!-- Il contenuto verrà visualizzato qui -->
      </div>
    </div>
  

    <script>
      function showContent(contentType) {
        // Rimuovi la classe "active" da tutti gli elementi della sidebar
        $('.sidebar ul li').removeClass('active');
        
        // Aggiungi la classe "active" all'elemento cliccato
        $(event.target).parent().addClass('active');
        
        // Ottieni il contenuto corrispondente al tipo di contenuto selezionato
        let content = getContent(contentType);
        
        // Aggiorna il contenuto del div main-content
        $('#mainContent').html(content);

      }
  
      function getContent(contentType) {
        // Qui puoi implementare la logica per ottenere il contenuto in base al tipo di contenuto selezionato
        // Ad esempio, puoi fare una chiamata AJAX per ottenere dati dinamici
        // In questo esempio, fornisco solo una rappresentazione statica
        switch (contentType) {
          case 'Orders':
            getOrdersData();
            return '';
          case 'Users':
            getUsersData(); // Chiamiamo la funzione per ottenere i dati degli utenti
            return ''; // Non restituiamo nulla qui perché visualizzeremo gli utenti una volta ricevuti i dati
          case 'AddProducts':
            return '<h3 class="text-white">Aggiungi Prodotto</h3>' +
                '<form action="add_product.php" method="POST" id="addProductForm">' +
                '<div>' +
                '<label class="text-white" for="product_id"> IdProdotto:</label>' +
                '<input type="text" id="product_id" name="product_id" required>' +
                '</div>' +
                '<div>' +
                '<label class="text-white" for="name">Nome Prodotto:</label>' +
                '<input type="text" id="name" name="name" required>' +
                '</div>' +
                '<div>' +
                '<label class="text-white" for="description">Descrizione Prodotto:</label>' +
                '<textarea id="description" name="description" required></textarea>' +
                '</div>' +
                '<div>' +
                '<label class="text-white" for="price">Prezzo Prodotto:</label>' +
                '<input type="number" id="price" name="price"  required>' +
                '</div>' +
                '<div>' +
                '<label  class="text-white" for="stock_quantity">Quantità:</label>' +
                '<input type="number" id="stock_quantity" name="stock_quantity" required>' +
                '</div>' +
                '<div' +
                '<label class="text-white" for="category">Categoria:</label>' +
                '<input type="text" id="category" name="category" required>' +
                '</div' +
                '<div>' +
                '<label class="text-white" for="image_url">Immagine:</label>' +
                '<input type="file" id="image_url" name="image_url" required>' +
                '</div>' +
                '<button type="submit">Aggiungi Prodotto</button>' +
                '</form>';
          case 'DeleteOrModifyProducts':
            getModifyProducts();
            return '';
          default:
            return '<p>Contenuto non disponibile</p>';
        }
      }

      

    function getUsersData() {
      $.ajax({
      url: 'get_users.php', // URL del file PHP che restituisce i dati degli utenti
      method: 'GET',
      success: function(response) {
        // Una volta ricevuti i dati, chiamiamo una funzione per mostrare gli utenti
        showUsersData(response);
      },
      error: function(xhr, status, error) {
        console.error(error); // In caso di errore, stampiamo l'errore nella console per debug
      }
    });
  }

  // Funzione per mostrare i dati degli utenti ottenuti dalla chiamata AJAX
  function showUsersData(users) {
    let html = '<h3 class="text-white">Elenco Utenti</h3>';
    html += '<table class="tableus table-striped">';
    html += '<thead>';
    html += '<tr>';
    html += '<th class="text-white" scope="col">Name</th>';
    html += '<th class="text-white" scope="col">Email</th>';
    html += '</tr>';
    html += '</thead>';
    html += '<tbody>';

    users.forEach(function(user) {
        html += '<tr>';
        html += '<td class="text-white">' + user.first_name + '</td>'; // Assumi che il campo username sia presente nell'oggetto user
        html += '<td class="text-white">' + user.email + '</td>'; // Assumi che il campo email sia presente nell'oggetto user
        html += '</tr>';
    });

    html += '</tbody>';
    html += '</table>';
    
    $('#mainContent').html(html);
  }






  function getOrdersData() {
      $.ajax({
      url: 'get_orders.php', // URL del file PHP che restituisce i dati degli utenti
      method: 'GET',
      success: function(response) {
        // Una volta ricevuti i dati, chiamiamo una funzione per mostrare gli utenti
        showOrdersData(response);
      },
      error: function(xhr, status, error) {
        console.error(error); // In caso di errore, stampiamo l'errore nella console per debug
      }
    });
  }

  // Funzione per mostrare i dati degli utenti ottenuti dalla chiamata AJAX
  function showOrdersData(orders) {
    let html = '<h3 class="text-white">Elenco Ordini</h3>';
    html += '<table class="tableor">';
    html += '<thead>';
    html += '<tr>';
    html += '<th class="text-white">ID Ordine</th>';
    html += '<th class="text-white">ID Cliente</th>';
    html += '<th class="text-white">Data Ordine</th>';
    html += '<th class="text-white">Totale</th>';
    html += '</tr>';
    html += '</thead>';
    html += '<tbody>';
    orders.forEach(function(order) {
        html += '<tr>';
        html += '<td class="text-white">' + order.order_id + '</td>';
        html += '<td class="text-white">' + order.customer_id + '</td>';
        html += '<td class="text-white">' + order.order_date + '</td>';
        html += '<td class="text-white">' + order.total_amount + '</td>';
        html += '</tr>';
    });
    html += '</tbody>';
    html += '</table>';
    $('#mainContent').html(html);
  }







  function getModifyProducts() {
    $.ajax({
        url: 'get_prod.php', // URL del file PHP che restituisce i dati dei prodotti da modificare
        method: 'GET',
        success: function (response) {
            // Una volta ricevuti i dati, chiamiamo una funzione per mostrare i prodotti da modificare
            showModifyProducts(response);
        },
        error: function (xhr, status, error) {
            console.error(error); // In caso di errore, stampiamo l'errore nella console per debug
        }
    });
  }





  function showModifyProducts(products) {
    let html = '<h3 class="text-white">Elenco Prodotti da Modificare</h3>';
    html += '<table class="table">';
    html += '<thead>';
    html += '<tr>';
    html += '<th class="text-white">Id Prodotto</th>';
    html += '<th class="text-white">Nome Prodotto</th>';
    html += '<th class="text-white">Immagine</th>';
    html += '<th class="text-white">Azioni</th>'; // Nuova colonna per le azioni
    html += '</tr>';
    html += '</thead>';
    html += '<tbody>';

    products.forEach(function (product) {
        html += '<tr>';
        html += '<td class="text-white">' + product.product_id + '</td>';
        html += '<td class="text-white">' + product.name + '</td>';
        html += '<td><img src="/img/products/' + product.image_url + '" alt="' + product.name + '" class="productmodifyimg img-fluid"></td>'; // Costruisci il percorso completo dell'immagine
        html += '<td>'; // Colonna per i bottoni
        html += '<button class="btn btn-primary" onclick="redirectToModifyPage(' + product.product_id + ')">Modifica</button>'; // Bottone Modifica con funzione onclick
        html += '<button class="btn btn-danger remove-product" data-id="' + product.product_id + '">Rimuovi</button>'; // Bottone Rimuovi con attributo data-id
        html += '</td>';
        html += '</tr>';
    });

    html += '</tbody>';
    html += '</table>';

    $('#mainContent').html(html);

    $('.remove-product').click(function() {
        const productId = $(this).data('id');
        // Esegui una chiamata AJAX per rimuovere il prodotto dal database
        $.ajax({
            url: 'remove_prod.php', // Assumi che questo sia il percorso del tuo file PHP per la rimozione del prodotto
            method: 'POST',
            data: { id: productId }, // Passa l'ID del prodotto da rimuovere
            success: function(response) {
                // Aggiorna l'interfaccia utente dopo aver eliminato il prodotto
                // Ad esempio, puoi ricaricare i dati dei prodotti
                getModifyProducts(); // Questo aggiorna la lista dei prodotti dopo la rimozione
            },
            error: function(xhr, status, error) {
                console.error(error); // In caso di errore, stampiamo l'errore nella console per debug
            }
        });
    });
   }



  function redirectToModifyPage(productId) {
    window.location.href = 'modify.php?id=' + productId;
  }











    </script>
</body>