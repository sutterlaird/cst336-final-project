<?php

session_start(); 

include 'database.php'; 
$dbConn = getDatabaseConnection(); 

function validate($username, $password) {
    global $dbConn; 
    $dbConn = getDatabaseConnection(); 
    
   $sql = "SELECT * FROM `users` WHERE username='$username' AND password=SHA('$password')"; 
   
    
    $statement = $dbConn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(); 
    
    
    if (count($records) == 1) {
        // login successful
        $_SESSION['user_id'] = $records[0]['user_id']; 
        $_SESSION['username'] = $records[0]['username']; 
        header('Location: index.php');
        
    }  else {
        echo "<div class='error'>Username and password are invalid </div>"; 
    }
}

?>


<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <h1> Welcome to the Meme Generator!</h1>
        
        <?php 
            if (isset($_POST['username'])) {
                validate($_POST['username'], $_POST['password']);  
            }
        ?>

        <form method="POST">
            Username: <input type="text" name="username"></input> <br/>
            Password: <input type="password" name="password"></input> <br/>
            <input type="submit" value="Login">
        </form>
    </body>
</html>
