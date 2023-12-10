<?php
session_start();
if (!isset($_SESSION["username"])) {
?>
    <script type="text/javascript">
        window.location = "login.php";
    </script>
<?php
}
$page = 'home';
include '../include/connection.php';
include '../include/header.php';
?>

<div id="layoutSidenav_content" style="padding-left: 270px;">
    <main><br>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-primary text-white mb-4" style="height: 180px;">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-users fa-5x me-4"></i>
                            <span class="fs-3 me-5">Users</span>
                            <span class="fs-1">
                                <?php
                                $res = mysqli_query($link, "SELECT * FROM user");
                                $count = mysqli_num_rows($res);
                                echo $count;
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-warning text-white mb-4" style="height: 180px;">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-book-reader fa-5x me-4"></i>
                            <span class="fs-3 me-5">Issued Books</span>
                            <span class="fs-1">
                                <?php
                                $res = mysqli_query($link, "SELECT * FROM issuebook");
                                $count = mysqli_num_rows($res);
                                echo $count;
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-success text-white mb-4" style="height: 180px;">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-book fa-5x me-4"></i>
                            <span class="fs-2 me-5">Books</span>
                            <span class="fs-1">
                                <?php
                                $res = mysqli_query($link, "SELECT * FROM book");
                                $count = mysqli_num_rows($res);
                                echo $count;
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-danger text-white mb-4" style="height: 180px;">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-book-open fa-5x me-4"></i>
                            <span class="fs-3 me-5">Book Requests</span>
                            <span class="fs-1">
                                <?php
                                $res = mysqli_query($link, "SELECT * FROM bookrequest");
                                $count = mysqli_num_rows($res);
                                echo $count;
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-secondary text-white mb-4" style="height: 180px;">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-list fa-5x me-4"></i>
                            <span class="fs-3 me-5">Category List</span>
                            <span class="fs-1">
                                <?php
                                $res = mysqli_query($link, "SELECT * FROM tblcategory");
                                $count = mysqli_num_rows($res);
                                echo $count;
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-info text-white mb-4" style="height: 180px;">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-dollar-sign fa-5x me-4"></i>
                            <span class="fs-2 me-5">Fines</span>
                            <span class="fs-1">
                                <?php
                                $res = mysqli_query($link, "SELECT * FROM fine");
                                $count = mysqli_num_rows($res);
                                echo $count;
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</div>
<?php include '../include/footer.php' ?>