<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$page = 'bookreport';
include '../include/header.php';
include '../include/connection.php';

// Fetch the data for the report
$bookReportQuery = "SELECT * FROM book";
$bookReportResult = mysqli_query($link, $bookReportQuery);
$bookData = array();
while ($bookRow = mysqli_fetch_assoc($bookReportResult)) {
    $bookData[] = $bookRow;
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
                                <span class="disabled">Book Report</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="book-report">
                                <table id="bookReportTable" class="table table-striped table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>Book ID</th>
                                            <th>Book Name</th>
                                            <th>Author Name</th>
                                            <th>Publication Name</th>
                                            <th>Purchase Date</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Availability</th>
                                            <th>Rent</th>
                                            <th>ISBN Number</th>
                                            <th>Librarian Username</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($bookData as $bookRow) {
                                            echo "<tr>";
                                            echo "<td>" . $bookRow['id'] . "</td>";
                                            echo "<td>" . $bookRow['books_name'] . "</td>";
                                            echo "<td>" . $bookRow['books_author_name'] . "</td>";
                                            echo "<td>" . $bookRow['books_publication_name'] . "</td>";
                                            echo "<td>" . $bookRow['books_purchase_date'] . "</td>";
                                            echo "<td>" . $bookRow['books_price'] . "</td>";
                                            echo "<td>" . $bookRow['books_quantity'] . "</td>";
                                            echo "<td>" . $bookRow['books_availability'] . "</td>";
                                            echo "<td>" . $bookRow['books_rent'] . "</td>";
                                            echo "<td>" . $bookRow['isbn_number'] . "</td>";
                                            echo "<td>" . $bookRow['librarian_username'] . "</td>";
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
    <!-- Add a link/button to download the PDF report -->

    <?php
    include '../include/footer.php';
    ?>

    <script>
        $(document).ready(function () {
            $('#bookReportTable').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
