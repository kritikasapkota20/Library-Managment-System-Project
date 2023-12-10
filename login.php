<?php
session_start();
include 'inc/connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        history.pushState(null, null, location.href);
        window.onpopstate = function() {
            history.go(1);
        };
    </script>
    <link rel="stylesheet" href="css/index.css">
    <title> DIGITAL LIBRARY </title>
</head>

<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="" method="post">
                    <h2>User login</h2>

                    <div class="inputbox">
                        <ion-icon name="person-circle-outline"></ion-icon>
                        <input type="text" name="username" required>
                        <label for="">Username</label>
                    </div>

                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" required>
                        <label for="">Password</label>
                    </div>

                    <label for="role">Role:</label>
                    <select id="role" name="role" required>
                        <option value="" disabled selected hidden>Select Role</option>
                        <option value="teacher">Teacher</option>
                        <option value="student">Student</option>
                    </select><br><br><br>

                    <div class="forget">
                        <label for=""><input type="checkbox">Remember Me<span class="spacer"></span><a href="forgetpassword.php">Forget Password</a></label>
                    </div>

                    <button type="submit" name="login">Login</button>
                    <div class="register">
                        <p>Don't have an account? <a href="register.php">Register</a></p>
                    </div>
                </form>
                <?php
                if (isset($_POST["login"])) {
                    $count = 0;
                    $role = $_POST["role"];
                    $res = mysqli_query($link, "SELECT * FROM user WHERE username='$_POST[username]' AND password='$_POST[password]' AND actype='$role'");
                    $count = mysqli_num_rows($res);
                    if ($count == 0) {
                ?>
                        <div class="alert alert-warning">
                            <strong style="color: red">Invalid!</strong> <span style="color: red;font-weight: bold;">Username, Password, or Role.</span>
                        </div>
                    <?php
                    } else {
                        $_SESSION["username"] = $_POST["username"];
                    ?>
                        <script type="text/javascript">
                            window.location = "my-issued-books.php";
                        </script>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>