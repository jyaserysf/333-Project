<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/generalstyle.css"> 
    <!-- <link rel="stylesheet" href="cardstyle.css"> 
 -->

 <style>
  .btn{

           
transform: translate(-50%, 125%);
width: 60%;
border-radius: 1.5rem;
border:none;
background-color: #292C6D;
color: #fff;
font-size: 1rem;
padding: .5rem 1rem;
position: absolute;
left: 50%;
bottom: 0;
opacity: 0;
transition: 0.3s ease-out;
        }



 .card:hover {
border-color: #008bf8;
 box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.25);

}

.card:hover .btn {
    transform: translate(-50%, 50%);
    opacity: 1;
        }

 .btn:hover{

    cursor: pointer;
  

                }
.card-img-top{

    height: 8rem;
}



.display{
 padding-bottom: 12px;
    display: flex;
flex-wrap: nowrap;
overflow-x: auto;
overflow-y: hidden;

.card {
flex: 0 0 auto;
}


&::-webkit-scrollbar {
  display: none;
} 


}



h2{
  margin-left: 1rem;
  margin-top: 1rem;
}
 </style>
        

</head>

<body>

<div id="header"> <?php include 'header.html'?> </div>
    <!-- Page content in this container -->
    <div class="cointainer" id="main">

  
    
<h2>Explore</h2>
  <div class="display">
<div class="d-flex flex-row flex-nowrap">
<?php for($x=0;$x<10;$x++){?>
  <div class="col"></div>
<div class="card m-3" style="min-width: 12rem; ">
  <img src="images/pic1.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">this is a shortt description about this survey </p>
    <a href="#" class="btn btn-primary">start</a>

  </div>
</div>

<?php } ?>

<br/>
  <br/>
</div>
</div>
</div>
    <div > <?php include 'footer.html'?> </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>