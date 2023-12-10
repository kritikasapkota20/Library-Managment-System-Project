<!DOCTYPE html>
<html>
<head>
  <title>Liabrary Management System</title>
  <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<style>
	header {
  background-color: green;
  padding: 20px;
}

nav ul {
  list-style: none;
  margin: 10;
  padding: 20px;
}

nav li {
  display: inline-block;
  margin: 0 10px;
}

nav li a {
  color: white;
  text-decoration: none;
  font-size: 20pt;
}

footer {
  background-color: #f7f7f7;
  padding: 40px 0;
  font-size: 14px;
}

footer h4 {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 20px;
}

footer p {
  margin-bottom: 10px;
}

.social-icons li {
  display: inline-block;
  margin-right: 10px;
}

.social-icons i {
  font-size: 20px;
  color: #555;
  transition: color 0.3s ease-in-out;
}

.social-icons i:hover {
  color: #00a0d1;
}


</style>

<body>
<h1>Library Management System</h1>
<header>
  <nav>
    <ul>
      <li><a href="/">Home</a></li>
      <li><a href="/about">About</a></li>
      <li><a href="/services">Services</a></li>
      <li><a href="/contact">Contact</a></li>
      <li><a href="/admin-login">Admin Login</a></li>
      <li><a href="/user-login">User Login</a></li>
      <li><a href="/user-signup">User Signup</a></li>
    </ul>
  </nav>
 </header>
  
  <main>
    <div id="myImage">
      <img src="image.jpg">
    </div>
  </main>
  <footer>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h4>About Us</h4>
        <p>We are a library management system dedicated to providing our users with a seamless experience in managing their library collections.</p>
      </div>
      <div class="col-md-4">
        <h4>Contact Us</h4>
        <p>Email: info@librarysystem.com</p>
        <p>Phone: 555-1234</p>
      </div>
      <div class="col-md-4">
        <h4>Follow Us</h4>
        <ul class="social-icons">
          <li><a href="#"><i class="fa fa-facebook"></i></a></li>
          <li><a href="#"><i class="fa fa-twitter"></i></a></li>
          <li><a href="#"><i class="fa fa-instagram"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="script.js"></script>
</body>
</html>