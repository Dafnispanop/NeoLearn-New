<?php
require("../connect.php"); // to connect database
require("email_validate.php"); //check if the email is valid
require("email_send.php"); // to send verification codes to emails with PHPMailer
require("email_verify.php"); // Email verification logic


if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["Sign Up"])) {
    $email = $_POST["user_email"];
    $verify_token = md5(rand());
    if (sendMail_verify($email, $verify_token) == false) echo "<br> Can't send verification Link to this email. Try again or try another mail !!";

    $password = $_POST["user_password"];
    $username = $_POST["user_name"];
    $role = $_POST["user_type"];

    //$hashedPassword = password_hash($password, 'SHA1'); 
    $verify_token = md5(rand());
    if (haveMail($email)) {
        header("Location: signUp.php?error=A user with that E-Mail already exists");
    } else if (validate_email($email)  == false) {
        header("Location: signUp.php?error=E-Mail is not valid");
    } else if (sendMail_verify($email, $verify_token) == false) {
        header("Location: signUp.php?error=Can't send verification Link to this email. Try again or try another mail !!");
    } else {
        insertUser($conn, $email, $password, $username, $role, $verify_token);
        header("Location: succes_signUp.php");
    }
}



function insertUser($conn, $email, $password, $username, $role, $verify_token)
{

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // INSERT USER
    $query = "INSERT INTO users (email, password, username, role, verify_token) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssss", $email, $hashedPassword, $username, $role, $verify_token);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($result) {
        echo "<br>Registration Successful! <br>Check your E-Mail for verification link";
    } else {
        echo "Try again! Something went wrong";
    }
    
}

//Check if the email has alraedy exist
function haveMail($email)
{
    global $conn;
    $query = "SELECT * FROM users WHERE email = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) return true;
    else return false;
}
