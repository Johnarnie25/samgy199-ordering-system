<?php

session_start();
require "includes/db.php";
require "includes/functions.php";

if (!isset($_SESSION['user'])) {
    header("location: logout.php");
}

// Fetch sales data from the database
$total_sales = [];
$sales_dates = [];
$grand_total = [
    'confirmed' => 0,
    'pending' => 0,
];

// Query to fetch total confirmed sales
$query_confirmed = "SELECT SUM(total) AS total_amount, DATE(date_made) AS sale_date
                    FROM basket 
                    WHERE status = 'confirmed'
                    GROUP BY sale_date
                    ORDER BY sale_date ASC";
$result_confirmed = mysqli_query($db, $query_confirmed);

while ($row = mysqli_fetch_assoc($result_confirmed)) {
    $sale_date = $row['sale_date'];
    $total_amount = (float)$row['total_amount'];

    // Add the confirmed amount to the sales data
    $total_sales['confirmed'][$sale_date] = $total_amount;
    $grand_total['confirmed'] += $total_amount;
    $sales_dates[] = $sale_date;
}

// Query to fetch total pending sales
$query_pending = "SELECT SUM(total) AS total_amount, DATE(date_made) AS sale_date
                  FROM basket 
                  WHERE status = 'pending'
                  GROUP BY sale_date
                  ORDER BY sale_date ASC";
$result_pending = mysqli_query($db, $query_pending);

while ($row = mysqli_fetch_assoc($result_pending)) {
    $sale_date = $row['sale_date'];
    $total_amount = (float)$row['total_amount'];

    // Add the pending amount to the sales data
    $total_sales['pending'][$sale_date] = $total_amount;
    $grand_total['pending'] += $total_amount;
    $sales_dates[] = $sale_date;
}

// Remove duplicate dates
$sales_dates = array_unique($sales_dates);
sort($sales_dates); // Sort the dates in ascending order





?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>ADMIN - ANALYTICS</title>

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
                    <a class="navbar-brand" href="#" style="color: #fff;">ANALYTICS</a>
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
<div class="container mt-5">
    <h2 class="text-center">Sales Analytics</h2>
    <canvas id="salesChart"></canvas>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
const salesDates = <?php echo json_encode(array_values($sales_dates)); ?>;
const salesData = <?php echo json_encode($total_sales); ?>;
const grandTotal = <?php echo json_encode($grand_total); ?>;

const ctx = document.getElementById('salesChart').getContext('2d');
const salesChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: salesDates,
        datasets: Object.keys(salesData).map((status, index) => ({
            label: `${status} (Total: ₱ ${grandTotal[status].toLocaleString()})`,
            data: salesDates.map(date => salesData[status][date] || 0),  // Ensure data consistency for each date
            backgroundColor: `hsl(${index * 60}, 70%, 50%)`,
            borderColor: `hsl(${index * 60}, 70%, 50%)`,
            borderWidth: 1
        }))
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Total Sales by Date and Status'
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return `₱ ${Number(context.raw).toLocaleString()}`;
                    }
                }
            }
        },
        scales: {
            y: {
                title: {
                    display: true,
                    text: 'Total Sales (PHP)'
                },
                ticks: {
                    callback: function(value) {
                        return '₱ ' + value.toLocaleString();
                    }
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Date'
                }
            }
        }
    }
});
</script>


</html>