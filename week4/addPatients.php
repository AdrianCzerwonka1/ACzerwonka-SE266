<?php
//connecting where all the functions are in the folder
include(__DIR__ . './models/model_patients.php');


// Initialize variables for error messages or success message
$errorMessage = '';
$successMessage = '';

// checks if the form was submmited and if it was then sends the information into the database 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // grabs information from form
    $firstName = ($_POST['firstName']);
    $lastName = ($_POST['lastName']);
    $marriageStatus = isset($_POST['marriageStatus']) ? 1 : 0; 
    $birthDate = ($_POST['birthDate']);

    // validates input fields
    if (empty($firstName) || empty($lastName) || empty($birthDate)) {
        $errorMessage = 'Please fill in all required fields (First Name, Last Name, Birth Date).';
    } else {
        // Add the patient to the database
        $result = addPatient($firstName, $lastName, $marriageStatus, $birthDate);
        
        if ($result == 'Data Added') {
            $successMessage = 'Patient added successfully.';
        } else {
            $errorMessage = 'Failed to add patient. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Patient</title>
</head>
<body>
    <h1>Add New Patient</h1>
    
    <?php if (!empty($errorMessage)): ?>
        <div style="color: red;"><?= ($errorMessage); ?></div>
    <?php endif; ?>

    <?php if (!empty($successMessage)): ?>
        <div style="color: green;"><?= ($successMessage); ?></div>
    <?php endif; ?>

    <form action="addPatients.php" method="post">
        <div>
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>
        </div>
        
        <div>
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required>
        </div>
        
        <div>
            <label for="marriageStatus">Married:</label>
            <input type="checkbox" id="marriageStatus" name="marriageStatus" value="1">
        </div>
        
        <div>
            <label for="birthDate">Birth Date:</label>
            <input type="date" id="birthDate" name="birthDate" required>
        </div>

        <br>
        <input type="submit" value="Add Patient">
    </form>

    <br>
    <a href="./PatientPopulate.php">Back to Patient List</a>
</body>
</html>