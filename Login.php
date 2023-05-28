<?php
session_start();
if(isset($_SESSION['user'])) {
    header("location: homepage.php");
    die();
}

elseif(isset($_COOKIE['remember_me'])) {
    $cookie = json_decode($_COOKIE['remember_me']);
    try {
        require("database/connection.php");
        $stmt = $db->prepeare("SELECT * FROM users WHERE username=?");
        $stmt->execute(array($cookie['username']));
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($cookie['password'], $row['password'])) {
                $_SESSION['user'][$row['username']] = $row['role'];
                header("location: homepage.php");
                die();
            }
        }
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
}
elseif(isset($_POST['login'])) {
$msg='';
    extract($_POST);
    require("test_input.php");
    $username = strtolower(test_input($username));
    $password = test_input($password);
    try {
        require("database/connection.php");
        $stmt = $db->prepare("SELECT * FROM users WHERE username=?");
        $stmt->execute(array($username));
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if(password_verify($password, $row['password'])) {
                $_SESSION['user'][$row['username']] = $row['role'];
                if(isset($remember_me)) {
                    $data = ["username"=>$row['username'], "password"=>$row['password'], "role"=>$row['role']];
                    setcookie('remember_me',json_encode($data), time() + 5*60);
                }
                header("location: homepage.php");
                die();
            }
            else {
                $msg= "Invalid username or password";
            }
        }
        else {
            $msg= "Invalid username or password";

        }
        $db=null;
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
    <title>Login</title>
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
                    <form action="Login.php" method="post" autocomplete="off" class="login-form">
                        
                        <div class="logo">
                            <!-- <img src="./img/logo.png" alt="SurveySphere"> -->
                            <h4>SurveySphere</h4>
                        </div>
    
                        <div class="heading">
                            <h2>Login</h2>
                            <p class="text">
                                Not registered yet?
                                <a href="Signup.php" class="Link">Sign up</a>
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
                                    value=<?php if(isset($_POST['username'])){echo $_POST['username']; /*movelabel*/}?>
                                >
                                <label class='un'>User Name</label>
                            </div>
    
                            <div class="input-area">
                                <input
                                    type="password"
                                    name="password"
                                    minlength="4"
                                    class="input-field"
                                    autocomplete="off"
                                    required
                                    value=<?php if(isset($_POST['password'])){echo $_POST['password']; /*movelabel*/}?>
                                >
                                <label class='ps' >Password</label>
                            </div>
    
                            <div class="input-area" id="rememberMeBtn">
                                <input
                                    type="checkbox"
                                    name="remember_me"
                                    minlength="4"
                                    class="input-field-checkbox"
                                    autocomplete="off"
                                >
                                <label class="label_rememberme">Remember me</label>
                            </div>
    
                            <input type="submit" value="Login" name="login" class="login-btn">
                            <?php
                            if(isset($msg))
                            {
                                if($msg!='')
                                echo "<h5 style='color:red;'>$msg<h5>";
                            }
                            ?>
    
                            <p class="text">
                                Forgotten your password?
                                <a href="#" class="toggle">Get help</a>
                            </p>

                        </div>
                    </form>

                    <!-- Forgot Password Form -->
                    <form action="Login.php" autocomplete="off" class="forgotPassword-form">
                        
                        <div class="logo">
                           <!--  <img src="./img/logo.png" alt="SurveySphere"> -->
                            <h4>SurveySphere</h4>
                            </div> 
    
                        <div class="heading"><h2>Forgot Your Password?</h2></div>
    
                        <div class="actual-form">

                            <div class="input-area">
                                <input
                                    type="text"
                                    minlength="4"
                                    class="input-field"
                                    autocomplete="off"
                                    required
                                >
                                <label>Email Address</label>
                            </div>
    
                            <input type="submit" value="Reset Password" class="resetPassword-btn">

                            <a href="#" class="toggle">
                                <input type="submit" value="Back to Login" class="backToLogin-btn">
                            </a>

                        </div>
                    </form>
                    
                </div>

                <!-- Image Area -->
                <div class="image-area">
                    <img src="./img/login-image.svg" alt="University" id="img1">
                    <img src="./img/forgot-password-image.svg" alt="University" id="img2">
                </div>
                

            </div>
        </div>
    </main>
    
    <!-- Javascript file -->
    <script src="javascript/Login.js"></script>



</body>
</html>