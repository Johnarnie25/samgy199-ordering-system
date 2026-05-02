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

// Fetch user-specific reservations
$per_page = 20;
$count = $db->query("SELECT * FROM reservation WHERE user_id='$user_id'");
$pages = ceil((mysqli_num_rows($count)) / $per_page);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_page;

$reserve = $db->query("SELECT * FROM reservation WHERE user_id='$user_id' LIMIT $start, $per_page");

$result = "";
if ($reserve->num_rows) {
    $result = "<table class='table table-hover'>
                <thead>
                    <th>S/N</th>
                    <th>No of Guests</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Table No.</th>
                    <th>Status</th>
                </thead>
                <tbody>";

    $x = $start + 1;
    while ($row = $reserve->fetch_assoc()) {
        // Trim and lowercase the status to avoid comparison issues
        $status = trim(strtolower($row['status']));

        // Determine the status color based on the reservation status
        if ($status === 'pending') {
            $statusColor = 'red';
        } elseif ($status === 'confirmed') {
            $statusColor = 'green';
        } else {
            $statusColor = 'black'; // Default color for unknown statuses
        }

        $result .= "<tr>
                        <td>$x</td>
                        <td>{$row['no_of_guest']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['date_res']}</td>
                        <td>{$row['time']}</td>
                        <td>{$row['table_no']}</td>
                        <td style='color: $statusColor; font-weight: bold;'>{$row['status']}</td>
                    </tr>";
        $x++;
    }

    $result .= "</tbody>
                </table>";
} else {
    $result = "<p style='color:red; padding: 10px; background: #ffeeee;'>No reservations available.</p>";
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Reservations</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<style>
    .container2 {
    max-width: 900px;
    margin: 200px auto;
    padding: 20px;
    background: #FFFBF4;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.9);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

p {
    text-align: center;
    font-size: 16px;
 
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.table th, .table td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: center;
}

.table th {
    background-color: #d31431;
    color: white;
}

.table tbody tr:hover {
    background-color: #f1f1f1;
}

.pagination {
    text-align: center;
    margin-top: 15px;
}

.pagination a {
    display: inline-block;
    padding: 8px 12px;
    margin: 10px 4px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.pagination a:hover {
    background-color: #000;
}

.pagination a.active {
    background-color: #d31431;
    color: white;
}
/* Responsive Design */
@media screen and (max-width: 768px) {
    .container2 {
        margin: 50px auto;
        padding: 15px;
    }

    h2 {
        font-size: 20px;
    }

    p {
        font-size: 14px;
    }

    .table th, .table td {
        padding: 8px;
        font-size: 14px;
    }

    .pagination a {
        padding: 6px 10px;
        margin: 5px 2px;
        font-size: 14px;
    }
}

@media screen and (max-width: 480px) {
    h2 {
        font-size: 18px;
    }

    p {
        font-size: 12px;
    }

    .table th, .table td {
        padding: 6px;
        font-size: 12px;
    }

    .pagination a {
        padding: 5px 8px;
        margin: 4px 1px;
        font-size: 12px;
    }
}
    </style>
<body>
    <?php require "includes/header.php"; ?>
    <section>
    <div class="container2">
        <h2>Your Reservations</h2>
        <?php if (isset($_GET['success'])): ?>
            <p style="color: green;">Reservation made successfully!</p>
        <?php endif; ?>
        <?php echo $result; ?>
    </div>
    <div class="pagination">
        <?php for($i = 1; $i <= $pages; $i++): ?>
            <a href="?page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>
    </div>
    </div>
       </section>



    <div class="footer_parallax" onclick="remove_class()">
        <div class="on_footer_parallax">
            <p>&copy; <?php echo date("Y"); ?> <span>SAMGYHAN 199</span>. All Rights Reserved</p>
        </div>
    </div>
  
</body>
</html>

