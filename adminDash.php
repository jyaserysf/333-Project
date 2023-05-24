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
        #title{
            margin-bottom: 30px;
        }
        #resultbtn{
            background-color: #161853;
            color: #FAEDF0;
        }
        #resultbtn:hover{
            color: #161853;
            background-color: #FAEDF0;
            border-color:#161853; 
        }

        #surveybox{
            min-height:100px;
        }
        #surveybox p{
            margin-bottom:0;
        }
        h4,h6{
            font-weight: bold;
        }

    </style>

</head>
<body>

    <div id="header"> <?php include 'header.php'?> </div>
        
    <!-- Page content in this container -->
    <div class="cointainer" id="main">
        <div id='adminpage'>
            <div class='row border-bottom' id='title'>
                <h1>Dahsboard</h1>
            </div>
            <div class='row' id='body'>
                <div class='col' id='surveySec'>
                    <div class='row  justify-content-end' >
                        <div class='col-lg-10 col-sm-8 ' >
                            <h2>Surveys</h2>
                        </div>
                        <div class='col ' >
                            <a href='createSurvey.php'><button class='btn  me-2' id='createbtn'> Create </button></a>
                        </div>
                    </div>
                </div>
                <div class='col-12' id=''>
                    <?php 
                        try{

                            require('database/connection.php');
                            $surveysrec=$db->prepare("SELECT * from surveys");
                            $surveysrec->execute();
                            $surveys=$surveysrec->fetchAll();
                            foreach($surveys as $survey){
                                echo "  
                                <div class='row border flex-wrap align-items-center align-content-center p-3' id='surveybox'>
                                    <div class='col-9'>
                                        <div><h4> ".$survey['title']." </h4></div>
                                        <div><h5> Category: ".$survey['category']." </h5></div>
                                        <div><p> ".$survey['description']." </p></div>
                                    </div>
                                    <div class='col-2'>
                                        <div> <h6>No. of Responses: </h6></div>
                                        <div><p>".$survey['numResponses']."</p></div>
                                        <div><h6>Date Created:</h6></div>
                                        <div><p>".$survey['date']."</p></div>
                                    </div>
                                    <div class='col-1'>
                                        <form action='showResult.php' method='post'>
                                        <div> <button class='btn' id='resultbtn' name='showResult' value='".$survey['surveyID']."'> Results </button></div>
                                        </form>
                                    </div>
                                </div>";
                            }
                        }catch(PDOException $e){
                            die($e->getMessage());
                        }
                        
                      
                    
                    ?>

                    
                </div>

            </div>
        </div>
    </div>
    <div > <?php include 'footer.html'?> </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>