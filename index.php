<?php
session_start();

// Initialize errors array to prevent undefined index errors
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register & Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <div class="container" id="signIn">
  <div class="logo1-container">
  <div style="text-align: center; margin-bottom: px;">
    <img src="image/sam.png" alt="Logo" class="logo" style="width: 180px; height: 180px; padding: px; margin: 0 auto; display: block;">
</div>


    </div>
    <h1 class="form-title">Sign In</h1>

    <!-- Display Login Error Message -->
    <?php if (!empty($errors['login'])): ?>
      <div class="error-main">
        <p><?php echo $errors['login']; ?></p>
      </div>
    <?php endif; ?>

    <form method="POST" action="user-account.php">
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="email" id="email" placeholder="Email" required>

        <!-- Display Email Error -->
        <?php if (!empty($errors['email'])): ?>
          <div class="error">
            <p><?php echo $errors['email']; ?></p>
          </div>
        <?php endif; ?>
      </div>

      <div class="input-group password">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <i id="eye" class="fa fa-eye" onclick="togglePassword()"></i>

        <!-- Display Password Error -->
        <?php if (!empty($errors['password'])): ?>
          <div class="error">
            <p><?php echo $errors['password']; ?></p>
          </div>
        <?php endif; ?>
      </div>

      <p class="recover">
      <a href="#" style="color: #d31431; font-weight: bold;">Recover Password</a>

      </p>

      <input type="submit" class="btn" value="Sign In" name="signin">
    </form>

    <p class="or">
      ----------or--------
    </p>

    <div class="icons">
      <i class="fab fa-google"></i>
      <i class="fab fa-facebook"></i>
    </div>

    <div class="links">
      <p>Don't have an account yet?</p>
      <a href="register.php" style="color: #d31431; font-weight: bold;">Sign Up</a>
    </div>
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

<?php
// Unset session errors after displaying them
unset($_SESSION['errors']);
?>
