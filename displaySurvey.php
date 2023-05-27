
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/generalstyle.css">
    <!-- <link rel="stylesheet" href="css/answerSurvey.css"> -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
        font-family: 'Nunito', sans-serif;
        }

        .container {
        width: 90%;
        margin: 30px auto;
        padding: 2%;
        font-size: 1.2em;
        }

        #displaySurvey {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: rgba(255, 255, 255, 1);
            padding: 0 0 1.5rem 0;
            border-radius: 5px;
            background-image: url("img/work-survey.svg");
            background-repeat: no-repeat;
            background-position: center;
            border-radius: 5px;
            background-size: 70%;
        }

        #displaySurvey h1 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 10px;
        }

        #displaySurvey h3 {
            font-size: 1.5rem;
            color: #555;
            margin-bottom: 10px;
        }

        #displaySurvey h5 {
            font-size: 1.2rem;
            color: #777;
            margin-bottom: 20px;
        }

        #displaySurvey p {
            font-size: 1rem;
            color: #999;
            margin-bottom: 10px;
        }

        #survey-btn {
            background-color: #161853;
            border: 1px solid #161853;
            border-radius: 5px;
            color: #ffffff;
            font-size: 1.2rem;
            padding: 5px 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #survey-btn:hover {
            background-color: #fff;
            color: #161853;
        }

        #surveyHead {
            background-color: rgba(255, 255, 255, 0.93);
            width: 100%;
            height: 100%;
            padding: 12rem;
            border: none;
        }

        
    </style>
    <script>
    // pop up to lgin (MAYBE)
        
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
    

    <div id="header"> <?php include 'header.php'?> </div>
    <!-- Page content in this container -->
    <div class="cointainer " id="main">
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
                    <div id='surveyHead'>
                        <div> <h1>".$displaySurvey['title']."</h1></div>";
                        if ($displaySurvey['category']=='work' || $displaySurvey['category']=='Work' ){
                            echo"<div> <h3> Category: Work </h3></div>";
                        }else{
                            echo"<div> <h3> Category: Student </h3></div>";
                        }
                            
                        
                        echo"<div> <h5> ".$displaySurvey['description']."</h5></div>
                                <div> <p> Created on: ".$displaySurvey['date']."</p></div>
                                <div><p>Total Responses: ".$displaySurvey['numResponses']." </p></div> 
                    </div>";
                   

                    echo"<form action='answerSurvey.php' method='POST'>
                        <input type='hidden' id='surveyID' name='svID' value=".$displaySurvey['surveyID'].">
                        <button class='btn' id='survey-btn' name='answerSurv'  type='submit'>Answer</button>
                    </form>
                    </div>";
                    //send survey id to answerSurvey.php again
                }else{
                    echo"<div class='container' id='displaySurvey'>
                        <div class='m-auto submitMsg' id=''>
                        <div> <h2> Please select a survey to respond to first. </h2></div>
                        <div> <img src='img\Computer troubleshooting-amico.svg' > </div>
                        
                        <div> <h4> Go back to <a href='homepage.php'style='text-decoration:none;'>Home</a>  </h4></div>
                </div>
                    </div>";
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