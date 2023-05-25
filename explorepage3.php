<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Explore</title>

     <link rel="stylesheet" href="css/generalstyle.css">
     <!-- <link rel="stylesheet" href="css/explorepage.css">     -->
    <style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/*Slider */
.wrapper {
      
    position: relative;
    width: 100%;
    align-items: center;
    margin: auto;

}

/* arrow */
.arrow {
   opacity: 0;
   border-radius: 0.5rem;
    position: absolute;
   top: 48%; 
    transform: translateY(-50%);
    transition: transform 150ms ease-in-out;
    display: none;
    height: 13rem;
   width: 3rem;
   display: flex;
    align-items: center;
    justify-content: center;
    color:black;
    background-color: rgba(0, 0, 0, 0.1);
    font-size: 3rem;
    cursor: pointer;
    border: none;
    margin: auto;
    overflow-x: hidden; 
  
}

.arrow:hover {
   
    background-color: rgba(0, 0, 0, .2);
    display: block;
}
.arrow.prev {
    left: 0;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    
}
.arrow.next {
    right: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    
}

.arrows{
    margin: auto;
}


/* end arrow */

.card-wrapper:hover :where(.arrow.next ,.arrow.prev){
    opacity: 1;
}
.card-wrapper {
   
    
    align-items: center;
    margin: 0 auto;
    display: grid;
    grid-auto-flow: column;
     
    overflow-x: auto;
    overflow-y: hidden;
    
     gap: 10px; 
    padding: 10px;
    padding-bottom: 20px;
    scroll-snap-type: x mandatory;
    scroll-padding-inline: 20px;
    scroll-behavior: smooth;
    scrollbar-width: none;
}
.card-wrapper::-webkit-scrollbar {
    display: none;
}
 .card-wrapper.grab {
    cursor: grabbing;
    user-select: none;
    scroll-snap-type: none;
     scroll-behavior: auto; }

.card-wrapper.no-smooth {
     scroll-behavior: auto; 
}


@media screen and (max-width: 575px) {
    .arrow {
        display: none;
    }
    h2{
        font-size: 1.5rem;
    }

    .card{
        width: 2rem;
        height: 10rem;
    }
    }



/*  Slider */

 

/* card */

.card{
    scroll-snap-align: start;
    width:15rem;
    height: 13rem;
    border-radius: 0.5;
   
}

.btnn{           
    transform: translate(-50%, 125%);
    width: 60%;
    border-radius: 1.5rem;
    border:none;
    background-color: #EC255A;
    color: #fff;
    font-size: 1rem;
    padding: .5rem 1rem;
    position: absolute;
    left: 50%;
    bottom: 0;
    opacity: 0;
    transition: 0.3s ease-out;
    text-align:center;
    
}

.card:hover {
border-color: #EC255A;
 box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.25);

}

.card a{
    text-decoration:none;
}


.card:hover .btnn {
    transform: translate(-50%, 50%);
    opacity: 1;
        }

 .btnn:hover{

    cursor: pointer;
  

                }


/* card */
 
/* extras */

h2{
    color: #EC255A;
    margin-top: 2rem;
    margin-left: 2rem;
    font-weight: bold;
}


   
    </style>
</head>
<body>
<div id="header"><?php include('header.php') ?></div>


<?php $type=array("Explore","Student","Work");?>





    <!-- Page content in this container -->
    <div class="cointainer" id="main">

    <?php foreach($type as $value){ ?>
        <?php echo"<h2>". $value ."</h2>" ?>
    <div class="wrapper"><!--  wrapper start -->
        
       <?php 
        try {
            require('database/connection.php');
            if($value == "Explore") {
                $stmt = $db->prepare("SELECT * FROM surveys ORDER BY numResponses DESC LIMIT 20");
                $stmt->execute();
            }
            else {
                $stmt = $db->prepare("SELECT * FROM surveys WHERE category=? ORDER BY surveyID DESC LIMIT 20");
                $stmt->execute(array($value));
            }
            
            $db=null;
          }
          catch(PDOException $e) {
            die("Error: " . $e->getMessage());
          }
       ?>
   
        <div class="card-wrapper"> <!-- card wrapper start -->
        
        <?php $rs = $stmt->fetchAll() ?>
        <?php foreach($rs as $r){ ?>
            <div class="card">
           
            <div class="card-body">
             <h5 class="card-title"><?php echo $r['title']; ?> </h5>
             <p class="card-text"><?php echo $r['description']; ?></p>
             <form action='displaySurvey.php' method='POST'>
                <input type='hidden' id='surveyID' name='svID' <?php echo " value='".$r['surveyID']."' ";?>>
                <button class='card-button' name='startSurv' type='submit'>Answer</button>
            </form>
        
            </div> 
            </div>
    
    <?php  }  ?>
          
      <button class="arrow prev"><i class="icon ri-arrow-left-s-line"></i></button>
        <button class="arrow next"><i class="icon ri-arrow-right-s-line"></i></button>
               
        </div> <!-- card wrapper end  --> 
    </div> <!-- wrapper end  -->
    <?php } ?>


    </div>
    </div>
    <div > <?php include 'footer.html'?> </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="javascript/explorepage.js"></script>
</body>
</html>