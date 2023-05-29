<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/generalstyle.css">
    <style>
        #adminpage{
            margin: 50px 100px;
        }
        #title{
            margin-bottom: 30px;
        }
        #backbtn{
            background-color: #161853;
            color: #FAEDF0;
        }
        #backbtn:hover{
            color: #161853;
            background-color: #FAEDF0;
            border-color:#161853; 
        }

        #surveybox{
            min-height:100px;
        }
        .shortAOption p{
            font-size:23px;
        }
        h3,h6{
            font-weight: bold;
        }
        .question-rslts{
            margin: 50px 0;
            min-height: 280px;
        }

    </style>

</head>
<body>

    <div id="header"> <?php include 'header.php'?> </div>
        
    <!-- Page content in this container -->
    <div class="cointainer" id="main">
        <div id='adminpage'>
            
        <div class='row border-bottom' id='title'>
                <?php 
                try{
                    require('database/connection.php');
                    if(isset($_POST['showResult'])){
                        $srvID=$_POST['showResult'];
                        $surveysrec=$db->prepare("SELECT * from surveys where surveyID=$srvID");
                        $surveysrec->execute();
                        $survey=$surveysrec->fetch();
                        if($survey){    
                            echo "
                                <div class='col-lg-10 col-m-9'> 
                                    <h1> ".$survey['title']." Results </h1>
                                </div>
                                <div class='col-lg-2 col-md-3'>
                                    <h4> Responses (".$survey['numResponses'].")</h4>
                                </div>
                                </div>";
                            }

                            if($survey['numResponses']>0){

                            
                                // get question details
                                $questionDetailRec=$db->prepare("SELECT questions.* FROM questions WHERE SurveyID=:sID");
                                $questionDetailRec->bindParam(':sID', $srvID);
                                $questionDetailRec->execute();
                                $questionDetails=$questionDetailRec->fetchAll();
                                $qNo=1;
                                $qIDarr=[];

                                // get amount of responses for each question
                                $num_Qrecords=$db->prepare("SELECT questions.questionID, questions.type, COUNT(*) as num_records FROM responses JOIN questions ON questions.questionID = responses.questionID WHERE questions.SurveyID=? GROUP BY questions.questionID ORDER BY questions.questionID");
                                $num_Qrecords->execute(array($srvID));
                                $allQamounts=$num_Qrecords->fetchAll();
                                
                            foreach($questionDetails as $question){
                            
                                $type=$question['type'];
                                $qID=$question['questionID'];
                                $qIDarr[]=$qID;
                                $choicesRec=$db->prepare("SELECT * FROM choices  WHERE choices.MCQID=?");
                                $choicesRec->execute(array($qID));
                                $choices=$choicesRec->fetch();

                                $totalQAmnt=0.0;
                                $yesPercntg=0.0;

                                foreach($allQamounts as $qAmount){
                                    if($qID==$qAmount['questionID']){
                                        $totalQAmnt=$qAmount['num_records'];
                                        break;
                                    }
                                }

                                //print_r($choices);
                                if($type=='mcq'){

                                    


                                    echo " 
                                        <div class='question-rslts row' id=''>
                                            <div class='questionTitle col-lg-12' id=''><h3> $qNo. " .$question['content']." </h3> </div>
                                            <div class='row ms-2' id='mcqChoices'>";
                                            $option=[];
                                            $eachMcqCount=$db->prepare("SELECT questions.questionID, responses.response, COUNT(*) as tnum FROM responses JOIN questions ON questions.questionID = responses.questionID WHERE responses.response=? and questions.SurveyID=?");
                                            for($i=1;$i<=4;$i++ ){
                                                    $eachMcqCount->execute(array($choices["choice".$i], $srvID));
                                                    $eachCnt=$eachMcqCount->fetch()['tnum'];
                                                    $option[$i]=$eachCnt;
                                                    
                                                }
                                             

                                            
                                            $mcqPerc=0.0;
                                            for($i=1;$i<=count($option); $i++){
                                                $mcqPerc=$option[$i]/$totalQAmnt*100;

                                                echo 
                                                "<div class=' mcqOption col-md-6 col-sm-12' id=''>
                                                    <div> <h4> Option $i. ".$choices["choice$i"]." </h4></div>
                                                    <div> <h5> Percentage: ".round($mcqPerc)."% </h5></div>
                                                </div>";

                                            }
                                                
                                                
                                            
                                            echo"</div>
    
                                       </div>";
    
                                }
                                elseif($type=='yes_no'){

                                    //amount of yes responses
                                    $yesAmntrec=$db->prepare("SELECT questions.questionID, responses.response, COUNT(*) as tnum FROM responses JOIN questions ON questions.questionID = responses.questionID WHERE responses.response='yes' and questions.SurveyID=?");
                                    $yesAmntrec->execute(array($srvID));
                                    $yesAmnt=$yesAmntrec->fetch()['tnum'];

                                    // amount of no responses
                                    $noAmntrec=$db->prepare("SELECT questions.questionID, responses.response, COUNT(*) as tnum FROM responses JOIN questions ON questions.questionID = responses.questionID WHERE responses.response='no' and questions.SurveyID=?");
                                    $noAmntrec->execute(array($srvID));
                                    $noAmnt=$noAmntrec->fetch()['tnum'];

                                    
                                    // calculate percentage of each
                                    $yesPercntg=$yesAmnt/$totalQAmnt*100;
                                    $noPercntg=$noAmnt/$totalQAmnt*100;

                                    echo " 
                                       <div class='question-rslts row' id=''>
                                            <div class='questionTitle col-lg-12' id=''><h3> $qNo. " .$question['content']."</h3>  </div>
                                            <div class='t/fOption  col' id=''>
                                                <div><h4> Yes Percentage : </h4> </div>
                                                <div> <h4> $yesPercntg%</h4></div>
                                            </div>
                                            <div class='t/fOption  col' id=''>
                                                <div><h4> No Percentage: </h4> </div>
                                                <div> <h4> $noPercntg%</h4></div>
                                            </div>
                                       </div>";
                                }
                                elseif($type=='scale'){

                                    $scaleResponsesrec=$db->prepare("SELECT questions.questionID, responses.response FROM responses JOIN questions ON questions.questionID = responses.questionID where questions.type='scale' and questions.SurveyID=?");
                                    $scaleResponsesrec->execute(array($srvID));
                                    $scaleResponses=$scaleResponsesrec->fetchAll();
                                    $scaleSum=0.0;
                                    $scaleAvg=0.0;
                                    foreach($scaleResponses as $scale){
                                        $scaleSum+=$scale['response'];

                                    }

                                    $scaleAvg=$scaleSum/$totalQAmnt;

                                    echo " 
                                       <div class='question-rslts row' id=''>
                                       <div class='questionTitle col-12' id=''><h3> $qNo. " .$question['content']."</h3>  </div>
                                            <div class='col' id='rangeLabel'>
                                                <div><h4>The response average is:  </h4></div>
                                                <div><h4> $scaleAvg </h4></div>
                                            </div>
                                            
                                       </div>";
                                }
                                else{

                                    $shortAnsResprec=$db->prepare("SELECT questions.questionID, responses.response FROM responses JOIN questions ON questions.questionID = responses.questionID where questions.type='short_answer' and questions.SurveyID=?");
                                    $shortAnsResprec->execute(array($srvID));
                                    $shortAnsResp=$shortAnsResprec->fetchAll();

                                    echo " 
                                       <div class='question-rslts row' id=''>
                                            <div class='questionTitle col-12' id=''><h3> $qNo. " .$question['content']." </h3> </div>
                                            <ul> ";
                                            foreach($shortAnsResp as $shortAns){
                                                if(!empty($shortAns['response'])){
                                                    echo"
                                                    <div class='shortAOption col' id=''>
                                                        <div> <li> <p>  ".$shortAns['response']."</p> </li></div>
                                                    </div>";
                                                }
                                                
                                            }
                                            
                                       echo"</ul>
                                       </div>";
                                }
                                $qNo++;
                            }
                        }

                         
                    }
                }catch(PDOException $e){
                    die($e->getMessage());
                }
                ?> 
            
        
              
            
            
                
                    <div class='row  justify-content-end' >
                        
                            <a href='adminDash.php'><button class='btn  me-2' id='backbtn'> Back </button></a>
                        
                    </div>
                
                
        </div>
            
        
    </div>
    <div > <?php include 'footer.html'?> </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>