
<?php 
if(isset($_REQUEST['S'])){?>
<?php
    $S = $_REQUEST['S'];
    $hint = "";
    try {
        require('database/connection.php');
        $SName = $db->prepare("SELECT * from surveys");
        $SName->execute();
        $SurveysNames = $SName->fetchAll();

        $stmt = $db->prepare("SELECT * FROM surveys WHERE title LIKE :title");
        $stmt->bindValue(":title", "%{$S}%");
        $stmt->execute();
        $results = $stmt->fetchAll();


        foreach ($results as $result) {
            echo "<a href='answerSurvey.php?id={$result["surveyID"]}'>{$result["title"]}</a><br>";
          }





        if($S !== "") {
            $S = strtolower($S);
            $len = strlen($S);
            foreach($SurveysNames as $serv) {
                if($S == strtolower(substr($serv[4], 0, $len))) {
                    if($hint === "") {
                        $hint = $serv[4];
                    } else {
                        $hint .= ",{$serv[4]}";
                    }
                }
            }
        }
        

        echo $hint === "" ? "no suggestion" : $hint;
    } catch(PDOException $e) {
        die($e->getMessage());
    }
}
?>