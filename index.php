<?php
$page_title = "Home";
$page_h2 = "Diagnostic Medical Sonography";
$body_class = "home";
$log_status = "Login";
include ("includes/connect.php");

session_start();
if (isset($_SESSION['asdjhvgjahfjierhvbdjfks-nina'])) {
    $log_status = "Logout";
}

?>

<?php include ("includes/header.php"); ?>

<div>
    <div>
        <p>Diagnostic Medical Sonographers are highly trained, in-demand professionals who use ultrasounds to produce and record images of important organs, masses and fetal images. This hands-on accredited program will allow you the opportunity to participate in clinical rotations in major Alberta hospitals. You’ll receive training on industry-standard equipment and get the opportunity to learn on the same technology you’ll use in your practicum placement – and career.</p>
    </div>
    <div>
        <h3>Credential: Diploma</h3>
        <p>Diplomas and Certificates are credit programs that take 1 or 2 years and lead to government approved and industry-recognized credentials.</p>
    </div>
    <div>
        <h3>Delivery Options:</h3>
        <p>Both On-Campus and Virtual - Some of your coursework will be in-person, on campus and some will be done online.</p>
    </div>
    <div>
        <h3>Length: 2.5 Years</h3>
        <p>With a typical full-time course load, this program will take 2.5 Years to complete.</p>
    </div>

    <div class="random-div">
        <?php
        $random = "SELECT * FROM lab4 ORDER BY RAND() LIMIT 1";
        $random_result = $conn->query($random);
        if ($random_result->num_rows > 0) {
            echo "<h3>Courses<h3>";
            while($random_row = $random_result->fetch_assoc()) {
                extract($random_row);
                echo "<h4>";
                echo "$course_code - $course_name";
                echo "</h4>";
                echo "<p>";
                echo "$course_desc";
                echo "</p>";
                echo "<a href=\"list.php?row_to_edit=$c_id\">View All Courses</a>";
            }
        }

        // $list_sql = "SELECT course_code, course_name, c_id FROM lab4 WHERE deletedYN = 'N'";
        // $list_result = $conn->query($list_sql);
        // if ($list_result->num_rows > 0) {
        //     echo "<ul>";
        //     while($list_row = $list_result->fetch_assoc()) {
        //         extract($list_row);
        //         echo "<li>";
        //         echo "<a href=\"admin/edit.php?row_to_edit=$c_id\">";
        //         echo "$course_code - $course_name";
        //         echo "</a>";
        //         echo "</li>";
        //     }
        //     echo "</ul>";
        // }
        ?>
    </div>
</div>

<?php include ("includes/footer.php"); ?>