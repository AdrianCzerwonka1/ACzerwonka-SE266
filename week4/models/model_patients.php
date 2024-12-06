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
    
?>