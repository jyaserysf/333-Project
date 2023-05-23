<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/generalstyle.css">
    <link rel="stylesheet" href="css/History.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <style>
</style>
</head>
<body>
    
    <div id="header"> <?php include 'header.html'?> </div>
    <!-- Page content in this container -->
    <div class="cointainer" id="main">
    <div class="container">
    <div class="outer">
      <div class="inner">
  
      <?php
      include ('SortByDate.php');
      # sample information
      # save information in numeric array when selecting them from the database by a loop
      # the needed information surveytitle, firstresponse, lastresponse, category, image of that survey
      # then sort them by date whether latest/oldest according to the button choice of the list then print the array in table
        $d1=mktime(0,0,0,date('m'),date('d')+23,date('y'));
        $d2=mktime(0,0,0,date('m'),date('d')-23,date('y'));
        $info[] = ['surveytitle', date('l, d-m-Y'), date('l, d-m-Y'),'category','img\Customer Survey-amico (1).png'];
        $info[] = ['surveytitle', date('l, d-m-Y'), date('l, d-m-Y',$d1),'category','img\Customer Survey-amico (1).png'];
        $info[] = ['surveytitle', date('l, d-m-Y'), date('l, d-m-Y',$d2),'category','img\Customer Survey-amico (1).png'];
        $info[] = ['surveytitle', date('l, d-m-Y'), date('l, d-m-Y'),'category','img\Customer Survey-amico (1).png'];
        #sort
        
        if(isset($_POST['oldest']))
            {
                $information=SortOldest($info);
            }
        else # default is latest
            {
                $information=SortLatest($info);
            }
        
      ?>
      
        <div class="area1">
            <h1>Past Surveys</h1> 
            <div class="surveys_no"><h6>313</h6></div>
            <div class="dropdown">
            <button class="dropbtn">Sort By</button>
            <div class="dropdown-content">

                <form method="post">
                <a href="#"><input type="submit" value='latest' name='latest'></a>
                <a href="#"><input type="submit" value='oldest' name='oldest'></a>
                </form>

            </div>
            </div>
        </div>

        <div class="area2">
            <table>
                <tr>
                <th>Survey Logo</th>
                <th>Survey Title</th>
                <th>Survey Category</th>
                <th>First Response</th>
                <th>Last Edit</th>
                <th>Edit?</th>
                </tr>

                <?php
                foreach($information as $value)
                {
                    echo
                    "<tr>
                     <td><img width='50' height='50' src='$value[4]'/></td>
                     <td>$value[0]</td>
                     <td>$value[3]</td>
                     <td>$value[1]</td>
                     <td>$value[2]</td>
                     <td><a href='#'><span style='background-color:#161853' class='material-symbols-outlined'>edit_square</span></a></td>
                     </tr>
                     ";
                }

                ?>
            </table>
    
        </div>
      
    </div>
  </div>


    </div> <!--end of cointainer-->
    <div > <?php include 'footer.html'?> </div>

    
  <script src="javascript/Common(History and Profile).js">
  </script>
</body>
</html>