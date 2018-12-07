<?php
$httpMethod = strtoupper($_SERVER['REQUEST_METHOD']);

switch($httpMethod) {
  case "OPTIONS":
    // Allows anyone to hit your API, not just this c9 domain
    header("Access-Control-Allow-Headers: X-ACCESS_TOKEN, Access-Control-Allow-Origin, Authorization, Origin, X-Requested-With, Content-Type, Content-Range, Content-Disposition, Content-Description");
    header("Access-Control-Allow-Methods: POST, GET");
    header("Access-Control-Max-Age: 3600");
    exit();
  case "GET":
    // Allow any client to access
    header("Access-Control-Allow-Origin: *");
    
    http_response_code(401);
    echo "Not Supported";
    
    break;
    
  case 'POST':
    
    $servername = 'sutterlaird.com';
    $username = 'sutterla_final';
    $password = 'cst336final';
    $database = 'sutterla_finalproject';
    
    // Establish the connection and then alter how we are tracking errors (look those keywords up)
    $dbConn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
    ////////////////////////////////////////////////////////////////////////////////
    // This is an example of a "select where" 
    ////////////////////////////////////////////////////////////////////////////////
    
    // if ($_GET['id'] != 0) {
    
    //   $whereSql = "SELECT * FROM pets WHERE id = :id";
      
    //   // The prepare caches the SQL statement for N number of parameters imploded above
    //   $whereStmt = $dbConn->prepare($whereSql);
      
    //   $whereStmt->bindParam(":id", $_GET['id']);
    // }
    
    // else {
      $allSql = "SELECT * FROM users";
      $whereStmt = $dbConn->prepare($allSql);
    // }
    
    $whereStmt->execute(); 
    $userJsonData = $whereStmt->fetchAll(PDO::FETCH_ASSOC);


    // Allow any client to access
    header("Access-Control-Allow-Origin: *");
    // Let the client know the format of the data being returned
    header("Content-Type: application/json");

    // Sending back down as JSON
    echo json_encode($userJsonData);
    
    break;
    
  case 'PUT':
    // Allow any client to access
    header("Access-Control-Allow-Origin: *");
    
    http_response_code(401);
    echo "Not Supported";
    break;
  case 'DELETE':
    // Allow any client to access
    header("Access-Control-Allow-Origin: *");
    
    http_response_code(401);
    break;
}
?>
