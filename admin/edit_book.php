<?php
session_start();
ob_start();
if (!isset($_SESSION["username"])) {
    header("Location: logins.php");
    exit();
}

include '../include/connection.php';
include '../include/header.php';

if (isset($_POST["submit"])) {
    $bookId = $_POST["book_id"];
    $bookName = $_POST["book_name"];
    $categoryId = $_POST["category_id"];
    $authorName = $_POST["author_name"];
    $publicationName = $_POST["publication_name"];
    // $isbnNumber = $_POST["isbn_number"];
    // $purchaseDate = $_POST["purchase_date"];
    $bookPrice = $_POST["book_price"];
    $bookQuantity = $_POST["book_quantity"];
    $bookAvailability = $_POST["book_availability"];

    // $updateQuery = "UPDATE book SET books_name = '$bookName', catid = '$categoryId', books_author_name = '$authorName', books_publication_name = '$publicationName', isbn_number = '$isbnNumber', books_purchase_date = '$purchaseDate', books_price = '$bookPrice', books_quantity = '$bookQuantity', books_availability = '$bookAvailability' WHERE id = $bookId";

    $updateQuery = "UPDATE book SET books_name = '$bookName', catid = '$categoryId', books_author_name = '$authorName', books_publication_name = '$publicationName', books_price = '$bookPrice', books_quantity = '$bookQuantity', books_availability = '$bookAvailability' WHERE id = $bookId";
    $updateResult = mysqli_query($link, $updateQuery);

    if ($updateResult) {
        $_SESSION['edit_success'] = true;
    } else {
        $_SESSION['edit_error'] = true;
    }

    header("Location: display_book.php");
    exit();
}

if (isset($_GET["id"])) {
    $bookId = $_GET["id"];
    $query = "SELECT * FROM book WHERE id = $bookId";
    $result = mysqli_query($link, $query);
    $book = mysqli_fetch_assoc($result);
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Edit Book</title>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    </head>

    <body>
        <div id="layoutSidenav_content" style="padding-left: 270px;">
            <main>
                <br><br>
                <div class="bstore">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <h2>Edit Book</h2>
                                <?php
                                if (isset($_SESSION['edit_success']) && $_SESSION['edit_success']) {
                                    echo '<div id="editSuccessAlert" class="alert alert-success" role="alert">
                                        Edit Successfully!
                                    </div>';
                                    unset($_SESSION['edit_success']);
                                }
                                if (isset($_SESSION['edit_error']) && $_SESSION['edit_error']) {
                                    echo '<div id="editErrorAlert" class="alert alert-danger" role="alert">
                                        Edit Error! Please try again.
                                    </div>';
                                    unset($_SESSION['edit_error']);
                                }
                                ?>
                                <form method="POST" action="edit_book.php">
                                    <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                                    <div class="form-group">
                                        <label>Book Name:</label>
                                        <input type="text" name="book_name" class="form-control" value="<?php echo $book['books_name']; ?>">
                                    </div>
                                    <!-- Add more fields for other book attributes -->
                                    <div class="form-group">
                                        <label>Category ID:</label>
                                        <input type="text" name="category_id" class="form-control" value="<?php echo $book['catid']; ?>">
                                    </div>
                                    <!-- Add more fields for other book attributes -->
                                    <div class="form-group">
                                        <label>Author Name:</label>
                                        <input type="text" name="author_name" class="form-control" value="<?php echo $book['books_author_name']; ?>">
                                    </div>
                                    <!-- Add more fields for other book attributes -->
                                    <div class="form-group">
                                        <label>Publication Name:</label>
                                        <input type="text" name="publication_name" class="form-control" value="<?php echo $book['books_publication_name']; ?>">
                                    </div>
                                    <!-- Add more fields for other book attributes -->
                                    <!-- <div class="form-group">
                                        <label>ISBN Number:</label>
                                        <input type="text" name="isbn_number" class="form-control" value="<?php echo $book['isbn_number']; ?>">
                                    </div> -->
                                    <!-- Add more fields for other book attributes -->
                                    <!-- <div class="form-group">
                                        <label>Purchase Date:</label>
                                        <input type="text" name="purchase_date" class="form-control" value="<?php echo $book['books_purchase_date']; ?>">
                                    </div> -->
                                    <!-- Add more fields for other book attributes -->
                                    <div class="form-group">
                                        <label>Book Price:</label>
                                        <input type="text" name="book_price" class="form-control" value="<?php echo $book['books_price']; ?>">
                                    </div>
                                    <!-- Add more fields for other book attributes -->
                                    <div class="form-group">
                                        <label>Book Quantity:</label>
                                        <input type="text" name="book_quantity" class="form-control" value="<?php echo $book['books_quantity']; ?>">
                                    </div>
                                    <!-- Add more fields for other book attributes -->
                                    <div class="form-group">
                                        <label>Book Availability:</label>
                                        <input type="text" name="book_availability" class="form-control" value="<?php echo $book['books_availability']; ?>">
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#bookTable').DataTable();
            });
        </script>
    </body>

    </html>

<?php
}
?>