//VARIABLES
var selectedWord ="";
var selectedHint ="";
var board = [];
var remainingGuesses = 6;
var words = ["snake", "monkey", "beetle"];
// Creating an array of available letters
var alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 
                'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 
                'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

//LISTENER
window.onload = startGame();

$(".letter").click(function() {
    checkLetter($(this).attr("id"));
});

//FUNCTIONS            
function startGame(){
    pickWord();
    initBoard();
    createletters();
    updateBoard();
}        
            
function pickWord(){
    var randomInt = Math.floor(Math.random() * words.length);
    selectedWord = words[randomInt].toUpperCase();
}

function createletters(){
    for (var letter of alphabet){
        $("#letters").append("<button class='letter' id='" + letter + "'>" + letter + "</button>");
    }
    
}

function checkLetter(letter){
    var positions = new Array();
    
    for(var i = 0; i < selectedWord.length; i++){
        if (letter == selectedWord[i]) {
            positions.push(i);
        }
    }
    
    if(positions.length > 0){
        updateWord(positions, letter);
    }
    
    else{
        remainingGuesses -= 1;
    }
}

function updateWord(positions, letter){
    for (var pos of positions){
        board[pos] = letter;
    }
    
    updateBoard();
}

function updateBoard(){
    for (var letter of board){
        document.getElementById("word").innerHTML += letter + " ";
    }    
}
            

function initBoard(){
    for (var letter in selectedWord){
        board.push("_");
    }
}
