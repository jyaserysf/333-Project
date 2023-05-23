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
    <title>Document</title>
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
            <form method="post" action="profile-e3.php">
            <input class="pass_change" type="submit" value='Change Password?' name='pass_change'>
            </form>
          </div>

        </div>
      
        <div class="two">


          <div class="two1">

            <div class="myprofile">
              <h3>My Profile</h3>
            </div>

            <form id="form1" method="post" action="profile-e1.php">
              <div class="fullname field">
                <?php 
                echo "<style>";include 'css/moveUp.css'; echo "</style>";
                # select statement
                # write a code here to retrieve the information from the database instead of null in echo isset($_POST['fullname']) ? $_POST['fullname']:null;
                ?>
                <input size="30" name="name" value="<?php echo $name;?>" class="input-field"  type="text"  autocomplete="off">
                <label>Name</label>
              </div>

  
              <div class="username field">
                <input size="30" name="username" value="<?php echo $username;?>" class="input-field"  type="text"  autocomplete="off" >
                <label>User Name</label>
              </div>
  
              <div class="email field">
                <input size="30" name="email" value="<?php echo $email;?>"  class="input-field"  type="text"  autocomplete="off" >
                <label>Email Address</label>
              </div>
              
              <div class="lastrowform1">

              <div class="phone">
                
                <div class="country">
                  <select id="code" name="code">">
                    
                    <option value="<?php
                    if($code!="")
                    {
                        echo $code;
                    }
                    else
                    {
                        echo "Code";
                    }
                    ?>">
                    <?php
                    if($code!="")
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
                  <input size="30" id="number" name="number" value="<?php echo $number;?>" class="input-field" type="text" autocomplete="off" >
                  <label>Phone number</label>
                </div>

              </div>

              <div class="submitbutton">
                <input name="sf1" type="submit" value="Save Changes">
              </div>

          </div>
          <?php
          include('test_input.php');
          ?>  
            </form>
          </div>



          <div class="two2">

            <form class="form2" id='f2' action="profile-e2.php">
              
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