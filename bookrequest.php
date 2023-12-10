<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$page = 'issuebookreport';
include 'inc/connection.php';
include 'inc/header.php';


if (isset($_POST["submit_request"])) {
    // Get the book ID from the form submission
    $bookId = $_POST["bookid"];


    // Get the user ID from the session (assuming it's stored in $_SESSION["userid"])
    $userId = $_SESSION["username"];
    // echo $userId;
    $userQuery = "SELECT id FROM user WHERE username = '$userId'";
    $userResult = mysqli_query($link, $userQuery);

    if ($userResult && mysqli_num_rows($userResult) > 0) {
        $userData = mysqli_fetch_assoc($userResult);
        $userId = $userData['id'];
    } else {
        // Handle the case where the user with the provided username was not found
        echo "User not found.";
    }
    $existingRequestQuery = "SELECT id FROM bookrequest WHERE userid = '$userId' AND bookid = '$bookId' AND status = 'Pending'";
    $existingRequestResult = mysqli_query($link, $existingRequestQuery);

    if ($existingRequestResult && mysqli_num_rows($existingRequestResult) > 0) {
        // A request for the same book by the same user already exists
        echo "You have already requested this book!.";
    } else {


        // Get the book details to be inserted into the bookrequest table
        $bookDetailsQuery = "SELECT books_name, books_author_name, catid, books_availability, books_rent, books_image FROM book WHERE id = $bookId";
        $bookDetailsResult = mysqli_query($link, $bookDetailsQuery);


        if ($bookDetailsResult && mysqli_num_rows($bookDetailsResult) > 0) {
            $bookDetails = mysqli_fetch_assoc($bookDetailsResult);
            $bookName = $bookDetails['books_name'];


            // Insert the request into the bookrequest table
            $insertRequestQuery = "INSERT INTO bookrequest (userid, bookid, request_date, status, bookname, actype, issuesdays) 
          VALUES ('$userId', '$bookId', NOW(), 'Pending', '$bookName', 'Rent', 14)";

            $insertResult = mysqli_query($link, $insertRequestQuery);

            if ($insertResult) {

                // Request successfully inserted, you can redirect to a success page if needed
                // header("Location: request_success.php");
                header("location:bookrequest.php");
                exit();
            } else {
                // Error occurred during insertion
                echo "Error: " . mysqli_error($link);

                // Redirect to an error page or show an error message
            }
        } else {
            // Book details not found, handle this error
            // Redirect to an error page or show an error message
            echo "Book details not found.";
        }
    }
}

// Fetch the book details for the table
$bookDetailsQuery = "SELECT id, books_name, books_image, catid, books_author_name, books_availability, books_rent FROM book WHERE 1";
$bookDetailsResult = mysqli_query($link, $bookDetailsQuery);
$bookDetails = array();
while ($bookRow = mysqli_fetch_assoc($bookDetailsResult)) {
    $bookDetails[] = $bookRow;
}

// Fetch the categories for displaying the category name in the table
$categoriesQuery = "SELECT id, categoryName FROM tblcategory WHERE 1";
$categoriesResult = mysqli_query($link, $categoriesQuery);
$categories = array();
while ($categoryRow = mysqli_fetch_assoc($categoriesResult)) {
    $categories[] = $categoryRow;
}
?>

<!-- The rest of your HTML code remains unchanged -->
<div id="layoutSidenav_content" style="padding-left: 270px;">
    <main><br><br>
        <div class="dashboard-content">
            <div class="dashboard-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="right text-right">
                                <a href="dashboard.php"><i class="fas fa-home"></i> Home</a>
                                <span class="disabled">Book Request</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="book-details">
                            <h2>Book Details</h2>
                            <table class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Book Name</th>
                                        <th>Book Author</th>
                                        <th>Category</th>
                                        <th>Available</th>
                                        <th>Rent</th>
                                        <th>Image</th>
                                        <th>Request Book</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bookDetails as $book) { ?>
                                        <tr>
                                            <td><?php echo $book['books_name']; ?></td>
                                            <td><?php echo $book['books_author_name']; ?></td>
                                            <td>
                                                <?php
                                                $categoryId = $book['catid'];
                                                $categoryName = "";
                                                foreach ($categories as $category) {
                                                    if ($category['id'] == $categoryId) {
                                                        $categoryName = $category['categoryName'];
                                                        break;
                                                    }
                                                }
                                                echo $categoryName;
                                                ?>
                                            </td>
                                            <td><?php echo $book['books_availability']; ?></td>
                                            <td><?php echo $book['books_rent']; ?></td>
                                            <td><img src="<?php echo $book['books_image']; ?>" alt="Book Image" width="100"></td>
                                            <td>
                                                <form method="POST" action="bookrequest.php">
                                                    <?php if ($book['books_availability'] > 0) { ?>
                                                        <input type="hidden" name="bookid" value="<?php echo $book['id']; ?>">
                                                        <a href="#"> <input type="submit" name="submit_request" class="btn btn-primary" value="Request Book"></a>
                                                    <?php } else { ?>
                                                        <button class="btn btn-secondary" disabled>Not Available</button>
                                                    <?php } ?>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'inc/footer.php'; ?>
</div>