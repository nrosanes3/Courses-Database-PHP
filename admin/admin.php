<?php
$page_title = "Admin";
$page_h2 = "Welcome to your Admin!";
$body_class = "admin";
$log_status = "Login";
include ("../includes/connect.php");

session_start();
if (isset($_SESSION['asdjhvgjahfjierhvbdjfks-nina'])) {
    $log_status = "Logout";
} else {
    header("Location:login.php");
}



include ("../includes/header.php");
?>

<div>
    <ul>
        <li><a href="insert.php">Insert Courses</a></li>
        <li><a href="edit.php">Edit Courses</a></li>
        <li><a href="delete.php">Delete Courses</a></li>
    </ul>
</div>

<?php include ("../includes/footer.php");?>