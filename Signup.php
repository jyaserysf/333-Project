<?php

require("test_input.php");

if(isset($_POST['signup'])) {

    extract($_POST);
    $username = test_input($username);
    $email = test_input($email);
    $password = test_input($password);
    $cpassword = test_input($cpassword);

    $pattern_user = '/^[a-z0-9.]{4,20}$/i';
    if(!preg_match($pattern_user, $username))
        die("Please enter a valid username");

    $pattern_email = '/^[a-z0-9.-_]+@[a-z0-9.-]+\.[a-z]{2,}$/i';
    if(!preg_match($pattern_email, $email))
        die("Please enter a valid email address");

    $pattern_password = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[_#@%\*\-.!$^?])[A-Za-z0-9_#@%.!$^\*\-?]{8,24}$/';
    if(!preg_match($pattern_password, $password))
        die("Please enter a valid password");

    if($password != $cpassword)
        die("The entered passwords do not match");

    try {
        require('database/connection.php');
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO users (username,email,password) VALUES(?,?,?)");
        $stmt->execute(array(strtolower($username), $email, $hash));
        $db=null;
        header("location: Login.php");
        die();
    }
    catch(PDOException $e) {
        die($e->getMessage());
    }
}
?>

<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="css/signup-login.css">
 </head>
 <body>
   
    <main> 
        <!-- Outer Box -->
        <div class="box">
            <!-- Inner Box -->
            <div class="inner-box">
                <!-- Form Area -->
                <div class="forms-area">
                    <!-- The Login Form -->
                    <form action="Signup.php" method="post" autocomplete="off" class="login-form">
                        
                        <div class="logo">
                           <!-- <img src="./img/logo.png" alt="SurveySphere"> -->
                            <h4>SurveySphere</h4></div>
    
                        <div class="heading">
                            <h2>Get Started</h2>
                            <p class="text">
                                Already have an account?
                                <a href="Login.php" class="Link">Login</a>
                            </p>
                        </div>
    
                        <div class="actual-form">
                            
                            <div class="input-area">
                                <input
                                    type="text"
                                    name="username"
                                    minlength="4"
                                    class="input-field"
                                    autocomplete="off"
                                    required
                                >
                                <label>User Name</label>
                            </div>

                            <div class="input-area">
                                <input
                                    type="text"
                                    name="email"
                                    minlength="4"
                                    class="input-field"
                                    autocomplete="off"
                                    required
                                >
                                <label>Email Address</label>
                            </div>
    
                            <div class="input-area">
                                <input
                                    type="password"
                                    name="password"
                                    minlength="8"
                                    class="input-field"
                                    autocomplete="off"
                                    required
                                >
                                <label>Password</label>
                            </div>

                            <div class="input-area">
                                <input
                                    type="password"
                                    name="cpassword"
                                    minlength="8"
                                    class="input-field"
                                    autocomplete="off"
                                    required
                                >
                                <label>Re-enter Password</label>
                            </div>
    
                            <div class="input-area" id="rememberMeBtn">
                                <input
                                    type="checkbox"
                                    minlength="4"
                                    class="input-field-checkbox"
                                    autocomplete="off"
                                >
                                <label class="label_rememberme">Remember me</label>
                            </div>
    
                            <input type="submit" value="Sign up" name="signup" class="signup-btn">

                            <!--
                            <p class="text">
                                By signing up, I agree to the <a href="#" class="Link">
                                    Terms of Services </a> and 
                                    <a href="#" class="Link">Privacy Policy</a>
                            </p>
                            -->

                        </div>
                    </form>

                <!-- Image Area -->
                <div class="image-area-signup">
                    <img src="./img/sign-up-image.svg" alt="University" id="img3">
                </div>
                

            </div>
        </div>
    </main>
    
    <script src="javascript/Login.js"></script>

 </body>
 </html>