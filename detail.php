<?php 
	session_start();
	require "admin/includes/functions.php";
	require "admin/includes/db.php";
	if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
    
    }else{
        header("Location: index.php");
        exit();
    }
	$name = "";
	$desc = "";
	$price = "";
	$id = "";
	
	if($_SERVER['REQUEST_METHOD'] == 'GET') {
		if(isset($_GET['fid']) && ctype_digit($_GET['fid'])) {
			$fid = intval($_GET['fid']);

			$get_detail = $db->query("SELECT * FROM food WHERE id='$fid' LIMIT 1");
			
			if($get_detail->num_rows) {
				$row = $get_detail->fetch_assoc();
				$id = $row['id'];
				$name = $row['food_name'];
				$desc = $row['food_description'];
				$price = number_format($row['food_price'], 2);
			} else {
				header("location: index.php");
				exit;
			}
		} else {
			header("location: index.php");
			exit;
		}
	} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(isset($_POST['submit'])) {
			$id = intval($_POST['fid']);
			$qty = intval($_POST['amount']);
			header("location: basket.php?fid=$id&qty=$qty");
			exit;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Delicious food at SAMGYHAN 199">
	<meta name="keywords" content="food, menu, SAMGYHAN 199, restaurant">
	<title>SAMGYHAN 199 - Food Details</title>

	<link rel="stylesheet" href="css/main.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/myscript.js"></script>
</head>
<body>
	
<?php require "includes/header.php"; ?>

<br/><br/><br/>

<div class="content remove_pad" onclick="remove_class()">
	<div class="inner_content on_parallax">
		<h2><span class="fresh">Food Description</span></h2>
		<div class="parallax_content">
			<div class="detail_holder">
				<div class="detail_img">
					<img src="image/FoodPics/<?php echo $id; ?>.jpg" width="100%" alt="Food Image">
				</div>
				<div class="detail_desc">
					<form method="post" action="detail.php">
						<h3 class="desc_header"><?php echo $name; ?></h3>
						<p class="desc_detail"><?php echo $desc; ?></p>
						<p><span class="bold_desc price">Price:</span> ₱<span id="price"><?php echo $price; ?></span></p>

						<div class="form_group">
							<p><span class="bold_desc">Quantity:</span></p>
							<p class="label_center">
								<label class="subtract" onclick="subtract_price();">-</label>
								<input readonly type="text" id="amount" name="amount" value="1">
								<label class="add" onclick="sum_price();">+</label>
							</p>
						</div>

						<p><span class="bold_desc">Total Price:</span> ₱<span id="total_price"><?php echo $price; ?></span></p>

						<div class="form_group">
							<input type="hidden" name="fid" value="<?php echo $id; ?>">
							<input type="submit" name="submit" class="submit add_order" value="Add to Order">
						</div>
					</form>
				</div>
				<p class="clear"></p>
			</div>
		</div>
	</div>
</div>

<div class="content" onclick="remove_class()">
	<div class="inner_content">
		<div class="contact">
			<div class="left">
				<h3>LOCATION</h3>
				<p>3rd floor V.P. Bldg. Brgy. H.Concepcion,</p>
				<p>Maharlika Highway, Cabanatuan City</p>
			</div>
			<div class="left">
				<h3>CONTACT</h3>
				<p>0962 825 0389</p>
			</div>
			<p class="left"></p>
			<div class="icon_holder">
				<a href="https://www.facebook.com/profile.php?id=61553215352222"><img src="image/icons/Facebook.png" alt="Facebook"></a>
			</div>
		</div>
	</div>
</div>

<div class="footer_parallax" onclick="remove_class()">
	<div class="on_footer_parallax">
		<p>&copy; <?php echo date("Y"); ?> <span>SAMGYHAN 199</span>. All Rights Reserved</p>
	</div>
</div>

<script>
	function sum_price() {
		let amount = parseInt($("#amount").val());
		let price = parseFloat($("#price").html().replace(",", ""));
		amount++;
		$("#amount").val(amount);
		let total_price = (price * amount).toFixed(2);
		$("#total_price").html(total_price);
	}
	
	function subtract_price() {
		let amount = parseInt($("#amount").val());
		let price = parseFloat($("#price").html().replace(",", ""));
		if (amount > 1) {
			amount--;
		}
		$("#amount").val(amount);
		let total_price = (price * amount).toFixed(2);
		$("#total_price").html(total_price);
	}
</script>

</body>
</html>
