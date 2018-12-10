<?php
session_start();
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
    // Server settings for Sutter's MySQL server
    $servername = 'sutterlaird.com';
    $username = 'sutterla_final';
    $password = 'cst336final';
    $database = 'sutterla_finalproject';
    
    // Establish the connection and then alter how we are tracking errors (look those keywords up)
    $dbConn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
    // Get transmitted data
    $rawJsonString = file_get_contents("php://input");
    // Make it a associative array (true, second param)
    $postedJsonData = json_decode($rawJsonString, true);
    
    // Allow any client to access
    header("Access-Control-Allow-Origin: *");
    // Let the client know the format of the data being returned
    header("Content-Type: application/json");
    
    
    if ($postedJsonData['requestType'] == "checkLogin") {
      if ($_SESSION['loggedIn']) {
        $results = ["statusCode" => "0",
                "message" => "Already logged in",
                "user_id" => $_SESSION['user_id'],
                "username" => $_SESSION['username']
                ];
      }
      else {
        $results = ["statusCode" => "1",
                "message" => "Not logged in"];
      }
    }
    
    
    
    
    
    
    
    
    
    else if ($postedJsonData['requestType'] == "logOut") {
      $_SESSION['loggedIn'] = false;
      $_SESSION['user_id'] = "";
      $_SESSION['username'] = "";
      $results = ["statusCode" => "0",
                "message" => "Logged out"];
    }
    
    
    
    
    // Check if request is for login, then execute login procedure
    else if ($postedJsonData['requestType'] == "login")
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
                "message" => "Login successful!",
                "user_id" => $records[0]["user_id"]];
        $_SESSION['loggedIn'] = true;
        $_SESSION['user_id'] = $records[0]["user_id"];
        $_SESSION['username'] = $records[0]["username"];
      }
      else {
        $results = ["statusCode" => "1",
                "message" => "Login failed!"];
      }
    }
    
    
    
    
    
    
    
    
    // Check if request is for signup, then execute signup procedure
    else if ($postedJsonData['requestType'] == "signup")
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
        $_SESSION['loggedIn'] = true;
        $_SESSION['user_id'] = $records[0]["user_id"];
      }
      else {
        $results = ["statusCode" => "1",
                "message" => "Account creation failed!"];
      }
    }
    
    
    
    
    
    
    
    
    // Check if request is to get the saved kit contents, then execute procedure
    else if ($postedJsonData['requestType'] == "getKit")
    {
      $whereSql = "SELECT shortname from `user_has` NATURAL JOIN `items` WHERE user_id=:user_id";
      
      // The prepare caches the SQL statement for N number of parameters imploded above
      $whereStmt = $dbConn->prepare($whereSql);
      $whereStmt->bindParam(":user_id", $postedJsonData['userId']);
      $whereStmt->execute();
      
      $results = $whereStmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    
    
    
    
    
    
    // Check if request is to update the saved kit contents
    else if ($postedJsonData['requestType'] == "setKit")
    {
      $userId = $postedJsonData['userId'];
      
      foreach ($postedJsonData['items'] as $item)
      {
        $whereSql = "SELECT item_id from `items` WHERE shortname=:shortname";
        // The prepare caches the SQL statement for N number of parameters imploded above
        $whereStmt = $dbConn->prepare($whereSql);
        $whereStmt->bindParam(":shortname", $item);
        $whereStmt->execute();
        $results = $whereStmt->fetchAll(PDO::FETCH_ASSOC);
        $itemId = $results[0]["item_id"];
        
        $whereSql2 = "SELECT * from `user_has` WHERE user_id=:user_id AND item_id=:item_id";
        // The prepare caches the SQL statement for N number of parameters imploded above
        $whereStmt2 = $dbConn->prepare($whereSql2);
        $whereStmt2->bindParam(":user_id", $userId);
        $whereStmt2->bindParam(":item_id", $itemId);
        $whereStmt2->execute();
        $results2 = $whereStmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($results2) == 0) {
          try {
            $insertSql = "INSERT INTO `user_has` (`user_id`, `item_id`) values(:user_id, :item_id)";
            $insertStmt = $dbConn->prepare($insertSql);
            $insertStmt->bindParam(":item_id", $itemId);
            $insertStmt->bindParam(":user_id", $userId);
            $insertStmt->execute();
          }
          catch (Exception $e) {
            $e.get_called_class();
          }
        }
      }
      
      $results = ["statusCode" => "0"];
    }
    
    
    
    
    
    
    
    
    
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
