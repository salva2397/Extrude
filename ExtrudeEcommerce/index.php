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
    <!-- Header Start-->

    <header class="header p-3 position-absolute start-0 top-0 end-0">
        <div class="d-flex justify-content-between align-items-center">
            <a href="/" class="text-decoration-none text-white fs-5 fw-bold">
                <img src="img/imm1.png" alt="Logo Ex-Rude" class="logo-img"> EX-RUDE
            </a>

            <div>
                <button class="navbar-toggler text-white" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar", aria-expanded="false" aria-label="Toggle navigation">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                      </svg>
            
                MENU</button>
            </div>

            <div class="header-buttons">
                <a href="login.php">
                  <button class="login-button btn rounded-pill fw-bold" type="button">
                      Log in
                  </button>
                </a>
                <a href="registration.php">
                  <button class="register-button btn rounded-pill fw-bold" type="button">
                      Register
                  </button>
                </a>
                <a href="shoppingcart.php">
                    <button class="cart-button btn rounded-pill fw-bold" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">
                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                        </svg>
                    </button>
                </a>
            </div>
        </div>
    </header>

    <!-- Header End-->





    <!-- Navbar Start -->
    <nav class="collapse navbar-collapse dropdown-nav" id="navbar">
        <div class="dropdown-nav__container container-xxl d-flex align-items-md-center align-item-start">
            <div class="row align-item-start">
                <div class="col-12 col-sm-6 mt-4 navbar-images">
                    <a href="shop.php" class="row text-decoration-none">
                        <div class="col-2 col-sm-12 mb-4">
                            <img src="img/shopnow.png" alt="Shop" class="img-fluid" loading="lazy" >
                        </div>
                        <div class="col-10">
                            <p class="text-center">Shop our product <i class="bi bi-arrow-right-short"></i></p>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 mt-4 navbar-images">
                    <a href="aboutus.php" class="row text-decoration-none">
                        <div class="col-2 col-sm-12 mb-4">
                            <img src="img/aboutus.png" alt="About Us" class="img-fluid"  loading="lazy">
                        </div>
                        <div class="col-10">
                            <p class="text-center">About Us <i class="bi bi-arrow-right-short"></i></p>
                        </div>
                    </a>
                </div>
            </div>
            <button class="navbar-toggler dropdown-nav__closeNavBtn text-white" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>
            </button>
        </div>
    </nav>
    

    <!-- Navbar End -->

    <!-- Hero Start -->





    <section class="hero">

        <img src="img/hero.png" alt="Hero">





    </section>








    <!-- Hero End -->










    


     <!-- Bootstrap JS -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html> 