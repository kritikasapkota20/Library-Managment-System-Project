<!DOCTYPE html>
<html lang="en">
<head>
  <title>Digita Library- Forget Password</title>
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
      color: #ffffff;
      max-width: 450px;  
      margin: 40px auto;
      padding: 30px;
      background-color: transparent;
      border: 1px solid blueviolet;
      border-radius: 5px;
      margin-right: 200px;
      box-shadow: 0px 0px 10px rgba(225, 225, 225, 0.5), 0px 0px 20px rgba(225, 225, 225, 0.3);
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
  </style>
</head>
<body>
  <div class="container">
    <h2 class="text-center">Forgot Password</h2>
    <form action="verification.php" method="post">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="username" id="username" name="username" class="form-control" placeholder="Enter your email" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
      </div>
      <div class="form-group">
        <input type="submit" value="Continue" class="btn btn-primary btn-block">
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
