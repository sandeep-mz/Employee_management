<?php
// db.php for database connection
require_once '../config/db.php';

if (isset($_GET['id'])) {
    // Retrieve employee ID from URL
    $id = $_GET['id'];

    // Query the database for the employee with that ID
    $sql = "SELECT * FROM employees WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id); // Binding the parameter
    $stmt->execute();
    $result = $stmt->get_result();
    
    // If employee data is found
    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();
    } else {
        die("Employee not found");
    }
} else {
    die("Invalid request");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .employee-details-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
        }
        
        .employee-details-container .image {
            flex: 0 0 200px;
            border-radius: 10px; 
            overflow: hidden; /* Make sure the profile image stays within the container */
        }

        
        .employee-details-container .details {
            flex: 1;
        }

        /* New Card-like Appearance for Employee Details */
        .detail-card {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .detail-card p {
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        .detail-card .key {
            font-weight: bold;
            color: #555;
        }

        .detail-card .value {
            font-weight: normal;
            color: #333;
        }

        /* Back to list button */
        .btn-back {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 30px;
        }

        .btn-back:hover {
            background-color: #0056b3;
        }

        /* Profile Image Styling */
        .profile-image {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Employee Details</h1>
        

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="employee-details-container">
                            <!-- Employee Profile Image -->
                            <div class="image">
                                <?php if (!empty($employee['profile_image'])): ?>
                                    <img src="../uploads/<?= htmlspecialchars($employee['profile_image']) ?>" alt="Profile Image" class="img-fluid profile-image">
                                <?php else: ?>
                                    <img src="https://via.placeholder.com/150" alt="No Profile Image" class="img-fluid profile-image">
                                <?php endif; ?>
                                <a href="index.php" class="btn btn-secondary mt-3 btn-back">Back to List</a>
                            </div>
                            
                            
                            
                            <div class="details">
                                <div class="detail-card">
                                    <p><span class="key">Name:</span> <span class="value"><?= htmlspecialchars($employee['first_name'] . ' ' . $employee['last_name']) ?></span></p>
                                    <p><span class="key">Email:</span> <span class="value"><?= htmlspecialchars($employee['email']) ?></span></p>
                                    <p><span class="key">Phone:</span> <span class="value"><?= htmlspecialchars($employee['phone']) ?></span></p>
                                    <p><span class="key">Gender:</span> <span class="value"><?= htmlspecialchars($employee['gender']) ?></span></p>
                                    <p><span class="key">Date of Birth:</span> <span class="value"><?= htmlspecialchars($employee['dob']) ?></span></p>
                                    <p><span class="key">Address:</span> <span class="value"><?= htmlspecialchars($employee['address']) ?></span></p>
                                    <p><span class="key">Position:</span> <span class="value"><?= htmlspecialchars($employee['position']) ?></span></p>
                                    <p><span class="key">Department:</span> <span class="value"><?= htmlspecialchars($employee['department']) ?></span></p>
                                    <p><span class="key">Date of Joining:</span> <span class="value"><?= htmlspecialchars($employee['date_of_joining']) ?></span></p>
                                    <p><span class="key">Salary:</span> <span class="value"><?= htmlspecialchars($employee['salary']) ?></span></p>
                                    <p><span class="key">Employee Type:</span> <span class="value"><?= htmlspecialchars($employee['employee_type']) ?></span></p>
                                    <p><span class="key">Work Location:</span> <span class="value"><?= htmlspecialchars($employee['work_location']) ?></span></p>
                                    <p><span class="key">Skills:</span> <span class="value"><?= htmlspecialchars($employee['skill']) ?></span></p>
                                    <p><span class="key">Status:</span> <span class="value"><?= htmlspecialchars($employee['status']) ?></span></p>
                                </div>
                            </div>
                        </div>
                        <!-- <a href="index.php" class="btn btn-secondary mt-3 btn-back">Back to List</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
