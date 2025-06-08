
function placeOrder() {
  const cart = getCart();

  console.log("Placing order with cart:", cart);
  fetch("http://localhost/AquaGrower/api/checkout.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ cart: getCart() }),
    credentials: "include"
  })
  .then(res => res.json())
  .then(data => {
    console.log("status:", data.status);
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
  printReceipt();
  const total = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
  document.getElementById("checkoutTotal").textContent = total.toFixed(2);
}
const CART_KEY = "cartItems";

  // Load cart from localStorage
  function getCart() {
    return JSON.parse(localStorage.getItem(CART_KEY)) || [];
  }

updateCheckoutTotal();


function printReceipt() {

  const cart = JSON.parse(localStorage.getItem("cartItems")) || [];
  const container = document.getElementById("receiptContainer");
  container.innerHTML = "";

  if (cart.length === 0) {
    container.innerHTML = "<p class='text-center'>Cart is empty</p>";
    return;
  }

  const grid = document.createElement("div");
  grid.style.display = "grid";
  grid.style.gridTemplateColumns = "1fr 100px 80px 100px";
  grid.style.gap = "10px";
  grid.classList.add("mb-3");

  // Header row
  ["Product", "Price", "Qty", "Subtotal"].forEach(text => {
    const cell = document.createElement("div");
    cell.innerHTML = `<strong>${text}</strong>`;
    grid.appendChild(cell);
  });

  let total = 0;
  cart.forEach(item => {
    const subtotal = item.price * item.qty;
    total += subtotal;

    grid.innerHTML += `
      <div>${item.name}</div>
      <div>₱${item.price.toFixed(2)}</div>
      <div>${item.qty}</div>
      <div>₱${subtotal.toFixed(2)}</div>
    `;
  });

  container.appendChild(grid);
  document.getElementById("checkoutTotal").textContent = total.toFixed(2);
}


        // const checkoutModalEl = document.getElementById('checkoutModal');
      // const checkoutModal = bootstrap.Modal.getInstance(checkoutModalEl);
      // document.activeElement.blur();
      // checkoutModal.hide();

      // // Show the success modal via JS
      // const successModal = new bootstrap.Modal(document.getElementById('successModal'));
      // document.activeElement.blur();
      // successModal.show();
