<?php 
/*session_start(); # open it later to prevent the user to come without premission to profile page (should be added to most pages)
if(!isset($_SESSION['user'])) {
    header("location: Login.php");
    die();
}*/

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
    <link rel="stylesheet" href="css\answerSurvey.css">
</head>
<body>
    <?php 
        try{
            
            require('database/connection.php');
            // should grab surveyID from card

        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    ?>

    <div id="header"> <?php include 'header.html'?> </div>
    <!-- Page content in this container -->
    <div class="cointainer" id="main">
        <div class="container" id="displaySurvey">
           <div> <h2> Survey Title </h2></div> 
            <div> <h5> Survey Description</h5></div>
            <div><a href="answerSurvey.php">  <button class="btn" > Answer </button></a></div>


        </div>
    </div>
    <div > <?php include 'footer.html'?> </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>