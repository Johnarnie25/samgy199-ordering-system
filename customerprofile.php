<?php 
session_start();
require "admin/includes/functions.php";
require "admin/includes/db.php";

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user']['id'];
error_reporting(0);

// Fetch user data from the database using the user ID
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

// Update profile if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $phone_number = trim($_POST['phone_number']);
    $password = trim($_POST['password']);

    // Check if required fields are filled
    if (!empty($name) && !empty($email) && !empty($address) && !empty($phone_number)) {
        if (!empty($password)) {
            // Hash the new password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $updateQuery = "UPDATE users SET name = ?, email = ?, address = ?, phone_number = ?, password = ? WHERE id = ?";
            $stmt = $db->prepare($updateQuery);
            $stmt->bind_param("sssssi", $name, $email, $address, $phone_number, $hashed_password, $user_id);
        } else {
            // Update without changing the password
            $updateQuery = "UPDATE users SET name = ?, email = ?, address = ?, phone_number = ? WHERE id = ?";
            $stmt = $db->prepare($updateQuery);
            $stmt->bind_param("ssssi", $name, $email, $address, $phone_number, $user_id);
        }

        // Execute the update query and provide feedback
        if ($stmt->execute()) {
            $message = "Profile updated successfully.";
            // Refresh the user data after the update
            $stmt = $db->prepare($query);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $userData = $result->fetch_assoc();
            // Update the session data as well
            $_SESSION['user'] = $userData;
        } else {
            $message = "Error updating profile: " . $stmt->error;
        }
    } else {
        $message = "Please fill in all the required fields.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Explore the gallery of SAMGYHAN 199">
    <meta name="keywords" content="Gallery, SAMGYHAN 199, Food, Restaurant">
    <title>SAMGYHAN 199 - GALLERY</title>
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/lightbox.min.css">

    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/myscript.js"></script>
</head>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.profile-container {
    width: 90%; /* Default for smaller screens */
    max-width: 500px; /* Restrict max width on larger screens */
    margin: 150px auto;
    background-color: #FFFBF4;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.8);
}

.profile-container h2 {
    text-align: center;
    margin-bottom: 20px;
}

.profile-container label {
    display: block;
    margin: 10px 0 5px;
}

.profile-container input[type="text"],
.profile-container input[type="email"],
.profile-container input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

.profile-container button,
.logout-btn {
    width: 100%;
    padding: 12px;
    background-color: #d31431;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-align: center;
    text-decoration: none;
    display: inline-block;
}

.profile-container button:hover,
.logout-btn:hover {
    background-color: #000;
}

.message {
    text-align: center;
    margin-bottom: 15px;
    color: green;
    font-weight: bold;
}

.button-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.button-container button,
.button-container .logout-btn {
    flex: 1; /* Allow buttons to grow and fill the space */
    min-width: 45%; /* Prevent buttons from becoming too narrow */
}

/* Media Query for Tablets */
@media (min-width: 600px) {
    .profile-container {
        width: 70%;
    }
}

/* Media Query for Desktops */
@media (min-width: 900px) {
    .profile-container {
        width: 40%;
    }

    .button-container {
        justify-content: space-between;
    }

    .button-container button,
    .button-container .logout-btn {
        width: 48%; /* Make them sit side by side with spacing */
    }
}


</style>
<body>
    <!-- Header -->
    <?php require "includes/header.php"; ?>

   <section>
   <div class="profile-container">
    <h2>User Profile</h2>
    <?php if (isset($message)) echo "<p class='message'>$message</p>"; ?>
    <form method="POST" action="customerprofile.php">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($userData['name']); ?>" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required><br>

        <label>Address:</label>
        <input type="text" name="address" value="<?php echo htmlspecialchars($userData['address']); ?>" required><br>

        <label>Phone Number:</label>
        <input type="text" name="phone_number" value="<?php echo htmlspecialchars($userData['phone_number']); ?>" required><br>

        <label>Password (leave blank to keep unchanged):</label>
        <input type="password" name="password" placeholder="Enter new password"><br>

        <div class="button-container">
            <button type="submit">Update Profile</button>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </form>
</div>




</section>
    
    <!-- Footer -->
    <div class="footer_parallax" onclick="remove_class()">
        <div class="on_footer_parallax">
            <p>&copy; <?php echo date("Y"); ?> <span>SAMGYHAN 199</span>. All Rights Reserved</p>
        </div>
    </div>

    <!-- Lightbox Script -->
    <script src="js/lightbox.min.js"></script>
</body>

</html>
