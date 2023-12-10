<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <title>Book List</title>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["username"])) {
    ?>
        <script type="text/javascript">
            window.location = "logins.php";
        </script>
    <?php
        exit();
    }

    include '../include/connection.php';
    include '../include/header.php';
    ?>

    <!-- Dashboard area -->
    <div id="layoutSidenav_content" style="padding-left: 270px;">
        <main>
            <br><br>
            <div class="bstore">
                <table id="bookTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="12" style="background-color: skyblue; text-align: center;">Book List</th>
                        </tr>
                        <tr>
                            <th>Sn</th>
                            <th>Books image</th>
                            <th>Books name</th>
                            <th>Category</th>
                            <th>Author name</th>
                            <th>Publication name</th>
                            <th>ISBN Number</th>
                            <th>Purchase date</th>
                            <th>Books price</th>
                            <th>Books quantity</th>
                            <th>Books availability</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT book.*, tblcategory.categoryName FROM book INNER JOIN tblcategory ON book.catid = tblcategory.id";
                        $result = mysqli_query($link, $query);
                        $sn = 1;

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $sn . "</td>";
                                // echo "<td><img src='books-image/" . $row["books_image"] . "' height='100' width='100' alt=''></td>";
                                echo "<td><img src='books-image/" . $row["books_image"] . "' height='100' width='100' alt=''></td>";
                                echo "<td>" . $row['books_name'] . "</td>";
                                echo "<td>" . $row['categoryName'] . "</td>";
                                echo "<td>" . $row['books_author_name'] . "</td>";
                                echo "<td>" . $row['books_publication_name'] . "</td>";
                                echo "<td>" . $row['isbn_number'] . "</td>";
                                echo "<td>" . $row['books_purchase_date'] . "</td>";
                                echo "<td>" . $row['books_price'] . "</td>";
                                echo "<td>" . $row['books_quantity'] . "</td>";
                                echo "<td>" . $row['books_availability'] . "</td>";
                                echo "<td>
                                <a href='edit_book.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a>
                                <a href='delete_book.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a>
                            </td>";
                                echo "</tr>";
                                $sn++;
                            }
                        } else {
                            echo "<tr><td colspan='12'>No books found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
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
            $('#bookTable').DataTable();
        });
    </script>
</body>

</html>