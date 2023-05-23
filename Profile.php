<?php
session_start(); # prevent the user to come without premission to profile page (must be added to most pages)
if(!isset($_SESSION['username'])) {
    header("Location: Login.php");
}
try
{   
    require('database/connection.php');
    $sql=$db->prepare('select * from users where username=?');
    $username = $_SESSION['username'];
    $sql->execute(array($username)); # I need the username from the session
    
    if($row=$sql->fetch(PDO::FETCH_NUM))
    {
        $name=$row[2];
        $email=$row[3];
        $code=$row[4];
        $number=$row[5];                        
    }
    $db=null;
}
catch(PDOException $e)
{
die("Error Occured:".$e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/generalstyle.css">
    <link rel="stylesheet" href="css/Profile.css">
<style>
/* .form2
{
    display:block;
} */
</style>

</head>
<body>
    
    <div id="header"> <?php include 'header.html'?> </div>
    <!-- Page content in this external container -->
    <div class="cointainer" id="main">
    <div class="container">
    <div class="outer">
      <div class="inner">
  
        <div class="one">

          <div class="profile-image">
            <h3 style='color:#161853' id="display_name"> <?php echo strtoupper($name);?></h3>
            <p>@<?php echo ucfirst($username)?></p>
            <img src="img/Profile-Image-Trail.jpeg" alt="The profile image should be here" id="profilePicture">
            <label id="profile-label" for="image-file">Update Image</label>
            <input type="file" accept="image/jpeg, image/png, image/jpg" id="image-file">
            <a class="history" href="history.php">View History</a>
            <form method="post">
            <input class="pass_change" type="submit" value='Change Password?' name='pass_change'>
            </form>
          </div>

        </div>
      
        <div class="two">


          <div class="two1">

            <div class="myprofile">
              <h3>My Profile</h3>
            </div>

            <form id="form1" method="post">
              <div class="fullname field">
                <?php 
                echo "<style>";include 'css/moveUp.css'; echo "</style>";
                # select statement
                # write a code here to retrieve the information from the database instead of null in echo isset($_POST['fullname']) ? $_POST['fullname']:null;
                ?>
                <input size="30" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name']:$name;?>" class="input-field"  type="text"  autocomplete="off">
                <label>Name</label>
              </div>

  
              <div class="username field">
                <input size="30" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] :$username;?>" class="input-field"  type="text"  autocomplete="off" >
                <label>User Name</label>
              </div>
  
              <div class="email field">
                <input size="30" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] :$email;?>"  class="input-field"  type="text"  autocomplete="off" >
                <label>Email Address</label>
              </div>
              
              <div class="lastrowform1">

              <div class="phone">
                
                <div class="country">
                  <select id="code" name="code">">
                    
                    <option value="<?php
                    if(isset($_POST['sf1'])&&isset($_POST['code']))
                    {
                        echo $_POST['code'];
                    }
                    else if($code!="")
                    {
                        echo $code;
                    }
                    else
                    {
                        echo "Code";
                    }
                    ?>">
                    <?php
                    if(isset($_POST['sf1'])&&isset($_POST['code']))
                    {
                        echo $_POST['code'];
                    }
                    else if($code!="")
                    {
                        echo $code;
                    }
                    else
                    {
                        echo "Code";
                    }
                    ?></option>
                     
                    <option value="+965">+965</option>
                    <option value="+966">+966</option>
                    <option value="+968">+968</option>
                    <option value="+971">+971</option>
                    <option value="+973">+973</option>
                    <option value="+974">+974</option>
                  </select>
                </div>

                <div class="phone-number field">
                  <input size="30" id="number" name="number" value="<?php echo isset($_POST['number']) ? $_POST['number'] :$number;?>" class="input-field" type="text" autocomplete="off" >
                  <label>Phone number</label>
                </div>

              </div>

              <div class="submitbutton">
                <input name="sf1" type="submit" value="Save Changes">
              </div>

          </div>
          <?php
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
                echo "<span style='color:red;font-size:12px;'>Please, fill all the fields properly !</span>" ;
                echo '<style>'; include 'moveUpF.css';'</style>';
                die();
            } 

             else if($code=="Code")
                {
                echo "<span style='color:red;font-size:12px;'>Please, choose your country code !</span>" ;
                echo '<style>'; include 'moveUpF.css';'</style>';
                die();
                }
        
                else if(!preg_match('/^[a-zA-Z ]{3,30}$/',$name))
                {
                    echo "<span style='color:red;font-size:12px;'>Please, enter your name properly !</span>" ;
                    echo '<style>'; include 'moveUpF.css';'</style>';
                    die();
                }

                else if(!preg_match('/^[a-z0-9.]{4,20}$/',$username))
                {
                    echo "<span style='color:red;font-size:12px;'>Please, enter a valid username!</span>" ;
                    echo '<style>'; include 'moveUpF.css';'</style>';
                    die();
                }
                else if(!preg_match('/^[a-z0-9.-_]+@[a-z0-9.-]+\.[a-z]{2,}$/i',$email))
                {
                    echo "<span style='color:red;font-size:12px;'>Please, enter a valid email format !</span>" ;
                    echo '<style>'; include 'moveUpF.css';'</style>';
                    die();
                }
                else if($code=="+973"){
                 if(!preg_match('/^(3|6)[0-9]{7}$/', $number))
                {
                    echo "<span style='color:red;font-size:12px;'>Please, enter a valid Bahraini phone number !</span>" ;
                    echo '<style>'; include 'moveUpF.css';'</style>';
                    die();
                }
        }
            else if($code!="+973") # general verification for the rest 5 countries
            {
                if(!preg_match('/^[0-9]{8,15}$/',$number))
                {
                    echo "<span style='color:red;font-size:12px;'>Please, enter a valid phone number !</span>" ;
                    echo '<style>'; include 'moveUpF.css';'</style>';
                    die();
                }  

            }
         else # all input are valid => you can update data
        {
            try {
                require('database/connection.php');
                $db->beginTransaction();
                $stmt = $db->prepare("update users set name=?, username=?, email=?,  phoneCode=?, phoneNumber=?  WHERE username=?");
                $stmt->execute(array($name, $username, $email, $code, $number, $_SESSION['username']));
                $db->commit();
                echo "<span style='color:green;font-size:12px;'>Your Data Has Been Updated Successfully.</span>" ;
                echo '<style>'; include 'moveUpF.css';'</style>';
            }
            catch(PDOException $e) {
                $db->rollBack();
                die('Error:'.$e->getMessage());
            }
        } 
           
        } # end of isset check
        ?>  
            </form>
    
          </div>



          <div class="two2">


        

            <form class="form2" id='f2'>
              
              <div id="oldpass" class="pass field"> <input size="30" name='oldpass' type="password"  class="input-field" autocomplete="off">
                <label class="pl">Old Password</label>
              </div>

              <div id="newpass" class="pass field"> <input size="30" name='newpass' type="password"  class="input-field" autocomplete="off" >
                <label class="pl">New Password</label>
              </div>

              <div id="verifynewpass" class="pass field"> <input size="30" name='cnewpass' type="password" class="input-field" autocomplete="off">
                <label class="pl">Verify New Password</label>
              </div>

              <div class="changepass">
                <input id='sf2' type="submit" value="Change Password">
              </div>

            </form>

            <?php
            if(isset($_POST['pass_change']))
            {
                echo "
                <style>
                .form2
                {
                    display: block;
                }
            </style>
                ";
            }
            ?>


            
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
        echo "<span style='color:green;font-size:111px;'>Password has been updated sccessfully !</span>" ;
        echo '<style>'; include 'moveUpF.css';'</style>';
        die();
    }
}

?>


          </div>

        </div>

  
      </div>
    </div>
  </div>


    </div> <!--end of cointainer-->
    <div > <?php include 'footer.html'?> </div>

    
  <script src="javascript/Profile.js"></script>
  <script src="javascript/Common(History and Profile).js"></script>
</body>
</html>