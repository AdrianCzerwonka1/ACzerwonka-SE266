<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Intake Form</title>
</head>
<body>
<h2>Patient Intake Form</h2>
    <form action="http://localhost/ACzerwonka-SE266/week2/PatientIntakeForm.php" method="post">
        <!-- Input for all fields-->
        <label for="first_name">First Name:</label>

        <input type="text" id="first_name" name="first_name" required><br>
        
        <label for="last_name">Last Name:</label>

        <input type="text" id="last_name" name="last_name" required><br>

        <label for="married">Are you married?</label>
        <input type="radio" id="married_yes" name="married" value="yes" required>
        <label for="married_yes">Yes</label>

        <input type="radio" id="married_no" name="married" value="no" required>
        <label for="married_no">No</label><br>
        
        <label for="birthDate">Birth date:</label><br>
        <input type="date" id="birthDate" name="birthDate" required><br><br>

        
        <label for="height_feet">Height ft:</label>
        <input type="number" id="height_feet" name="height_feet" required>

        <label for="height_inches">Height in:</label>

        <input type="number" id="height_inches" name="height_inches" required><br><br>
        
        
        <label for="weight">Weight lbs:</label><br>

        <input type="number" id="weight" name="weight" required><br><br>
        
        <input type="submit" value="Submit">
    </form>
    <?php
    // Function to validate weight, must be under 1400 pounds
    function validate_weight($weight) {
        return $weight <= 1400 and $weight > 0; 
    }

    // Function to validate height, must be under 8 feet tall
    function validate_height($feet, $inches) {
        return $feet < 8 && $inches < 12; 
    }

    function validate_input($data) {
        return trim($data); // Trim whitespace to make the data easier to read & so it doesn't give us bad inputs
    }

    function convert_to_meters($feet, $inches) {
        $total_inches = ($feet * 12) + $inches;
        return $total_inches * 0.0254; // Convert inches to meters
    }

    function convert_to_kg($pounds) {
        return $pounds * 0.453592; // Convert pounds to kilograms
    }

    function calculate_bmi($weight_pounds, $height_feet, $height_inches) {
        $weight_kg = convert_to_kg($weight_pounds);
        $height_m = convert_to_meters($height_feet, $height_inches);
        return $weight_kg / ($height_m * $height_m);
    }

    function bmi_category($bmi) {
        if ($bmi < 18.5) {
            return "Underweight";
        } elseif ($bmi >= 18.5 && $bmi < 24.9) {
            return "Healthy";
        } elseif ($bmi >= 25 && $bmi < 29.9) {
            return "Overweight";
        } else {
            return "Obese";
        }
    }

    // Function to calculate age from the birth date
    function calculate_age($birthDate) {
        $birthDate = new DateTime($birthDate); 
        $today = new DateTime(); 
        $age = $today->diff($birthDate); 
        return $age->y; 
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $first_name = validate_input($_POST["first_name"]);
        $last_name = validate_input($_POST["last_name"]);
        $married = validate_input($_POST["married"]);

        $birthDate = validate_input($_POST["birthDate"]);
        $height_feet = validate_input($_POST["height_feet"]);


        $height_inches = validate_input($_POST["height_inches"]);
        $weight = validate_input($_POST["weight"]);

        //stores all errors messages in case they have many, also prints them in red
        $error_messages = [];

        
        if (empty($first_name)) {
            $error_messages[] = "First name is required.";
        }
        if (empty($last_name)) {
            $error_messages[] = "Last name is required.";
        }
        if (empty($married)) {
            $error_messages[] = "Marital status is required.";
        }
        if (empty($birthDate)) {
            $error_messages[] = "Birth date is required.";
        }
        if (!validate_weight($weight)) {
            $error_messages[] = "Weight must be under 1400 pounds.";
        }
        if (!validate_height($height_feet, $height_inches)) {
            $error_messages[] = "Height must be under 8 feet.";
        }

        
        if (!empty($error_messages)) {
            foreach ($error_messages as $error) {
                echo "<p style='color:red;'>$error</p>";
            }
        } else {
            // Calculate BMI and age
            $bmi = calculate_bmi($weight, $height_feet, $height_inches);
            $bmi_category = bmi_category($bmi);
            $age = calculate_age($birthDate); 

            // Display the results
            echo "<h2>Intake Form Results:</h2>";
           
            echo "Age: " . $age . "<br>"; 
            
            
            echo "BMI: " . round($bmi, 1) . " (" . $bmi_category . ")<br>";

            if ($bmi_category === "Healthy") {
                echo "Your BMI is in a good and safe range.";
            } else {
                echo "Your BMI shows that you are " . $bmi_category . ".";
            }
        }
    }
    ?>
</body>
</html>