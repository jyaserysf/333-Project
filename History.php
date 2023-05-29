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
    
    <div id="header"> <?php include 'header.php'?> </div>
    <?php if(!isset($_SESSION['user'])){
        ?><script>
        window.location.href = "Login.php";
        </script><?php
    }?>
    <!-- Page content in this container -->
    <div class="cointainer" id="main">
    <div class="container">
    <div class="outer">
      <div class="inner pt-2 px-2">
  
      <?php
      include ('SortByDate.php');
      # sample information
      # save information in numeric array when selecting them from the database by a loop
      # the needed information surveytitle, firstresponse, lastresponse, category, image of that survey
      # then sort them by date whether latest/oldest according to the button choice of the list then print the array in table
      try
      {
        require('database/connection.php');
        $stmt = $db->prepare("SELECT * FROM participate WHERE userID=?");
        $keys=array_keys($_SESSION['user']);
        $userIDrec=$db->prepare("SELECT userID from users where username=?");
        $userIDrec->execute(array($keys[0]));
        $userID=$userIDrec->fetch()['userID'];
        $stmt->execute(array($userID));
        $db=null;
      }
      catch(PDOException $e)
      {
        die('error:'.$e->getMessage());
      }

      while($participateData=$stmt->fetch())
      {
        $surveyID = $participateData[2];
        $date = $participateData[3];
        try
        {
        require('database/connection.php');
        $stmt1 = $db->prepare("SELECT * FROM surveys WHERE surveyID=?");
        $stmt1->execute(array($surveyID));
        if($surveyInfo=$stmt1->fetch()){
        $Stitle = $surveyInfo[4];
        $Scategory = $surveyInfo[6];
    }
            if($Scategory=='Work')
            {
                $img = 'img\Work.png';
            }
            else
            {
                $img = 'img\Students.jpg';
            }
        $info[] = [$Stitle, $date, $Scategory,$img];
        $db=null;
        }
        catch(PDOException $e)
        {
            die('error:'.$e->getMessage());
        }
      }

        
        if(isset($_POST['oldest']))
            {
                $information=SortOldest($info);
            }
        else # default is latest
            {
                $information=SortLatest($info);
            }
        
      ?>
      
        <div class="area1 row">
            <h1 class="col-lg-9 col-12">Past Surveys</h1> 
            <div class="surveys_no col-lg-1 col-2"><h6><?php if($information!=null)echo count($information); else echo'0';?></h6></div>
            <div class="dropdown col text-end">
            <button class="dropbtn">Sort By</button>
            <div class="dropdown-content">

                <form method="post">
                <a href="#"><input type="submit" value='latest' name='latest'></a>
                <a href="#"><input type="submit" value='oldest' name='oldest'></a>
                </form>

            </div>
            </div>
        </div>

        <div class="area2 row">


                
                <?php
                if($information==null)
                {
                    echo "<h1 style='color: #EC255A'>No surveys available in the history.😕</h1>";
                }
                else{
                    echo
                "<table class='col'>                    
                    <tr>
                    <th>Survey Logo</th>
                    <th>Survey Title</th>
                    <th>Survey Category</th>
                    <th>Submitted On</th>
                    <th>Edit?</th>
                    </tr>";
                    foreach($information as $value)
                    {
                        echo
                        "<tr>
                            <td><img width='50' height='50' src='$value[3]'/></td>
                            <td>$value[0]</td>
                            <td>$value[2]</td>
                            <td>$value[1]</td>
                            <td><a href='answerSurvey.php?survID=$surveyID><span style='' class='material-symbols-outlined'>edit_square</span></a></td>
                            </tr>
                            ";
                    }
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
  <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>