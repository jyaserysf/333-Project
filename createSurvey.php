
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Survey</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/generalstyle.css">
    <!-- icons library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- .. -->
    <style>
        .container {
            justify-content: center;
            margin-top: 3rem;
            margin-bottom: 3rem;
        }

        .inner-container {
            background-color: rgba(255, 255, 255, 0.65);
            padding: 2rem;
            border: solid 1px rgba(211, 214, 219, 0.7);
            border-radius: 20px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 1rem;
            color: rgba(0, 0, 0, 0.7);
        }

        label {
            margin-bottom: 0.55rem;
            font-size: 1rem;
            color: rgba(0, 0, 0, 0.65)
        }

        input {
            color: rgba(0, 0, 0, 0.7)
        }

        .button {
            display: inline-block;
            padding: 5px 10px;
            margin: 10px 0;
            border: 1px solid;
            border-radius: 5px;
            background-color: rgba(236, 37, 90, 0.9);
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .button:hover {
        background-color: #fff;
        color: rgba(236, 37, 90, 0.9);
        }

        .button:active {
        background-color: #cccccc;
        }

        .btn-primary {
            background-color: rgba(41, 44, 109, 0.9);
            color: #fff;
            border: 1px solid;
            border-radius: 5px;
            padding: 5px 10px;
        }

        .btn-primary:hover {
            background-color: #fff;
            color: rgba(41, 44, 109, 0.9);
            border: 1px solid;
        }

        #space {
            margin: 2rem 0 2rem 0;
        }

        #input-area {
            background: none;
            font-size: 0.95rem;
            transition: 0.4s;
            color: rgba(0, 0, 0, 0.7);
            margin-bottom: 1.1rem;
        }

        #trash {
            float: right;
        }

        #questions {
            background-color: rgba(250, 237, 240, 0.1);
            padding: 2rem;
            border: solid 1px rgba(211, 214, 219, 0.7);
            border-radius: 20px;
            margin: 1rem 0 2rem 0;
        }

        .qCounter {
            display: inline-block;
            padding: 5px 10px;
            margin: 10px 0;
            border: 1px solid #EC255A;
            border-radius: 5px;
            
            color:#EC255A;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            float: right;
        }

    </style>
</head>
<body>
    <div id="header">
        <?php include 'header.php' ?>
    </div>
    <div class="container" id="main">
        <div class="inner-container col-lg-8">
            <form class="form-horizontal" id="form1" method='post'>
                <div class="form-group">
                    <td>
                        <h3><b>Enter Survey Information</b></h3>
                    </td>
                </div>

                <div class="form-group">
                    <div>
                        <label for="surveyTitle" class="col-sm-2 control-label">Survey Title</label>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="surveyTitle" maxlength="100"
                            placeholder="Please enter a survey title !" required class="form-control" id="input-area">
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <label for="surveyDesc" class="col-sm-2 control-label">Survey Description</label>
                    </div>
                    <div class="col-sm-10">
                        <textarea name="surveyDesc" rows="5" cols="auto" maxlength="300" form="form1"
                            placeholder="Please enter survey description !" required class="form-control" id="input-area"></textarea>
                    </div>
                </div>

                <div>
                    <div class="form-group">
                        <div>
                            <label for="surveyCat" class="col-sm-2 control-label">Survey Category</label>
                        </div>
                        <div class="col-sm-10">
                            <select name='surveyCat' class="form-control" id="input-area">
                                <option disabled selected>Select Survey Category</option>
                                <option value='work'>Work</option>
                                <option value='student'>Student</option>
                            </select>
                        </div>
                    </div>

                    <!--Create questions start-->
                    <div id="space"></div>
                    <h5>Create Your Own Questions </h5>

                    <input class="button" type="button" value="TRUE / FALSE" id="yes/no" onclick="addYesNO()">
                    <input class="button" type="button" value="MCQ" id="MCQ" onclick="addMCQ()">
                    <input class="button" type="button" value="SHORT ANSWER" id="shortA" onclick="addshortA()">
                    <input class="button" type="button" value="SCALE" id="Scale " onclick="addscale()">
                    <span id="q" class="qCounter"></span>
                    <div id="questions">
                        
                    </div>

                    
                    <script>

                        questions = document.getElementById("questions");
                        var questionCount = 0
                        var max=" / 20"

                        document.getElementById("q").innerHTML=questionCount+max;
                        function addYesNO() {
                            questionCount++;
                            if (questionCount > 20) {
                            // disable the button if the limit is reached
                            document.getElementById("yes/no").disabled = true;
                            return;
                            }

                            yes_no = `<div class="question" id="question">
                            <ul type="none">
                            <li> 

                            <label>Question ${questionCount}</label>
                            <button class="btn" id="trash"><i class="fa fa-trash delete-question"></i></button><p>

                            <input type="text" name="TFQ[]" id="question" placeholder="True / False Question" class="form-control">  
                            </li>

                            </div>`;
                            
                            document.getElementById("q").innerHTML=questionCount+max;
                            questions.insertAdjacentHTML("beforeend", yes_no);
                            
                          
                        

                        }

                      

                        //each MCQ saved in the array MCQ[] followed by its 4 choices
                        function addMCQ() {
                            questionCount++;
                            if (questionCount > 20) {
                            // disable the button if the limit is reached
                            document.getElementById("MCQ").disabled = true;
                            return;
                            }

                            MCQ = `<div class="question">
                            <ul type="none">

                            <li>
                            <label>Question ${questionCount}</label>
                            <button class="btn" id="trash"><i class="fa fa-trash delete-question"></i></button>

                            <input type="text" name="MCQ[]" id="question" placeholder="MCQ Question" class="form-control">

                                <br>
                            <input type="text" name="MCQ[]" id="MCQop1" placeholder="1st Option" class="form-control" id="input-area"><br>
                            <input type="text" name="MCQ[]" id="MCQop2"  placeholder="2nd Option" class="form-control" id="input-area"><br>
                            <input type="text" name="MCQ[]" id="MCQop3" placeholder="3rd Option" class="form-control" id="input-area"><br>
                            <input type="text" name="MCQ[]" id="MCQop4"placeholder="4th Option" class="form-control" id="input-area">
                            </div>`;
                            
                            document.getElementById("q").innerHTML=questionCount+max;
                            questions.insertAdjacentHTML("beforeend", MCQ);
                        }

                        function addshortA() {
                            questionCount++;
                            if (questionCount > 20) {
                            // disable the button if the limit is reached
                            document.getElementById("shortA").disabled = true;
                            return;
                            }

                            ShortA = `<div class="question">
                            <ul type="none">
                            <li>
                                <label>Question ${questionCount}</label>
                                <button class="btn" id="trash"><i class="fa fa-trash delete-question"></i></button>

                                <input type="text" name="Short[]" id="question" placeholder="Short Answer Question" class="form-control">

                                </li>
                            </div>`;

                            document.getElementById("q").innerHTML=questionCount+max;
                            questions.insertAdjacentHTML("beforeend", ShortA);
                        }

                        function addscale() {
                            questionCount++;
                            if (questionCount > 20) {
                            // disable the button if the limit is reached
                            document.getElementById("Scale").disabled = true;
                            return;
                            }

                            scale = `<div class="question">
                            <ul type="none">
                            <li>
                                <label>Question ${questionCount}</label>
                                <button class="btn" id="trash"><i class="fa fa-trash delete-question"></i></button>

                                <input type="text" name="Scale[]" id="question" placeholder="Scale Question" class="form-control">
                                </li>

                            </div>`;

                            document.getElementById("q").innerHTML=questionCount+max;
                            questions.insertAdjacentHTML("beforeend", scale);
                        }


                      /*   delete question */

                            
                    questions.addEventListener("click", function(event) {
                 if (event.target.classList.contains("delete-question")) {
                  event.target.closest(".question").remove();
                  questionCount--;
                  document.getElementById("q").innerHTML=questionCount+max;
                  updateQuestionNumbers();
                     }
                    });

                    function updateQuestionNumbers(){
                        var questionNumbers = document.querySelectorAll(".question label");
                    for (var i = 0; i < questionNumbers.length; i++) {
                    questionNumbers[i].textContent = "Question " + (i + 1);
                        }
                    }


                    </script>
                </div>
                <div>
                    <input type="submit" value="Create Survey" class="btn btn-primary">
                    <input type="reset" value="Clear" class="btn btn-primary">
                </div>
                
            </form>
            
        </div>
    </div>
    <!------------------------------------------------------------------------------------------>
    
    <?php # validation
    if (isset($_POST['surveyTitle'])) {
        include 'test_input.php';
        $surveyTitle = test_input($_POST['surveyTitle']);
        $surveyDesc = test_input($_POST['surveyDesc']);
        $surveyCat = test_input($_POST['surveyCat']);
        $MCQ = isset($_POST['MCQ'])?$_POST['MCQ']:null;
        $TFQ = isset($_POST['TFQ'])?$_POST['TFQ']:null;
        $Short = isset($_POST['Short'])?$_POST['Short']:null;
        $Scale = isset($_POST['Scale'])?$_POST['Scale']:null;
        $mcqloopcount = isset($_POST['MCQ'])?count($MCQ):0;
        $TFQC = isset($_POST['TFQ'])?count($TFQ):0;
        $ShortC = isset($_POST['Short'])?count($Short):0;
        $ScaleC = isset($_POST['Scale'])?count($Scale):0;

        $surveyTitlePattern = "/^[a-z0-9\s]{5,50}$/i";
        $surveyCatPattern = "/^(work|student)$/";
        $questionsPattern = "/^[a-z0-9\?\s]{3,100}$/i";
        $choicesPattern = "/^[a-z0-9 ]{1,50}$/i";
        $validation = false;

        if (!preg_match($surveyTitlePattern, $surveyTitle))
            echo "<span style='color:red;font-size:12px;'>The title must be at least 5 characters and not exceeding 50 characters !</span>";
        else if (!preg_match($surveyCatPattern, $surveyCat))
            echo "<span style='color:red;font-size:20px;'>Please, choose a category !</span>";
        else {
            if ($mcqloopcount != 0)
                $mcqloopcount = $mcqloopcount / 5;
            for ($i = 0; $i < $mcqloopcount; $i++) {
                if (!preg_match($questionsPattern, $MCQ[$i])) {
                    echo "<span style='color:red;font-size:12px;'>Please, enter a valid question format (do not include special characters) !</span>";
                    die();
                }
                for ($j = $i + 1; $j < $i + 4; $j++) {
                    if (!preg_match($choicesPattern, $MCQ[$j])) {
                        echo "<span style='color:red;font-size:12px;'>Please, enter a valid choices format (do not include special characters) !</span>";
                        die();
                    }
                }
            }

            for ($i = 0; $i < $TFQC; $i++) {
                if (!preg_match($questionsPattern, $TFQ[$i])) {
                    echo "<span style='color:red;font-size:12px;'>Please, enter a valid question format (do not include special characters)!</span>";
                    die();
                }
            }
            for ($i = 0; $i < $ShortC; $i++) {
                if (!preg_match($questionsPattern, $Short[$i])) {
                    echo "<span style='color:red;font-size:12px;'>Please, enter a valid question format (do not include special characters)!</span>";
                    die();
                }
            }
            for ($i = 0; $i < $ScaleC; $i++) {
                if (!preg_match($questionsPattern, $Scale[$i])) {
                    echo "<span style='color:red;font-size:12px;'>Please, enter a valid question format (do not include special characters)!</span>";
                    die();
                }
            }
            $validation = true;
        }
            
    

          

        if ($validation)
            try {
                $totalQuestions = $mcqloopcount + $ScaleC + $ShortC + $TFQC;
                require('database/connection.php');
                $db->beginTransaction();
                $stmt = $db->prepare("INSERT INTO surveys VALUES(NULL, DEFAULT, ?, NOW(), ?, ?, ?)");
                $stmt->execute(array($totalQuestions, $surveyTitle, $surveyDesc, $surveyCat));
                $lastSurvey = $db->lastInsertId();
                $stmt1 = $db->prepare("INSERT INTO questions VALUES(NULL,?,?,$lastSurvey)");
                $stmt2 = $db->prepare("INSERT INTO choices VALUES(?,?,?,?,?)");

                for ($i = 0; $i < $mcqloopcount; $i++) {
                    $stmt1->execute(array($MCQ[$i], 'mcq'));
                    $stmt2->execute(array($db->lastInsertId(), $MCQ[$i + 1], $MCQ[$i + 2], $MCQ[$i + 3], $MCQ[$i + 4]));
                }
                for ($i = 0; $i < $TFQC; $i++) {
                    $stmt1->execute(array($TFQ[$i], 'yes_no'));

                }
                for ($i = 0; $i < $ShortC; $i++) {
                    $stmt1->execute(array($Short[$i], 'short_answer'));

                }
                for ($i = 0; $i < $ScaleC; $i++) {
                    $stmt1->execute(array($Scale[$i], 'scale'));

                }
                $db->commit();

            } catch (PDOException $e) {
                $db->rollBack();
                die("Error: " . $e->getMessage());
            }
    }

    ?>

    <div>
        <?php include 'footer.html' ?>
    </div>
</body>

</html>