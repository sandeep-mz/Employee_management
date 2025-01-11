<?php
require_once '../config/db.php';

// If there is a search query, get results based on the search term.
$query = isset($_GET['query']) ? '%' . $_GET['query'] . '%' : '%';
$sql = "SELECT * FROM employees WHERE first_name LIKE ? OR last_name LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $query, $query);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #suggestions {
            list-style: none;
            margin-top: 0;
            padding-left: 0;
            position: absolute;
            /* Position the suggestions list above other content */
            width: 41.3%;
            /* Ensure it takes the full width of the search input */
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            max-height: 200px;
            overflow-y: auto;
            z-index: 9999;
        }

        #suggestions li {
            background-color: #f8f9fa;
            padding: 8px;
            cursor: pointer;
        }

        #suggestions li:hover {
            background-color: #e9ecef;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Employees</h1>
        <a href="create.php" class="btn btn-primary mb-3">Add New Employee</a>

        <!-- Search bar for employees -->
        <div class="input-group mb-3">
            <input type="text" id="employee-search" class="form-control" placeholder="Start typing a name..."
                aria-describedby="button-addon2">
        </div>
        
        <!-- Suggestions list will be displayed here -->
        <ul id="suggestions" class="list-group" style="display:none;"></ul>

        <!-- Table of Employees -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Profile Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['phone']) ?></td>
                        <td>
                            <?php if (!empty($row['profile_image'])): ?>
                                <img src="../uploads/<?= htmlspecialchars($row['profile_image']) ?>" alt="Profile Image"
                                    style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                            <?php else: ?>
                                <img src="https://via.placeholder.com/50" alt="No Profile Image"
                                    style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="read.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">Read More</a>
                                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="../actions/delete_action.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this employee?')">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (for interactive elements like dropdowns, modals, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery (necessary for AJAX and DOM manipulation) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#employee-search').on('keyup', function () {
                var query = $(this).val();

                // Hide suggestions if the input is empty
                if (query.length == 0) {
                    $('#suggestions').hide();
                    return;
                }

                // Make AJAX request to search employees
                $.ajax({
                    url: 'index.php',  // Request to the same page with a query
                    type: 'GET',
                    data: { query: query },
                    success: function (data) {
                        var employees = $(data).find("tbody tr");
                        $('#suggestions').html('');
                        if (employees.length > 0) {
                            employees.each(function () {
                                var name = $(this).find("td:nth-child(2)").text();
                                var employeeId = $(this).find("td:first").text();

                                $('#suggestions').append('<li class="list-group-item" data-id="' + employeeId + '">' + name + '</li>');
                            });
                            $('#suggestions').show();  // Show the suggestions list
                        } else {
                            $('#suggestions').append('<li class="list-group-item">No results found</li>');
                            $('#suggestions').show();  // Show message if no employees found
                        }
                    }
                });
            });

            // When a suggestion is clicked, populate the input field and hide suggestions
            $(document).on('click', '#suggestions li', function () {
                var selectedName = $(this).text();
                $('#employee-search').val(selectedName);  // Fill input field with selected name
                $('#suggestions').hide();  // Hide suggestions after selection
            });
        });
    </script>
</body>

</html>
