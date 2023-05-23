<?php
if(isset($_POST['oldpass']))
{   $oldsaved='';
    try
    {   
        require('database/connection.php');
        $sql=$db->prepare('select password from users where username=?');
        $sql->execute(array($username)); # I need the username from the session
        $db=null;
        if($row=$sql->fetch(PDO::FETCH_NUM))
        {
            $oldsaved=$row[0];
        }
    }
    catch(PDOException $e)
    {
        die("Error Occured:".$e->getMessage());
    }
    $oldpass=$_POST['oldpass'];
    $newpass=$_POST['newpass'];
    $cnewpass=$_POST['cnewpass'];
    $pattern_password = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[_#@%\*\-.!$^?])[A-Za-z0-9_#@%.!$^\*\-?]{8,24}$/';
     if($oldpass==''||$newpass==''||$cnewpass=='')
     {
        echo "<span style='color:red;font-size:12px;'>Please, fill all the fields properly !</span>" ;
        echo '<style>'; include 'moveUpF.css';'</style>';
        die();
     }

     else if(!password_verify($oldpass, $oldsaved))
     {
        echo "<span style='color:red;font-size:12px;'>Please, enter your old password correctly !</span>" ;
        echo '<style>'; include 'moveUpF.css';'</style>';
        die();
     }
     else if(!preg_match($pattern_password, $newpass)){
         echo "<span style='color:red;font-size:12px;'>Enter a valid new password !</span>" ;
         echo '<style>'; include 'moveUpF.css';'</style>';
         die();
    }
 
     else if($cnewpass != $newpass){
     echo "<span style='color:red;font-size:12px;'>The new password and its confirmation does not match !</span>" ;
     echo '<style>'; include 'moveUpF.css';'</style>';
     die();
     }
    else
    { #try and catch to do update password 
        // echo "<span style='color:green;font-size:111px;'>Password has been updated sccessfully !</span>" ;
        // echo '<style>'; include 'moveUpF.css';'</style>';
        header('location: Profile.php');
        die();
    }
}

?>