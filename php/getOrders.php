<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'test');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch previous orders
$ordersSql = "SELECT * FROM Order ORDER BY id DESC";
$orderList = $conn->query($ordersSql);

if ($orderList->num_rows > 0) {
    echo "<div class='container'>";
    echo "<h2>Your Orders</h2>";
    echo "<ul id='orders-list'>";

    while($orderRow = $orderList->fetch_assoc()) {
        $orderId = $orderRow['id'];

        // Fetch order items
        $orderItemsSql = "SELECT oi.id, mi.name, oi.quantity FROM OrderItem oi JOIN MenuItem mi ON oi.menuItemId = mi.id WHERE oi.orderId = $orderId";
        $OrderItemList = $conn->query($orderItemsSql);
        if ($OrderItemList->num_rows > 0) {
            echo "<li class='order-item'>";
            echo "<strong>Order #$orderId</strong>";
            echo "<ul class='order-items-list'>";
            while ($orderItemRow = $OrderItemList->fetch_assoc()) {
                $idStavke = $orderItemRow['id'];
                $itemName = $orderItemRow['name'];
                $itemQuantity = $orderItemRow['quantity'];
                echo "<li class='order-item' data-order-item-id='$idStavke'>";
                echo "$itemName (x$itemQuantity) <button class='remove-item'>&#x2212;</button>";
                echo "</li>";
            }
            echo "</ul>";
            echo "<br/>";
        }

        echo "</li>";
    }
    echo "</ul>";
    echo "</div>";
}

$conn->close();
?>
