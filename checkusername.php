<?php

try
    {
        require('database/connection.php');
        $sql = 'select * from users where username = ?';
        $statement = $db->prepare($sql);
        $statement->execute(array($_GET['u']));
        if(0<$statement->rowCount())
        {
            echo 'exists';
        } else {
          // Username is available
          echo 'available';
        }
        $db=null;
        
    }
    catch(PDOException $e)
    {
        die($e->getMessage());
    }
    
    ?>