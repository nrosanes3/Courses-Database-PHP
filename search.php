<?php
$page_title = "Search for Courses";
$body_class = "search";
$page_h2 = "Search for Courses";
$log_status = "Login";

session_start();
if (isset($_SESSION['asdjhvgjahfjierhvbdjfks-nina'])) {
    $log_status = "Logout";
}

$message = "<div class=\"message\">";

include ("includes/connect.php");
if (isset($_POST['search-btn'])){
    $search = trim($_POST['search']);
    $search = filter_var($search, FILTER_SANITIZE_STRING);
    if (strlen($search) < 3) {
        $message .= "<p>Please try a longer word.</p>";
    } else {
        $sql = "SELECT course_code, course_name, course_desc FROM lab4 WHERE (course_code LIKE '%$search%' OR course_name LIKE '%$search%' OR course_desc LIKE '%$search%') AND deletedYN = 'N'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                extract($row);
                $course_code = strtoupper($course_code);
                $course_name = ucwords($course_name);

                $output .= "<div>";
                $output .= "<h2>$course_name - $course_code</h2>"; 
                $output .= "<p>$course_desc</p>"; 
                $output .= "</div>";
            }
        } else {
            $message .= "<p>No records match your search. Try again.</p>";
        }
    }
}

$message .= "</div>";

include ("includes/header.php");
?>
        <?php echo $message;?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
            <label for="search">Search:</label>
            <input type="text" id="search" name="search" value="<?php echo $search;?>"> 
    
            <input type="submit" name="search-btn" value="Search">
        </form>
        <?php echo $output; ?>


<?php include ("includes/footer.php");?>