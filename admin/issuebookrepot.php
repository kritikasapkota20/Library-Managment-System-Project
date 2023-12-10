<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$page = 'issuebookreport';
include '../include/header.php';
include '../include/connection.php';

// Fetch the data for the report
$issueBookReportQuery = "SELECT id, bookid, actype, userid, issue_date, due_date, return_date, status, issuebook, issuename, fine_amount FROM issuebook";
$issueBookReportResult = mysqli_query($link, $issueBookReportQuery);
$issueBookData = array();
while ($issueBookRow = mysqli_fetch_assoc($issueBookReportResult)) {
    $issueBookData[] = $issueBookRow;
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
                                <span class="disabled">Issue Book Report</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="issuebook-report">
                                <table id="issueBookReportTable" class="table table-striped table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>Issue ID</th>
                                            <th>Book ID</th>
                                            <th>Account Type</th>
                                            <th>User ID</th>
                                            <th>Issue Date</th>
                                            <th>Due Date</th>
                                            <th>Return Date</th>
                                            <th>Status</th>
                                            <th>Issued By</th>
                                            <th>Issued To</th>
                                            <th>Fine Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($issueBookData as $issueBookRow) {
                                            echo "<tr>";
                                            echo "<td>" . $issueBookRow['id'] . "</td>";
                                            echo "<td>" . $issueBookRow['bookid'] . "</td>";
                                            echo "<td>" . $issueBookRow['actype'] . "</td>";
                                            echo "<td>" . $issueBookRow['userid'] . "</td>";
                                            echo "<td>" . $issueBookRow['issue_date'] . "</td>";
                                            echo "<td>" . $issueBookRow['due_date'] . "</td>";
                                            echo "<td>" . $issueBookRow['return_date'] . "</td>";
                                            echo "<td>" . $issueBookRow['status'] . "</td>";
                                            echo "<td>" . $issueBookRow['issuebook'] . "</td>";
                                            echo "<td>" . $issueBookRow['issuename'] . "</td>";
                                            echo "<td>" . $issueBookRow['fine_amount'] . "</td>";
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
        $(document).ready(function() {
            $('#issueBookReportTable').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
</div>