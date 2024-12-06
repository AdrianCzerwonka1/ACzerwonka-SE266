<?php
    include (__DIR__ . '/db.php');

    //collects all the patients information from the database and allows us to access it
    function getAllPatients(){
        global $db;
        $results = [];
        $stmt = $db->prepare('SELECT id, patientFirstName, patientLastName, patientMarried, patientBirthDate FROM patients');
        if( $stmt->execute() && $stmt->rowCount() > 0){
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return $results;
    }

    //code to convert information we have to allow us to add it to a database
    function addPatient($firstName, $lastName, $marriageStatus, $birthDate){
        global $db;
        $stmt = $db->prepare('INSERT INTO patients SET patientFirstName = :fName, patientLastName = :lName, patientMarried = :married, patientBirthDate = :bD');
        $binds = array(
                ':fName'=> $firstName,
                ':lName'=> $lastName,
                ':married'=> $marriageStatus,
                ':bD'=> $birthDate);
        if($stmt->execute($binds) && $stmt->rowCount() > 0){
            $results = 'Data Added';
        }
        return($results);
    }

    // code to get and hold patient specific ID
    function getPatient($id) {
        global $db;
        $results = [];
        $stmt = $db->prepare('SELECT id, patientFirstName, patientLastName, patientMarried, patientBirthDate FROM patients WHERE id = :id');
        $binds = array(':id' => $id);
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $results;
    }

    //code to update patient 

    function updatePatient($id, $firstName, $lastName, $marriageStatus, $birthDate) {
        global $db;
        $stmt = $db->prepare('UPDATE patients SET patientFirstName = :fName, patientLastName = :lName, patientMarried = :married, patientBirthDate = :bD WHERE id = :id');
        $binds = array(
            ':fName' => $firstName,
            ':lName' => $lastName,
            ':married' => $marriageStatus,
            ':bD' => $birthDate,
            ':id' => $id,
        );
        return $stmt->execute($binds);
    }

    //function to delete patient by the id

    function deletePatient($id) {
        global $db;
        $stmt = $db->prepare('DELETE FROM patients WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }


?>