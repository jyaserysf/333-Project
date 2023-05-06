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
    <!-- Page content in this container -->
    <div class="cointainer" id="main">
    <div class="container">
    <div class="outer">
      <div class="inner">
  
        <div class="one">

          <div class="profile-image">
            <h3 id="display_name"> MUNTADHER ALMUTAWAJ</h3>
            <p>@Almutawaj</p>
            <img src="img/Profile-Image-Trail.jpeg" alt="The profile image should be here" id="profilePicture">
            <label id="profile-label" for="image-file">Update Image</label>
            <input type="file" accept="image/jpeg, image/png, image/jpg" id="image-file">
          </div>

        </div>
      
        <div class="two">


          <div class="two1">

            <div class="myprofile">
              <h3>My Profile</h3>
            </div>

            <form id="form1" action="">
              <div class="firstname field">
                <input size="30" id="firstname" class="input-field"  type="text" minlength="4" autocomplete="off" required >
                <label>First Name</label>
              </div>
  
              <div class="lastname field">
                <input size="30" id="lastname" class="input-field"  type="text" minlength="4" autocomplete="off" required >
                <label>Last Name</label>
              </div>
  
              <div class="username field">
                <input size="30" id="username" class="input-field"  type="text" minlength="4" autocomplete="off" required >
                <label>User Name</label>
              </div>
  
              <div class="email field">
                <input size="30" id="email"  class="input-field"  type="email" minlength="4" autocomplete="off" required >
                <label>Email Address</label>
              </div>
              
              <div class="lastrowform1">

              <div class="phone">
                
                <div class="country">
                  <select id="code">
                    <option value="Not chosed">Code</option>
                    <option value="Kuwait">+965</option>
                    <option value="Saudi-Arabia">+966</option>
                    <option value="Oman">+968</option>
                    <option value="United Arab Emirates">+971</option>
                    <option value="Bahrain">+973</option>
                    <option value="Qatar">+974</option>
                  </select>
                </div>

                <div class="phone-number field">
                  <input size="30" id="number" class="input-field" type="text" minlength="8" autocomplete="off" >
                  <label>Phone number</label>
                </div>

              </div>

              <div class="submitbutton">
                <input name="sf1" type="submit" value="Save Changes">
              </div>

          </div>
              
            </form>
           
          </div>


          <div class="two2">



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
      
        <div class="three">
      
        </div>
  
      </div>
    </div>
  </div>


    </div> <!--end of cointainer-->
    <div > <?php include 'footer.html'?> </div>

    
  <script src="Profile.js">
  </script>
</body>
</html>