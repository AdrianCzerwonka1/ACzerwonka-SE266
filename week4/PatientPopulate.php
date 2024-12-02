<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients</title>
</head>
<body>
    <h1>Patients</h1>
    <a href="./addPatients.php">Add New Patient</a>

    <div>
    <?php
        // code that includes previce models made and then uses the get all patients function to acquire all the information about the patients
        include './models/model_patients.php';
       
        $patients = getAllPatients ();
        
    ?>
  
    <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Marriage Status</th>
                    <th>Birth Date</th>
                </tr>
            </thead>
            <tbody>
           
            
            <?php foreach ($patients as $p):         
            //code that populates each row by creating a new row and providing the patients information         
            ?>
                <tr>
                    <td><?= $p['id']; ?></td>
                    <td><?= $p['patientFirstName'] . ' ' . $p['patientLastName']; ?></td>
                    <td><?= $p['patientMarried'] ? 'Married' : 'Single'; ?></td>
                    <td><?= $p['patientBirthDate']; ?></td> 
                      
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        
        <br />
        <a href="./addPatients.php">Add New Patient</a>
   
    </div>
</body>
</html>