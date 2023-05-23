<?php 
session_start(); # open it later to prevent the user to come without premission to profile page (should be added most to all pages)

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
    <script>
    // pop up to 
        
    function displayPopup() {
        // Display the popup
        var popup = document.getElementById("popup");
        popup.style.display = "block";
    }

    function closePopup() {
        // Close the popup
        var popup = document.getElementById("popup");
        popup.style.display = "none";
    }

    </script>
</head>
<body>
    

    <div id="header"> <?php include 'header.html'?> </div>
    <!-- Page content in this container -->
    <div class="cointainer" id="main">
        <?php 
            try{
                
                
                require('database/connection.php');
                $db->beginTransaction();
                // should grab surveyID from card 
                if(isset($_POST['startSurv'])){
                    $survID=$_POST['svID'];
                    // display survey title and description
                    $displaySurvRec=$db->prepare("SELECT * from surveys where surveyID=:svID");
                    $displaySurvRec->bindParam(':svID', $survID);
                    $displaySurvRec->execute();
                    $displaySurvey=$displaySurvRec->fetch();
                    echo "<div class='container' id='displaySurvey'>
                    <div class=' id='surveyHead'>
                        <div> <h1>".$displaySurvey['title']."</h1></div>
                        <div> <h5> ".$displaySurvey['description']."</h5></div>
                    </div>";
                   

                    echo"<form action='answerSurvey.php' method='POST'>
                        <input type='hidden' id='surveyID' name='svID' value=".$displaySurvey['surveyID'].">
                        <button class='btn' id='survey-btn' name='answerSurv'  type='submit'>Answer</button>
                    </form>
                    </div>";
                    //send survey id to answerSurvey.php again
                }

                $db->commit();
                
            }
            catch(PDOException $e){
                die($e->getMessage());
            }
        ?>
        
    </div>
    <div > <?php include 'footer.html'?> </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>