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
    $task = [
//assigning each varable its values in the list 
        'Task' => 'Dishes',
        'Time needed in mins' => 20,
        'Required Equipment' => 'Sink, Soap, Spondge and drying rack',
        'Completed' => true
    /// creating the status vairable and assigning completed to it
    ];

    ?>
    <ul>
        
        <?php 

        //creating a foreach loop so that it goes around and loops the value from the array and the assoicative value
        //checks if the key is the completed one and if it is then it checks the value either printing the check mark or incomplete
        foreach($task as $key => $desc){
        if($key == 'Completed'){
            if($desc == true){
                echo "<li><strong>$key:</strong> <span class=\"icon\">&#9989;</span></li>";
            }
            else{
            echo "<li><strong>$key</strong> Incomplete </li>";}
        }
            
        else{
        echo "<li><strong>$key</strong> $desc</li>";
    }
    }

        ?>

    </ul>


</body>
</html>