<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Online Restaurant</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="container">
    <?php
        if (isset($_GET['orderSuccess']) && $_GET['orderSuccess'] == 1) {
            echo "<p class='success-message'>Order created successfully!</p>";
        }
        if (isset($_GET['orderSuccess']) && $_GET['orderSuccess'] == 2) {
          echo "<p class='success-message'>Order item removed successfully.</p>";
      }
      ?>
      <h1>Restoran Meni</h1>
      <ul id="menu-list">
        <?php include 'php/getMenuItems.php'; ?>
      </ul>
    </div>
    <br/>

    <div class="container"> 
    <h2>Korpa</h2>
      <ul id="cart-list">
        <li class="empty-cart">Your cart is empty.</li>
      </ul>

      <form id="order-form" method="post" action="php/postOrder.php">
        <input type="hidden" name="cartItems" id="cartItems" />
        <button type="submit" id="order-button">Order</button>
      </form>
    </div>
    <br/>
     
    <?php include 'php/getOrders.php'; ?>
    <script src="script.js"></script>
  </body>
</html>
