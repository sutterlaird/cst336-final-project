<?php
session_start(); 
// connect to our mysql database server
function getDatabaseConnection() {
    if (strpos($_SERVER['SERVER_NAME'], "c9users") !== false) {
        // running on cloud9
        $host = "localhost";
        $username = "gerardolopez";
        $password = ""; // best practice: define this in a separte file
        $dbname = "memes_v2"; 
    } else {
        // running on Heroku
        $host = "";
        $username = "";
        $password = ""; 
        $dbname = ""; 
    }
    
    
    // Create connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbConn; 
}
// temporary test code
//$dbConn = getDatabaseConnection(); 
?>