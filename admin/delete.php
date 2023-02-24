<?php 
$page_title = "Delete Courses";
$page_h2 = "Delete Courses";
$body_class = "delete";
$log_status = "Login";
include ("../includes/connect.php");

session_start();
if (isset($_SESSION['asdjhvgjahfjierhvbdjfks-nina'])) {
    $log_status = "Logout";
} else {
    header("Location:login.php");
}

$row_to_edit = $_GET['row_to_edit'];

if ($row_to_edit && is_numeric($row_to_edit)) {
    $update_sql = "UPDATE lab4 SET deletedYN = 'Y' WHERE c_id = $row_to_edit";
    if ($conn->query($update_sql)){
        $message = "<p>Record deleted.</p>";
    } else {
        $message = "<p>There was a problem deleting that course: $conn->error</p>";
    }
}

?>

<?php include ("../includes/header.php"); ?>


<div>
    <h3>Select a Course to Delete</h3>
    <?php
    echo $message;
    $list_sql = "SELECT course_code, course_name, c_id FROM lab4 WHERE deletedYN = 'N'";
    $list_result = $conn->query($list_sql);

    if ($list_result->num_rows > 0) {
        echo "<ul>";
        while($list_row = $list_result->fetch_assoc()) {
            extract($list_row);
            echo "<li>";
            echo "<a href=\"delete.php?row_to_edit=$c_id\">";
            echo "$course_code - $course_name";
            echo "</a>";
            echo "</li>";
        }
        echo "</ul>";
    }
    ?>
</div>

<?php include ("../includes/footer.php"); ?>