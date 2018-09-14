<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>
     

       
<?php

    echo "<table>";
        
    echo "<tr> <td>Number</td> <td>Even or Odd</td> </tr>";
    
for($i=0; $i<9; $i++){
    echo "<tr>";
    $num = rand(0,10);
    echo "<td>$num</td>";
    
    $odd_or_even = ($num % 2 == 0)? "even":"odd";
    echo "<td>$odd_or_even</td>";
    echo "</tr>";



    
    // echo "<br />";
}
    echo "</table>";

?>


    </body>
</html>