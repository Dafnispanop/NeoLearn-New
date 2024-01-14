
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - NeoLearn</title>
        <link rel="stylesheet" href="../Login_SignUp_style.css">
    </head>
    <body>
        <div class="container">
            <div class="form-box">
                <h1> Sign In</h1>
                <form action="check_login.php" method="POST" >
                    
                    <div class="input-group" >
                        <div class="input-field">
                            <input type="email"  name="user_email" placeholder="Email"  required />
                        </div>
                        <div class="input-field">
                            <input type="password"  name="user_password" placeholder="Password" minlength = "8" maxlength="35" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                         title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/>
                        </div>  
                    </div>  
                    <div class ="btn-field">
                        <input type="submit" value="Login">
                    </div>
                    <?php 
                        if(isset($_GET['error'])){
                            echo $_GET['error'] . "<br><br>";
                        }
                    ?>
                    <div class ="changeSign-field">
                        <p>Don't have an account? </p>
                        <a href= "../SignUp/signUp.php"> Sign Up </a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>