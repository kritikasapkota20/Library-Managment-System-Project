<?php
include '../include/connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../CSS/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand-lg navbar-dark bg-dark" style="height: 90px;">

        <!-- Logo -->
        <a class="navbar-brand" href="#" style="margin-left: 10px;"><img src="../IMAGES/logo_new.png" alt="Logo" style="max-height: 80px; max-width: 200px;"></a>

        <!-- Digital Library Title -->
        <span class="navbar-text mx-auto" style="font-size: 20px; font-weight: bold;">Digital Library</span>

        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

        <!-- Navbar-->

        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-bell"></i> <!-- Notification Icon -->
                        <span class="badge badge-danger" id="notificationCount"></span> <!-- Notification Badge -->
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user fa-fw"></i> Admin
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../admin/changepass.php">Change Password</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="../admin/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="width: 230px;">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <br><br>
                        <a class="nav-link" href="../admin/dashboard.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategories" aria-expanded="false" aria-controls="collapseCategories">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                <span style="text-transform: uppercase;">CATEGORIES</span>
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCategories" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../admin/add_category.php">Add Category</a>
                                    <a class="nav-link" href="../admin/display_category.php">Manage Categories</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseBooks" aria-expanded="false" aria-controls="collapseBooks">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                <span style="text-transform: uppercase;">BOOKS</span>
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseBooks" aria-labelledby="headingBooks" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../admin/add_books.php">Add Book</a>
                                    <a class="nav-link" href="../admin/display_book.php">Manage Books</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseIssue" aria-expanded="false" aria-controls="collapseIssue">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                <span style="text-transform: uppercase;">ISSUE BOOKS</span>
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseIssue" aria-labelledby="headingIssue" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../admin/issue_book.php">Issue New Book</a>
                                    <a class="nav-link" href="../admin/display_issuebook.php">Manage Issued Books</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUser" aria-expanded="false" aria-controls="collapseUser">
                                <div class="sb-nav-link-icon"><i class="fas fa-fw fa-users"></i></div>
                                <span style="text-transform: uppercase;">MANAGE USERS</span>
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseUser" aria-labelledby="headingUser" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../admin/adduser.php">Add User</a>
                                </nav>
                            </div>

                            <a class="nav-link" href="../admin/bookrequest.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                <span style="text-transform: uppercase;">BOOK REQUEST</span>
                            </a>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReports" aria-expanded="false" aria-controls="collapseReports">
                                ` <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                <span style="text-transform: uppercase;">REPORTS</span>
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseReports" aria-labelledby="headingReports" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../admin/userreport.php">USER REPORT</a>
                                    <a class="nav-link" href="../admin/bookreport.php">BOOK REPORT</a>
                                    <a class="nav-link" href="../admin/issuebookrepot.php">BOOK ISSUE REPORT</a>
                                </nav>
                            </div>
            </nav>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
</body>

</html>