<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/generalstyle.css">
    <style>
        body{
            color: #161853;
        }
        #faqs{
            margin: 60px auto;
        }
        h1{
            font-size:50px;
            font-weight:bold;
        }
        p{
            font-size:20px;
            color: #292C6D;
        }
        hr{
            color: #161853;
            height:20px;
        }
        h4{
           font-size: 30px;
           font-weight:bold; 
        }


    </style>
</head>
<body>

    <div id="header"> <?php include 'header.php'?> </div>
    <!-- Page content in this container -->
    <div class="cointainer" id="main">
        <div class='container' id='faqs'>
            <div class="row mb-4" id="faq-head">
                <div class="col-lg-12">
                    <h1 class="mb-3"> FAQS </h1>
                </div>
                <div class="col-lg-12">
                    <h5 class="mb-3"> These are our most asked questions. </h5>
                </div>
                <hr>
            </div>
            
            <div class="row" id="faq-body">
                <div class="faq mb-3">
                    <div class="col-lg-12">
                    <h4 class="mb-3"> 1. Where are our responses saved? </h4>
                    </div>
                    <div class="col-lg-12">
                    <p class="mb-3"> Your responses are stored securely in our databases! Only the site admin has access to them. </p>
                    </div>
                </div> 
                <div class="faq mb-3">
                    <div class="col-lg-12">
                    <h4 class="mb-3"> 2. What do you do with the data? </h4>
                    </div>
                    <div class="col-lg-12">
                    <p class="mb-3"> Your responses are visualized in the admin dashboard as insightful information that can be used by different industries. Remeber, data is power! </p>
                    </div>
                </div>
                <div class="faq mb-3">
                    <div class="col-lg-12">
                    <h4 class="mb-3"> 3. Where are our responses saved? </h4>
                    </div>
                    <div class="col-lg-12">
                    <p class="mb-3"> Your responses are stored securely in our databases! Only the site admin has access to them. </p>
                    </div>
                </div>
                
            </div>
            

        </div>
    </div>
    <div > <?php include 'footer.html'?> </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>