<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

include '../include/connection.php';

if (isset($_GET["id"])) {
    // Get the category ID from the URL
    $categoryId = $_GET["id"];

    // Perform the delete operation
    $query = "DELETE FROM tblcategory WHERE id = $categoryId";
    $result = mysqli_query($link, $query);

    if ($result) {
        // Redirect to the category list page after successful deletion
        header("Location: display_category.php");
        exit();
    } else {
        // Handle the error if the deletion fails
        // You can display an error message or redirect to an error page
        echo "Error: " . mysqli_error($link);
    }
}
