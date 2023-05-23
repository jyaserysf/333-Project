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
                <form id="form1" method='post' action="createQs.php">
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
                                autocomplete="off"
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
                                placeholder="Please enter survey description" 
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
                    </div>
                    
                    <div>
                        <div>
                            <label for="noOfQuestions">Number Of Questions</label>
                        </div>
                        <div>
                            <input 
                                type="number"
                                name="noOfQuestions"
                                min="5"
                                max="12"
                                autocomplete="off"
                                required
                            >
                        </div>
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
    <div> <?php include 'footer.html' ?> </div> 
</body> 
</html>