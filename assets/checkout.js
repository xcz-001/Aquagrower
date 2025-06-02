
function placeOrder() {
  const cart = getCart();

  console.log("Placing order with cart:", cart);
  fetch("api/checkout.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ cart: getCart() }),
    credentials: "include"
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      localStorage.removeItem("cartItems");

    } else {
      console.error(data.error);
    }
  })
  .catch(err => console.error("Checkout error:", err));
}

function updateCheckoutTotal() {
  const cart = getCart();
  const total = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
  document.getElementById("checkoutTotal").textContent = total.toFixed(2);
}
const CART_KEY = "cartItems";

  // Load cart from localStorage
  function getCart() {
    return JSON.parse(localStorage.getItem(CART_KEY)) || [];
  }

updateCheckoutTotal();


        // const checkoutModalEl = document.getElementById('checkoutModal');
      // const checkoutModal = bootstrap.Modal.getInstance(checkoutModalEl);
      // document.activeElement.blur();
      // checkoutModal.hide();

      // // Show the success modal via JS
      // const successModal = new bootstrap.Modal(document.getElementById('successModal'));
      // document.activeElement.blur();
      // successModal.show();
