<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome!</h1>

    <?php
   // 2 fucntions to check if it is a multiple of 2 or 3 by dividing the numbers down
    function multipleoftwo($num){
        while($num > 2){
            $num /= 2;
        }
        if ($num == 2){
            return true;
        }
        else{
            return false;
        }
    }
    function multipleofthree($num){
        while($num > 3){
            $num /= 3;
        }
        if ($num == 3){
            return true;
        }
        else{
            return false;
        }
    }
    //function that checks if either of the number are results of the other and prints it
    //declairs $results as global since it was created inside a function, so that other aspects can access it
function fizzbuzz($num){
    global $results;
    if(multipleoftwo($num)){
        $results .= "fizz";
    }
    else{
        $results .= "";
    }
    
    if(multipleofthree($num)){
        $results .= "buzz";
    }
    else{
        $results .= "";
    }
    if($results != ""){
        echo $results;
        echo "<br>";
    }
    else{
        echo $num;
        echo "<br>";
    }


}
//loops thruough each number and check adn then breaks and resets results each time.
for($i = 1; $i <= 100; $i++){
    fizzbuzz($i);
    $results = "";
}

    ?>
</body>
</html>