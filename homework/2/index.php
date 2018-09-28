<?php
    include 'php/generator.php';
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Random Name Generator</title>
    </head>
    <body>
        
        <?php
        
        printNames($lastName, $lastNameParts, $firstName, $firstNameParts);
        
        ?>

        <div>
            <form id= main3>
                <input type="submit" value="Generate Names!!"/>
            </form>
        </div>
    </body>
</html>