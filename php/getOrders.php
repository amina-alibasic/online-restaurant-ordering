<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'test');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch previous orders
$ordersSql = "SELECT * FROM Narudzba ORDER BY id DESC";
$listaNarudzbi = $conn->query($ordersSql);

if ($listaNarudzbi->num_rows > 0) {
    echo "<div class='container'>";
    echo "<h2>Vase Narudzbe</h2>";
    echo "<ul id='orders-list'>";

    while($orderRow = $listaNarudzbi->fetch_assoc()) {
        $orderId = $orderRow['id'];

        // Fetch order items
        $orderItemsSql = "SELECT sn.id, ms.ime, sn.kolicina FROM StavkaNarudzbe sn JOIN meniStavka ms ON sn.meniStavkaId = ms.id WHERE sn.idNarudzbe = $orderId";
        $listaStavkiNarudzbe = $conn->query($orderItemsSql);
        if ($listaStavkiNarudzbe->num_rows > 0) {
            echo "<li class='order-item'>";
            echo "<strong>Narudzba #$orderId</strong>";
            echo "<ul class='order-items-list'>";
            while ($orderItemRow = $listaStavkiNarudzbe->fetch_assoc()) {
                $idStavke = $orderItemRow['id'];
                $imeStavke = $orderItemRow['ime'];
                $kolicinaStavke = $orderItemRow['kolicina'];
                echo "<li class='order-item' data-order-item-id='$idStavke'>";
                echo "$imeStavke (x$kolicinaStavke) <button class='remove-item'>&#x2212;</button>";
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
