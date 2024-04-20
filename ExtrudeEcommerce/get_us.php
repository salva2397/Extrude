<?php
session_start();

include('server/connection.php');

if (!isset($_SESSION['user_id'])) {
    exit('Unauthorized access');
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM customers WHERE customer_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Ottieni i dati dell'utente
    $row = $result->fetch_assoc();
    ?>
    <!-- Inizio del form -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="update_user.php" method="post" class="border p-4 shadow rounded">
                    <h2 class="text-center mb-4 text-white">Modify Information</h2>
                    <div class="mb-3">
                        <label for="first_name" class="form-label text-white">First Name:</label>
                        <input type="text" id="first_name" name="first_name" class="form-control bg-transparent text-white" value="<?php echo $row['first_name']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label text-white">Last Name:</label>
                        <input type="text" id="last_name" name="last_name" class="form-control bg-transparent text-white" value="<?php echo $row['last_name']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label text-white">Email:</label>
                        <input type="email" id="email" name="email" class="form-control bg-transparent text-white" value="<?php echo $row['email']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label text-white">Address:</label>
                        <input type="text" id="address" name="address" class="form-control bg-transparent text-white" value="<?php echo $row['address']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="telephone" class="form-label text-white">Telephone:</label>
                        <input type="text" id="telephone" name="telephone" class="form-control bg-transparent text-white" value="<?php echo $row['telephone']; ?>">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Fine del form -->
    <?php
} else {
    echo '<p>No user found.</p>';
}
?>
