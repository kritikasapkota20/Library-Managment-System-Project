<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$page = 'userreport';
include '../include/header.php';
include '../include/connection.php';

// Fetch the data for the report
$userReportQuery = "SELECT id, name, username, email, actype, registration_date, last_login_date FROM user";
$userReportResult = mysqli_query($link, $userReportQuery);
$userData = array();
while ($userRow = mysqli_fetch_assoc($userReportResult)) {
    $userData[] = $userRow;
}
?>

<!-- Dashboard area -->
<div id="layoutSidenav_content" style="padding-left: 270px;">
    <main><br><br>
        <div class="dashboard-content">
            <div class="dashboard-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="right text-right">
                                <a href="dashboard.php"><i class="fas fa-home"></i> Home</a>
                                <span class="disabled">User Report</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="user-report">
                                <table id="userReportTable" class="table table-striped table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Account Type</th>
                                            <th>Registration Date</th>
                                            <th>Last Login Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($userData as $userRow) {
                                            echo "<tr>";
                                            echo "<td>" . $userRow['id'] . "</td>";
                                            echo "<td>" . $userRow['name'] . "</td>";
                                            echo "<td>" . $userRow['username'] . "</td>";
                                            echo "<td>" . $userRow['email'] . "</td>";
                                            echo "<td>" . $userRow['actype'] . "</td>";
                                            echo "<td>" . $userRow['registration_date'] . "</td>";
                                            echo "<td>" . $userRow['last_login_date'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php
    include '../include/footer.php';
    ?>

    <script>
        $(document).ready(function () {
            $('#userReportTable').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
</div>
