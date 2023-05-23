<?php
    if (isset($_POST['surveyTitle']) && isset($_POST['surveyDesc']) 
    && isset($_POST['surveyCat']) && isset($_POST['noOfQuestions'])) {

        $surveyTitle = $_POST['surveyTitle'];
        $surveyDesc = $_POST['surveyDesc'];
        $surveyCat = $_POST['surveyCat'];
        $noOfQuestions = $_POST['noOfQuestions']; 

        $surveyTitlePattern = "/^[a-z]{3,20}(\s{1}[a-z]{3,20}){0,5}$/i";
        $surveyCatPattern = "/^(work|student)$/";
        $noOfQuestionsPattern = "/^(4-9|1[0-2]){1}$/";

        if(!preg_match($surveyTitlePattern, $surveyTitle))
            die ("Invalid Survey Title");
        if(!preg_match($surveyCatPattern, $surveyCat))
            die ("Invalid Survey Category");
        // if(!preg_match($noOfQuestionsPattern, $noOfQuestions))
        //     die ("Invalid Number Of Questions");

        try {
            require('database/connection.php');
            $stmt = $db->prepare("INSERT INTO surveys VALUES(NULL, DEFAULT, ?, NOW(), ?, ?, ?)");
            $stmt->execute(array($noOfQuestions, $surveyTitle, $surveyDesc, $surveyCat));
            $db = null;
            // TODO: Proper Success Message
            // echo "<h2>New Survey Added Auccessfully!</h2>";
        } 
        catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
    else {
      header("location: createSurvey.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="css/generalstyle.css">
</head>

<body>

  <div id="header"> <?php include 'header.html' ?> </div>



  <div class="cointainer" id="main">
    <h1>create your own Questions </h1>

    <form action="" id="questionare">
        <input type="button" value="T/F" id="yes/no" onclick="addYesNO()">
        <input type="button" value="MCQ" id="MCQ" onclick="addMCQ()">
        <input type="button" value="short answer " id="shortA" onclick="addshortA()">
        <input type="button" value="scale " id="Scale " onclick="addscale()">
        <div id="questions">

        <br>
        <br>
      </div>



      <div><input type="submit" value="Submit"></div>
      <br>
       <br>
    </form>
    <script >
   
      questions = document.getElementById("questions");

      function addYesNO() 
      {
        yes_no = `<div class="question" id="question">
     <ul type="disc">
      <li > <input type="text" name="question" id="question" placeholder="Question">  </li> <br>
      True <input type="radio" name="yes/no" id="yes/no">
      False<input type="radio" name="yes/no" id="yes/no">
      <br>
       <br>
    </div>`;
        questions.insertAdjacentHTML("beforeend", yes_no);
      }


      function addMCQ() 
      {
        MCQ = `<div class="question">
      <ul type="disc">

      <li><input type="text" name="question" id="question" placeholder="Question"></li>
        <br>
      <input type="checkbox" name="MCQ" id="MCQ"><input type="text  " name="MCQ-op1" id="MCQop1" placeholder="1st option "><br>
       <input type="checkbox" name="MCQ" id="MCQ"><input type="text  " name="MCQ-op2" id="MCQop2"  placeholder="2nd option "><br>
       <input type="checkbox" name="MCQ" id="MCQ"><input type="text  " name="MCQ-op3" id="MCQop3" placeholder="3rd option "><br>
       <input type="checkbox" name="MCQ" id="MCQ"><input type="text  " name="MCQ-op4" id="MCQop4"placeholder="4th option "><br>
       <br>
       <br>
    </div>`;
        questions.insertAdjacentHTML("beforeend", MCQ);
      }

      function addshortA() {
        ShortA = `<div class="question">
      <ul type="disc">
      <li>
        <input type="text" name="question" id="question" placeholder="Question">
        </li>
        <br>
      <input type="text" name="ShortA" id="ShortA"><br>
       <br>
       <br>
    </div>`;
        questions.insertAdjacentHTML("beforeend", ShortA);
      }

      function addscale() {
        scale = `<div class="question">
      <ul type="disc">
      <li>
        <label for="temp"><input type="text" name="question" id="question" placeholder="Question"></label><br /> </li>
<input type="range" id="temp" name="temp" list="markers" />

<datalist id="markers">
  <option value="0">1</option>
  <option value="25">2</option>
  <option value="50">3</option>
  <option value="75">4</option>
  <option value="100">5</option>
</datalist>
       <br>
       <br>
    </div>`;
        questions.insertAdjacentHTML("beforeend", scale);
      }
  
 

  
  </script>
  <div> <?php include 'footer.html' ?> </div> 
 </div>
</body> 
</html>