<!DOCTYPE html>
<html lang="en">
<head>
  <title>DIGITAL LIBRARY - Password Reset Success</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    body {
      background: #f2f2f2;
    }
    .container {
      max-width: 400px;
      margin: 100px auto;
      padding: 20px;
      background-color: #ffffff;
      border: 1px solid #cccccc;
      border-radius: 5px;
      text-align: center;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
      margin-bottom: 20px;
    }
    p {
      margin-bottom: 30px;
    }
    .btn-primary {
      background-color: blueviolet;
      border-color: blueviolet;
    }
    .btn-primary:hover {
      background-color: #4b0082;
      border-color: #4b0082;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Password Reset Success</h2>
    <p>Your password has been successfully reset.</p>
    <form>
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>
      </div>
      <div class="form-group">
        <label for="password">New Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your new password" required>
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Update Password">
      </div>
    </form>
  </div>
</body>
</html>
