<?php
   
$page_title = "Insert Courses";
$page_h2 = "Insert Courses";
$body_class = "insert";
$log_status = "Login";
include ("../includes/connect.php");

session_start();
if (isset($_SESSION['asdjhvgjahfjierhvbdjfks-nina'])) {
    $log_status = "Logout";
} else {
    header("Location:login.php");
}

$message = "<div class=\"message\">";

if (isset($_POST['register'])) {
    extract($_POST);
    // echo "$username $course_name $course_desc";
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
        if ($course_code && $course_name && $course_desc) {
            $course_code = strtoupper($course_code);
            $course_name = ucwords($course_name);
            $course_desc = ucfirst($course_desc);

            $sql = "INSERT INTO `lab4` (course_code, course_name, course_desc, deletedYN) VALUES ('$course_code', '$course_name', '$course_desc', 'N')";
            echo $sql;

            if ($conn->query($sql)) {
                $message .= "Record inserted successfully";
                $course_code = $course_desc = $course_name = "";
            } else {
                $message .= "There was a problem inserting: $conn->error";
            }            
        }
    }
        
}
$message .= "</div>";

include ("../includes/header.php");

?>

<?php echo $message;?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
    <div>
        <label for="course_code">Course Code:</label>
        <input type="text" id="course_code" name="course_code" value="<?php echo $course_code;?>">
    </div> 

    <div>
        <label for="course_name">Course Name:</label>
        <input type="text" id="course_name" name="course_name" value="<?php echo $course_name;?>">
    </div>

    <label for="course_desc">Course Description:</label>
    <textarea name="course_desc" id="course_desc"><?php echo $course_desc;?></textarea>

    <input type="submit" name="register" value="Register Course">
</form>


<?php include ("../includes/footer.php"); ?>