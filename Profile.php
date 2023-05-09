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
                <?php if(isset($_POST['fullname'])||isset($_POST['role'])||isset($_POST['username'])||isset($_POST['email'])||isset($_POST['number']))
                         echo
                        '<style>
                         .field label{
                         font-size: 0.69rem;
                         top:-45%;
                         transform: translateX(-10%);
                         color: #4be01a;
                         font-weight: bold;
                         transition-duration: 0.45s;
                         }
                         </style>';

                ?>
                <input size="30" name="fullname" value="<?php echo isset($_POST['fullname']) ? $_POST['fullname']:null;?>" class="input-field"  type="text"  autocomplete="off">
                <label>Full Name</label>
              </div>
  
              <div class="role field">
                <input size="30" name="role" value="<?php echo isset($_POST['role']) ? $_POST['role'] : null;?>" class="input-field"  type="text"  autocomplete="off">
                <label>Role</label>
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
                    if(isset($_POST['sf1'])&&$_POST['code']!='Code'){$cc=explode('#',$_POST['code'])[0]; $cn=explode('#',$_POST['code'])[1];
                        echo $cn.'#'.$cc;
                      } 
                      else{echo 'Code';}
                    ?>">
                    <?php
                    if(isset($_POST['sf1'])&&$_POST['code']!='Code'){
                        echo explode('#',$_POST['code'])[1];
                      } 
                      else{echo 'Code';}
                    ?></option>
                     
                    <option value="Kuwait#+965">+965</option>
                    <option value="Saudi-Arabia#+966">+966</option>
                    <option value="Oman#+968">+968</option>
                    <option value="United Arab Emirates#+971">+971</option>
                    <option value="Bahrain#+973">+973</option>
                    <option value="Qatar#+974">+974</option>
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
        if(isset($_POST['sf1']))
        {
            $fullname = $_POST['fullname']; 
            $role = $_POST['role']; 
            $username = $_POST['username']; 
            $email = $_POST['email']; 
            $code = $_POST['code']; 
            $number = $_POST['number'];
            if(trim($fullname)==""||trim($role)==""||trim($username)==""||trim($email)==""||trim($number)=="")
            {
                echo "<span style='color:red;font-size:12px;'>Please, fill all the fields !</span>" ;
                echo "
                <style>
                .field{
                    margin-bottom:2%;
                }
                </style>
                ";
               
            } 

             else if(trim($code)=="Code")
                {
                echo "<span style='color:red;font-size:12px;'>Please, choose your country code !</span>" ;
                    echo "<style>
                    .field{
                        margin-bottom:2%;
                    }
                    </style>
                    ";
                }
        }
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