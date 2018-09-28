<?php
    include 'php/generator.php';
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Random Name Generator</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Arimo|Kalam" rel="stylesheet">
    </head>
    <body>
        <div id = "wrapper">
            <div id = "text">
            <header>
                <h1 id = "head1"><strong>Random Name Generator</strong></h1>
                <hr width = "75%"/>
            </header>
    
        <h2 id = "names">
        <?php
        printNames($lastName, $lastNameParts, $firstName, $firstNameParts);
        ?>
        </h2>
            </div>
    
    
        <div>
            <form id= "form">
                <input type="image" src="img/button_generate-names.png" alt="submit" name="submit"/>
            </form>
        </div>
        
    <footer>
        <hr width="75%">
        <section id="logo">
        <a href="https://csumb.edu/" target="_blank">
        <img src="img/csumb_logo.png" width="50" title="CSU Monterey Bay"/>
        </a>
        </section>
        
        <br />
        
        CST-336 Internet Programming. 2018&copy; Lopez <br />
        <strong>Disclaimer</strong> The information in this website is fictitious. <br />
        It is used for academic purposes only.
    </footer>
        </div>
    </body>
</html>