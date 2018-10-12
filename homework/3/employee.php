

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>
        <div>
            <h2>
                Please create and assign the emlpoyees to their department below
            </h2>
            <br><br>
            <?php 
            
                if(isset($_POST['employeeNum']) && $_POST['employeeNum'] > 0){
                        for ($i = 0; $i < $_POST['employeeNum']; $i++){
                            echo '<strong>Employee Form Number: </strong>' . $i . '<br>';
            ?>
                            <form> 
                            First Name: <input type="text" name="fName"/>
                            <br>
                            Last Name: <input type="text" name="lName"/>
                            <br>
                            Birth Date (mm/dd/yyyy): <input type="text" name"empNum"/>
                            <br>
                            Employee Number: <input type="text" name"empNum"/>
                            <br>
                            Gender:
                            <input type="checkbox" /> Male 
                            <input type="checkbox" /> Female
                            <input type="checkbox" /> Prefered not to answer
                            <br>
                            Position: 
                            <select>
                            <option value="Human Resources">Human Resources</option>
                            <option value="Administration">Administration</option>
                            <option value="Software Development ">Software Development</option>
                            <option value="Janitotial">Janitotial</option>
                            <option value="Marketing">Marketing</option>
                            </select>
                            <br><br>
                            </form>
            <?php       }
                }            
            
            
            ?>
        </div>
    </body>
</html>