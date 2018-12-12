<?php
    require("dbinfo.php");

    function parseToXML($htmlStr)
    {
        $xmlStr=str_replace('<','&lt;',$htmlStr);
        $xmlStr=str_replace('>','&gt;',$xmlStr);
        $xmlStr=str_replace('"','&quot;',$xmlStr);
        $xmlStr=str_replace("'",'&#39;',$xmlStr);
        $xmlStr=str_replace("&",'&amp;',$xmlStr);
        return $xmlStr;
    }
    
    // Opens a connection to a MySQL server
    $connection = mysqli_connect($hostname, $username, $password, $database);
    
    if (!$connection) {
      die('Not connected : ' . mysqli_error($connection));
    }
    
    //** This is where the problem lies ** 
    //If you load this page it will print "Can't use db" because $db_selected is coming up false

    // Set the active MySQL database

    $db_selected = mysqli_select_db($connection, $database);
    if (!$db_selected) {
      die ('Can\'t use db : ' . mysqli_error($connection));
    }
    
    // Select all the rows in the markers table
    $query = "SELECT * FROM map WHERE 1";
    $result = mysqli_query($connection, $query);
    if (!$result) {
      die('Invalid query: ' . mysqli_error());
    }
    
    header("Content-type: text/xml");
    
    // Start XML file, echo parent node
    echo "<?xml version='1.0' ?>";
    echo '<markers>';
    $ind=0;
    // Iterate through the rows, printing XML nodes for each
    while ($row = @mysqli_fetch_assoc($result)) {
      // Add to XML document node
      echo '<marker ';
      echo 'id="' . $row['id'] . '" ';
      echo 'name="' . parseToXML($row['name']) . '" ';
      echo 'address="' . parseToXML($row['address']) . '" ';
      echo 'description="' . parseToXML($row['description']) . '" ';
      echo 'lat="' . $row['lat'] . '" ';
      echo 'lng="' . $row['lng'] . '" ';
      echo 'type="' . $row['type'] . '" ';
      echo '/>';
      $ind = $ind + 1;
    }
    
    // End XML file
    echo '</markers>';

?>