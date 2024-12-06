<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients</title>
</head>
<body>
    <h1>Patients</h1>
    <a href="./addPatients.php?action=add">Add New Patient</a>

    <div>
    <?php
        // code that makes it so that when delete is clicked next to someones name it gets there ID and then deletes it
        include './models/model_patients.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_Patient'])) {
            $id = filter_input(INPUT_POST, 'patientId', FILTER_VALIDATE_INT);
            if ($id) {
                if (deletePatient($id)) {
                    $successMessage = 'Patient deleted successfully.';
                } else {
                    $errorMessage = 'Please try again.';
                }
            } else {
                $errorMessage = 'Please try again';
            }
        }
       
        $patients = getAllPatients ();
        
    ?>
  
    <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Marriage Status</th>
                    <th>Birth Date</th>
                    <th>Edit Information</th>
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
                    <td><a href="addPatients.php?action=Update&id=<?= $p['id']; ?>">Edit</a></td> 
                    <td>
                    <form method="post" action="PatientPopulate.php" style="display: inline;">
                    <input type="hidden" name="patientId" value="<?= $p['id']; ?>">
                    <button type="submit" name="delete_Patient" onclick="return confirm('Are you sure you want to delete this patient?');">Delete</button>
                    </form></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        
        <br />
        <a href="./addPatients.php?action=add">Add New Patient</a>
   
    </div>
</body>
</html>