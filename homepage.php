<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/generalstyle.css">
    <link rel="stylesheet" href="css/homepageStyle.css">
   
</head>
<body>
    <div id="header"> <?php include 'header.html'?> </div>
    <!-- Page content in this container -->
    <div class="cointainer " id="main">
        <div class="seperate">
            <hr>
        </div>
         
        <div class="top-display d-flex justify-content-around ">
            
            <div class="displaysection d-flex flex-column align-items-center justify-content-center flex-grow-1" id="tagline">
             <h1 class="m-5"> Something about surveys </h1>
             <div> 
                <h2 class="mb-4"> Create an account now! </h2> 
                <div class="d-grid gap-2 col-6 mx-auto my-2">
                    <button class="btn p-2 create" type="button"> Create </button></div>
             </div>
            </div>
            <div class="displaysection flex-grow-2 me-5 p-2" id="displayImg">
            <img src="img\Customer Survey-amico.svg" width=450px  >
            </div>
        </div> 
    
   
    
    <div id="explore">
        <h1> Explore </h1>
        <div class="card">
            <div class="card-pic"><img src="images/pic1.jpg"  > </div> 
            <div class="card-details">
                <p class="text-title">Card title</p>
                <p class="text-body">Here are the details of the card</p>
            </div>
            <button class="card-button">start</button>
        </div>
    </div>
    <div id="pastsurvey">

    </div>
    </div>
    <div > <?php include 'footer.html'?> </div>


</body>
</html>