<?php
    include '../include/connection.php';
    include '../include/header.php';

    // Initialize the message variable
    $message = "";

    // Handle form submission
    if (isset($_POST["submit"])) {
        $categoryName = $_POST["categoryName"];
        $status = $_POST["status"] == "Active" ? 1 : 0;

        // Check if the category name already exists
        $existingCategoryQuery = mysqli_query($link, "SELECT * FROM tblcategory WHERE categoryName = '$categoryName'");
        if (mysqli_num_rows($existingCategoryQuery) > 0) {
            $message = "Category already exists. Please enter a unique category name.";
        } else {
            // Perform database insert operation
            $creationDate = date("Y-m-d H:i:s"); // Get the current server date and time
            $query = "INSERT INTO `tblcategory` (`categoryName`, `status`, `creationDate`) VALUES ('$categoryName', '$status', '$creationDate')";
            if (mysqli_query($link, $query)) {
                $message = "Category added successfully";
            } else {
                $message = "Error adding category";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
    <style>
        .bstore input[type="text"] {
            width: 100%;
        }
        .message {
            margin: 10px 0;
            padding: 5px;
            background-color: #dff0d8;
            border: 1px solid #d6e9c6;
            color: #3c763d;
            text-align: center;
            max-width: 400px; /* Adjust the width as needed */
            margin: 0 auto; /* Center the message horizontally */
        }
    </style>
    <script>
        setTimeout(function() {
            var messageElement = document.querySelector('.message');
            messageElement.style.display = 'none';
            window.location.href = 'add_category.php';
        }, 5000); // 5 seconds delay
    </script>
</head>
<body>
    <!--dashboard area-->
    <div id="layoutSidenav_content" style="padding-left: 270px;">
        <main>
            <br><br>
            <div class="bstore">
                <?php if (!empty($message)) { ?>
                    <div class="message"><?php echo $message; ?></div>
                <?php } ?>
                <form action="" method="post">
                    <table class="table table-bordered" style="width: 800px;">
                        <tr>
                            <th colspan="2" style="background-color: skyblue; text-align: center;">Add Category</th>
                        </tr>
                        <tr>
                            <td>Category Name</td>
                            <td><input type="text" name="categoryName" required></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <select name="status" required>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <input type="submit" name="submit" value="Add Category">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </main>
    </div>

    <footer>
        <?php include '../include/footer.php'; ?>
    </footer>
</body>
</html>
