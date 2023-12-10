<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$page = 'bookrequest';
include '../include/header.php';
include '../include/connection.php';

// Fetch the book requests made by users
$bookRequestsQuery = "SELECT id, userid, bookid, request_date, status FROM bookrequest WHERE 1";
$bookRequestsResult = mysqli_query($link, $bookRequestsQuery);
$bookRequests = array();
while ($requestRow = mysqli_fetch_assoc($bookRequestsResult)) {
    $bookRequests[] = $requestRow;
}

// Fetch the book details for displaying book information in the table
$bookDetailsQuery = "SELECT b.id, b.books_name, b.books_author_name, b.books_availability, b.books_rent, i.due_date 
                    FROM book as b
                    INNER JOIN issuebook as i
                    ON b.id = i.bookid";
$bookDetailsResult = mysqli_query($link, $bookDetailsQuery);
$bookDetails = array();
while ($bookRow = mysqli_fetch_assoc($bookDetailsResult)) {
    $bookDetails[$bookRow['id']] = $bookRow;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['request_id'])) {
        $request_id = $_POST['request_id'];
        // Update the status in the database
        $updateStatusQuery = "UPDATE bookrequest SET status = 'approved' WHERE id = '$request_id'";
        $updateStatusResult = mysqli_query($link, $updateStatusQuery);

        if ($updateStatusResult) {
            // Store the approved request ID in the database
            $storeApprovalQuery = "INSERT INTO approved_requests (request_id) VALUES ('$request_id')";
            mysqli_query($link, $storeApprovalQuery);

            echo json_encode(array("status" => "success"));
            exit();
        } else {
            echo json_encode(array("status" => "error", "message" => "Error updating record: " . mysqli_error($link)));
            exit();
        }
    }
}
?>

<div id="layoutSidenav_content" style="padding-left: 270px;">
    <main><br><br>
        <div class="dashboard-content">
            <div class="dashboard-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="book-request-list">
                                <h2>Approve Book Requests</h2> <!-- Update heading here -->
                                <table class="table table-striped table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>Request ID</th>
                                            <th>User Name</th>
                                            <th>Book Name</th>
                                            <th>Author</th>
                                            <th>Availability</th>
                                            <th>Rent</th>
                                            <th>Request Date</th>
                                            <th>Due Date</th>
                                            <th>Approve</th> <!-- Update column heading here -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($bookRequests as $request) {
                                            $isApproved = mysqli_query($link, "SELECT * FROM approved_requests WHERE request_id = '" . $request['id'] . "'");
                                            $isApproved = mysqli_num_rows($isApproved) > 0;

                                        ?>
                                            <tr>
                                                <td><?php echo $request['id']; ?></td>

                                                <td>
                                                    <?php

                                                    $userId = $request['userid'];
                                                    $userNameQuery = "SELECT username FROM user WHERE id = '$userId'";
                                                    $userNameResult = mysqli_query($link, $userNameQuery);
                                                    $userNameRow = mysqli_fetch_assoc($userNameResult);
                                                    echo $userNameRow['username'];
                                                    ?>
                                                </td>
                                                <td><?php echo $bookDetails[$request['bookid']]['books_name']; ?></td>
                                                <td><?php echo $bookDetails[$request['bookid']]['books_author_name']; ?></td>
                                                <td><?php echo $bookDetails[$request['bookid']]['books_availability']; ?></td>
                                                <td><?php echo $bookDetails[$request['bookid']]['books_rent']; ?></td>
                                                <td><?php echo $request['request_date']; ?></td>
                                                <td><?php echo $bookDetails[$request['bookid']]['due_date']; ?></td>
                                                <td>
                                                    <form method="POST" action="">
                                                        <?php if ($isApproved) { ?>
                                                            <button type="button" class="btn btn-success" disabled>Approved</button>
                                                        <?php } else { ?>
                                                            <button type="button" class="btn btn-success" id="approveButton<?php echo $request['id']; ?>" onclick="approveRequest(<?php echo $request['id']; ?>)">Approve</button>
                                                        <?php } ?>

                                                    </form>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <script>
                                    function approveRequest(requestId) {
                                        // Update the button text to 'Approved'
                                        var button = document.getElementById('approveButton' + requestId);
                                        button.innerHTML = 'Approved';
                                        // Disable the button after it has been clicked
                                        button.disabled = true;

                                        // Simulate the form submission with AJAX
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST', 'bookrequest.php', true);
                                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                        xhr.onreadystatechange = function() {
                                            if (xhr.readyState == 4 && xhr.status == 200) {
                                                var response = JSON.parse(xhr.responseText);
                                                if (response.status === 'success') {
                                                    // Do something on success
                                                } else {
                                                    // Handle the error
                                                    alert(response.message);
                                                }
                                            }
                                        };
                                        xhr.send('request_id=' + requestId);
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include '../include/footer.php'; ?>
</div>