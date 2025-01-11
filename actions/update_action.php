<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $profile_image = ''; // Initialize with an empty string, in case no new image is uploaded

    // Handle profile image upload if it exists
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES['profile_image']['name']);
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
            $profile_image = basename($_FILES['profile_image']['name']); // Store uploaded file name
        } else {
            echo "Failed to upload image.";
        }
    }

    // Prepare SQL update query
    $sql = "UPDATE employees SET first_name = ?, last_name = ?, profile_image = ? WHERE id = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("sssi", $first_name, $last_name, $profile_image, $id);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect to the list page after successful update
            header('Location: ../views/index.php');
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}


// Close the database connection
$conn->close();
?>
