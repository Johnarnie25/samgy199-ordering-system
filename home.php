<?php 
	session_start();
	require "admin/includes/functions.php";
	require "admin/includes/db.php";

	// Check if user is logged in
	if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
    
    }else{
        header("Location: index.php");
        exit();
    }

	$get_recent = $db->query("SELECT * FROM food LIMIT 9");
	
	$result = "";
	
	if ($get_recent->num_rows > 0) {
		while ($row = $get_recent->fetch_assoc()) {
			$food_id = htmlspecialchars($row['id']);
			$food_name = htmlspecialchars($row['food_name']);
			$food_description = htmlspecialchars(substr($row['food_description'], 0, 33));
			$food_price = number_format($row['food_price'], 2);
			
			$result .= "<div class='parallax_item'>
						<a href='detail.php?fid=$food_id'>
							<img src='image/FoodPics/$food_id.jpg' width='80px' height='80px' /> 
							<div class='detail'>
								<h4>$food_name</h4>
								<p class='desc'>$food_description...</p>
								<p class='price'>₱$food_price</p>
							</div>
							<p class='clear'></p>
						</a>
					</div>";
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Delicious food at SAMGYHAN 199" />
    <meta name="keywords" content="Food, Restaurant, SAMGYHAN 199, Menu" />
    <title>SAMGYHAN 199</title>
    <link rel="stylesheet" href="css/main.css" />
    <script src="js/jquery.min.js"></script>
    <script src="js/myscript.js"></script>
</head>
<body>
    <?php require "includes/header.php"; ?>
    
    <div class="parallax" onclick="remove_class()">
        <div class="parallax_head">
            <h2>Welcome</h2>
            <h3>We are Excited to Cook for You</h3>
        </div>
    </div>
    
    <div class="content" onclick="remove_class()">
        <a href="reservation.php" class="submit">BOOK A TABLE</a>
    </div>
    
    <div class="content remove_pad" onclick="remove_class()">
        <div class="inner_content on_parallax">
            <h2><span class="fresh">Discover Fresh Menu</span></h2>
            <div class="parallax_content">
                <?php echo $result; ?>
                <p class="clear"></p>
            </div>
        </div>
    </div>
    
    <div class="content" onclick="remove_class()">
        <div class="inner_content">
            <div class="contact">
                <div class="left">
                    <h3>LOCATION</h3>
                    <p>3rd floor V.P. Bldg. Brgy. H.Concepcion,</p>
                    <p>Maharlika Highway, Cabanatuan City, Philippines</p>
                </div>
                <div class="left">
                    <h3>CONTACT</h3>
                    <p>0962 825 0389</p>
                </div>
                <p class="left"></p>
                <div class="icon_holder">
                    <a href="https://www.facebook.com/profile.php?id=61553215352222"><img src="image/icons/Facebook.png" alt="Facebook" /></a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer_parallax" onclick="remove_class()">
        <div class="on_footer_parallax">
            <p>&copy; <?php echo date("Y"); ?> <span>SAMGYHAN 199</span>. All Rights Reserved</p>
        </div>
    </div>
</body>
</html>