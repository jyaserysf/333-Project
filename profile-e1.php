<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: Login.php");
}

include('test_input.php');

if(isset($_POST['sf1']))
{
    $name = test_input($_POST['name']); 
    $name=ucfirst($name); 
    $username = test_input($_POST['username']); 
    $username = strtolower($username);
    $email = test_input($_POST['email']); 
    $code = $_POST['code']; 
    $number = test_input($_POST['number']);
    if($name==""||$username==""||$email==""||$number=="")
    {
        // echo "<span style='color:red;font-size:12px;'>Please, fill all the fields properly !</span>" ;
        // echo '<style>'; include 'moveUpF.css';'</style>';
        // die();
    } 

    elseif($code=="Code")
    {
        // echo "<span style='color:red;font-size:12px;'>Please, choose your country code !</span>" ;
        // echo '<style>'; include 'moveUpF.css';'</style>';
        // die();
    }

    elseif(!preg_match('/^[a-zA-Z ]{3,30}$/',$name))
    {
        // echo "<span style='color:red;font-size:12px;'>Please, enter your name properly !</span>" ;
        // echo '<style>'; include 'moveUpF.css';'</style>';
        // die();
        
    }

    elseif(!preg_match('/^[a-z0-9.]{4,20}$/',$username))
    {
        echo "<span style='color:red;font-size:12px;'>Please, enter a valid username!</span>" ;
        echo '<style>'; include 'moveUpF.css';'</style>';
        die();
    }

    elseif(!preg_match('/^[a-z0-9.-_]+@[a-z0-9.-]+\.[a-z]{2,}$/i',$email))
    {
        echo "<span style='color:red;font-size:12px;'>Please, enter a valid email format !</span>" ;
        echo '<style>'; include 'moveUpF.css';'</style>';
        die();
    }

    elseif($code=="+973" && !preg_match('/^[36][0-9]{7}$/', $number))
    {
            echo "<span style='color:red;font-size:12px;'>Please, enter a valid Bahraini phone number !</span>" ;
            echo '<style>'; include 'moveUpF.css';'</style>';
            die();
    }

    elseif($code!="+973" && !preg_match('/^[0-9]{8,15}$/',$number)) # general verification for the rest 5 countries
    {
            echo "<span style='color:red;font-size:12px;'>Please, enter a valid phone number !</span>" ;
            echo '<style>'; include 'moveUpF.css';'</style>';
            die();
    }

    else # all input are valid => you can update data
    {
        try {
            require('database/connection.php');
            $stmt = $db->prepare("update users set name=?, username=?, email=?,  phoneCode=?, phoneNumber=?  WHERE username=?");
            $stmt->execute(array($name, $username, $email, $code, $number, $_SESSION['username']));
            $db=null;
            // echo "<span style='color:green;font-size:12px;'>Your Data Has Been Updated Successfully.</span>" ;
            // echo '<style>'; include 'moveUpF.css';'</style>';
            header('location: Profile.php');
        }
        catch(PDOException $e) {
            die('Error:'.$e->getMessage());
        }
    }  
}
else {
    echo "An error occured Bitch";
}

?>