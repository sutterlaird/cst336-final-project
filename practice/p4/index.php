<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>
    <h2>Aces vs Kings</h2>
    
    <forms action="submit.php" method="POST">
    
    <label for="numOfRows">Bumber of Rows:</label>
    <input type="text" id="numOfRows" />
    <br><br>
    <label for="numOfColumns">Number of Columns:</label>
    <input type="text" id="numOfColumns" />
    <br><br>
    
    <label for="choice">Suit to omit</label>
    <select id="choice">
        <option value="Hearts">Hearts</option>
        <option value ="Clubs">Clubs</option>
        <option value ="Diamonds">Diamonds</option>
        <option value ="Spades">Spades</option>
    </select>
    
    <input type="submit" value="Submit" />

    </forms>

    </body>
</html>