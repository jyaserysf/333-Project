

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/generalstyle.css">
    <link rel="stylesheet" href="css/answerSurvey.css">
</head>
<body>
    
    <div id="header"> <?php include 'header.php'?> </div>
    <?php
       
        //session_start(); # open it later to prevent the user to come without premission to profile page (should be added most to all pages)
        if(!isset($_SESSION['user'])) {
            
            ?><script>
                    window.location.href = "Login.php";
            </script>
            <!-- header("location: Login.php");
            exit(); -->
       <?php }
        

        //should not be accessible to non-users 
        //var_dump($_POST);
        //print_r($_SESSION['username']);
    ?>
    <!-- Page content in this container -->
    <div class="cointainer" id="main">
    <div class='container' id='displaySurvey'>
        <?php 
        try{ 
                require('database/connection.php');
               $db->beginTransaction();
                if(isset($_POST['answerSurv'])||isset($_GET['survID']) ){
                     // grab surveyID from displaySurvey 
                     if(isset($_POST['answerSurv']))
                        $survID=$_POST['svID'];
                    else
                        {
                            $survID = $_GET['survID']; # came from the history page link
                        }
                    $displaySurvRec=$db->prepare("SELECT * from surveys where surveyID=:svID");
                    $displaySurvRec->bindParam(':svID', $survID);
                    $displaySurvRec->execute();
                    $sTitle = '';
                    $sDesc = '';
                    if($displaySurvey=$displaySurvRec->fetch())
                        {
                            $sTitle = $displaySurvey['title'];
                            $sDesc = $displaySurvey['description'];
                        }   
                        
                    // display survey title and description
                    echo "  <form method='post' action='submittedResponse.php' >
                        <div class=' id='surveyHead'>
                            <div> <h1>" .$sTitle." </h1></div>
                            <div> <h5> " .$sDesc." </h5></div>
                            <hr>
                        </div>";
                        //  join survey with questions table through surveyID
                        $questionDetailRec=$db->prepare("SELECT questions.* FROM questions WHERE SurveyID=:sID");
                        $questionDetailRec->bindParam(':sID', $survID);
                        $questionDetailRec->execute();
                        $questionDetails=$questionDetailRec->fetchAll();
                        //loop based on no. of questions
                        // display question 
                        echo "<div class='row' id='surveyBody'>
                               ";
                        $qNo=1;
                        $qIDarr=[];
                        $atLeastOneAnswered = false;
                        foreach($questionDetails as $question){
                            $type=$question['type'];
                            $qID=$question['questionID'];
                            $qIDarr[]=$qID;
                            $choicesRec=$db->prepare("SELECT * FROM choices  WHERE choices.MCQID=?");
                            $choicesRec->execute(array($qID));
                            $choices=$choicesRec->fetch();
                            //print_r($choices);

                            if($type=='mcq'){

                                echo " 
                                    <div class='question col-12' id=''>
                                        <div class='questionTitle row' id=''><h3> $qNo. " .$question['content']." </h3> </div>
                                        <div class='row ms-2' id='mcqChoices'>";
                                        for($i=1; $i<=4; $i++ ){
                                            //echo $choices[$i];
                                            echo 
                                            "<div class='form-check mcqOption col-md-6 col-sm-12' id=''>
                                            <input class='form-check-input ' type='radio' name='qID_$qID' value='".$choices["choice$i"]."'> ".$choices["choice$i"]."
                                            </div>";
                                        }
                                        echo"</div>

                                   </div>";

                            }
                            elseif($type=='yes_no'){
                                echo " 
                                   <div class='question' id=''>
                                   <div class='questionTitle' id=''><h3> $qNo. " .$question['content']."</h3>  </div>
                                        <div class='t/fOption form-check' id=''>
                                            <input type='radio' class='form-check-input' name='qID_$qID' value='yes'> Yes
                                        </div>
                                        <div class='t/fOption form-check' id=''>
                                            <input type='radio' class='form-check-input' name='qID_$qID' value='no'> No
                                        </div>

                                   </div>";
                            }
                            elseif($type=='scale'){
                                echo " 
                                   <div class='question' id=''>
                                   <div class='questionTitle' id=''><h3> $qNo. " .$question['content']."</h3>  </div>
                                        <div class='row' id='rangeLabel'>
                                            <div class='col'> <label for='rangeQ' class='form-label'>1</label> </div>
                                            <div class='col text-end'> <label for='rangeQ' class='form-label'>5</label> </div>
                                        </div>
                                        <div class='rangeOption' id='rangeQ'>
                                            <input type='range' class='form-range' name='qID_$qID' value='' min=1 max=5 step=1>
                                        </div>
                                   </div>";
                            }
                            else{
                                echo " 
                                   <div class='question' id=''>
                                   <div class='questionTitle' id=''><h3> $qNo. " .$question['content']." </h3> </div>

                                        <div class='shortAOption' id=''>
                                        <input class='form-control' type='text' name='qID_$qID' placeholder='Answer Here' aria-label='default input example'>
                                        </div>
                                   </div>";
                            }

                            // Check if the question has been answered
                        


                            $qNo++;

                        }

                        // if ($atLeastOneAnswered) {
                        //     // At least one question has been answered
                        //     echo "<div id='submitResponse'> 
                        //         <input type='hidden' id='surveyID' name='svID' value=" . $displaySurvey['surveyID'] . ">
                        //         <input type='hidden' id='surveyID' name='SrqID' value=" . serialize($qIDarr) . ">
                        //         <button class='btn' id='survey-btn' name='submitSurv' type='submit'>Submit</button>
                        //     </div>";
                        // } else {
                        //     // No question has been answered
                        //     echo "<p>Please answer at least one question.</p>";
                        // }
                    
                    $qIDarrSerialized = serialize($qIDarr);
                    // inner if based on type
                    // loop for mcq, maybe for t/f? 
                    // how to save the responses?? should be in array (like assignment)
                        
                        echo"</div>
                        <div id='submitResponse'> 
                                    <input type='hidden' id='surveyID' name='svID' value=". $survID.">
                                    <input type='hidden' id='surveyID' name='SrqID' value=".$qIDarrSerialized.">
                                    <button class='btn' id='survey-btn' name='submitSurv'  type='submit'>Submit</button>";

                        echo"</div> 
                    </form>
                    ";
                    
                    
                    //foreach($qIDarr as $qid)
                    //echo $qid;

                    // if(isset($_POST['submitSurv'])){
                    //     $userIDrec=$db->prepare("SELECT userID from users where username=?");
                    //     $userIDrec->execute(array($_SESSION['username']));
                    //     $userID=$userIDrec->fetch()['userID'];
                    //     echo $userID;
                    //     print_r($qIDarr);
                    //     echo "<h3> ".$_POST["qID_1"]."</h3>";
                    //     //echo count($qIDarr);
                    //     $insertResponse=$db->prepare("INSERT into responses (userID, questionID, response) values (:userID, :qID, :resp) ");
                    //     $insertResponse->bindParam(':userID',$userID);
                    //     $insertResponse->bindParam(':qID',$qIDarr[0]);
                    //     $insertResponse->bindParam(':resp',$_POST["qID_1"]);
                    //     $insertResponse->execute();
                    //     foreach($qIDarr as $qid){
                            
                    //         //$insertResponse->execute(array($userID,$qid,$_POST["qID_".$qid]));
                    //         //$insertResponse->bindParam(':userID',$userID);
                    //         //$insertResponse->bindParam(':qID',$qid);
                    //         //$insertResponse->bindParam(':resp',$_POST["qID_".$qid]);
                            
                    //     }
                        
                        
                    // }
                    
                }


                $db->commit();
                $db=null;
                

        }
        catch(PDOException $e){
            die($e->getMessage());
        }
        ?>


        </div>
    </div>
    <div > <?php include 'footer.html'?> </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>