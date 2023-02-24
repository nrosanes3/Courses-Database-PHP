<?php
include ("../includes/connect.php");
$page_title = "Login";
$body_class = "login";
$page_h2 = "Login to Admin";
$log_status = "Login";



include("/home/nrosanes3/data/data.php");

session_start();
$message = "<div class=\"message\">";
if (isset($_SESSION['asdjhvgjahfjierhvbdjfks-nina'])) {
    $log_status = "Logout";
    if ($log_status = "Logout") {
        session_start();
        unset($_SESSION["asdjhvgjahfjierhvbdjfks-nina"]);
        unset($_SESSION["username"]);
        header('Location: login.php');
    }
} else {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($username == $valid_user && password_verify($password, $encrypted_pass)) {

            session_start();
            $_SESSION['asdjhvgjahfjierhvbdjfks-nina'] = session_id();
            $_SESSION['username'] = $username;

            header('Location: admin.php');
            

        } else {
            $message .= "Invalid login. Please try again.";
        }

    }
}
$message .= "</div>";

?>

<?php include ("../includes/header.php"); ?>
<?php echo $message;?>
<form action="" method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username">
    <label for="password">Password:</label>
    <input type="password" id="password" name="password">
    <input type="submit" value="Login" name="login">
</form>

<?php include ("../includes/footer.php"); ?>