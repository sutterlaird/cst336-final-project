<?php
    
            $firstNameParts = array("ger", "ardo", "ya", "dira", "car", "los", "jen", "nifer", "bran", "don", "bren", "da", "sam", "antha", "ty", "ler", "fer", "nando", "so", "nia", "jaz", "lyn", "sut", "ter", "ja", "son", "brad", "ley");
            $firstName = array(array());
            $lastNameParts = array("wil", "son", "own", "ore", "lor", "ris", "tin", "cia", "lez", "ward", "guez", "ker", "ton", "am", "wart", "in", "lips", "ez");
            $lastName = array(array());

    function printNames($lastName, $lastNameParts, $firstName, $firstNameParts){

        
        for ($i = 0; $i < 4; $i++){
            $numOfParts = rand(1, 3);
            
            if($numOfParts == 1){
                shuffle($firstNameParts);
                
                $firstName[$i][0] = array_shift($firstNameParts);
                $firstName[$i][0] = ucfirst($firstName[$i][0]);
                $firstName[$i][1] = array_shift($firstNameParts);
                
                array_push($firstName, array());
            }

            if($numOfParts == 2){
                shuffle($firstNameParts);
                
                $firstName[$i][0] = array_shift($firstNameParts);
                $firstName[$i][0] = ucfirst($firstName[$i][0]);
                $firstName[$i][1] = array_shift($firstNameParts);
                $firstName[$i][2] = array_shift($firstNameParts);               

                array_push($firstName, array());            
            }
            
            else if($numOfParts == 3){
                shuffle($firstNameParts);
                
                $firstName[$i][0] = array_shift($firstNameParts);
                $firstName[$i][0] = ucfirst($firstName[$i][0]);
                $firstName[$i][1] = array_shift($firstNameParts);
                $firstName[$i][2] = array_shift($firstNameParts);

                array_push($firstName, array());                
            }
        
    
        }
        
        for ($i = 0; $i < 4; $i++){
            $numOfParts = rand(1, 3);
            
            if($numOfParts == 1){
                shuffle($lastNameParts);
                
                $lastName[$i][0] = array_shift($lastNameParts);
                $lastName[$i][0] = ucfirst($lastName[$i][0]);
                $lastName[$i][1] = array_shift($lastNameParts);
            
                array_push($lastName, array());                
            }

            if($numOfParts == 2){
                shuffle($lastNameParts);
                
                $lastName[$i][0] = array_shift($lastNameParts);
                $lastName[$i][0] = ucfirst($lastName[$i][0]);
                $lastName[$i][1] = array_shift($lastNameParts);
                $lastName[$i][2] = array_shift($lastNameParts);

                array_push($lastName, array());                
            }
            
            else if($numOfParts == 3){
                shuffle($lastNameParts);
                
                $lastName[$i][0] = array_shift($lastNameParts);
                $lastName[$i][0] = ucfirst($lastName[$i][0]);
                $lastName[$i][1] = array_shift($lastNameParts);
                $lastName[$i][2] = array_shift($lastNameParts);

                array_push($lastName, array());                
            }
        
    
        } 
        
        for ($i = 0; $i < 4; $i++){
            for ($j = 0; $j < sizeof($firstName); $j++){
                echo $firstName[$i][$j];
            }
            
            echo ' '; 
            
            for ($j = 0; $j < sizeof($lastName); $j++){
            echo $lastName[$i][$j];
            }
            
            echo '<br><br>';
        }
    }
    

        


?>