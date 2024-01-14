<?php
session_start();

// Έλεγχος αν ο χρήστης είναι συνδεδεμένος
if (!isset($_SESSION['id'])) {
    header("Location: ../Login/login.php");
    exit();
}

// Συμπεριλαμβάνουμε το αρχείο σύνδεσης στη βάση δεδομένων
require("../connect.php");

// Λήψη των λεπτομερειών του συνδεδεμένου χρήστη
$user_id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $email = $row['email'];
    $username = $row['username'];
    $role = $row['role'];
} else {
    echo "Σφάλμα: Η εγγραφή του χρήστη δεν βρέθηκε.";
    exit();
}

// Εδώ ξεκινά ο HTML της σελίδας
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Προφίλ - NeoLearn</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include("../Navbar/navbar.php"); ?>
    <div class="wrapper">
        <div class="container">
            <div class="form-box">
                <h1>Προφίλ Χρήστη</h1>
                <form action="update_profile.php" method="POST">
                    <div class="input-group">
                        <div class="input-field">
                            <label for="email">Email:</label>
                            <input type="email" name="email" value="<?php echo $email; ?>" required>
                        </div>
                        <div class="input-field">
                            <label for="username">Όνομα χρήστη:</label>
                            <input type="text" name="username" value="<?php echo $username; ?>" required>
                        </div>
                        <div class="input-field">
                            <label for="role">Ρόλος:</label>
                            <input type="text" name="role" value="<?php echo $role; ?>" required>
                        </div>
                    </div>
                    <div class="btn-field">
                        <input type="submit" value="Ενημέρωση Προφίλ">
                    </div>
                </form>

                <!-- Κουμπί για αλλαγή κωδικού πρόσβασης -->
                <div class="btn-field">
                    <a href="change_password.php">Αλλαγή Κωδικού Πρόσβασης</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../Scripts/logout.js"></script>
</body>
</html>
