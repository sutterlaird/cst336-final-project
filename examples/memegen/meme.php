<?php 

    include 'database.php';


function createMeme($line1, $line2, $memeType) {
  
    if ($memeType == 'college-grad'){
      $memeURL = 'https://upload.wikimedia.org/wikipedia/commons/c/ca/LinusPaulingGraduation1922.jpg';
    }
    
    else if ($memeType == 'thinking-ape'){
       $memeURL = 'https://upload.wikimedia.org/wikipedia/commons/f/ff/Deep_in_thought.jpg';
    }
    
    else if ($memeType == 'coding'){
       $memeURL = 'https://upload.wikimedia.org/wikipedia/commons/b/b9/Typing_computer_screen_reflection.jpg';
    }    
    
    else if ($memeType == 'old-class'){
       $memeURL = 'https://upload.wikimedia.org/wikipedia/commons/4/47/StateLibQld_1_100348.jpg';
    }    
    
    
    
    $dbConn = getDatabaseConnection(); 

    $sql = "INSERT INTO `all_memes` (`id`, `line1`, `line2`, `meme_url`) VALUES (NULL, '$line1', '$line2', '$memeURL');"; 
    echo "SQL: $sql <br>";
    
    $statement = $dbConn->prepare($sql); 
    
    $statement->execute(); 
}

if (isset($_POST['line1']) && isset($_POST['line2'])) {
  createMeme($_POST['line1'], $_POST['line2'], $_POST['meme-type']); 
}

function displayMemes() {
    
    $dbConn = getDatabaseConnection(); 

    $sql = "SELECT * from all_memes"; 
    $statement = $dbConn->prepare($sql); 
    
    $statement->execute(); 
    $records = $statement->fetchAll(); 
    foreach ($records as $record) {
      $memeURL = $record['meme_URL'];
      echo '<div class="meme-div" style="background-image:url(' . $memeURL . ');">';
      echo "<h2 class='line1'>" . $record['line1'] . "</h2>";
      echo  "<h2 class='line2'>" .  $record['line2'] . "</h2>";
      echo '</div>';
    }
} 


?>

<!DOCTYPE html>
<html>
  <head>
    <title>A Meme</title>
    <style>
      .meme-div{
      width: 450px;
      height: 450px;
      background-size: 100%;
      text-align: center;
      position: relative;
      font-size: 18px;
      }
      
      .memes-container .meme-div{
        width: 300px;
        height: 300px;
        float: left;
        margin: 10px 20px ;
      }
      
      h2 {
        position: absolute;
        left: 0;
        right: 0;
        margin: 15px 0;
        padding: 0 5px;
        font-family: impact;
        color: white;
        text-shadow: 1px 1px black;
      }
      .line1 {
         top: 0;
       }
      .line2 {
         bottom: 0;
       }
    </style>
  </head>
  <body>
    
    <?php if(isset($_POST['line1']) && isset($_POST['line2'])){ ?>
    <h1>Your Meme</h1>
    <!--The image needs to be rendered for each new meme
    so set the div's background-image property inline -->
    <div class="meme-div" style="background-image:url(https://upload.wikimedia.org/wikipedia/commons/f/ff/Deep_in_thought.jpg);">
      <h2 class="line1"><?= $_POST['line1']?> </h2>
      <h2 class="line2"><?= $_POST['line2']?></h2>
    </div>
    <?php } ?>
    <br>
    
    <h1>Display All Memes</h1>
    <div  class='memes-container'>
    <?php
        displayMemes();
    ?>
    <div style=clear: both></div>
    </div>
    
    <!--DO ThE SQL PART FOR MULTIPLE MEMES-->
    
  </body>
</html>