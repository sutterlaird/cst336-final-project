<?php
    
    session_start();

    
    if(isset($_POST['destroy'])) {
        session_destroy();
        session_start();
    }
    
    if(!isset($_SESSION['randomval'])){
        $_SESSION['randomval'] = rand(1, 100);
    }
    
    if(isset($_POST['guess'])){
        if ($_POST['guess'] < $_SESSION['randomval']){
            echo 'TOO LOW';
            echo 'Number of tries: ' . $counter++;
        }
        
        if ($_POST['guess'] > $_SESSION['randomval']){
            echo 'TOO HIGH';
        }
        
        if ($_POST['guess'] == $_SESSION['randomval']){
            echo 'THATS CORRECT';
        }
        
    }


?>

<!DOCTYPE html>
<html>
    <head></head>
    <body>
        Random Numer: <?php echo $_SESSION['randomval']; ?>
        <br/><br/>
        <form method="POST">
            <input type="text" name="guess"/>
            <input type="submit" value="Submit"/>
        </form>
        <br/>
        <form method="POST">
            <input type="submit" name="destroy" value="Start Over"></input>
        </form>

        
        
    </body>
</html>