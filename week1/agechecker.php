<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome</h1>
    <?php
    //checks if the vulae of the age is of age and if it isn't then returns false
    function agechecker($age){
        if($age >= 21){
            return true;
        }
           else
            {
            return false;
            }
            
        
    }
    //checks if the value from agechecker and if it is true then prints they are allowed to enter otherwise they are not
    function ofage($value){
        if($value){
            echo "<h3 style='color:green;'>You are old enough to enter, have fun!</h3>";
        } else {
            echo "<h3 style='color:red;'>You are not old enough, please leave!</h3>";
        }
    }
    //calls the function with different values
    ofage(agechecker(23));

    ofage(agechecker(12));

    ofage(agechecker(21));
    ?>
</body>
</html>