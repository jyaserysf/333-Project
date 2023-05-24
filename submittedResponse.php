<?php

var_dump($_POST);
//print_r($_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/generalstyle.css">
</head>
<body>

    <div id="header"> <?php include 'header.php'?> </div>
    <!-- Page content in this container -->
    <div class="cointainer" id="main">
        <div class='container' id='displaySurvey'>
            <!-- <div> <h3> Hi </h3></div> -->
            <?php 
              # prevent the user to come without premission to profile page (should be added to all pages)
             if(!isset($_SESSION['user'])) {
                 // js popup
                 header("location: Login.php");
                 exit();
             }
                require('database/connection.php');
                $db->beginTransaction();
                try{
                    $keys=array_keys($_SESSION['user']);
                    $userIDrec=$db->prepare("SELECT userID from users where username=?");
                    $userIDrec->execute(array($keys[0]));
                    $userID=$userIDrec->fetch()['userID'];

                    if(isset($_POST['submitSurv'])){
                        
                        $surveyID=$_POST['svID'];
                        $surveyRec=$db->prepare('SELECT surveyID, numResponses from surveys where surveyID=? ');
                        $surveyRec->execute(array($surveyID));

                        
                        $responded=true;
                        $qIDarrSerialized = $_POST['SrqID'];
                        $qIDarr = unserialize($qIDarrSerialized);
                        for($i=0; $i<count($qIDarr); $i++){
                            if (!isset($_POST["qID_".$qIDarr[$i]]) || $_POST["qID_".$qIDarr[$i]]==null) {
                                   $responded=false; 
                                }
                        }
                        
                        
                        if($responded){
                            $insertResponse=$db->prepare("INSERT into responses (userID, questionID, response) values (:userID, :qID, :resp) ");
                            for($i=0; $i<count($qIDarr); $i++){
                                
                                // insert new response record
                                $insertResponse->bindParam(':userID',$userID);
                                $insertResponse->bindParam(':qID',$qIDarr[$i]);
                                $insertResponse->bindParam(':resp',$_POST["qID_".$qIDarr[$i]]);
                                $insertResponse->execute();
                            }
                            if($survey=$surveyRec->fetch()){
                                // increase no. of responses
                                $numResp=$survey['numResponses']+1;
                                $updateResponseNo=$db->prepare("UPDATE surveys set numResponses=? where surveyID=?");
                                $updateResponseNo->execute(array($numResp,$survey['surveyID']));

                                $insertParticipate=$db->prepare("INSERT into participate (userID, surveyID, date) values (?,?,NOW())");
                                
                                $insertParticipate->execute(array($userID,$survey['surveyID'] ));
                            }

                            // checking submission
                            if($insertResponse->rowCount()>0){
                                echo "
                                <div class='m-auto submitMsg' id=''>
                                    <div> <h2>Your response has been submitted succesfully! </h2></div>
                                    <div> <h4> Try another one of our surveys </h4></div>
                                    <div> <a class='btn' id='submitpagebtn' href='explorepage2.php'>Explore</a></div>
                                </div>";
                            }
                            else{
                                echo "
                                <div class='m-auto submitMsg' id=''>
                                    <div> <h2> Apologies... Your response has not been submitted. </h2></div>
                                    <div> <h4> Try taking the survey again! </h4></div>
                                    <div> 
                                        <form action='answerSurvey.php' method='POST'>
                                        <input type='hidden' id='surveyID' name='svID' value=".$_POST['svID'].">
                                        <button class='btn' id='submitpagebtn' name='answerSurv'  type='submit'>Answer</button>
                                        </form>
                                    </div>
                                </div>";
                            }

                        }
                        else{ // check if response is empty
                            echo"
                            <div class='m-auto submitMsg' id=''>
                                <div> <h2> You did not answer any of the survey questions </h2></div>
                                <div>  <h4> Try taking the survey again! </h4> </div>
                                <div> 
                                <form action='answerSurvey.php' method='POST'>
                                    <input type='hidden' id='surveyID' name='svID' value=".$_POST['svID'].">
                                    <button class='btn' id='submitpagebtn' name='answerSurv'  type='submit'>Answer</button>
                                </form>
                                </div>
                            </div>";
                        }
                        
                        
                        
                        
                        
                    }
                    $db->commit();
                    $db=null;

                }catch(PDOException $e){
                    die($e->getMessage());
                }
            ?>
        </div>
    </div>
    <div > <?php include 'footer.html'?> </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>