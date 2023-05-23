<?php
 session_start(); # open it later to prevent the user to come without premission to profile page (should be added most to all pages)
if(!isset($_SESSION['user'])) {
    // js popup
    header("location: Login.php");
    exit();
}

//should not be accessible to non-users 
//var_dump($_POST);
//print_r($_SESSION['username']);
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
</head>
<body>

    <div id="header"> <?php include 'header.html'?> </div>
    <!-- Page content in this container -->
    <div class="cointainer" id="main">
        <div class='container' id='displaySurvey'>
            <!-- <div> <h3> Hi </h3></div> -->
            <?php 
                require('database/connection.php');
                $db->beginTransaction();
                try{
                    $userIDrec=$db->prepare("SELECT userID from users where username=?");
                    $userIDrec->execute(array($_SESSION['username']));
                    $userID=$userIDrec->fetch()['userID'];
                    
                    //print_r($qIDarr);
                    //foreach($qIDarr as $qid)
                    //echo $qid;

                    if(isset($_POST['submitSurv'])){
                        //echo "<h3> ".$_POST["qID_1"]."</h3>";
                        $qIDarrSerialized = $_POST['SrqID'];
                        $qIDarr = unserialize($qIDarrSerialized);
                        //echo count($qIDarr);
                        $insertResponse=$db->prepare("INSERT into responses (userID, questionID, response) values (:userID, :qID, :resp) ");
                        for($i=0; $i<count($qIDarr); $i++){
                            
                            $insertResponse->bindParam(':userID',$userID);
                            $insertResponse->bindParam(':qID',$qIDarr[$i]);
                            $insertResponse->bindParam(':resp',$_POST["qID_".$qIDarr[$i]]);
                            $insertResponse->execute();
                            
                        }
                         if($insertResponse->rowCount()>0){
                            echo "
                            <div class='m-auto submitMsg' id=''>
                                <div> <h2>Your response has been submitted succesfully! </h2></div>
                                <div> <h4> Try another one of our surveys </h4></div>
                                <div> <a class='btn' href='explorepage2.php'>Explore</a></div>
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
                                    <button class='btn' id='survey-btn' name='answerSurv'  type='submit'>Answer</button>
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