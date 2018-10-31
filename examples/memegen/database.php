<?php
// connect to our mysql database server

function getDatabaseConnection() {
    if($_SERVER['SERVER_NAME'] == "cst336-gerardolopez.c9users.io"){
        $host = "localhost";
        $username = "gerardolopez";
        // $password = "cst336";
        $dbname = meme_lab; 
    }
    
    else{
        $host = "us-cdbr-iron-east-01.cleardb.net";
        $username = "be1ef852f0d88";
        $password = "97aa5537";
        $dbname = "heroku_773c99b358a4f76"; 
    }
    
    // Create connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbConn; 
}


// $dbConn = getDatabaseConnection();


?>
