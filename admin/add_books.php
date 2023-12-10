<?php
session_start();
if (!isset($_SESSION["username"]) && basename($_SERVER['PHP_SELF']) != 'login.php') {
    header("Location: login.php");
    exit();
}
include '../include/connection.php';
include '../include/header.php';


$message = ""; // Initialize the message variable

if (isset($_POST["submit"])) {
    $image_name = $_FILES['f1']['name'];
    $temp = explode(".", $image_name);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    $imagepath = "books-image/" . $newfilename;
    move_uploaded_file($_FILES["f1"]["tmp_name"], $imagepath);
    $booksname = $_POST['booksname'];
    $bauthorname = $_POST['bauthorname'];
    $bpubname = $_POST['bpubname'];
    $bpurcdate = $_POST['bpurcdate'];
    $bprice = $_POST['bprice'];
    $bquantity = $_POST['bquantity'];
    $bavailability = $_POST['bavailability'];
    $isbn = $_POST['isbn'];
    $categoryName = $_POST['category'];
    $librarian_username = $_SESSION["username"];


    $isbnQuery = mysqli_query($link, "SELECT * FROM book WHERE isbn_number = '$isbn'");
    if (mysqli_num_rows($isbnQuery) > 0) {
        $message = "ISBN number already exists. Please enter a unique ISBN.";
    } else {
        $catidQuery = mysqli_query($link, "SELECT id FROM tblcategory WHERE categoryName = '$categoryName'");
        $row = mysqli_fetch_assoc($catidQuery);
        $catid = $row['id'];

        $query = "INSERT INTO book (books_name, books_image, books_author_name, books_publication_name, books_purchase_date, books_price, books_quantity, books_availability, books_rent, isbn_number, catid, librarian_username) VALUES ('$booksname', '$imagepath', '$bauthorname', '$bpubname', '$bpurcdate', '$bprice', '$bquantity', '$bavailability', '', '$isbn', '$catid', '$librarian_username')";

        if (mysqli_query($link, $query)) {
            $message = "Book has been successfully added.";
            // Clear the form inputs after successful book addition
            echo '<script>document.getElementById("addBookForm").reset();</script>';
        } else {
            $message = "Error adding book: " . mysqli_error($link);
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Book</title>
</head>

<body>
    <!--dashboard area-->
    <div id="layoutSidenav_content" style="padding-left: 270px;">
        <main>
            <br><br>
            <div class="bstore">
                <?php if ($message) { ?>
                    <div class="alert alert-success text-center" role="alert" style="margin-bottom: 20px;">
                        <?php echo $message; ?>
                    </div>
                <?php } ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="table table-bordered" style="width: 800px;">
                        <tr>
                            <th colspan="2" style="background-color: skyblue; text-align: center;">Book Info</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="booksname" placeholder="Books name" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Books image
                                <input type="file" class="form-control" name="f1" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="bauthorname" placeholder="Books author name" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="bpubname" placeholder="Books publication name" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="bpurcdate" placeholder="Books purchase date" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="bprice" placeholder="Books price" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="bquantity" placeholder="Books quantity" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="bavailability" placeholder="Books availability" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="isbn" placeholder="ISBN Number" required="">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select class="form-control" name="category" required="">
                                    <option value="">Select Category</option>
                                    <?php
                                    $categories = mysqli_query($link, "SELECT * FROM tblcategory");
                                    while ($row = mysqli_fetch_assoc($categories)) {
                                        echo "<option value='" . $row['categoryName'] . "'>" . $row['categoryName'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <div class="submit mt-20">
                        <input type="submit" name="submit" class="btn btn-info submit" value="Add Book">
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        setTimeout(function() {
            var alertElement = document.querySelector('.alert.alert-success');
            alertElement.style.display = 'none';
        }, 5000); // 5 seconds delay
    </script>

    <footer>
        <?php include '../include/footer.php'; ?>
    </footer>
</body>

</html>