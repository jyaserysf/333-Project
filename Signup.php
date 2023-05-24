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
      /*   die("Please enter a valid username"); */

    $pattern_email = '/^[a-z0-9.-_]+@[a-z0-9.-]+\.[a-z]{2,}$/i';
    if(!preg_match($pattern_email, $email))
       /*  die("Please enter a valid email address"); */

    $pattern_password = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[_#@%\*\-.!$^?])[A-Za-z0-9_#@%.!$^\*\-?]{8,24}$/';
    if(!preg_match($pattern_password, $password))
      /*   die("Please enter a valid password"); */

    if($password != $cpassword)
    /*     die("The entered passwords do not match");
 */
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

    <style>
    
    .input-area small{
    
    position: absolute;
   
   top: 2.5rem;
    left: 0;
    
    visibility: hidden;
  

} 
 .input-area.error small{
   
    visibility: visible;
    color: red;
}  

    </style>
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
                    <form action="Signup.php" method="post" autocomplete="off" class="login-form" id="form">
                        
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
                                  
                                    class="input-field"
                                    autocomplete="off"
                                   
                                    id="username"
                                >
                                <label for='username'>User Name</label>
                                <small ></small>
                            </div>

                            <div class="input-area">
                                <input
                                    type="text"
                                    name="email"
                                  
                                    class="input-field"
                                    autocomplete="off"
                                   
                                    id="email"
                                >
                                <label>Email Address</label>
                                <small></small>
                            </div>

    
                            <div class="input-area">
                                <input
                                    type="password"
                                    name="password"
                                    
                                    class="input-field"
                                    autocomplete="off"
                                   
                                    id="userpassword"
                                >
                                <label>Password</label>
                                <small ></small>
                            </div>

                            <div class="input-area">
                                <input
                                    type="password"
                                    name="cpassword"
                                   
                                    class="input-field"
                                    autocomplete="off"
                                    
                                    id="cpassword"
                                >
                                <label>Re-enter Password</label>
                                <small></small>
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
    <script>
            window.addEventListener('DOMContentLoaded', function() {

                const form =document.getElementById('form');
                //console.log(form);
                const username= document.getElementById("username");
                //console.log(username);
                const email = document.getElementById("email");
                //console.log(email);
                const userpassword =document.getElementById("userpassword");
                //console.log(userpassword);
                const passwordVerify=document.getElementById("cpassword");
                //console.log(passwordVerify);
                
                function showError(input,message){
                    const inputarea=input.parentElement;
                    inputarea.className='input-area error';
                    const small =inputarea.querySelector('small');
                    small.innerText=message;


                }

                function showSuccess(input){
                    const inputarea=input.parentElement;
                inputarea.className='input-area success';
                }


                form.addEventListener('submit',function(e) {
                e.preventDefault();
                let errors=0;
                    //validate all inputs 
                   /*  errors+=checkRequired([username,email,userpassword,passwordVerify]); */
                    errors+=checkLength(username,3,14);
                    errors+=checkLength(userpassword,8,24);
                    errors+=checkEmail(email);
                    errors+=checkPasswrodsMatch(userpassword,passwordVerify);


                    //if there is no errors submit 
                    if(errors==0){
                        form.submit();
                    }
            });



/*                 
                function checkRequired(userinputARR){
                let error=0;
                userinputARR.forEach(function(input){

                    if(input.value.trim() === ''){

                            showError(input, `${getFieldName(input)} is required `);
                            ++error;
                           
                    }else{
                         showSuccess(input); 
                       
                    }

                });
                    return error;
                }
 */
                
                
              
                function checkEmail(input){

                    let error=0;
                    
                     if(input.value.trim() === ''){

                            showError(input, `*${getFieldName(input)} is required `);
                            ++error;
                     }else{
                    const ex=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

                    if(ex.test(input.value.trim())){
                        showSuccess(input);
                    }else{
                        showError(input,'Email is not valid');
                        ++error;
                    }
                    return error;}
                }



                function checkLength(input,min,max){
                    let error=0;

                    if(input.value.trim() === ''){

                       showError(input, `*${getFieldName(input)} is required `);
                        ++error;
                        }else{

                    if(input.value.length < min ){

                        showError(
                            input,`*${getFieldName(input)} must be atleast ${min} characters `
                        );
                        ++error;
                    }else if(input.value.length>max){
                        showError(
                            input, `*${getFieldName(input) } must be less tha ${max} charachters ` );

                            ++error;
                        }
                    else{
                        showSuccess(input);
                    }
                    
                    return error;
                }
                }
                

                function checkPasswrodsMatch(input1,input2){
                    let error=0;
                     if(input1.value.trim() === ''){

                            showError(input, `*${getFieldName(input)} is required `);
                            ++error;
                     }else{
                    if(input1.value !== input2.value){
                        showError(input2 , 'password do not match');
                        ++error;
                    }
                    return error;
                }
                }


                function getFieldName(input){
                    
                    return input.id.charAt(0).toUpperCase() + input.id.slice(1);
                }

                //event listener for submit 

               
                

                

                

                //get field name 

               

                //check input length 

                

                //check if email is valid


                
            });
            
    </script>

 </body>

 </html>