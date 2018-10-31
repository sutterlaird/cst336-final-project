<?php
include "database.php";
function soledad(){
    $dbConn = getDatabaseConnection();
    $sql = "SELECT * FROM `mp_town` WHERE population >= 50000 && population<= 80000";
    $statement = $dbConn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll();
    
    foreach($records as $record){
        echo "Town Name: " .$record['town_name']."-".$record['population'];
        echo "<br>";
    }
    
}

function orderedByPopulation(){
    
    $dbConn = getDatabaseConnection();
    $sql .= "SELECT * FROM `mp_town` WHERE population ORDER BY population DESC";
    $statement = $dbConn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll();
    
    foreach($records as $record){
        echo "Town Name: " .$record['town_name']."-".$record['population']."<br>";
    }
    
}

function leastThree(){
    
    $dbConn = getDatabaseConnection();
    $sql .= "SELECT * FROM `mp_town` WHERE population < 27175";
    $statement = $dbConn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll();
    
    foreach($records as $record){
        echo "Town Name: " .$record['town_name']."-".$record['population']."<br>";
    }
}

function countiesThatStartWithS(){
    $dbConn = getDatabaseConnection();
    $sql .= "SELECT * FROM `mp_county` WHERE county_name like 's%'";
    $statement = $dbConn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll();
    
    foreach($records as $record){
        echo "Town Name: " .$record['county_name']."<br>";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Reports</title>
    </head>
    <body>
        <?php soledad(); 
        echo "<br>";
        orderedByPopulation();
        echo "<br>";
        leastThree();
        echo "<br>";
        countiesThatStartWithS();
        ?>
        <br><br>
        
    </body>
</html>