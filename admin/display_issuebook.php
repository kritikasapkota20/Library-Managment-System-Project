<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

include '../include/connection.php';
include '../include/header.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Display Issued Books</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <!--dashboard area-->
    <div id="layoutSidenav_content" style="padding-left: 270px;">
        <main>
            <br><br>
            <div class="bstore">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="issueBookTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="8" style="background-color: skyblue; text-align: center;">Issued Books</th>
                                    </tr>
                                    <tr>
                                        <th colspan="8">
                                            <div class="text-end mb-3">
                                                <input type="text" id="issueBookSearch" placeholder="Search...">
                                                <button type="button" id="searchButton" class="btn btn-primary">Search</button>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Sn</th>
                                        <th>Book Name</th>
                                        <th>Member Name</th>
                                        <th>Issue Date</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $issuedBooksQuery = "SELECT * FROM issuebook";
                                    $issuedBooksResult = mysqli_query($link, $issuedBooksQuery);
                                    $sn = 1;

                                    while ($issuedBookRow = mysqli_fetch_assoc($issuedBooksResult)) {
                                        echo "<tr>";
                                        echo "<td>" . $sn . "</td>";
                                        echo "<td>" . $issuedBookRow['issuebook'] . "</td>";
                                        echo "<td>" . $issuedBookRow['issuename'] . "</td>";
                                        echo "<td>" . $issuedBookRow['issue_date'] . "</td>";
                                        echo "<td>" . $issuedBookRow['due_date'] . "</td>";
                                        echo "<td>" . $issuedBookRow['status'] . "</td>";
                                        echo "<td>" . $issuedBookRow['actype'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='?id=" . $issuedBookRow['id'] . "' class='btn btn-primary'>Returned</a>";
                                        echo "</td>";
                                        echo "</tr>";
                                        $sn++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <footer>
        <?php include '../include/footer.php'; ?>
    </footer>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#issueBookTable').DataTable();

            $('#searchButton').on('click', function() {
                var keyword = $('#issueBookSearch').val().trim();
                table.search(keyword).draw();
            });
        });
    </script>
</body>

</html>