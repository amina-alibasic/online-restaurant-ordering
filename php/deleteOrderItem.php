<?php
if (isset($_GET['orderItemId'])) {
    $conn = new mysqli('localhost', 'root', '', 'test');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $orderItemId = $conn->real_escape_string($_GET['orderItemId']);
    $deleteSql = "DELETE FROM StavkaNarudzbe WHERE id = $orderItemId";

    if ($conn->query($deleteSql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }

    $conn->close();
}
?>
