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
    
    $rawJsonString = file_get_contents("php://input");
    // Make it a associative array (true, second param)
    $postedJsonData = json_decode($rawJsonString, true);
    
    if ($postedJsonData['requestType'] == "login")
    {
      $whereSql = "SELECT * FROM `users` WHERE username=:username AND password=SHA(:password)";
      
      // The prepare caches the SQL statement for N number of parameters imploded above
      $whereStmt = $dbConn->prepare($whereSql);
      $whereStmt->bindParam(":username", $postedJsonData['username']);
      $whereStmt->bindParam(":password", $postedJsonData['password']);
      $whereStmt->execute(); 
      $records = $whereStmt->fetchAll(PDO::FETCH_ASSOC);
      
      if (count($records) == 1) {
        // login successful
        $results = ["statusCode" => "0",
                "message" => "Login successful!"];
      }
      else {
        $results = ["statusCode" => "1",
                "message" => "Login failed!"];
      }
    }
    
    
    if ($postedJsonData['requestType'] == "signup")
    {
      $whereSql = "INSERT INTO `users` (`username`, `password`) values(:username,SHA(:password))";
      
      // The prepare caches the SQL statement for N number of parameters imploded above
      $whereStmt = $dbConn->prepare($whereSql);
      $whereStmt->bindParam(":username", $postedJsonData['username']);
      $whereStmt->bindParam(":password", $postedJsonData['password']);
      $whereStmt->execute();
      
      
      $whereSql = "SELECT * FROM `users` WHERE username=:username AND password=SHA(:password)";
      // The prepare caches the SQL statement for N number of parameters imploded above
      $whereStmt = $dbConn->prepare($whereSql);
      $whereStmt->bindParam(":username", $postedJsonData['username']);
      $whereStmt->bindParam(":password", $postedJsonData['password']);
      $whereStmt->execute(); 
      $records = $whereStmt->fetchAll(PDO::FETCH_ASSOC);
      
      if (count($records) == 1) {
        // login successful
        $results = ["statusCode" => "0",
                "message" => "Account creation successful!"];
      }
      else {
        $results = ["statusCode" => "1",
                "message" => "Account creation failed!"];
      }
    }
    
    
    // Allow any client to access
    header("Access-Control-Allow-Origin: *");
    // Let the client know the format of the data being returned
    header("Content-Type: application/json");
    // Sending back down as JSON
    echo json_encode($results);
    
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
