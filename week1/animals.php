<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <!-- This is for me to make sure that the page is loading.-->
    <h1>Welcome</h1>
    <ul>
    <?php 
    $animals = ["Dog", "Cat", "Pig", "Fish"];
   ?>

    <?php 
    foreach ($animals as $animal) {
          echo "<li> $animal </li>";
        }
        ?>
      
    
    
    
    
    </ul>
</body>
</html>