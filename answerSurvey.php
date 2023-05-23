<?php
 session_start(); # open it later to prevent the user to come without premission to profile page (should be added most to all pages)
if(!isset($_SESSION['user'])) {
    // js popup
    header("location: Login.php");
    exit();
}

//should not be accessible to non-users 
//var_dump($_POST);
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
    <link rel="stylesheet" href="css/answerSurvey.css">
</head>
<body>
    
    <div id="header"> <?php include 'header.html'?> </div>
    <!-- Page content in this container -->
    <div class="cointainer" id="main">
    <div class='container' id='displaySurvey'>
        <?php 
        try{
                
                
                require('database/connection.php');
               $db->beginTransaction();
                if(isset($_POST['answerSurv'])){
                     // grab surveyID from displaySurvey 
                    $survID=$_POST['svID'];
                    $displaySurvRec=$db->prepare("SELECT * from surveys where surveyID=:svID");
                    $displaySurvRec->bindParam(':svID', $survID);
                    $displaySurvRec->execute();
                    $displaySurvey=$displaySurvRec->fetch();
                    // display survey title and description
                    echo "  <form action='post'>
                        <div class=' id='surveyHead'>
                            <div> <h1>" .$displaySurvey['title']." </h1></div>
                            <div> <h5> " .$displaySurvey['description']." </h5></div>
                            <hr>
                        </div>";
                    //  join survey with questions table through surveyID
                    $questionDetailRec=$db->prepare("SELECT questions.* FROM questions WHERE SurveyID=:sID");
                    $questionDetailRec->bindParam(':sID', $survID);
                    $questionDetailRec->execute();
                    $questionDetails=$questionDetailRec->fetchAll();
                    //loop based on no. of questions
                    // display question 
                    echo "<div class=' id='surveyBody'>
                           ";
                    $qNo=1;
                    foreach($questionDetails as $question){
                        $type=$question['type'];
                        $qID=$question['questionID'];
                        $choicesRec=$db->prepare("SELECT choices.* FROM questions JOIN choices on questions.questionID=choices.questionID WHERE SurveyID=? and choices.questionID=?");
                        $choicesRec->execute(array($survID,$qID));
                        $choices=$choicesRec->fetchAll();
                        if($type=='mcq'){
                            
                            echo " 
                                <div class='question' id=''>
                                    <div class='questionTitle' id=''><h3> $qNo. " .$question['content']." </h3> </div>
                                    <div id='mcqChoices'>";
                                    foreach($choices as $choice){
                                        echo 
                                        "<div class='form-check mcqOption' id=''>
                                        <input class='form-check-input' type='radio' name='qID_$qID' value='".$choice['choiceID']."'> ".$choice['choice']."
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
                                    <input class='form-control' type='text' name='qID_$qID' placeholder='Default input' aria-label='default input example'>
                                    </div>
                               </div>";
                        }

                        $qNo++;

                    }
                    
                    
                    // inner if based on type
                    // loop for mcq, maybe for t/f? 
                    // how to save the responses?? should be in array (like assignment)
 
                    echo"</div>
                    <div id='submitResponse'> 
                                <input type='hidden' id='surveyID' name='svID' value=".$displaySurvey['surveyID'].">
                                <button class='btn' id='survey-btn' name='startsSurv'  type='submit'>Submit</button>
                            
                    </div> </form>
                    ";
                }


                $db->commit();
                

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