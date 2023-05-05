

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>explore page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> 
    <style>

.card {
 width: 12rem;
 height: 16rem;
 border-radius: 1rem;
 position: relative;

 border: 1px solid #c3c6ce;
 transition: 0.5s ease-out;
 overflow: visible;
}


.card-details {
 color: black;
 height:50%;
 
 
 margin: 0.5rem;
 
 place-content: center;

}

.card-button {
 transform: translate(-50%, 125%);
 width: 60%;
 border-radius: 1rem;
border:none;
 background-color: #008bf8;
 color: #fff;
 font-size: 1rem;
 padding: .5rem 1rem;
 position: absolute;
 left: 50%;
 bottom: 0;
 opacity: 0;
 transition: 0.3s ease-out;
}



.text-title {
 font-size: 1.5em;
 font-weight: bold;
}


.card:hover {
 border-color: #008bf8;
 box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.25);

}

.card:hover .card-button {
 transform: translate(-50%, 50%);
 opacity: 1;
}

.card-pic{

   
    width: 100%;
    height: 50%;

  
    border-top-left-radius:0.8rem;
    border-top-right-radius:0.8rem;
    display: flex; 
    overflow: hidden;
    position: relative;"
   
 
}

.card-button:hover{

    cursor: pointer;
    filter: brightness(1.3);

}

img{
    
    width:100%;
    height: 100%;
  object-fit: cover;
  
}

</style>
    


</head>
    
    
<body>




   


<div class="card">


<div class="card-pic"><img src="images/pic1.jpg"  > </div> 
  <div class="card-details">
  
    <p class="text-title">Card title</p>
    <p class="text-body">Here are the details of the card</p>
  </div>
  <button class="card-button">start</button>
</div>



</body>

</html>