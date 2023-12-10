<?php
include '../include/connection.php';
include '../include/header.php';

$successMessage = "";
$errorMessage = "";

if (isset($_POST["add_user"])) {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $role = $_POST["role"];

    if ($password !== $confirmPassword) {
        $errorMessage = "Password and Confirm Password do not match.";
    } else {
        $insertQuery = "INSERT INTO user (name, username, password, email, actype, registration_date, last_login_date) 
                        VALUES ('$name', '$username', '$password', '$email', '$role', NOW(), NOW())";
        if (mysqli_query($link, $insertQuery)) {
            $successMessage = "User added successfully.";
        } else {
            $errorMessage = "Error: " . mysqli_error($link);
        }
    }
}
?>
<div id="layoutSidenav_content" style="padding-left: 270px;">

        <main><br><br>
        <div class="container mt-4">
            <h2>Library Management System - Add User</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="username">User Name:</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Enter the username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password:</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm your password" required>
                    <?php if (!empty($errorMessage)) { ?>
                        <p class="text-danger"><?php echo $errorMessage; ?></p>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select id="role" name="role" class="form-control" required>
                        <option value="" disabled selected hidden>Select Role</option>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                        <option value="librarian">Librarian</option>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" name="add_user" value="Add User" class="btn btn-primary">
                </div>
            </form>
            <?php if (!empty($successMessage)) { ?>
                <p class="text-success"><?php echo $successMessage; ?></p>
            <?php } ?>
        </div>
    </main>

    <?php include '../include/footer.php'; ?>
</div>
