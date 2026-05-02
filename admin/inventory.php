<?php 

session_start();
require "includes/db.php";
require "includes/functions.php";

if (!isset($_SESSION['user'])) {
    header("location: logout.php");
}

// Handle stock reset
if (isset($_GET['reset'])) {
    $foodId = intval($_GET['reset']);
    $query = "UPDATE food SET stock = 0 WHERE id = $foodId";
    mysqli_query($db, $query);
    header("location: inventory.php");
}

// Handle adding stock
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_stock'])) {
    $foodName = mysqli_real_escape_string($db, $_POST['food_name']);
    $quantity = intval($_POST['quantity']);
    $query = "UPDATE food SET stock = stock + $quantity WHERE food_name = '$foodName'";
    mysqli_query($db, $query);
    header("location: inventory.php");
}

// Fetch all food items
$query = "SELECT id, food_name, stock FROM food";
$result = mysqli_query($db, $query);
?>


<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>ADMIN - INVENTORY</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	
	<!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
	
	<link href="assets/css/style.css" rel="stylesheet" />
	
</head>
<style>
    
        .stock-green { background-color: #d4edda; }
        .stock-yellow { background-color: #fff3cd; }
        .stock-skyblue { background-color: #d1ecf1; }
        .stock-red { background-color: #f8d7da; }
    </style>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="#000" data-image="assets/img/sidebar-5.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    	<?php require "includes/side_wrapper.php"; ?>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed" style="background: #d31431;">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar" style="background: #fff;"></span>
                        <span class="icon-bar" style="background: #fff;"></span>
                        <span class="icon-bar" style="background: #fff;"></span>
                    </button>
                    <a class="navbar-brand" href="#" style="color: #fff;">INVENTORY MANAGEMENT</a>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="logout.php" style="color: #fff;">
                                Log out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

<section>
<div class="container">
    <h2 class="text-center">Inventory Management</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Food Name</th>
                <th>Stocks</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { 
                $stockClass = '';
                if ($row['stock'] > 100) $stockClass = 'stock-green';
                elseif ($row['stock'] >= 50) $stockClass = 'stock-yellow';
                elseif ($row['stock'] >= 40) $stockClass = 'stock-skyblue';
                else $stockClass = 'stock-red';
            ?>
                <tr>
                    <td><?php echo $row['food_name']; ?></td>
                    <td class="<?php echo $stockClass; ?>"><?php echo $row['stock']; ?></td>
                    <td>
                        <a href="inventory.php?reset=<?php echo $row['id']; ?>" class="btn btn-danger">Reset to Zero</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h3>Add Stock</h3>
    <form method="POST">
        <div class="form-group">
            <label>Food Name</label>
            <select name="food_name" class="form-control" required>
                <?php
                $foodQuery = "SELECT food_name FROM food";
                $foodResult = mysqli_query($db, $foodQuery);
                while ($foodRow = mysqli_fetch_assoc($foodResult)) {
                    echo "<option value='" . $foodRow['food_name'] . "'>" . $foodRow['food_name'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>
        <button type="submit" name="add_stock" class="btn btn-success">Add Stock</button>
    </form>
</div>
</section>


        <footer class="footer">
            <div class="container-fluid">
                
                <p class="copyright pull-right">
                &copy; <span style="color: #FFFBF4;">2025</span> <a href="index.php" style="color: #FFFBF4;">SAMGYHAN 199</a>

                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

</html>