<?php 

    








?>



    
<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>
        <div id="vacationForm">
        <h1>
            Winter Vacation Planner!
        </h1>
        <form>
            Select Month: 
            <select>
                <option>Select</option>
                <option>November</option>
                <option>December</option>
                <option>January</option>
                <option>February</option>                
            <select/>
            <!--ADD INFO I-->
            
            <br>
            <br>
            
            Number of locations: 
            <input type="radio" value="3" name="locations" id="label3"/> 
            <label for="label3"><strong>Three</strong><label>
            <input type="radio" value="4" name="locations" id="label4"/>         
            <label for="label4"><strong>Four</strong><label>
            <input type="radio" value="5" name="locations" id="label5"/>         
            <label for="label5"><strong>Five</strong><label>
            <!--ADD INFO I-->
            
            <br>
            <br>
            
            Select Country: 
            <select>
                <option>USA</option>
                <option>Mexico</option>
                <option>France</option>  
            <select/>
            <!--ADD INFO I-->
            
            <br>
            <br>
            
            Visit locations in alphabetical order: 
            <input type="radio" name="order" id="az"/>
            <label for="az"><strong>A-Z</strong></label>
            <input type="radio" name="order" id="za"/>
            <label for="za"><strong>Z-A</strong></label>

            <br><br>

            <input type="button" value="Create Itinerary"/>
            <!--ADD INFO I-->
            <br/><br/>
            
        </form>
        </div>
    <style>
    
table {
	margin: 0 auto;
}
td {
                padding: 30px;
                border: 1px solid black;
}
    </style>
        
        <div>
            <table border="1">
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                    <td>6</td>
                    <td>7</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>9</td>
                    <td>10</td>
                    <td>11</td>
                    <td>12</td>
                    <td>13</td>
                    <td>14</td>
                </tr>
                <tr>
                    <td>14</td>
                    <td>15</td>
                    <td>16</td>
                    <td>17</td>
                    <td>18</td>
                    <td>19</td>
                    <td>20</td>
                </tr>
                                <tr>
                    <td>21</td>
                    <td>22</td>
                    <td>23</td>
                    <td>24</td>
                    <td>25</td>
                    <td>26</td>
                    <td>27</td>
                </tr>
                <tr>
                    <td>one</td>
                    <td>two</td>
                    <td>three</td>
                    <td>four</td>
                    <td>five</td>
                    <td>six</td>
                    <td>seven</td>
                </tr>
                <tr>
                    <td>one</td>
                    <td>two</td>
                    <td>three</td>
                    <td>four</td>
                    <td>five</td>
                    <td>six</td>
                    <td>seven</td>
                </tr>
                <tr>
                    <td>one</td>
                    <td>two</td>
                    <td>three</td>
                    <td>four</td>
                    <td>five</td>
                    <td>six</td>
                    <td>seven</td>
                </tr>
            </table>
        </div>
        
        
    </body>
</html>