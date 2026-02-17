<?php
include "partials/header.php";

$students = [
    ["id" => 1, "name" => "John Doe", "email" => "john@example.com"],
    ["id" => 2, "name" => "Jane Smith", "email" => "jane@example.com"],
    ["id" => 3, "name" => "Bob Johnson", "email" => "bob@example.com"],
    ["id" => 4, "name" => "Alice Williams", "email" => "alice@example.com"],
    ["id" => 5, "name" => "Charlie Brown", "email" => "charlie@example.com"],
    ["id" => 6, "name" => "Diana Prince", "email" => "diana@example.com"],
    ["id" => 7, "name" => "Ethan Hunt", "email" => "ethan@example.com"],
    ["id" => 8, "name" => "Fiona Green", "email" => "fiona@example.com"],
    ["id" => 9, "name" => "Grace Lee", "email" => "grace@example.com"],
    ["id" => 10, "name" => "Henry Davis", "email" => "henry@example.com"],
    ["id" => 11, "name" => "Ivy Chen", "email" => "ivy@example.com"],
    ["id" => 12, "name" => "Jack Wilson", "email" => "jack@example.com"],
    ["id" => 13, "name" => "Kevin White", "email" => "kevin@example.com"],
    ["id" => 14, "name" => "Lily Black", "email" => "lily@example.com"],
    ["id" => 1, "name" => "John Doe", "email" => "john@example.com"],
    ["id" => 2, "name" => "Jane Smith", "email" => "jane@example.com"],
    ["id" => 3, "name" => "Bob Johnson", "email" => "bob@example.com"],
    ["id" => 4, "name" => "Alice Williams", "email" => "alice@example.com"],
    ["id" => 5, "name" => "Charlie Brown", "email" => "charlie@example.com"],
    ["id" => 6, "name" => "Diana Prince", "email" => "diana@example.com"],
    ["id" => 7, "name" => "Ethan Hunt", "email" => "ethan@example.com"],
    ["id" => 8, "name" => "Fiona Green", "email" => "fiona@example.com"],
    ["id" => 9, "name" => "Grace Lee", "email" => "grace@example.com"],
    ["id" => 10, "name" => "Henry Davis", "email" => "henry@example.com"],
    ["id" => 11, "name" => "Ivy Chen", "email" => "ivy@example.com"],
    ["id" => 12, "name" => "Jack Wilson", "email" => "jack@example.com"],
    ["id" => 13, "name" => "Kevin White", "email" => "kevin@example.com"],
    ["id" => 14, "name" => "Lily Black", "email" => "lily@example.com"]
];
?>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Student Records</h1>
        <div style="display: flex; gap: 10px;">
            <button id="open-modal" class="add-btn">Add New Student</button>
            <form action="index.php" method="POST" style="margin: 0;">
                <button type="submit" name="auth-logout" class="add-btn" style="background-color: #dc3545;">Logout</button>
            </form>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo $student["id"]; ?></td>
                        <td><?php echo $student["name"]; ?></td>
                        <td><?php echo $student["email"]; ?></td>
                        <td>
                            <button class="edit-link">Edit</button>
                            <button class="delete-link">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div id="student-modal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Add New Student</h2>
        <form method="POST">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <button type="submit" name="add-student" class="auth-btn">Save Student</button>
        </form>
    </div>
</div>

<?php include "partials/footer.php"; ?>
