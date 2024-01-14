<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up - NeoLearn</title>
        <link rel="stylesheet" href="Login_SignUp_style.css">
    </head>
    <body>
        <div class="container">
            <div class="form-box">
                <h1>Sign Up</h1>
                <form action="process_signup.php" method="POST" >
                    
                    <div class="input-group" >
                        <div class = "input-field">
                            <input type="email"  name="user_email" placeholder="Email"  required />
                        </div>
                        <div class="input-field">
                            <input type="password"  name="user_password" placeholder="Password" minlength = "8" maxlength="35" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                            title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/>
                        </div>  
                        <div class="input-field">
                            <input type="text" name="user_name" placeholder="Username" minlength="3" maxlength="80" required>
                        </div> 
                        <div class="input-radio">
                            <label><input type="radio" name="user_type" value="student" required> Student </label>
                            <label><input type="radio" name="user_type" value="teacher"> Teacher </label>
                        </div> 
                    </div>  
                    <div class ="btn-field">
                        <input type="submit" name ="Sign Up" value="Sign Up">
                    </div>
                    <?php 
                        if(isset($_GET['error'])){
                            echo $_GET['error'] . "<br><br>";
                        }
                    ?>
                    <div class ="changeSign-field">
                        <p> "Have an account?"</p>
                        <a href= "../Login/login.php"> Sign In </a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>



