<?php
session_start();
require '../connect.php';

// Προσθήκη: Έλεγχος αν υπάρχει ενεργό session
if (!isset($_SESSION['id'])) {
    header('Location: ../Login/login.php'); // Κατεύθυνση στη σελίδα σύνδεσης
    exit(); // Τερματισμός εκτέλεσης του κώδικα
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $url = mysqli_real_escape_string($conn, $_POST['url']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $pdf = $_FILES['pdf']['name'];
    $teacher_id = $_SESSION['id'];

    // Υπόλοιπος κώδικας εδώ...

    $query = "INSERT INTO lessons (name, url, description, pdf, teacher_id) VALUES ('$name', '$url', '$description', '$pdf', '$teacher_id')";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        echo "Lesson created successfully!";
    } else {
        echo "Error creating lesson: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Lesson</title>
</head>
<body>

<form action="addLesson.php" method="post" enctype="multipart/form-data">
    <label for="name">Lesson Name:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="url">Video URL:</label>
    <input type="text" id="url" name="url" required><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="4" required></textarea><br>

    <label for="pdf">PDF File:</label>
    <input type="file" id="pdf" name="pdf"><br>

    <input type="submit" value="Create Lesson">
</form>

</body>
</html>

