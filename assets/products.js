async function loadProducts() {
  const res = await fetch("api/products/index.php");
  const products = await res.json();
  const container = document.getElementById("products");

  container.innerHTML = "";

  products.forEach(p => {
    const card = document.createElement("div");
    card.className = "card";
    card.dataset.id = p.id; // Store product ID for later use
    card.innerHTML = `
      <img src="${p.filepath}" class="card-img-top" alt="${p.name}">
      <div class="card-body">
        <span class="card-headko d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">${p.name}</h5>
          <span class="card-price">₱${p.price}</span>
          </span>
          <p class="card-text">${p.description}</p>
          <p class="card-qty">Stock: ${p.quantity}</p>
      </div>
    `;

    const btn = document.createElement("button");
    btn.className = "btn btn-success mt-2";
    btn.textContent = "Add to Cart";
    card.querySelector(".card-body").appendChild(btn);
    container.appendChild(card);
  });
}

const CART_KEY = "cartItems";

  // Load cart from localStorage
  function getCart() {
    return JSON.parse(localStorage.getItem(CART_KEY)) || [];
  }

  function saveCart(cart) {
    localStorage.setItem(CART_KEY, JSON.stringify(cart));
  }

  function addToCart(product) {
  const cart = getCart();
  const existing = cart.find(item => item.id === product.id);

  if (existing) {
    if (existing.qty + 1 > existing.stock_qty) {
      alert("Not enough stock.");
      return;
    }
    existing.qty++;
  } else {
    if (product.stock_qty <= 0) {
      alert("Product is out of stock");
      return;
    }
    cart.push({ ...product, qty: 1 });
  }

  saveCart(cart);
  renderCart();
  showToast();
}


  function renderCart() {
    const cart = getCart();
    const body = document.querySelector("#cartModal .modal-body");
    body.innerHTML = "";

    if (cart.length === 0) {
      body.innerHTML = "<p class='text-center'>Cart is empty</p>";
      return;
    }

    cart.forEach((item, index) => {
      const row = document.createElement("div");
      row.className = "d-flex justify-content-between align-items-center mb-2";
      row.innerHTML = `
        <span>${item.name}</span>
        <div>
          <button class="btn btn-sm btn-outline-success" onclick="updateQty('${item.id}', -1)">-</button>
          <span class="mx-2">${item.qty}</span>
          <button class="btn btn-sm btn-outline-success" onclick="updateQty('${item.id}', 1)">+</button>
          <button class="btn btn-sm btn-danger" onclick="removeFromCart('${item.id}')">Remove</button>
        </div>
      `;
      body.appendChild(row);
    });
  }

  // function updateQty(id, delta) {
  //   const cart = getCart();
  //   const item = cart.find(i => i.id === id);
  //   if (!item) return;
  //   item.qty += delta;
  //   if (item.qty <= 0) {
  //     removeFromCart(id);
  //   } else {
  //     saveCart(cart);
  //     renderCart();
  //   }
  // }

  function updateQty(id, delta) {
  const cart = getCart();
  const item = cart.find(i => i.id === id);
  if (!item) return;

  const newQty = item.qty + delta;

  if (newQty <= 0) {
    removeFromCart(id);
  } else if (newQty > item.stock_qty) {
    alert("Not enough stock.");
  } else {
    item.qty = newQty;
    saveCart(cart);
    renderCart();
  }
}

  function removeFromCart(id) {
    let cart = getCart().filter(item => item.id !== id);
    saveCart(cart);
    renderCart();
  }

  // Attach handlers to dynamically rendered buttons
  document.addEventListener("click", e => {
    if (e.target.classList.contains("btn-success") && e.target.textContent === "Add to Cart") {
      const card = e.target.closest(".card");
      const product = {
        id: card.dataset.id,
        name: card.querySelector(".card-title").textContent.trim(),
        price: parseFloat(card.querySelector(".card-price").textContent.replace(/[^\d.]/g, "")),
        stock_qty: parseInt(card.querySelector(".card-qty").textContent.replace(/[^\d]/g, "")), //step 2: Add quantity to product object
      };
      addToCart(product);
    }
  });

function showToast() {
  const toast = new bootstrap.Toast(document.getElementById('cartToast'));
  toast.show();
}

document.addEventListener('DOMContentLoaded', () => {
  const toastEl = document.getElementById('cartToast');
  if (toastEl) {
    toastEl.addEventListener('shown.bs.toast', () => {
      setTimeout(() => bootstrap.Toast.getInstance(toastEl).hide(), 1500);
    });
  }
});

// Initial render
renderCart();
loadProducts();
