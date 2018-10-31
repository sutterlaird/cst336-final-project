

<!DOCTYPE html>
<html>
  <head>
    <title>Welcome</title>
  </head>
  <body>
    <h1>Meme Generator</h1>
    <?php  
    $meme_array = ['https://www.publicdomainpictures.net/pictures/90000/velka/alpaca-chewing.jpg', 'https://upload.wikimedia.org/wikipedia/commons/c/ca/LinusPaulingGraduation1922.jpg', 
    'https://upload.wikimedia.org/wikipedia/commons/f/ff/Deep_in_thought.jpg', 'https://upload.wikimedia.org/wikipedia/commons/b/b9/Typing_computer_screen_reflection.jpg',
    'https://upload.wikimedia.org/wikipedia/commons/4/47/StateLibQld_1_100348.jpg'];
      
    echo "<img height='100px' width='150px' src= " . $meme_array[array_rand($meme_array)] . " >";
    ?>
    <h2>Welcome to my Meme Generator!</h2>
    
    <form action="meme.php" method="post">
        Line 1: <input type="text" name="line1"></input> <br/>
        Line 2: <input type="text" name="line2"></input> <br/>
        <input type="submit"></input>
                Meme Type:
        <select name="meme-type">
          <option value="college-grad">Happy College Grad</option>
          <option value="thinking-ape">Deep Thought Monkey</option>
          <option value="coding">Learning to Code</option>
          <option value="old-class">Old Classroom</option>
        </select>

    </form>
    
    <a href="./meme.php">View All Memes</a>
    
  </body>
</html>