<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $conn = new mysqli('localhost', 'root', '', 'test');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $cartItems = json_decode($_POST['cartItems'], true);

    if (!empty($cartItems)) {
        // Insert into Order table
        $orderDate = date('Y-m-d H:i:s');
        $totalPrice = array_sum(array_column($cartItems, 'price'));
        $insertOrderSql = "INSERT INTO Order (orderDate, totalPrice) VALUES ('$orderDate', '$totalPrice')";
        
        if ($conn->query($insertOrderSql) === TRUE) {
            $orderId = $conn->insert_id;

            // Insert each item into OrderItem table
            foreach ($cartItems as $item) {
                $menuItemId = $item['id'];
                $quantity = $item['quantity'];
                $insertOrderItemSql = "INSERT INTO OrderItem (orderId, menuItemId, quantity) VALUES ('$orderId', '$menuItemId', '$quantity')";
                $conn->query($insertOrderItemSql);
            }

            // Redirect with success message
            header("Location: ../homepage.php?orderSuccess=1");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Cart is empty!";
    }

    $conn->close();
}
?>
