<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/generalstyle.css">
    <style>
        #adminpage{
            margin: 50px 100px;
        }
    </style>

</head>
<body>

    <div id="header"> <?php include 'header.php'?> </div>
        
    <!-- Page content in this container -->
    <div class="cointainer" id="main">
        <div id='adminpage'>
            <div class='row' id='title'>
                <h1>Dahsboard</h1>
            </div>
            <div class='row' id='body'>
                <div class='col'>
                    <div class='row  justify-content-end' id='surveySec'>
                        <div class='col-lg-10 col-sm-8' >
                            <h3>Surveys</h3>
                        </div>
                        <div class='col ' >
                            <a href='createSurvey.php'><button class='btn  me-2' id='createbtn'> Create </button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div > <?php include 'footer.html'?> </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>