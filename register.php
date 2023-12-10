<?php
include 'inc/connection.php';

$successMessage = "";

if (isset($_POST["register"])) {
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
            $successMessage = "Registration successful.";
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'login.php';
                }, 5000);
            </script>";
        } else {
            echo "Error: " . mysqli_error($link);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Library Management System - Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            min-height: 100vh;
            width: 100%;
            background: url('IMAGES/walp3.jpg') no-repeat;
            background-position: center;
            background-size: cover;
        }

        .container {
            max-width: 450px;
            margin: 40px auto;
            background-color: transparent;
            color: #ffffff;
            padding: 20px;
            border: 2px solid blueviolet;
            border-radius: 5px;
            margin-right: 200px;
            box-shadow: 0px 0px 10px rgba(225, 225, 225, 0.5), 0px 0px 20px rgba(225, 225, 225, 0.3);
        }

        .form-group {
            margin-bottom: 20px;
            color: #ffffff;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #cccccc;
        }

        .form-group input[type="submit"] {
            background-color: blueviolet;
            color: #ffffff;
            cursor: pointer;
        }

        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .success-message {
            color: green;
            font-size: 18px;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Digital Library- Registration</h2>
    <form method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>
        </div>
        <div class="form-group">
            <label for="name">User Name:</label>
            <input type="text" id="username" name="username" placeholder="Enter the username name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="form-group">
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password"
                   required>
            <?php if (isset($errorMessage)) { ?>
                <p style="color: red;"><?php echo $errorMessage; ?></p>
            <?php } ?>
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="" disabled selected hidden>Select Role</option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
                <option value="librarian">Librarian</option>
            </select>
        </div>
        <br><br>
        <div class="form-group">
            <input type="submit" name="register" value="Register">
        </div>
    </form>
    <?php if (!empty($successMessage)) { ?>
        <p class="success-message"><?php echo $successMessage; ?></p>
    <?php } ?>
</div>
</body>
</html>
