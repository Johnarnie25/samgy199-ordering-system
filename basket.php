<?php 
session_start();
require "admin/includes/functions.php";
require "admin/includes/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user']['id'];
error_reporting(0);

// Section 1: Add Item to Cart
if (isset($_GET['fid']) && isset($_GET['qty'])) {
    $fid = (int) $_GET['fid'];
    $qty = (int) $_GET['qty'] ?? 1;

    $sql = $db->query("SELECT * FROM user_cart WHERE user_id='$user_id' AND food_id='$fid' LIMIT 1");
    if ($sql->num_rows > 0) {
        $db->query("UPDATE user_cart SET quantity = quantity + $qty WHERE user_id='$user_id' AND food_id='$fid'");
    } else {
        $db->query("INSERT INTO user_cart (user_id, food_id, quantity) VALUES ('$user_id', '$fid', '$qty')");
    }

    header("location: basket.php");
    exit();
}

// Section 2: Empty Cart
if (isset($_GET['cmd']) && $_GET['cmd'] == "emptycart") {
    $db->query("DELETE FROM user_cart WHERE user_id='$user_id'");
}

// Section 3: Remove Item from Cart
if (isset($_POST['index_to_remove']) && $_POST['index_to_remove'] !== "") {
    $item_id = (int) $_POST['index_to_remove'];
    $db->query("DELETE FROM user_cart WHERE user_id='$user_id' AND food_id='$item_id'");
}

// Section 4: Render the Cart
$cartOutput = "";
$cartTotal = 0;
$product_id_array = "";

$sql = $db->query("SELECT uc.food_id, uc.quantity, f.food_name, f.food_price FROM user_cart AS uc
                   JOIN food AS f ON uc.food_id = f.id
                   WHERE uc.user_id='$user_id'");

if ($sql->num_rows == 0) {
    $cartOutput = "<h3 style='text-align: center; font-weight: lighter; padding: 10px 0px; background: #ffeeee; color: #333;'>Your shopping basket is empty</h3>";
} else {
    $cartOutput = "<div class='single_order_head'>
                        <h3>Food</h3>
                        <h3>Price (₱)</h3>
                        <h3>Qty</h3>
                        <h3>Total</h3>
                        <h3>Remove</h3>
                    </div>";

    while ($row = $sql->fetch_assoc()) {
        $foodName = htmlspecialchars($row['food_name']);
        $price = (float) $row['food_price'];
        $quantity = (int) $row['quantity'];
        $pricetotal = $price * $quantity;
        $cartTotal += $pricetotal;

        $product_id_array .= "$foodName-$quantity, ";

        $cartOutput .= '<form action="basket.php" method="post">
            <div class="single_order">
                <p>' . $foodName . '</p>
                <p>₱' . number_format($price, 2) . '</p>
                <p>
                    <select name="quantity" id="'.$row['food_id'].'" onChange="update_qty(\''.$row['food_id'].'\', \''.$cartTotal.'\', \''.$pricetotal.'\')"> 
                        '.render_options($quantity, $row['food_id']).'
                    </select>
                </p>
                <p id="ajax_qty_'.$row['food_id'].'">₱' . number_format($pricetotal, 2) . '</p>
                <p>
                    <input name="deleteBtn' . $row['food_id'] . '" class="remove" onclick="return verify_choice();" type="submit" value="x" />
                    <input name="index_to_remove" type="hidden" value="' . $row['food_id'] . '" />
                </p>
            </div>
        </form>';
    }

    $cartTotalFormatted = number_format($cartTotal, 2);
    $cartTotal = '<p class="p_total"><span>Basket Total</span>: <span id="cart-total">₱' . $cartTotalFormatted . '</span></p>';
    $empty_cart = '<div class="empty_cart"><a href="basket.php?cmd=emptycart">Empty Basket</a></div>';
    $chkbtn = '<div class="checkout"><a href="#" onclick="show_overlay(); return false">Checkout</a></div>';
    $chkfood = '<input type="hidden" id="chkfood" name="chkfood" value="'.$product_id_array.'" />';
    $chkprice = '<input type="hidden" id="chkprice" name="chkprice" value="'.$cartTotalFormatted.'" />';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SAMGYHAN 199 - BASKET</title>
    <link rel="stylesheet" href="css/main.css" />
    <script src="js/jquery.min.js"></script>
    <script src="js/myscript.js"></script>
</head>
<body>
<?php require "includes/header.php"; ?>

<div class="parallax_basket" onclick="remove_class()">
    <div class="parallax_head_basket">
        <h2></h2>
        <h3></h3>
    </div>
</div>

<div class="content remove_pad" onclick="remove_class()">
    <div class="inner_content on_parallax">
        <h2><span class="cart">Food Basket</span></h2>
        <div class="order_holder">
            <?php echo $cartOutput; ?>
        </div>
        <?php echo $cartTotal; ?>
        <div class="checkout_section">
            <?php echo $empty_cart; ?>
            <?php echo $chkbtn; ?>
        </div>
    </div>
</div>

<div class="overlay" id="overlay" onclick="hide_overlay()"></div>
<div class="info_holder">
    <p class="close_p"><span class="close_sp" onclick="hide_overlay()"></span></p>
    <h2><span class="tag">Complete Your Order</span></h2>
    <form method="post" action="" onSubmit="validate_input(); return false">
        <div class="form_group">
            <label>Name</label>
            <input type="text" id="name" name="name" required>
            <label>Address</label>
            <input type="text" id="addr" name="addr" required>
            <label>Email</label>
            <input type="email" id="email" name="email" required>
            <label>Phone Number</label>
            <input type="text" id="phone" name="phone" required>
            <?php echo $chkfood; ?>
            <?php echo $chkprice; ?>
            <input type="submit" class="submit" value="PLACE ORDER" />
        </div>
    </form>
</div>

<div class="footer_parallax" onclick="remove_class()">
    <div class="on_footer_parallax">
        <p>&copy; <?php echo date("Y"); ?> <span>SAMGYHAN 199</span> . All Rights Reserved</p>
    </div>
</div>
</body>
</html>
