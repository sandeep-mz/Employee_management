<?php
    require_once '../config/db.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Fetch the employee data
        $stmt = $conn->prepare("SELECT * FROM employees WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $employee = $result->fetch_assoc();

        if (!$employee) {
            die("Employee not found");
        }
    } else {
        die("Invalid request");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
    <link href="./assets/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Employee</h1>
        <form action="../actions/update_action.php" method="POST" enctype="multipart/form-data"> <!-- Adding enctype for file upload -->
            <input type="hidden" name="id" value="<?= $employee['id'] ?>">

            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $employee['first_name'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?= $employee['last_name'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" id="gender" name="gender" required>
                    <option value="Male" <?= $employee['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= $employee['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                    <option value="Other" <?= $employee['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" value="<?= $employee['dob'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $employee['email'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?= $employee['phone'] ?>">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address"><?= $employee['address'] ?></textarea>
            </div>

            <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="text" class="form-control" id="position" name="position" value="<?= $employee['position'] ?>">
            </div>

            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" class="form-control" id="department" name="department" value="<?= $employee['department'] ?>">
            </div>

            <div class="mb-3">
                <label for="date_of_joining" class="form-label">Date of Joining</label>
                <input type="date" class="form-control" id="date_of_joining" name="date_of_joining" value="<?= $employee['date_of_joining'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="salary" class="form-label">Salary</label>
                <input type="number" class="form-control" id="salary" name="salary" step="0.01" value="<?= $employee['salary'] ?>" required>
            </div>

            <div class="mb-3">
                <label for="employee_type" class="form-label">Employee Type</label>
                <select class="form-select" id="employee_type" name="employee_type" required>
                    <option value="Full-time" <?= $employee['employee_type'] == 'Full-time' ? 'selected' : '' ?>>Full-time</option>
                    <option value="Part-time" <?= $employee['employee_type'] == 'Part-time' ? 'selected' : '' ?>>Part-time</option>
                    <option value="Contract" <?= $employee['employee_type'] == 'Contract' ? 'selected' : '' ?>>Contract</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="work_location" class="form-label">Work Location</label>
                <input type="text" class="form-control" id="work_location" name="work_location" value="<?= $employee['work_location'] ?>">
            </div>

            <div class="mb-3">
                <label for="skill" class="form-label">Skills</label>
                <textarea class="form-control" id="skill" name="skill"><?= $employee['skill'] ?></textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="Active" <?= $employee['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                    <option value="Inactive" <?= $employee['status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>

            <!-- Profile Image Field -->
            <div class="mb-3">
                <label for="profile_image" class="form-label">Profile Image</label>
                <input type="file" class="form-control" id="profile_image" name="profile_image">
                <?php if (!empty($employee['profile_image'])): ?>
                    <img src="../uploads/<?= htmlspecialchars($employee['profile_image']) ?>" alt="Profile Image" style="width: 50px; height: 50px; object-fit: cover; margin-top: 10px;">
                <?php else: ?>
                    <p>No profile image</p>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary" style="margin-left: 10px;">Back to List</a>
        </form>
    </div>
    <br>
</body>
</html>
