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
    <title>Display Category</title>
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
                            <table id="categoryTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="7" style="background-color: skyblue; text-align: center;">Category List</th>
                                    </tr>
                                    <tr>
                                        <th colspan="7">
                                            <div class="text-end mb-3">
                                                <input type="text" id="categorySearch" placeholder="Search...">
                                                <button type="button" id="searchButton" class="btn btn-primary">Search</button>
                                            </div>
                                        </th>
                                    <tr>
                                    <tr>
                                        <th>Sn</th>
                                        <th>Category ID</th>
                                        <th>Category Name</th>
                                        <th>Status</th>
                                        <th>Creation Date</th>
                                        <th>Updation Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM tblcategory";
                                    $result = mysqli_query($link, $query);
                                    $sn = 1;

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $sn . "</td>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['categoryName'] . "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
                                        echo "<td>" . $row['creationDate'] . "</td>";
                                        echo "<td>" . $row['updationDate'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='edit_category.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a> ";
                                        echo "<a href='delete_category.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a>";
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
            var table = $('#categoryTable').DataTable();

            $('#searchButton').on('click', function() {
                var keyword = $('#categorySearch').val().trim();
                table.search(keyword).draw();
            });
        });
    </script>
</body>

</html>