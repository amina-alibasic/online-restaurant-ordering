document.addEventListener('DOMContentLoaded', function () {
  const cartList = document.getElementById('cart-list');
  const menuItems = document.querySelectorAll('.add-to-cart');
  const cartItems = [];

  menuItems.forEach((item) => {
    item.addEventListener('click', function () {
      const itemElement = this.parentElement;
      const itemName = itemElement.querySelector('.item-name').textContent;
      const itemId = itemElement.getAttribute('data-id');
      const itemPrice = parseFloat(itemName.split('- $')[1]);

      // Check if the cart is empty
      if (cartList.querySelector('.empty-cart')) {
        cartList.innerHTML = '';
      }

      // Add item to cart array
      const cartItem = {
        id: itemId,
        name: itemName,
        price: itemPrice,
        quantity: 1,
      };
      cartItems.push(cartItem);

      // Add item to the cart list visually
      const cartListItem = document.createElement('li');
      cartListItem.textContent = itemName;
      cartList.appendChild(cartListItem);
    });
  });

  // Handle order submission
  document
    .getElementById('order-form')
    .addEventListener('submit', function (event) {
      if (cartItems.length === 0) {
        event.preventDefault();
        alert('Your cart is empty!');
      } else {
        document.getElementById('cartItems').value = JSON.stringify(cartItems);
      }
    });

  document.querySelectorAll('.remove-item').forEach((button) => {
    button.addEventListener('click', function () {
      const orderItemId = this.parentElement.getAttribute('data-order-item-id');

      fetch(`php/deleteOrderItem.php?orderItemId=${orderItemId}`, {
        method: 'GET',
      })
        .then((response) => response.text())
        .then((data) => {
          if (data === 'success') {
            this.parentElement.remove();
          } else {
            alert('Error deleting order item');
          }
        });
    });
  });
});
