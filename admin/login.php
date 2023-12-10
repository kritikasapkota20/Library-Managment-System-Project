<?php
session_start();
include '../include/connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../CSS/index.css">
    <title> DIGITAL LIBRARY </title>
</head>

<body>

    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="" method="POST">
                    <h2>Admin login</h2>

                    <div class="inputbox">
                        <ion-icon name="person-circle-outline"></ion-icon>
                        <input type="username" name="username" required>
                        <label for="">Username</label>
                    </div>

                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" required>
                        <label for="">Password</label>
                    </div>



                    <div class="forget">
                        <label for=""><input type="checkbox">Remember Me<span class="spacer"></span><a href="#">Forgot Password?</a></label>
                    </div>

                    <button type="submit" name="login">Login</button>

                    <?php
                    if (isset($_POST["login"])) {
                        $count = 0;
                        $res = mysqli_query($link, "select * from admin where username='$_POST[username]' && password= '$_POST[password]'");
                        $count = mysqli_num_rows($res);

                        if ($count == 0) {
                    ?>
                            <div class="alert alert-warning">
                                <strong style="color:#333">Invalid!</strong> <span style="color: red;font-weight: bold; ">Username Or Password.</span>
                            </div>
                        <?php
                        } else {
                            $_SESSION["username"] = $_POST["username"];
                        ?>
                            <script type="text/javascript">
                                window.location = "dashboard.php";
                            </script>
                    <?php
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
    </section>


    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>