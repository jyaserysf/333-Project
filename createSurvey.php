<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Survey</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="css/generalstyle.css">
</head>
<body>
    <div id="header"> <?php include 'header.php' ?> </div>
        <div class="cointainer" id="main">
            <div>
                <form id="form1" method='post'>
                    <div>
                        <td><h3>Enter Survey Information</h3></td>
                    </div>

                    <div>
                        <div>
                            <label for="surveyTitle">Survey Title</label>
                        </div>
                        <div>
                            <input 
                                type="text"
                                name="surveyTitle"
                                maxlength="100"
                                placeholder="Please enter a survey title !" 
                                required
                            >
                        </div>
                    </div>
                    
                    <div>
                        <div>
                            <label for="surveyDesc">Survey Description</label>
                        </div>
                        <div>
                            <textarea 
                                name="surveyDesc"
                                rows="5" 
                                cols="50"
                                maxlength="300"
                                form="form1"
                                placeholder="Please enter survey description !" 
                                required
                            ></textarea>
                            
                        </div>
                    </div>
                    
                    <div>
                        <div>
                            <label for="surveyCat">Survey Category</label>
                        </div>
                        <div>
                            <select name='surveyCat'>
                                <option disabled selected>Select Survey Category</option>
                                <option value='work'>Work</option>
                                <option value='student'>Student</option>
                            </select>
                        </div>

             <!--Create questions start-->

    <h1>Create Your Own Questions </h1>

        <input type="button" value="T/F" id="yes/no" onclick="addYesNO()">
        <input type="button" value="MCQ" id="MCQ" onclick="addMCQ()">
        <input type="button" value="short answer " id="shortA" onclick="addshortA()">
        <input type="button" value="scale " id="Scale " onclick="addscale()">
        <div id="questions">

        <br>
      </div>

    
    <script >
   
      questions = document.getElementById("questions");

      function addYesNO() 
      {
        yes_no = `<div class="question" id="question">
     <ul type="disc">
      <li > <input type="text" name="TFQ[]" id="question" placeholder="True/False Question">  </li> <br>
      <br>
    </div>`;
        questions.insertAdjacentHTML("beforeend", yes_no);
      }


      function addMCQ() //each MCQ saved in the array MCQ[] followed by its 4 choices
      {
        MCQ = `<div class="question">
      <ul type="disc">

      <li><input type="text" name="MCQ[]" id="question" placeholder="MCQ Question"></li> 
        <br>
      <input type="text" name="MCQ[]" id="MCQop1" placeholder="1st option "><br>
      <input type="text" name="MCQ[]" id="MCQop2"  placeholder="2nd option "><br>
      <input type="text" name="MCQ[]" id="MCQop3" placeholder="3rd option "><br>
      <input type="text" name="MCQ[]" id="MCQop4"placeholder="4th option "><br>
       <br>
    </div>`;
        questions.insertAdjacentHTML("beforeend", MCQ);
      }

      function addshortA() {
        ShortA = `<div class="question">
      <ul type="disc">
      <li>
        <input type="text" name="Short[]" id="question" placeholder="Short Answer Question">
        </li>
       <br>
    </div>`;
        questions.insertAdjacentHTML("beforeend", ShortA);
      }

      function addscale() {
        scale = `<div class="question">
      <ul type="disc">
      <li>
        <input type="text" name="Scale[]" id="question" placeholder="Scale Question"></li>
        <br>
    </div>`;
        questions.insertAdjacentHTML("beforeend", scale);
      }
  
  
  </script>
 </div>
                    <div>
                        <input 
                            type="submit" 
                            value="Create Survey" 
                        >
                    </div>
 </form>
    </div>
 </div>
                <?php # validation
    if (isset($_POST['surveyTitle'])) {
        include 'test_input.php';
        $surveyTitle = test_input($_POST['surveyTitle']); 
        $surveyDesc = test_input($_POST['surveyDesc']); 
        $surveyCat = test_input($_POST['surveyCat']); 
        $MCQ = $_POST['MCQ'];
        $TFQ = $_POST['TFQ'];
        $Short = $_POST['Short'];
        $Scale = $_POST['Scale'];
        $surveyTitlePattern = "/^[a-z]{3,20}(\s{1}[a-z]{3,20}){0,5}$/i";
        $surveyCatPattern = "/^(work|student)$/";
        $questionsPattern = "/^[a-z0-9\?\s]{3,100}$/i";
        $choicesPattern = "/^[a-z0-9 ]{1,50}$/i";
        $validation=false;

        if(!preg_match($surveyTitlePattern, $surveyTitle))
            echo "<span style='color:red;font-size:12px;'>Please, enter a valid title !</span>" ;
        else if(!preg_match($surveyCatPattern, $surveyCat))
            echo "<span style='color:red;font-size:12px;'>Please, choose a category !</span>" ;
        else
        {
            $mcqloopcount = count($MCQ);
            if($mcqloopcount!=0)$mcqloopcount=$mcqloopcount/5;
            for($i=0;$i<$mcqloopcount;$i++)
            {
                if(!preg_match($questionsPattern,$MCQ[$i]))
                {
                    echo "<span style='color:red;font-size:12px;'>Please, enter a valid🧨 question format !</span>" ;
                    die();
                }
                for($j=$i+1;$j<$i+4;$j++)
                {
                    if(!preg_match($choicesPattern,$MCQ[$j]))
                    {
                    echo "<span style='color:red;font-size:12px;'>Please, enter a valid choices format !</span>" ;
                    die();   
                    }
                }
            }

            $TFQC = count($TFQ);
            for($i=0;$i<$TFQC;$i++)
            {
                if(!preg_match($questionsPattern,$TFQ[$i]))
                {
                    echo "<span style='color:red;font-size:12px;'>Please, enter a valid question format !</span>" ;
                    die();
                }   
            }
            $ShortC = count($Short);
            for($i=0;$i<$ShortC;$i++)
            {
                if(!preg_match($questionsPattern,$Short[$i]))
                {
                    echo "<span style='color:red;font-size:12px;'>Please, enter a valid question format !</span>" ;
                    die();
                }   
            }
            $ScaleC = count($Scale);
            for($i=0;$i<$ScaleC;$i++)
            {
                if(!preg_match($questionsPattern,$Scale[$i]))
                {
                    echo "<span style='color:red;font-size:12px;'>Please, enter a valid question format !</span>" ;
                    die();
                }   
            }
            $validation = true;
        }
        #.....to be continued     



        if($validation)
        try {
            $totalQuestions = $mcqloopcount+$ScaleC+$ShortC+$TFQC;
            require('database/connection.php');
            $db->beginTransaction();
            $stmt = $db->prepare("INSERT INTO surveys VALUES(NULL, DEFAULT, ?, NOW(), ?, ?, ?)");
            $stmt->execute(array($totalQuestions, $surveyTitle, $surveyDesc, $surveyCat));
            $lastSurvey = $db->lastInsertId();
            $stmt = $db->prepare("INSERT INTO choices VALUES(NULL,?,?,?,?,?,$lastSurvey)");

            for($i=0;$i<$mcqloopcount;$i++)
            {
                $stmt->execute(array($MCQ[$i],$MCQ[$i+1],$MCQ[$i+2],$MCQ[$i+3],$MCQ[$i+4]));
            }
            $stmt = $db->prepare("INSERT INTO questions VALUES(NULL,?,?,$lastSurvey)");
            for($i=0;$i<$TFQC;$i++)
            {
                $stmt->execute(array($TFQ[$i],'yes_no'));

            }
            for($i=0;$i<$ShortC;$i++)
            {
                $stmt->execute(array($Short[$i],'short_answer'));

            }
            for($i=0;$i<$ScaleC;$i++)
            {
                $stmt->execute(array($Scale[$i],'scale'));

            }
            $db->commit();
            
        } 
        catch (PDOException $e) {
            $db->rollBack();
            die("Error: " . $e->getMessage());
        }
    }

?>

    <div> <?php include 'footer.html' ?> </div> 
</body> 
</html>