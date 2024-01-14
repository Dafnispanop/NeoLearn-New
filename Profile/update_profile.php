<?php
session_start();

// Έλεγχος αν ο χρήστης είναι συνδεδεμένος
if (!isset($_SESSION['id'])) {
    header("Location: ../Login/login.php");
    exit();
}

// Συμπεριλαμβάνουμε το αρχείο σύνδεσης στη βάση δεδομένων
require("../connect.php");

// Λήψη των νέων πληροφοριών από τη φόρμα
$new_email = $_POST['email'];
$new_username = $_POST['username'];
$new_role = $_POST['role'];

// Λήψη του ID του συνδεδεμένου χρήστη
$user_id = $_SESSION['id'];

// Ενημέρωση των πληροφοριών του προφίλ στη βάση δεδομένων (χωρίς τον κωδικό πρόσβασης)
$sql = "UPDATE users SET email='$new_email', username='$new_username', role='$new_role' WHERE id='$user_id'";
$result = $conn->query($sql);

if ($result) {
    echo "Τα στοιχεία του προφίλ ενημερώθηκαν με επιτυχία.";
} else {
    echo "Σφάλμα κατά την ενημέρωση των πληροφοριών του προφίλ.";
}
?>
