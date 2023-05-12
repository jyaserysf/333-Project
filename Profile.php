<?php
/*session_start(); # open it later to prevent the user to come without premission to profile page (should be added most to all pages)
if(!isset($_SESSION['user'])) {
    header("location: Login.php");
    die();
}*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/generalstyle.css">
    <link rel="stylesheet" href="css/Profile.css">


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
            <h3 style='color:#161853' id="display_name"> MUNTADHER ALMUTAWAJ</h3>
            <p>@Almutawaj</p>
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
                # select statement
                # write a code here to retrieve the information from the database instead of null in echo isset($_POST['fullname']) ? $_POST['fullname']:null;
                # instead of all the below if statement make the style directly printed (No need for if statement because the data of the user must be placed in the fields initially)
                if(isset($_POST['firstname'])||isset($_POST['lastname'])||isset($_POST['username'])||isset($_POST['email'])||isset($_POST['number']))
                        { echo"<style>";include 'css/moveUp.css'; echo "</style>";}
                ?>
                
                <input size="30" name="firstname" value="<?php echo isset($_POST['firstname']) ? $_POST['firstname']:"place it here from the database";?>" class="input-field"  type="text"  autocomplete="off">
                <label>First Name</label>
              </div>
  
              <div class="role field">
                <input size="30" name="lastname" value="<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : null;?>" class="input-field"  type="text"  autocomplete="off">
                <label>Last Name</label>
              </div>
  
              <div class="username field">
                <input size="30" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] :null;?>" class="input-field"  type="text"  autocomplete="off" >
                <label>User Name</label>
              </div>
  
              <div class="email field">
                <input size="30" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] :null;?>"  class="input-field"  type="text"  autocomplete="off" >
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
                  <input size="30" id="number" name="number" value="<?php echo isset($_POST['number']) ? $_POST['number'] :null;?>" class="input-field" type="text" autocomplete="off" >
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
            $firstname = test_input($_POST['firstname']); 
            $firstname=ucfirst($firstname); 
            $lastname = test_input($_POST['lastname']);
            $lastname=ucfirst($lastname);
            $username = test_input($_POST['username']); 
            $username = strtolower($username);
            $email = test_input($_POST['email']); 
            $code = test_input($_POST['code']); 
            $number = test_input($_POST['number']);
            if($firstname==""||$lastname==""||$username==""||$email==""||$number=="")
            {
                echo "<span style='color:red;font-size:12px;'>Please, fill all the fields properly !</span>" ;
                echo "
                <style>
                .field{
                    margin-bottom:2%;
                }
                </style>
                ";
                die();
            } 

             else if($code=="Code")
                {
                echo "<span style='color:red;font-size:12px;'>Please, choose your country code !</span>" ;
                    echo "<style>
                    .field{
                        margin-bottom:2%;
                    }
                    </style>
                    ";
                die();
                }
        
                else if(!preg_match('/^[a-zA-Z]{3,15}$/',$firstname))
                {
                    echo "<style>
                    .field{
                        margin-bottom:2%;
                    }
                    </style>
                    ";
                    echo "<span style='color:red;font-size:12px;'>Please, enter your firstname properly !</span>" ;
                    die();
                }
                else if(!preg_match('/^[a-z]{3,15}$/i',$lastname))
                {
                    echo "<style>
                    .field{
                        margin-bottom:2%;
                    }
                    </style>
                    ";
                    echo "<span style='color:red;font-size:12px;'>Please, enter your lastname properly !</span>" ;
                die();
                }
                else if(!preg_match('/^[a-z0-9.]{4,20}$/',$username))
                {
                    echo "<style>
                    .field{
                        margin-bottom:2%;
                    }
                    </style>
                    ";
                    echo "<span style='color:red;font-size:12px;'>Please, enter a valid username!</span>" ;
                die();
                }
                else if(!preg_match('/^[a-z0-9.-_]+@[a-z0-9.-]+\.[a-z]{2,}$/i',$email))
                {
                    echo "<style>
                    .field{
                        margin-bottom:2%;
                    }
                    </style>
                    ";
                    echo "<span style='color:red;font-size:12px;'>Please, enter a valid email format !</span>" ;
                die();
                }
                else if($code=='+973'){
                 if(!preg_match('/^(3|6)[0-9]{7}$/', $number))
                {
                    echo "<style>
                    .field{
                        margin-bottom:2%;
                    }
                    </style>
                    ";
                    echo "<span style='color:red;font-size:12px;'>Please, enter a valid Bahraini phone number !</span>" ;
                die();
            }
        }
            else if($code!='+973') # general verification for the rest 5 countries
            {
                if(!preg_match('/^[0-9]{8,15}$/',$number))
                {
                    echo "<style>
                    .field{
                        margin-bottom:2%;
                    }
                    </style>
                    ";
                    echo "<span style='color:red;font-size:12px;'>Please, enter a valid phone number !</span>" ;
                die();

            }  

        }
         else # all input are good => you can update data
        {
            try {
                require('database/connection.php');
                $stmt = $db->prepare("UPDATE users SET fullname=?, role=?, username=?, email=?, number=?, code=?  WHERE username= ?");
                $stmt->execute(array($fullname, $role, $username, $email, $number, $code, $_SESSION['user']));
                $db=null;
                header("location: Profile.php");
            }
            catch(PDOException $e) {
                die($e->getMessage());
            }
        } 

        } # end of isset check
        ?>  
            </form>
    
          </div>





          <div class="two2">


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


            <form class="form2" action="">
              
              <div id="oldpass" class="pass field"> <input size="30" type="password" minlength="4" class="input-field" autocomplete="off" required>
                <label class="pl">Old Password</label>
              </div>

              <div id="newpass" class="pass field"> <input size="30" type="password" minlength="4" class="input-field" autocomplete="off" required>
                <label class="pl">New Password</label>
              </div>

              <div id="verifynewpass" class="pass field"> <input size="30" type="password" minlength="4" class="input-field" autocomplete="off" required>
                <label class="pl">Verify New Password</label>
              </div>

              <div class="changepass">
                <input type="submit" name="sf2" value="Change Password">
              </div>

            </form>



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