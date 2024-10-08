<?php
$conn = new mysqli('localhost', 'root', '', 'test');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select all items from MenuItem table
$sql = "SELECT id, name, description, price FROM MenuItem";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // za svaku stavku u meniju vrati list item (<li>)s informacijama
    while($row = $result->fetch_assoc()) {
        echo "<li class='menu-item' data-id='{$row['id']}'>";
        echo "<span class='item-name'>{$row['name']} - {$row['price']} KM</span>";
        echo "<button class='add-to-cart'>+</button>";
        echo "</li>";
    }
} else {
    echo "Meni je prazan.";
}

$conn->close();
?>
