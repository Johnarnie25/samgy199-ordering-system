<?php
session_start();
require "includes/functions.php";
require "includes/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'])) {
    $order_id = escape($_POST['order_id']);

    // Delete from items table first to maintain referential integrity
    $delete_items = $db->prepare("DELETE FROM items WHERE order_id=?");
    $delete_items->bind_param('i', $order_id);
    $delete_items->execute();

    // Delete from basket table
    $delete_order = $db->prepare("DELETE FROM basket WHERE id=?");
    $delete_order->bind_param('i', $order_id);

    if ($delete_order->execute()) {
        echo "Order deleted successfully.";
    } else {
        echo "Failed to delete the order.";
    }
} else {
    echo "Invalid request.";
}
?>
