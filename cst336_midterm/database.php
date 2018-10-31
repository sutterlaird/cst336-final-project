<?php
// connect to our mysql database server

function getDatabaseConnection() {
    $host = "localhost";
    $username = "gerardolopez";
    
    $dbname = midterm; 
    
    // Create connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username);
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbConn; 
}


?>