<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if the form is submitted
  // Retrieve the new password and confirm password from the form
  $newPassword = $_POST['newPassword'];
  $confirmPassword = $_POST['confirmPassword'];

  // Validate the password fields
  if ($newPassword !== $confirmPassword) {
    // Passwords don't match
    echo '<p class="text-danger">Passwords do not match. Please try again.</p>';
  } else {
    // Passwords match, perform password change logic

    // TODO: Implement your password change logic here

    // Redirect with success message
    header("Location: changepassword.html?success=true");
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Digital Library - Change Password</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      width: 100%;
      background: url('IMAGES/walp3.jpg') no-repeat;
      background-position: center;
      background-size: cover;
    }
    .container {
      color: #ffffff;
      max-width: 450px;
      margin: 40px auto;
      padding: 30px;
      background-color: transparent;
      border: 1px solid blueviolet;
      border-radius: 5px;
      box-shadow: 0px 0px 10px rgba(225, 225, 225, 0.5), 0px 0px 20px rgba(225, 225, 225, 0.3);
      margin-right: 250px;
     }
    .form-group {
     margin-top: 20px;
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
    .text-danger {
      color: red;
      font-weight: bold;
      margin-top: 20px;
    }
    .text-success {
      color: green;
      font-weight: bold;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="text-center">Change Password</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="form-group">
        <label for="newPassword">New Password:</label>
        <input type="password" id="newPassword" name="newPassword" class="form-control" placeholder="Enter your new password" required>
      </div>
      <div class="form-group">
        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Confirm your new password" required>
      </div>
      <div class="form-group">
        <input type="submit" value="Change Password" class="btn btn-primary btn-block">
      </div>
    </form>

    <?php
    // Check if success parameter is present in the URL
    if (isset($_GET['success']) && $_GET['success'] === 'true') {
      echo '<p class="text-success">Password changed successfully!</p>';
    }
    ?>

  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
