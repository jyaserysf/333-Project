
<?php 
if(isset($_REQUEST['S'])){?>
<?php
    $S = $_REQUEST['S'];
    $hint = "";
    try {
        require('database/connection.php');
     

        $stmt = $db->prepare("SELECT * FROM surveys WHERE title LIKE :title");
        $stmt->bindValue(":title", "%{$S}%");
        $stmt->execute();
        $results = $stmt->fetchAll();


        foreach ($results as $result) {
            echo "<a href='answerSurvey.php?link={$result["surveyID"]}'>{$result["title"]}</a><br>";
          }

        if($S !== "") {
            $S = strtolower($S);
            $len = strlen($S);
            foreach($results as $serv) {
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
<style>

    a{
        text-decoration: none;
        color: black;
    }
    a:hover{

       
        color: grey;
    }
</style>