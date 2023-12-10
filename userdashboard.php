<?php 
     session_start();
    if(!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>		
        <?php
	}
$page = 'home';
include 'inc/header.php';
include 'inc/connection.php';

$username = $_SESSION["username"];

?>

<!--dashboard area-->
<div class="dashboard-content">
    <div class="dashboard-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left">
                        <p><span>dashboard</span>User panel</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right text-right">
                        <a href="dashboard.php"><i class="fas fa-home"></i>home</a>
                        <span class="disabled">my issued books</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="st-issuedBook">
                        <table id="dtBasicExample" class="table table-dark table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Books Name</th>
                                    <th>Books Issue Date</th>
                                    <th>Books Due Date</th>
                                    <th>Books Return Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT ib.issuename, ib.issuebook, ib.issue_date, ib.due_date, ib.return_date FROM issuebook ib
                                          JOIN user u ON ib.issuename = u.name
                                          WHERE u.username = '$username'";
                                $res = mysqli_query($link, $query);
                                while ($row = mysqli_fetch_array($res)) {
                                    echo "<tr>";
                                    echo "<td>" . $row["issuename"] . "</td>";
                                    echo "<td>" . $row["issuebook"] . "</td>";
                                    echo "<td>" . $row["issue_date"] . "</td>";
                                    echo "<td>" . $row["due_date"] . "</td>";
                                    echo "<td>" . $row["return_date"] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'inc/footer.php';
?>

<script>
    $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
</script>
