<?php
session_start();
ob_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

include '../include/connection.php';
include '../include/header.php';

// Handle update operation if form is submitted
if (isset($_POST["submit"])) {
    $categoryId = $_POST["category_id"];
    $categoryName = $_POST["category_name"];

    // Perform the update operation
    $updateQuery = "UPDATE tblcategory SET categoryName = '$categoryName' WHERE id = $categoryId";
    $updateResult = mysqli_query($link, $updateQuery);

    if ($updateResult) {
        $_SESSION['edit_success'] = true;
    } else {
        $_SESSION['edit_error'] = true;
    }

    // Redirect to display_category.php
    header("Location: display_category.php");
    exit();
}

// Display the edit form
if (isset($_GET["id"])) {
    $categoryId = $_GET["id"];
    $query = "SELECT * FROM tblcategory WHERE id = $categoryId";
    $result = mysqli_query($link, $query);
    $category = mysqli_fetch_assoc($result);
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Edit Category</title>
        <!-- Add Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>

    <body>
        <!--dashboard area-->
        <div id="layoutSidenav_content" style="padding-left: 270px;">
            <main>
                <br><br>
                <div class="bstore">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <h2>Edit Category</h2>
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
                                <!-- Display the form to edit the category -->
                                <form method="POST" action="edit_category.php">
                                    <input type="hidden" name="category_id" value="<?php echo $category['id']; ?>">
                                    <div class="form-group">
                                        <label>Category Name:</label>
                                        <input type="text" name="category_name" class="form-control" value="<?php echo $category['categoryName']; ?>">
                                        <!-- Add more fields for other category attributes -->
                                    </div>

                                    <!-- Add more form fields here for updating category details -->

                                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <!-- Footer -->
        <?php include '../include/footer.php'; // Including the footer file 
        ?>

        <script>
            // Hide the edit success message after 5 seconds and then redirect
            setTimeout(function() {
                document.getElementById('editSuccessAlert').style.display = 'none';
                window.location.href = 'display_category.php';
            }, 5000);
        </script>
    </body>

    </html>


<?php
}
?>