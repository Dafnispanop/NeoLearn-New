<?php
session_start();

// Έλεγχος αν ο χρήστης είναι συνδεδεμένος
if (!isset($_SESSION['id'])) {
    header("Location: ../Login/login.php");
    exit();
}

// Συμπεριλαμβάνουμε το αρχείο σύνδεσης στη βάση δεδομένων
require("../connect.php");

// Λήψη του ID του συνδεδεμένου χρήστη
$user_id = $_SESSION['id'];

// Λήψη του τρέχοντος κωδικού πρόσβασης από τη βάση δεδομένων
$sql = "SELECT password FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $stored_hashed_password = $row['password'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];

        if (password_verify($current_password, $stored_hashed_password)) {
            // Ο τρέχον κωδικός πρόσβασης είναι σωστός
            // Κωδικοποίηση του νέου κωδικού πρόσβασης
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Ενημέρωση του κωδικού πρόσβασης στη βάση δεδομένων
            $update_password_sql = "UPDATE users SET password='$hashed_new_password' WHERE id='$user_id'";
            $result_password_update = $conn->query($update_password_sql);

            if ($result_password_update) {
                echo "Ο κωδικός πρόσβασης ενημερώθηκε με επιτυχία.";
            } else {
                echo "Σφάλμα κατά την ενημέρωση του κωδικού πρόσβασης.";
            }
        } else {
            echo "Λανθασμένος τρέχον κωδικός πρόσβασης.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Αλλαγή Κωδικού Πρόσβασης - NeoLearn</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1>Αλλαγή Κωδικού Πρόσβασης</h1>
            <form action="change_password.php" method="POST">
                <div class="input-field">
                    <label for="current_password">Τρέχον Κωδικός:</label>
                    <input type="password" name="current_password" required>
                </div>
                <div class="input-field">
                    <label for="new_password">Νέος Κωδικός:</label>
                    <input type="password" name="new_password" minlength="8" maxlength="35" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                </div>
                <div class="btn-field">
                    <input type="submit" value="Αλλαγή Κωδικού">
                </div>
            </form>
            <a href="./profile.php">Επιστροφή στο Προφίλ μου</a>
        </div>
    </div>
</body>
</html>
