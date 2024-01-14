<?php

require("../connect.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Successfully sign up - NeoLearn</title>
        <link rel="stylesheet" href="../Login_SignUp_style.css">
    </head>
    <body>
        <div class="container">
            <div class="form-box">
                <h1> Verify Account</h1>
                
                
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["token"]) ){
                        $verify_token = $_GET["token"];
                        $verify_status = haveToken( $conn, $verify_token);
                        $page = "Login";
                        // Handle the verification status
                        if ($verify_status == 1)  {
                            echo "<br><h3>Your Account has been verified <strong>Successfully</strong>. <a href='../Login/login.php'> Login </a> </h3><br>";
                        }else if($verify_status == 2){
                            echo "<br><h3>Your account has <strong>already</strong> been verified. <a href='../Login/login.php'> Login </a> </h3>";
                        }else if($verify_status == 0) {
                            echo "<br><h3>The link is <strong>invalid</strong>. <a href='signUp.php'> Sign Up </a> </h3><br> ";
                            $page = "Sign Up";
                        }
                        echo "Wait <strong>3 seconds</strong> to redirect you to <strong>" . $page . "</strong> page";
                        header("refresh:3;url= ../Login/login.php"); // Redirect for sign in after 5 seconds 
                    }
                    // Function to check if a token is valid and update the verification status
                    function haveToken($conn, $verify_token) {
                        $query = "SELECT verify_token, verified FROM users WHERE verify_token = ? LIMIT 1";
                        $stmt = mysqli_prepare($conn, $query);
                        mysqli_stmt_bind_param($stmt, "s", $verify_token);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        if (mysqli_num_rows($result) > 0) {     
                            $row = mysqli_fetch_assoc($result);
                            if ($row['verified'] == 1) return 2; // Already verified
                            else return 1; // Not verified
                        } else {
                        return 0; // Invalid token Can't be verified
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>
