<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/generalstyle.css">
    <!-- <link rel="stylesheet" href="css/Profile.css"> -->
  
  <style>
    .container {
      justify-content: center;
      margin-top: 3rem;
      margin-bottom: 3rem;
    }

    .inner {
      background-color: rgba(255, 255, 255, 0.65);
      padding: 2rem;
      border: solid 1px rgba(211, 214, 219, 0.7);
      border-radius: 20px;
      margin: 0 auto;
    }

    .form-group {
      margin-bottom: 0.8rem;
      display: flex;
      flex-direction: row;
    }

    label {
      margin-bottom: 0.55rem;
      font-size: 1rem;
      color: rgba(0, 0, 0, 0.55);
    }

    input {
      color: rgba(0, 0, 0, 0.7);
    }

    .myprofile {
      color: rgba(0, 0, 0, 0.7);
      margin-bottom: 2rem;
    }

    #profilePicture {
      width: 9.5rem;
      margin: 1rem 0;
    }

    #profileUserName {
      font-size: 1.3rem;
      color: rgba(0, 0, 0, 0.7);
    }

    .btn-primary {
      background-color: #292C6D/*#161853*/;
      color: #fff;
      border: 1px solid;
      border-radius: 5px;
      padding: 6px 10px;
      text-decoration:none;
      transition: 0.2s;
    }

    .btn-primary:hover {
      background-color: #fff;
      color: #292C6D;
      border: 1px solid;
      transition: 0.2s;
    }

    #input-area {
      background: none;
      font-size: 0.95rem;
      transition: 0.4s;
      color: rgba(0, 0, 0, 0.7);
      margin-left: 2rem;
    }

    #profilePictureArea {
      margin-bottom: 2rem;
    }

    #upload-img-div {
      margin-bottom: 2rem;
    }

    .submitArea {
      float: left;
      margin-top: 0.5rem;
    }

    form{
      margin-bottom:10px;
    }

    #code{
      padding: 6px;
      border-radius: 5px;
      border-color:#292C6D;
      color:#292C6D;
      background-color: rgba(255, 255, 255, 0.65);
      width: 4.65rem;
      float: left;
    }

    #number {
      border-radius:5px;
    }

    #myProfile-container {
      background-color: rgba(250, 237, 240, 0.1);
      padding: 2rem;
      border: solid 1px rgba(211, 214, 219, 0.7);
      border-radius: 20px;
      margin: 0 auto;
    }

    #display_name {
      margin-top: 0.85rem;
    }

    #space {
      margin: 7rem 0 7rem 0;
    }

    #image-file {
      display: none;
    }

    .btn-changePicture {
      background: none;
      color: #292C6D;
      border: 1px solid;
      border-radius: 5px;
      padding: 6px 10px;
      text-decoration:none;
      cursor: pointer;
    }

    .btn-changePicture:hover {
      background-color: #292C6D;
      color:#fff;
      transition: 0.2s;
    }

  </style>

</head>
<body>
  
  <div id="header"> 
    <?php include 'header.php';

    try { 
      require('database/connection.php');
      $sql=$db->prepare('select * from users where username=?');
      $username = key($_SESSION['user']);
      $sql->execute(array($username)); # I need the username from the session
      
      if($row=$sql->fetch(PDO::FETCH_NUM)) {
        $name=$row[2];
        $email=$row[3];
        $code=$row[4];
        $number=$row[5];                        
      }
      $db=null;
    } catch(PDOException $e) {
      die("Error Occured:".$e->getMessage());
      }
    ?> 
  </div> <!-- end of try catch for displaying profile information -->

  <!-- Page content in this external container -->
  <div class="container" id="main">
    <div class="outer">
      
      <div class="inner row">
        
        <div class="one col-lg-5 col-md-12 mb-4  ">
          <div class="profile-image ps-5 d-flex flex-column justify-content-center">
  
            <div id="profilePictureArea" class="col-12">
              <h3 style='color:rgba(0, 0, 0, 0.7)' id="display_name"> <?php echo strtoupper($name);?></h3>
              <p id="profileUserName">@<?php echo ucfirst($username)?></p>
              <img src="img/undraw_male_avatar.svg" alt="The profile image should be here" id="profilePicture">
            </div>
            
            <div class="row">
              
              <div class="col-10" id="upload-img-div">
                <input type="button" class="btn-changePicture" for-="image-file" value="Change Picture" onclick="changePicture()">
                <input type="file" accept="image/jpeg, image/png, image/jpg" id="image-file" class="form-control w-75">
              </div>
             
              <div class="col">
                <a class="history btn-primary" href="History.php">View History</a>
              </div>

            </div> 
          </div>
        </div>
          
        <div class="two col-lg-7 col-md-12 pt-md-3" id="myProfile-container">
          
          <div class="two1 row">
           
            <div class="myprofile">
              <h3>My Profile</h3>
            </div>

            <form id="form1" method="post">
              <?php 
              echo "<style>";include 'css/moveUp.css'; echo "</style>";
              # select statement
              # write a code here to retrieve the information from the database instead of null in echo isset($_POST['fullname']) ? $_POST['fullname']:null;
              ?>
              
              <div class="form-group col-11">
                <label class="col-3">Name</label>
                <input size="30" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name']:$name;?>"   type="text"  autocomplete="off" class="form-control" id="input-area">
              </div>
              

              <div class="form-group col-11">
                <label class="col-3">User Name</label>
                <input size="30" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] :$username;?>"  type="text"  autocomplete="off" class="form-control" id="input-area">
              </div>
        
              <div class="form-group col-11">
                <label class="col-3" id="lable">Email Address</label>
                <input size="30" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] :$email;?>"  type="text"  autocomplete="off" class="form-control" id="input-area">
              </div>
              
                <div class="phone col-11" id="phoneNO">
                <div class="row d-flex flex-wrap align-items-center">
                  <label class="col-4" for="phoneNO" class="">Phone number</label>
                  <div class="country col-lg-1 col-3">
                        <select id="code" name="code" class="button mb-3">
                          <option value="
                          <?php
                            if  (isset($_POST['sf1'])&&isset($_POST['code'])) {
                              echo $_POST['code'];
                            }
                            else if ($code!="") {
                              echo $code;
                            }
                            else  {
                              echo "Code";
                            }
                          ?>">
                          <?php
                            if  (isset($_POST['sf1'])&&isset($_POST['code'])) {
                              echo $_POST['code'];
                            }
                            else if($code!="")  {
                              echo $code;
                            }
                            else  {
                              echo "Code";
                            }
                          ?>
                          </option>
                                
                          <option value="+965">+965</option>
                          <option value="+966">+966</option>
                          <option value="+968">+968</option>
                          <option value="+971">+971</option>
                          <option value="+973">+973</option>
                          <option value="+974">+974</option>
                        </select>
                      </div>
                    <div class="form-group col input-group">
                      <input size="30" name="number" value="<?php echo isset($_POST['number']) ? $_POST['number'] :$number;?>" type="text" autocomplete="off" class="form-control" id="input-area">
                    </div>
                  </div>
                </div>

                <div class="submitArea col-7">
                 <input name="sf1" type="submit" value="Save Changes" class="btn btn-primary">
                </div>

                <div id="space"></div>
             
                
              <?php
              include('test_input.php');
              
              if (isset($_POST['sf1'])) {
                $name = test_input($_POST['name']); 
                $name=ucfirst($name); 
                $username = test_input($_POST['username']); 
                $username = strtolower($username);
                $email = test_input($_POST['email']); 
                $code = $_POST['code']; 
                $number = test_input($_POST['number']);
                
                if($name==""||$username==""||$email==""||$number=="") {
                  echo "<span style='color:red;font-size:12px;'>Please, fill all the fields properly !</span>" ;
                  echo '<style>'; include 'moveUpF.css';'</style>';
                  die();
                } 
                else if ($code=="Code") {
                  echo "<span style='color:red;font-size:12px;'>Please, choose your country code !</span>" ;
                  echo '<style>'; include 'moveUpF.css';'</style>';
                  die();
                }
                else if (!preg_match('/^[a-zA-Z ]{3,30}$/',$name)) {
                  echo "<span style='color:red;font-size:12px;'>Please, enter your name properly !</span>" ;
                  echo '<style>'; include 'moveUpF.css';'</style>';
                  die();
                }
                else if (!preg_match('/^[a-z0-9.]{4,20}$/',$username)) {
                  echo "<span style='color:red;font-size:12px;'>Please, enter a valid username!</span>" ;
                  echo '<style>'; include 'moveUpF.css';'</style>';
                  die();
                }
                else if(!preg_match('/^[a-z0-9.-_]+@[a-z0-9.-]+\.[a-z]{2,}$/i',$email)) {
                  echo "<span style='color:red;font-size:12px;'>Please, enter a valid email format !</span>" ;
                  echo '<style>'; include 'moveUpF.css';'</style>';
                  die();
                }
                else if($code=="+973" && !preg_match('/^(3|6)[0-9]{7}$/', $number)) {
                  echo "<span style='color:red;font-size:12px;'>Please, enter a valid Bahraini phone number !</span>" ;
                  echo '<style>'; include 'moveUpF.css';'</style>';
                  die();
                }
                # general verification for the rest 5 countries
                else if($code!="+973" && !preg_match('/^[0-9]{8,15}$/',$number)) { 
                  echo "<span style='color:red;font-size:12px;'>Please, enter a valid phone number !</span>" ;
                  echo '<style>'; include 'moveUpF.css';'</style>';
                  die();
                }
                # all input are valid => you can update data
                else {
                  try {
                  require('database/connection.php');
                  $db->beginTransaction();
                  $stmt = $db->prepare("update users set name=?, username=?, email=?,  phoneCode=?, phoneNumber=?  WHERE username=?");
                  $stmt->execute(array($name, $username, $email, $code, $number,  key($_SESSION['user'])));
                  $db->commit();
                  echo "<span style='color:green;font-size:12px;'>Your Data Has Been Updated Successfully.</span>" ;
                  echo '<style>'; include 'moveUpF.css';'</style>';
                  } catch(PDOException $e) {
                      $db->rollBack();
                      die('Error:'.$e->getMessage());
                    }
                } 
              } # end of isset check
              ?>  
            </form>
          </div>

          <div class="two2 row">
            
            <form method='post' class="form2" id='f2'>
              
              <div class="form-group col-11" id="oldpass" class="pass">
                <label class="col-3" class="pl">Old Password</label>
                <input size="30" name='oldpass' type="password" autocomplete="off" class="form-control" id="input-area">
              </div>
              
              <div class="form-group col-11" id="newpass" class="pass">
                <label class="col-3" class="pl">New Password</label>
                <input size="30" name='newpass' type="password" autocomplete="off" class="form-control" id="input-area">
              </div>

              <div class="form-group col-11" id="verifynewpass" class="pass">
                <label class="col-3" class="pl">Verify New Password</label>
                <input size="30" name='cnewpass' type="password" autocomplete="off" class="form-control" id="input-area">
              </div>

              <div class="submitArea col-7">
                <input id='sf2' type="submit" value="Change Password" class="btn btn-primary">
              </div>

            </form>
            
            <?php
            if (isset($_POST['pass_change'])) {
              echo "<style>.form2 {display: block;}</style>";
            }
            ?>
     
            <?php
            if(isset($_POST['oldpass'])) {
              $oldsaved='';
              try {   
                require('database/connection.php');
                $sql=$db->prepare('select password from users where username=?');
                $sql->execute(array(key($_SESSION['user']))); 
                $db=null;
                if($row=$sql->fetch(PDO::FETCH_ASSOC)) {
                    $oldsaved=$row['password'];
                }
              } catch(PDOException $e) {
                die("Error Occured:".$e->getMessage());
                }
              
              $oldpass=$_POST['oldpass'];
              $newpass=$_POST['newpass'];
              $cnewpass=$_POST['cnewpass'];
              $pattern_password = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[_#@%\*\-.!$^?])[A-Za-z0-9_#@%.!$^\*\-?]{8,24}$/';
              
              if ($oldpass==''||$newpass==''||$cnewpass=='') {
                echo "<span style='color:red;font-size:12px;'>Please, fill all the fields properly !</span>" ;
              }
              else if (!password_verify($oldpass, $oldsaved)) {
                echo "<span style='color:red;font-size:12px;'>Please, enter your old password correctly !</span>" ;
              } else if(!preg_match($pattern_password, $newpass)) {
                echo "<span style='color:red;font-size:12px;'>Enter a valid new password !</span>" ;
              }
              else if($cnewpass != $newpass) {
                echo "<span style='color:red;font-size:12px;'>The new password and its confirmation does not match !</span>" ;
              }
              else { 
                #try and catch to do update password 
                $passToUpdate = password_hash($cnewpass,PASSWORD_DEFAULT);
                
                try {
                  require('database/connection.php');
                  $db->beginTransaction();
                  $stmt = $db->prepare("update users set password=? WHERE username=?");
                  $stmt->execute(array($passToUpdate, key($_SESSION['user'])));
                  $db->commit();
                  echo "<span style='color:green;font-size:16px;'>Password has been updated sccessfully !</span>" ;
                } catch(PDOException $e) {
                  $db->rollBack();
                  die('Error:'.$e->getMessage());
                  }
              }
            }
            ?>

          </div>
        </div> 
      </div>
    </div> <!-- outer -->
  </div> <!--end of cointainer-->
  
  <div > <?php include 'footer.html'?> </div>

  <script src="javascript/Profile.js"></script>
  <script src="javascript/Common(History and Profile).js"></script>
  <script>
    function changePicture() {
      // Display the image-file input
      document.getElementById("image-file").style.display = "block";
    }
  </script>
</body>
</html>