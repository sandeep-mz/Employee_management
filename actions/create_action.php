<?php
require_once '../config/db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $date_of_joining = $_POST['date_of_joining'];
    $salary = $_POST['salary'];
    $employee_type = $_POST['employee_type'];
    $work_location = $_POST['work_location'];
    $skill = $_POST['skill'];
    $status = $_POST['status'];

    // Handle profile image upload
    $profile_image = null;  // Initialize variable

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $file_info = pathinfo($_FILES['profile_image']['name']);
        $file_extension = strtolower($file_info['extension']);
        
        // Validate file extension
        if (in_array($file_extension, $allowed_extensions)) {
            // Create a unique name for the file
            $profile_image = uniqid('emp_', true) . '.' . $file_extension;
            $upload_path = '../uploads/' . $profile_image;

            // Move the file to the uploads folder
            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $upload_path)) {
                echo "Image uploaded successfully!";
            } else {
                echo "Failed to upload image.";
            }
        } else {
            echo "Invalid file type. Please upload a jpg, jpeg, png, or gif image.";
            exit(); // Stop the execution in case of error
        }
    }

    // SQL query to insert employee data, including the image
    $sql = "INSERT INTO employees 
            (first_name, last_name, gender, dob, email, phone, address, position, department, 
             date_of_joining, salary, employee_type, work_location, skill, status, profile_image) 
            VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters to the SQL query
        $stmt->bind_param("sssssssssssssss", $first_name, $last_name, $gender, $dob, $email, $phone, $address, 
                          $position, $department, $date_of_joining, $salary, $employee_type, $work_location, $skill, $status, $profile_image);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the employee list after successful insertion
            header('Location: ../views/index.php');
            exit();
        } else {
            // Error executing the statement
            echo "Error: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // SQL prepare failed
        echo "Error: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
