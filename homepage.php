<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/generalstyle.css">
    <link rel="stylesheet" href="css/homepageStyle.css">
    
   
</head>
<body>
    <div id="header"> <?php include 'header.php'?> </div>
    <!-- Page content in this container -->
    <div class="cointainer " id="main">
        <div class="seperate">
            <hr>
        </div>
         
        <div class="top-display d-flex justify-content-center
         ">
            
            <div class="displaysection d-flex flex-column align-items-center justify-content-center m-5" id="tagline">
             <h1 class=" text-center"> Your <span style="color:#EC255A">No.1 </span> source for surveys and questionnaires </h1>
             <div> 
                <?php 
                if(!isset($_SESSION['user'])){?>

                    <h2 class="mb-4 text-center"> Create an account now! </h2> 
                    <div class="d-grid gap-2 col-6 mx-auto my-2">
                        <button class="btn p-2 create" type="button"> <a href="Signup.php">Register </a></button>
                    </div>
                <?php 
                }?>
             </div>
            </div>
            <div class="displaysection flex-grow-2 me-5 p-2" id="displayImg">
            <img src="img\Customer Survey-amico.svg" width=450px  >
            </div>
        </div> 
    
   
    
    <div id="explore">
    
        <div class="container pb-5 my-4">
            <div class="row position-relative">
                <div class="col-6 mb-5">
                    <h2 class="mb-3"> Explore </h2>
                </div>
                <div class="col-6 text-end   position-absolute top-0 end-0 ">
                    <a type="button" class="btn mb-3 mr-1" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                        </svg>
                    </a>
                    <a type="button" class="btn  mb-3 " href="#carouselExampleIndicators2" role="button" data-slide="next">

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                    </a>
                </div>
                <div class="row"> 
                <div class="col ">
                    <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">

                        <div class="carousel-inner">
                            <!-- this should be done with php -->
                            <?php
                                echo "<div class='carousel-item active'>
                                    <div class='row cardrow'>";
                                         
                                        try{
                                            require('database/connection.php');
                                            $surveysrec=$db->prepare("SELECT * from surveys");
                                            $surveysrec->execute();
                                            $surveys=$surveysrec->fetchAll();
                                            $db=null;
                                            //print_r($surveys);
                                            foreach($surveys as $surv){
                                                // create form for button and hidden input then redirect to displaySu
                                            echo "<div class='col-lg-3 col-md-4 col-sm-8 mb-3'>
                                                <div class='card '>
                                                   
                                                    <div class='card-details'>";
                                                      echo"  <p class='text-title'>".$surv['title']."</p>
                                                        <p class='text-body'>".$surv['description']."</p>
                                                    </div>
                                                    <form action='displaySurvey.php' method='POST'>
                                                        <input type='hidden' id='surveyID' name='svID' value='".$surv['surveyID']."'>
                                                        <button class='card-button' name='startSurv' type='submit'>Answer</button>
                                                    </form>
                                            
                                                </div>
                                            </div> ";
                                            }
                                    echo "</div>
                                </div>
                            
                            <div class='carousel-item '>
                                <div class='row cardrow'>";

                                 for($i=0; $i<4; $i++){
                                       echo" <div class='col-lg-3 col-md-4 col-sm-8 mb-3'>
                                            <div class='card '>
                                                 
                                                <div class='card-details'>
                                                    <p class='text-title'>Card title</p>
                                                    <p class='text-body'>Here are the details of the card</p>
                                                </div>
                                                <form action='displaySurvey.php' method='POST'>
                                                <input type='hidden' id='surveyID' value='surveyID'>
                                                <button class='card-button'  name='startSurv' type='submit'>Answer</button>
                                                </form>
                                            </div>
                                        </div>";
                                         } 

                              echo "  </div>
                            </div>";
                        }catch(PDOException $e){
                                            
                            die($e->getMessage());
                                        
                            }?>
                            <!--end of carousel item  -->
                        </div> <!--end of carousel inner  -->
                    </div> <!--end of carousel ID  -->
                </div>
                </div> 
                <div class="text-end morelink" >
                    <a class="link-opacity-75 link-underline-opacity-0" href="explorepage3.php">More</a>
                </div>
            </div><!--end of row  -->

        </div>

    </div>
    <div id="pastsurvey">
        <div class="container pb-5 my-4">
            <div class="row">
                <div class="col-12 mb-5">
                    <h2 class="mb-3"> Past Surveys </h2>
                </div>
                <div class="row  d-flex flex-column align-items-center justify-content-center surveydisplay text-center ">
                    
                <?php if(!isset($_SESSION['user'])) { ?>
                    <!-- if no sign up/login -->
                    <div class="col " style="font-size: 1.5rem">
                        Please <a href="Login.php"> Login </a> to see your past surveys!
                    </div>
                    <div class="col " style="font-size: 1.25rem">
                        Don't have an account? <a href="Signup.php">Register now!</a>
                    </div>
                <?php 
                }
                else {
                    try {
                        require('database/connection.php');
                        $userSQL = $db->prepare("SELECT userID FROM users WHERE username=?");
                        $keys = array_keys($_SESSION['user']);
                        $userSQL->execute(array($keys[0]));
                        if($userID = $userSQL->fetch()) {
                            $stmt = $db->prepare("SELECT *
                                FROM participate
                                WHERE participateID IN (
                                SELECT MAX(participateID)
                                FROM participate
                                WHERE userID=?
                                GROUP BY surveyID
                            )
                            ORDER BY participateID DESC;
                            ");
                            //$stmt = $db->prepare("SELECT * FROM participate WHERE userID=? ORDER BY participate ID DESC");
                            $stmt->execute(array($userID['userID']));
                        }
                        $db=null;
                    }
                    catch(PDOException $e) {
                        die("Error: " . $e->getMessage());
                    }

                    if($stmt->rowCount() > 0) {
                        echo '<div class="col">';
                        echo '<div class="row cardrow">';
                        $i=0;
                        while($row=$stmt->fetch()) {

                            if($i > 4)
                                break;
                            try {
                                require('database/connection.php');
                                $pastSurveysSQL = $db->prepare("SELECT * FROM surveys WHERE surveyID=?");
                                $pastSurveysSQL->execute(array($row['surveyID']));
                                if($surveyInfo=$pastSurveysSQL->fetch()) {
                                    $title = $surveyInfo['title'];
                                    $desc = $surveyInfo['description'];
                                } 
                                $i++;
                                $db=null;
                            }
                            catch(PDOException $e) {
                                die("Error: " . $e->getMessage());
                            }
                            ?>
                            <!-- user taken surveys : only most recent ones -->
                                    <div class="col-lg-3 col-md-4 col-sm-8 mb-3">
                                            <div class="card ">
                                                <div class="card-details">
                                                    <p class="text-title"><?php echo $title ?></p>
                                                    <p class="text-body"><?php echo $desc ?></p>
                                                </div>
                                                <form action='answerSurvey.php' method='get'>
                                                <!-- <input type="hidden" id="surveyID" <?php echo "value=".$row['surveyID']; ?> > -->
                                                <button class="card-button" name='survID' <?php echo "value=".$row['surveyID']; ?> type='submit'> Edit Response </button>
                                            </form>
                                            </div>
                                    </div>
                        <?php
                        }
                        echo '</div></div>';
                    }

                    else {
                    ?>
                        <!-- if new user -->
                    <div class="col" style="font-size: 1.5rem">
                       Welcome to <span style="color: #EC255A" style="text-decoration:"> SurveySphere</span>! 
                    </div>
                    <div class="col " style="font-size: 1.25rem">
                        You haven't taken any survey yet. <a href="#explore" style="font-size: 1.25rem">Explore</a> our surveys!
                    </div>
                <?php }
                } 
                ?>
               
                </div>
            </div>
        </div>

    </div>
    </div>
    <div > <?php include 'footer.html'?> </div>


    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    
</body>
</html>