<?php 
session_start();
include('dbcon.php');
include('header.php');

if (isset($_POST['Login'])) {

    $UserName = mysqli_real_escape_string($conn, $_POST['UserName']);
    $Password = mysqli_real_escape_string($conn, $_POST['Password']);
    
    // Note: Ideally, password should be hashed and verified with password_verify()
    $login_query = mysqli_query($conn, "SELECT * FROM users WHERE UserName='$UserName' AND Password='$Password'");
    
    if ($login_query && mysqli_num_rows($login_query) > 0) {
        $row = mysqli_fetch_assoc($login_query);
        $f = $row['FirstName'];
        $l = $row['LastName'];
        
        $_SESSION['id'] = $row['User_id'];
        $_SESSION['User_Type'] = $row['User_Type'];
        $type = $row['User_Type'];
        
        mysqli_query($conn, "INSERT INTO history (data, action, date, user) VALUES ('$f $l', 'Login', NOW(), '$type')")
            or die(mysqli_error($conn));
        
        header("Location: home.php");
        exit;
    } else {
        echo "<p style='color:red;'>Invalid username or password.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container" id="signIn">
        <div class="logo1-container">
            <div style="text-align: center; margin-bottom: 20px;">
                <img src="image/sam.png" alt="Logo" class="logo" style="width: 180px; height: 180px; margin: 0 auto; display: block;">
            </div>
        </div>
        <h1 class="form-title">Administrator</h1>

        <!-- Display Login Error Message -->
        <?php if (!empty($errors['login'])): ?>
            <div class="error-main">
                <p><?php echo $errors['login']; ?></p>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="username" id="username" placeholder="Username" required>
            </div>

            <div class="input-group password">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i id="eye" class="fa fa-eye" onclick="togglePassword()"></i>
            </div>

            <input type="submit" class="btn" value="Sign In">
        </form>
    </div>

    <script>
        function togglePassword() {
            let passwordField = document.getElementById("password");
            let eyeIcon = document.getElementById("eye");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>

</body>

</html>
