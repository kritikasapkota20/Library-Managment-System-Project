<?php
session_start();
if (!isset($_SESSION["username"])) {
?>
    <script type="text/javascript">
        window.location = "login.php";
    </script>
<?php
}
// include '../include/header.php';
include '../include/connection.php';

?>


<!--dashboard area-->

<head>
    <link rel="stylesheet" href="../inc/css/bootstrap.min.css">
    <link rel="stylesheet" href="../inc/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../inc/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../inc/css/datatables.min.css">
    <link rel="stylesheet" href="../inc/css/pro1.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">
    <link href="../CSS/styles.css" rel="stylesheet" />

</head>

<div class="dashboard-content  ">
    <div class="dashboard-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left">
                        <p><span>dashboard</span>Admin panel</p>
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
                        <input type="password" required class="form-control mt-10" name="acpassword" placeholder="Current password">
                        <br>
                        <b>New Password:</b>
                        <input type="password" reuired class="form-control mt-10" name="anpassword" placeholder="New password">
                        <br>
                        <b>Confirm Password:</b>
                        <input type="password" reuired class="form-control mt-10" name="aconpass" placeholder="Confirm password">
                        <br>
                        <input type="submit" name="submit" class="btn" value="Change Password">
                    </form>

                    <?php
                    if (isset($_POST["submit"])) {
                        $cpass = $_POST['acpassword'];
                        $npass = $_POST['anpassword'];
                        $conpass = $_POST['aconpass'];
                        $pass = '';
                        $res = mysqli_query($link, "SELECT password FROM admin WHERE username='$_SESSION[username] ' ");

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
                                mysqli_query($link, "UPDATE admin SET password='$npass' WHERE username='$_SESSION[username]' ");
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
include '../include/footer.php';
?>