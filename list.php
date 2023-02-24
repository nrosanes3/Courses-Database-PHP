<?php
$page_title = "List of Courses";
$page_h2 = "Diagnostic Medical Sonography Courses";
$body_class = "list";
include ("includes/connect.php");
$log_status = "Login";

session_start();
if (isset($_SESSION['asdjhvgjahfjierhvbdjfks-nina'])) {
    $log_status = "Logout";
}
?>

<?php include ("includes/header.php"); ?>

<?php
    $list_sql = "SELECT course_code, course_name, course_desc, c_id FROM lab4 WHERE deletedYN = 'N'";
    $list_result = $conn->query($list_sql);

    if ($list_result->num_rows > 0) {
        echo "<ul>";
        while($list_row = $list_result->fetch_assoc()) {
            extract($list_row);
            echo "<li>";
            echo "<a href=\"admin/edit.php?row_to_edit=$c_id\">";
            echo "<h3>$course_code - $course_name</h3>"; 
            echo "<p>$course_desc</p>"; 
            echo "</a>";
            echo "</li>";
        }
        echo "</ul>";
    }
?>

<?php include ("includes/footer.php"); ?>