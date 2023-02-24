<?php 
include ("../includes/connect.php");
$page_title = "Edit Courses";
$body_class = "two-column edit";
$page_h2 = "Edit Courses";
$log_status = "Login";
$row_to_edit = $_GET['row_to_edit'];

session_start();
if (isset($_SESSION['asdjhvgjahfjierhvbdjfks-nina'])) {
    $log_status = "Logout";
} else {
    header("Location:login.php");
}

$message = "<div class=\"message\">";

if (isset($_POST['save'])) {
    extract($_POST);

    $is_form_valid = TRUE;

    if ($course_code == "") {
        $message .= "<p>Course Code is required.</p>";
        $is_form_valid = FALSE;
    } else {
        $course_code = filter_var($course_code, FILTER_SANITIZE_STRING);
        if ($course_code == FALSE) { 
            $message .= "<p>Please enter a Course Code with no HTML in it.</p>";
            $is_form_valid = FALSE;
            }
    }

    if ($course_name == "") {
        $message .= "<p>Course Name is required.</p>";
        $is_form_valid = FALSE;
    } else {
        $course_name = filter_var($course_name, FILTER_SANITIZE_STRING);
        if ($course_name == FALSE) { 
            $message .= "<p>Please enter a Course Name with no HTML in it.</p>";
            $is_form_valid = FALSE;
            }
    }

    if ($course_desc == "") {
        $message .= "<p>Course Description is required.</p>";
        $is_form_valid = FALSE;
    } else {
        $course_desc = filter_var($course_desc, FILTER_SANITIZE_STRING);
        if ($course_desc == FALSE) { 
            $message .= "<p>Please enter a Course Description with no HTML in it.</p>";
            $is_form_valid = FALSE;
            } else {
                if (strlen($course_desc) < 5) {
                    $message .= "<p>Please enter a longer description.</p>";
                    $is_form_valid = FALSE;
                }
            }
    } 

    if ($is_form_valid == TRUE) {
        $code = strtoupper($course_code);
        $name = ucwords($course_name);
        $desc = ucfirst($course_desc);

        if ($code && $name && $desc) {
            $update_sql = "UPDATE lab4 SET course_code = '$code', course_name = '$name', course_desc = '$desc' WHERE c_id = '$row_to_edit'";

            if ($conn->query($update_sql)) {
                $message = "Record updated successfully";
                $course_code = $course_desc = $course_name = "";
            } else {
                $message = "<p>There was a problem updating: $conn->error</p>";
            }
        } else {
            $message = "<p>All fields are required.</p>";
        }
    }



    
}
$message .= "</div>";

?>



<?php include ("../includes/header.php"); ?>


<!-- Step 1 - Get all the records that can be edited -->
<div>
    <h3>Select a Course to Edit</h3>
    <?php
    $list_sql = "SELECT course_code, course_name, c_id FROM lab4 WHERE deletedYN = 'N'";
    $list_result = $conn->query($list_sql);

    if ($list_result->num_rows > 0) {
        echo "<ul>";
        while($list_row = $list_result->fetch_assoc()) {
            extract($list_row);
            echo "<li>";
            echo "<a href=\"edit.php?row_to_edit=$c_id\">";
            echo "$course_code - $course_name";
            echo "</a>";
            echo "</li>";
        }
        echo "</ul>";
    }
    ?>
</div>
<div class="edit-fields">
    <?php if($row_to_edit):?>
    <?php
        $row_to_edit_sql = "SELECT course_code, course_desc, course_name FROM lab4 WHERE c_id = $row_to_edit";
        $row_to_edit_result = $conn->query($row_to_edit_sql);
        $row_to_edit_row =  $row_to_edit_result->fetch_assoc();
        extract($row_to_edit_row);
    ?>
    <?php echo $message;?>
    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'])?>" method="POST">
        <label for="course_code">Course Code:</label>
        <input type="text" id="course_code" name="course_code" value="<?php if($code) echo $code; else echo $course_code;?>"> 

        <label for="course_name">Course Name:</label>
        <input type="text" id="course_name" name="course_name" value="<?php if($name) echo $name; else echo $course_name;?>">

        <label for="course_desc">Course Description:</label>
        <textarea name="course_desc" id="course_desc"><?php if($desc) echo $desc;else echo $course_desc;?></textarea>

        <input type="submit" name="save" value="Save Changes">
    </form>
    <?php endif; ?>
</div>


<?php include ("../includes/footer.php"); ?>