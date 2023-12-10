<?php


session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

include '../include/connection.php';
include '../include/header.php';

$message = ""; // Initialize the message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["issue"])) {
        $bookId = $_POST["bookId"];
        $memberId = $_POST["memberId"];
        $actype = $_POST["actype"]; // Get the selected member type
        $issueDate = date("Y-m-d"); // Get the current server date
        $dueDate = $_POST["dueDate"]; // Get the selected due date

        // Check if the book request has been approved
        $getRequestIdQuery = "SELECT id FROM bookrequest WHERE bookid = ? AND userid = ? AND status = 'approved' LIMIT 1";
        $stmt = mysqli_prepare($link, $getRequestIdQuery);
        mysqli_stmt_bind_param($stmt, "ii", $bookId, $memberId);
        mysqli_stmt_execute($stmt);
        $getRequestIdResult = mysqli_stmt_get_result($stmt);

        if ($getRequestIdResult && $approvedRequest = mysqli_fetch_assoc($getRequestIdResult)) {
            $requestId = $approvedRequest['id'];

            // Check if the book is available and the availability is greater than 0
            $checkAvailabilityQuery = "SELECT books_availability FROM book WHERE id = '$bookId'";
            $availabilityResult = mysqli_query($link, $checkAvailabilityQuery);

            if ($availabilityResult) {
                $availabilityRow = mysqli_fetch_assoc($availabilityResult);
                $availability = $availabilityRow["books_availability"];

                if ($availability > 0) {
                    // Check if the same book is already issued to the user
                    $checkIssuedBookQuery = "SELECT id FROM issuebook WHERE bookid = '$bookId' AND userid = '$memberId' AND status = 'Issued'";
                    $issuedBookResult = mysqli_query($link, $checkIssuedBookQuery);

                    if ($issuedBookResult && mysqli_num_rows($issuedBookResult) === 0) {
                        // Perform the book issuing operation
                        $issueQuery = "INSERT INTO issuebook (bookid, actype, userid, issue_date, due_date, status, issuebook, issuename, fine_amount) 
                            VALUES ('$bookId', '$actype', '$memberId', '$issueDate', '$dueDate', 'Issued', 
                            (SELECT books_name FROM book WHERE id = '$bookId'), 
                            (SELECT name FROM user WHERE id = '$memberId'), 0.00)";

                        if (mysqli_query($link, $issueQuery)) {
                            // Update the book availability status and decrease the availability
                            $updateAvailabilityQuery = "UPDATE book SET books_availability = books_availability - 1 WHERE id = '$bookId'";
                            mysqli_query($link, $updateAvailabilityQuery);

                            $message = "Book has been issued successfully.";
                            // Clear the form inputs after successful book issuance
                            echo '<script>document.getElementById("issueBookForm").reset();</script>';
                        } else {
                            $message = "Error issuing book: " . mysqli_error($link);
                        }
                    } else {
                        $message = "This book is already issued to the user.";
                    }
                } else {
                    $message = "Book is not available for issuance.";
                }
            } else {
                $message = "Error checking book availability: " . mysqli_error($link);
            }
        } else {
            $message = "Book request has not been approved for this user.";
        }
    }
}




?>

<!DOCTYPE html>
<html>

<head>
    <title>Issue Book</title>
    <style>
        .dropdown-select {
            position: relative;
        }

        .dropdown-select::after {
            content: "";
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            pointer-events: none;
            border-style: solid;
            border-width: 5px 5px 0 5px;
            border-color: #999 transparent transparent transparent;
        }

        .message {
            margin: 10px auto;
            padding: 5px;
            background-color: #dff0d8;
            border: 1px solid #d6e9c6;
            color: #3c763d;
            text-align: center;
            max-width: 800px;
            /* Adjust the width as needed */
            margin: 0 auto;
            /* Center the message horizontally */
        }

        */
    </style>
    <script>
        setTimeout(function() {
            var messageElement = document.querySelector('.message');
            messageElement.style.display = 'none';
            window.location.href = 'issue_book.php';
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
                <h5>Only user requests that have been approved will be eligible to receive a book!</h5>

                <form id="issueBookForm" action="" method="post">
                    <table class="table table-bordered" style="width: 800px;">
                        <tr>
                            <th colspan="2" style="background-color: skyblue; text-align: center;">Issue Book</th>
                        </tr>
                        <tr>
                            <td style="width: 50%;">
                                <label for="bookId">Select Book:</label>
                                <div class="dropdown-select">
                                    <select class="form-control" name="bookId" id="bookId" required>
                                        <option value="">Select Book</option>
                                        <?php
                                        $booksQuery = "SELECT id, books_name, books_availability FROM book WHERE books_availability >= 0";
                                        $booksResult = mysqli_query($link, $booksQuery);
                                        while ($bookRow = mysqli_fetch_assoc($booksResult)) {
                                            $availability = ($bookRow['books_availability'] >= 0) ? ' (Available: ' . $bookRow['books_availability'] . ')' : '';
                                            echo "<option value='" . $bookRow['id'] . "'>" . $bookRow['books_name'] . $availability . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="actype">Member Type:</label>
                                <div class="dropdown-select">
                                    <select class="form-control" name="actype" id="actype" required>
                                        <option value="student">Student</option>
                                        <option value="teacher">Teacher</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="memberId">Select Member:</label>
                                <div class="dropdown-select">
                                    <select class="form-control" name="memberId" id="memberId" required>
                                        <option value="">Select Member</option>
                                        <?php
                                        $membersQuery = "SELECT * FROM user WHERE actype = 'student' OR actype = 'teacher'";
                                        $membersResult = mysqli_query($link, $membersQuery);
                                        while ($memberRow = mysqli_fetch_assoc($membersResult)) {
                                            $memberInfo = $memberRow['name'] . " (" . $memberRow['actype'] . ")";
                                            echo "<option value='" . $memberRow['id'] . "'>" . $memberInfo . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="dueDate">Due Date:</label>
                                <input class="form-control" type="date" name="dueDate" id="dueDate" required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <input type="submit" name="issue" value="Issue Book" class="btn btn-info">
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