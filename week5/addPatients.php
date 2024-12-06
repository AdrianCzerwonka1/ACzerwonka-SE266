<?php
// Include the model file containing database functions
include(__DIR__ . '/models/model_patients.php');

// Initialize variables for error messages, success messages, and form data
$errorMessage = '';
$successMessage = '';
$firstName = '';
$lastName = '';
$marriageStatus = 0;
$birthDate = '';

// Check if editing an existing patient otherwise tells the user that the
if (isset($_GET['action']) && $_GET['action'] == 'Update') {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Validate the 'id' parameter
    if (!$id) {
        $errorMessage = 'Patient ID is missing or wasnt able to be collected please go back to search.';
    } else {
        // Fetch patient data
        $patient = getPatient($id);
        if ($patient) {
            $firstName = $patient['patientFirstName'];

            $lastName = $patient['patientLastName'];
            $marriageStatus = $patient['patientMarried'];
            $birthDate = $patient['patientBirthDate'];

        } else {
            $errorMessage = 'Patient Error could not find patient please return to patient search.';
        }
    }
}

// Handle form submission
// Also makes sure that check box has information so that it converts what it means
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $marriageStatus = isset($_POST['marriageStatus']) ? 1 : 0; 
    $birthDate = $_POST['birthDate'];
    $id = filter_input(INPUT_POST, 'patientId', FILTER_VALIDATE_INT); // Get 'patientId' from the hidden input field

    // Validate required fields
    if (empty($firstName) || empty($lastName) || empty($birthDate)) {
        $errorMessage = 'Make sure that all field that are required are filled in please.';
    } else {
        if ($id) { // If there is an id from the 
            $updateResult = updatePatient($id, $firstName, $lastName, $marriageStatus, $birthDate);
            if ($updateResult) {
                $successMessage = 'Patient updated successfully.';
                header('Location: PatientPopulate.php'); 
                
            } else {
                $errorMessage = 'Failed to update patient. Please try again.';
            }
        } else { // If there is no id for the site it makes sure to switch to the add patient function
            $result = addPatient($firstName, $lastName, $marriageStatus, $birthDate);
            if ($result) {
                $successMessage = 'Patient added successfully.';
                header('Location: PatientPopulate.php'); // Redirect after success
                
            } else {
                $errorMessage = 'Failed to add patient. Please try again.';
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($_GET['action']) && $_GET['action'] == 'Update' ? 'Edit Patient' : 'Add New Patient'; ?></title>
</head>
<body>
    <h1><?= isset($_GET['action']) && $_GET['action'] == 'Update' ? 'Edit Patient' : 'Add New Patient'; ?></h1>

    <?php if (!empty($errorMessage)): ?>
        <div style="color: red;"><?= $errorMessage; ?></div>
    <?php endif; ?>
    <?php if (!empty($successMessage)): ?>
        <div style="color: green;"><?= $successMessage; ?></div>
    <?php endif; ?>

    <!-- Form for adding or updating patient -->
    <form action="addPatients.php?action=<?= isset($_GET['action']) ? $_GET['action'] : 'Add'; ?>" method="post">
        <?php if (isset($_GET['action']) && $_GET['action'] == 'Update'): ?>
            <input type="hidden" name="patientId" value="<?= $id; ?>">
        <?php endif; ?>

        <div>
            <label for="firstName">First Name:</label>

            <input type="text" id="firstName" name="firstName" value="<?= $firstName; ?>" required>
        </div>

        <div>
            <label for="lastName">Last Name:</label>

            <input type="text" id="lastName" name="lastName" value="<?= $lastName; ?>" required>
        </div>

        <div>
            <label for="marriageStatus">Married:</label>

            <input type="checkbox" id="marriageStatus" name="marriageStatus" <?= $marriageStatus ? 'checked' : ''; ?>>
        </div>

        <div>
            <label for="birthDate">Birth Date:</label>
            <input type="date" id="birthDate" name="birthDate" value="<?= $birthDate; ?>" required>

        </div>

        <br>
        <input type="submit" value="<?= isset($_GET['action']) && $_GET['action'] == 'Update' ? 'Update Patient' : 'Add Patient'; ?>">

    </form>

    <br>
    <a href="./PatientPopulate.php">Back to Patient List</a>
</body>
</html>
