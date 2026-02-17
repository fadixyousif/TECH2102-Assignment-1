<?php
include "partials/header.php";
?>

<!-- Dashboard view for displaying student records -->
<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Student Records</h1>
        <div class="header-actions">
            <button id="open-modal" class="add-btn">Add New Student</button>
            <form action="index.php" method="POST" class="inline-form">
                <button type="submit" name="auth-logout" class="add-btn btn-logout">Logout</button>
            </form>
        </div>
    </div>

    <!-- Display success or error messages -->
    <?php include "partials/message.php"; ?>

    <!-- Search form for filtering students by name or email -->
    <div class="search-container">
        <form action="index.php" method="GET" class="search-form">
            <input type="text" name="search" class="search-input" placeholder="Search by name or email..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
            <button type="submit" class="add-btn btn-search">Search</button>
            <?php if(isset($_GET['search'])): ?>
                <a href="index.php" class="btn-clear">Clear</a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Student records table -->
    <div class="table-container">
        <table>
            <!-- Table headers for student records -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <!-- Table body to display student records, with options to delete each record -->
            <tbody>
                <?php if (empty($students)): ?>
                    <tr>
                        <td colspan="4" class="text-center">No students found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?php echo $student["id"]; ?></td>
                            <td><?php echo $student["name"]; ?></td>
                            <td><?php echo $student["email"]; ?></td>
                            <td>
                                <!-- Delete button to remove students from database -->
                                <form action="index.php" method="POST" class="inline-form">
                                    <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                                    <button type="submit" name="delete-student" class="delete-link" onclick="return confirm('Are you sure you want to delete this student?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal for adding new student records -->
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
