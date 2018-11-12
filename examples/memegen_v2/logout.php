<?php
    include 'functions.php';
    
    checkLoggedIn(); 
    
    session_start(); 
    
    session_destroy(); 
    
    header("Location: login.php"); 
?>
