<!DOCTYPE html>
<html lang="en">

<>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Survey</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/generalstyle.css">

    <style>
        .container {
            justify-content: center;
            margin-top: 3rem;
            margin-bottom: 3rem;
        }
        .inner-container {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 2rem;
            border: solid 1px rgba(22, 24, 83, 0.3);
            border-radius: 20px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            margin-bottom: 0.5rem;
            font-size: 1rem;
            color: rgba(0, 0, 0, 0.7)
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
        background-color: #EC255A;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
        }

        .button:hover {
        background-color: #fff;
        color: #EC255A;
        }

        .button:active {
        background-color: #cccccc;
        }

        .btn-primary {
            background-color: #292C6D/*#161853*/;
            color: #fff;
            border: 1px solid;
            border-radius: 5px;
            padding: 5px 10px;
        }

        .btn-primary:hover {
            background-color: #fff;
            color: #292C6D;
            border: 1px solid;
        }

        #space {
            margin: 2rem 0 2rem 0;
        }

        .form-control {
            background: none;
            font-size: 0.95rem;
            transition: 0.4s;
            color: #fff;
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
                        <h3>Enter Survey Information</h3>
                    </td>
                </div>

                <div class="form-group">
                    <div>
                        <label for="surveyTitle" class="col-sm-2 control-label">Survey Title</label>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="surveyTitle" maxlength="100"
                            placeholder="Please enter a survey title !" required class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <label for="surveyDesc" class="col-sm-2 control-label">Survey Description</label>
                    </div>
                    <div class="col-sm-10">
                        <textarea name="surveyDesc" rows="5" cols="auto" maxlength="300" form="form1"
                            placeholder="Please enter survey description !" required class="form-control"></textarea>
                    </div>
                </div>

                <div>
                    <div class="form-group">
                        <div>
                            <label for="surveyCat" class="col-sm-2 control-label">Survey Category</label>
                        </div>
                        <div class="col-sm-10">
                            <select name='surveyCat' class="form-control">
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
                    <div id="questions">

                        <br>
                    </div>


                    <script>

                        questions = document.getElementById("questions");
                        var questionCount = 0

                        function addYesNO() {
                            questionCount++;

                            yes_no = `<div class="question" id="question">
                            <ul type="none">
                            <li> 
                            <label>Question ${questionCount}</label>
                            <input type="text" name="TFQ[]" id="question" placeholder="True / False Question" class="form-control">  </li>
                            </div>`;
                            questions.insertAdjacentHTML("beforeend", yes_no);
                        }

                        //each MCQ saved in the array MCQ[] followed by its 4 choices
                        function addMCQ() {
                            questionCount++;

                            MCQ = `<div class="question">
                            <ul type="none">

                            <li>
                            <label>Question ${questionCount}</label>
                            <input type="text" name="MCQ[]" id="question" placeholder="MCQ Question" class="form-control"></li> 
                                <br>
                            <input type="text" name="MCQ[]" id="MCQop1" placeholder="1st Option" class="form-control"><br>
                            <input type="text" name="MCQ[]" id="MCQop2"  placeholder="2nd Option" class="form-control"><br>
                            <input type="text" name="MCQ[]" id="MCQop3" placeholder="3rd Option" class="form-control"><br>
                            <input type="text" name="MCQ[]" id="MCQop4"placeholder="4th Option" class="form-control">
                            </div>`;
                            questions.insertAdjacentHTML("beforeend", MCQ);
                        }

                        function addshortA() {
                            questionCount++;

                            ShortA = `<div class="question">
                            <ul type="none">
                            <li>
                                <label>Question ${questionCount}</label>
                                <input type="text" name="Short[]" id="question" placeholder="Short Answer Question" class="form-control">
                                </li>
                            </div>`;
                            questions.insertAdjacentHTML("beforeend", ShortA);
                        }

                        function addscale() {
                            questionCount++;

                            scale = `<div class="question">
                            <ul type="none">
                            <li>
                                <label>Question ${questionCount}</label>
                                <input type="text" name="Scale[]" id="question" placeholder="Scale Question" class="form-control"></li>
                            </div>`;
                            questions.insertAdjacentHTML("beforeend", scale);
                        }


                    </script>
                </div>
                <div>
                    <input type="submit" value="Create Survey" class="btn btn-primary">
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
        $MCQ = $_POST['MCQ'];
        $TFQ = $_POST['TFQ'];
        $Short = $_POST['Short'];
        $Scale = $_POST['Scale'];
        $surveyTitlePattern = "/^[a-z]{3,20}(\s{1}[a-z]{3,20}){0,5}$/i";
        $surveyCatPattern = "/^(work|student)$/";
        $questionsPattern = "/^[a-z0-9\?\s]{3,100}$/i";
        $choicesPattern = "/^[a-z0-9 ]{1,50}$/i";
        $validation = false;

        if (!preg_match($surveyTitlePattern, $surveyTitle))
            echo "<span style='color:red;font-size:12px;'>Please, enter a valid title !</span>";
        else if (!preg_match($surveyCatPattern, $surveyCat))
            echo "<span style='color:red;font-size:12px;'>Please, choose a category !</span>";
        else {
            $mcqloopcount = count($MCQ);
            if ($mcqloopcount != 0)
                $mcqloopcount = $mcqloopcount / 5;
            for ($i = 0; $i < $mcqloopcount; $i++) {
                if (!preg_match($questionsPattern, $MCQ[$i])) {
                    echo "<span style='color:red;font-size:12px;'>Please, enter a valid🧨 question format !</span>";
                    die();
                }
                for ($j = $i + 1; $j < $i + 4; $j++) {
                    if (!preg_match($choicesPattern, $MCQ[$j])) {
                        echo "<span style='color:red;font-size:12px;'>Please, enter a valid choices format !</span>";
                        die();
                    }
                }
            }

            $TFQC = count($TFQ);
            for ($i = 0; $i < $TFQC; $i++) {
                if (!preg_match($questionsPattern, $TFQ[$i])) {
                    echo "<span style='color:red;font-size:12px;'>Please, enter a valid question format !</span>";
                    die();
                }
            }
            $ShortC = count($Short);
            for ($i = 0; $i < $ShortC; $i++) {
                if (!preg_match($questionsPattern, $Short[$i])) {
                    echo "<span style='color:red;font-size:12px;'>Please, enter a valid question format !</span>";
                    die();
                }
            }
            $ScaleC = count($Scale);
            for ($i = 0; $i < $ScaleC; $i++) {
                if (!preg_match($questionsPattern, $Scale[$i])) {
                    echo "<span style='color:red;font-size:12px;'>Please, enter a valid question format !</span>";
                    die();
                }
            }
            $validation = true;
        }
        #.....to be continued     
    


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