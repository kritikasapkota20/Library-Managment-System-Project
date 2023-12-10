<?php
session_start();
if (!isset($_SESSION["username"])) {
?>
    <script type="text/javascript">
        window.location = "login.php";
    </script>
<?php
}
include 'inc/header.php';
include 'inc/connection.php';

?>


<!--dashboard area-->
<div class="dashboard-content">
    <div class="dashboard-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left">
                        <p><span>dashboard</span>User panel</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right text-right">
                        <a href="dashboard.php"><i class="fas fa-home"></i>home</a>
                        <span class="disabled">change password</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="" class="pass-content" method="post">
                        <b>Current Password:</b>
                        <input type="password" required class="form-control mt-10" name="cpassword" placeholder="Current password">
                        <br>
                        <b>New Password:</b>
                        <input type="password" required class="form-control mt-10" name="npassword" placeholder="New password">
                        <br>
                        <b>Confirm Password:</b>
                        <input type="password" required class="form-control mt-10" name="conpass" placeholder="Confirm password">
                        <br>
                        <input type="submit" name="submit" class="btn" value="Change Password">
                    </form>

                    <?php
                    if (isset($_POST["submit"])) {
                        $cpass = $_POST['cpassword'];
                        $npass = $_POST['npassword'];
                        $conpass = $_POST['conpass'];
                        $pass = '';
                        $res = mysqli_query($link, "SELECT password FROM user WHERE username='$_SESSION[username] ' ");

                        while ($row = mysqli_fetch_array($res)) {
                            $pass = $row['password'];
                        }

                        if ($cpass != $pass) {
                    ?>
                            <div class="alert alert-warning">
                                <strong style="color:#333">Invalid!</strong> <span style="color: red;font-weight: bold; ">You entered the wrong password</span>
                            </div>
                            <?php
                        } else {
                            if ($npass == $conpass) {
                                mysqli_query($link, "UPDATE user SET password='$npass' WHERE username='$_SESSION[username]' ");
                            ?>
                                <div class="alert alert-success">
                                    <strong style="color:#333">Success!</strong> <span style="color: green;font-weight: bold; ">Your password has been changed.</span>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="alert alert-warning">
                                    <strong style="color:#333">Not a match!</strong> <span style="color: red;font-weight: bold; ">The passwords do not match.</span>
                                </div>
                    <?php
                            }
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'inc/footer.php';
?>