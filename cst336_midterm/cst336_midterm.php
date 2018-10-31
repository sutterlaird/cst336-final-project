<?php 
include "database.php";

function randomQuote(){
    
    $dbConn = getDatabaseConnection();
    
    $sql .= "SELECT * FROM `q_quotes` ORDER BY RAND() LIMIT 1";
    
    // SELECT column FROM table
    // ORDER BY RAND()
    // LIMIT 1
    
    $statement = $dbConn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll();
    
    foreach($records as $record){
        echo '<h1>';
        echo $record['quote'];
        echo '</h1>';
        echo '<h3> <i>';
        echo "  -" . $record['author']. "<br>";
        echo '</i> </h3>';
    }
    
}

function createQuote($newQuote, $newAuthor) {
    
    // construct the proper SQL INSERT statement
    $dbConn = getDatabaseConnection(); 

    $sql = "INSERT INTO `q_quotes` (`quoteId`, `quote`, `author`) VALUES (NULL, '$newQuote', '$newAuthor');"; 
    
    $statement = $dbConn->prepare($sql); 
    $result = $statement->execute(); 
    
    if (!$result) {
      return null; 
    }
    
    $last_id = $dbConn->lastInsertId();

    
    // fetch the newly created object from database
    
    $sql = "SELECT * from q_quotes WHERE quoteId = $last_id"; 
    $statement = $dbConn->prepare($sql); 
    
    $statement->execute(); 
    $records = $statement->fetchAll(); 
    $newMeme = $records[0]; 
}


if (isset($_POST['newQuote']) && isset($_POST['newAuthor'])) {
    if($_POST['newQuote'] == ""){
        echo '<font color="red">Text must not be empty</font>';
        echo '</br>';
    }
    
    if($_POST['newAuthor'] == ""){
        echo '<font color="red">Author must not be empty</font>';
        echo '</br>';
    }
    
    elseif ($_POST['newQuote'] != "" && $_POST['newAuthor'] != "") {
    $quoteObj = createQuote($_POST['newQuote'], $_POST['newAuthor']); 
    }        
}




?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <link href="styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        
        <?php 
        
        randomQuote();
        
        ?>

        </br>
        
        <a href="create.php" id="createQuote">Create</a>
        
 

    </body>
</html>