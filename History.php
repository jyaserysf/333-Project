<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/generalstyle.css">
    <link rel="stylesheet" href="css/History.css">
</head>
<body>
    
    <div id="header"> <?php include 'header.html'?> </div>
    <!-- Page content in this container -->
    <div class="cointainer" id="main">
    <div class="container">
    <div class="outer">
      <div class="inner">
  
      <?php
      # sample information
      # save information in associative array when selecting them from the database by a loop
      # the needed information id, surveytitle, firstresponse, secondresponse, category, image of that survey
      # then sort them by date whether latest/oldest according to the button choice of the list then print the array in table 
        $info['1'] = ['surveytitle',date('l, d-m-Y'), date('l, d-m-Y'),'category','img\Customer Survey-amico (1).png'];
        $info['3'] = ['surveytitle',date('l, d-m-Y'), date('l, d-m-Y'),'category','img\Customer Survey-amico (1).png'];
        $info['4'] = ['surveytitle',date('l, d-m-Y'), date('l, d-m-Y'),'category','img\Customer Survey-amico (1).png'];
        $info['5'] = ['surveytitle',date('l, d-m-Y'), date('l, d-m-Y'),'category','img\Customer Survey-amico (1).png'];
        #sort
        $sortby='latest'; 
        if($sortby='latest')
        {
            #sort by latest
        }
        else
        {
            #sort by oldest
        }
      
      ?>
      
        <div class="area1">
            
        </div>

        <div class="area2">
            <table>
                <?php
                
                ?>
            </table>
    
        </div>
      
    </div>
  </div>


    </div> <!--end of cointainer-->
    <div > <?php include 'footer.html'?> </div>

    
  <script src="javascript/Profile.js">
  </script>
</body>
</html>