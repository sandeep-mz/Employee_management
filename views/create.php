<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Employee</title>
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Add New Employee</h1>
        <form action="../actions/create_action.php" method="POST">
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="first_name" class="form-label">First Name:</label>
                    <input type="text" id="first_name" name="first_name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="last_name" class="form-label">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="gender" class="form-label">Gender:</label>
                    <select name="gender" id="gender" class="form-select">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="dob" class="form-label">DOB:</label>
                    <input type="date" id="dob" name="dob" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone:</label>
                    <input type="text" id="phone" name="phone" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="address" class="form-label">Address:</label>
                    <textarea id="address" name="address" class="form-control"></textarea>
                </div>
                <div class="col-md-6">
                    <label for="position" class="form-label">Position:</label>
                    <input type="text" id="position" name="position" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="department" class="form-label">Department:</label>
                    <input type="text" id="department" name="department" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="date_of_joining" class="form-label">Date of Joining:</label>
                    <input type="date" id="date_of_joining" name="date_of_joining" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="salary" class="form-label">Salary:</label>
                    <input type="number" id="salary" name="salary" class="form-control" step="0.01" required>
                </div>
                <div class="col-md-6">
                    <label for="employee_type" class="form-label">Employee Type:</label>
                    <select name="employee_type" id="employee_type" class="form-select">
                        <option value="Full-time">Full-time</option>
                        <option value="Part-time">Part-time</option>
                        <option value="Contract">Contract</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="work_location" class="form-label">Work Location:</label>
                    <input type="text" id="work_location" name="work_location" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="status" class="form-label">Status:</label>
                    <select name="status" id="status" class="form-select">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
            </div>

            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="skill" class="form-label">Skills:</label>
                    <textarea id="skill" name="skill" class="form-control"></textarea>
                </div>
                <!-- Profile Image Field -->
            
                <div class="col-md-6">
                    <label for="profile_image" class="form-label">Profile Image:</label>
                    <input type="file" id="profile_image" name="profile_image" class="form-control" accept="image/*">
                </div>
            
            </div>

            <button type="submit" style="margin-bottom: 20px;" class="btn btn-success">Submit</button>
            <button type="button" style="margin-bottom: 20px;" class="btn btn-secondary" onclick="window.location.href = 'index.php';">Back</button>


        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
