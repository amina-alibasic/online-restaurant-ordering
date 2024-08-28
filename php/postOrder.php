<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $conn = new mysqli('localhost', 'root', '', 'test');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $cartItems = json_decode($_POST['cartItems'], true);

    if (!empty($cartItems)) {
        // Insert into Order table
        $datumNarudzbe = date('Y-m-d H:i:s');
        $ukupnaCijena = array_sum(array_column($cartItems, 'price'));
        $insertOrderSql = "INSERT INTO Narudzba (datumNarudzbe, ukupnaCijena) VALUES ('$datumNarudzbe', '$ukupnaCijena')";
        
        if ($conn->query($insertOrderSql) === TRUE) {
            $orderId = $conn->insert_id;

            // Insert each item into OrderItem table
            foreach ($cartItems as $item) {
                $meniStavkaId = $item['id'];
                $kolicina = $item['quantity'];
                $insertOrderItemSql = "INSERT INTO StavkaNarudzbe (idNarudzbe, meniStavkaId, kolicina) VALUES ('$orderId', '$meniStavkaId', '$kolicina')";
                $conn->query($insertOrderItemSql);
            }

            // Redirect with success message
            header("Location: ../homepage.php?orderSuccess=1");
            exit();
        } else {
            echo "Greska: " . $conn->error;
        }
    } else {
        echo "Korpa je prazna!";
    }

    $conn->close();
}
?>
