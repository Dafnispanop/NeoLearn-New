<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php 
        require('../bootstrap.php');
    ?>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php 
        session_start();

        // Έλεγχος αν ο χρήστης είναι συνδεδεμένος
        if (!isset($_SESSION['id'])) {
            header("Location: ../Login/login.php");
            exit();
        }

        // Συμπεριλαμβάνουμε το αρχείο σύνδεσης στη βάση δεδομένων
        require("../connect.php");
        
        include("../Navbar/navbar.php");

        // Λήψη των λεπτομερειών του συνδεδεμένου χρήστη
        $userID = $_SESSION['id'];
        $userRole = $_SESSION['role'];
        

        if ($userRole === 'teacher') {
            header("Location: ../Lessons/teacher.php");
            exit();
        } else {
            header("Location: ../Lessons/showlessons.php");
            exit();
        }
    ?>

    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="Scripts/logout.js"></script>
</body>
</html>