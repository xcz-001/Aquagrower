 // PRODUCTS
  async function loadProducts() {
    const res = await fetch("api/products/index.php");
    const data = await res.json();
    const tbody = document.querySelector("#productsTable tbody");
    tbody.innerHTML = "";
    data.forEach(p => {
      const tr = document.createElement("tr");
      tr.innerHTML = `
        <td><img src="${p.filepath}" class="thumb" /></td>
        <td>${p.barcode}</td>
        <td>${p.name}</td>
        <td>${p.description}</td>
        <td>${p.quantity}</td>
        <td>${p.price}</td>
        <td><button class="btn btn-danger btn-sm" onclick="deleteProduct(${p.id})">Delete</button></td>
      `;
      tbody.appendChild(tr);
    });
  }

    document.querySelector("#addProductForm").onsubmit = async (e) => {
      e.preventDefault();
      const formData = new FormData(e.target);
      console.log("Form data:", formData);
      // alert(formData)
      const res = await fetch("api/products/create.php", {
        method: "POST",
        body: formData
      });
      const result = await res.json();
      console.log(result); // to catch any error message
      if (result.success) {
        alert("Product added.");
        e.target.reset();
        loadProducts();
      } else alert(result.error || "Error");
    };

  async function deleteProduct(id) {
    if (!confirm("Delete product?")) return;
    const res = await fetch("api/products/delete.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ id })
    });
    const result = await res.json();
    console.log(result); // to catch any error message
    if (result.success) loadProducts();
    else alert("Delete failed");
  }

  // USERS
  async function loadUsers() {
    const res = await fetch("api/users/index.php");
    const data = await res.json();
    const tbody = document.querySelector("#usersTable tbody");
    tbody.innerHTML = "";
    data.forEach(u => {
      const tr = document.createElement("tr");
      tr.innerHTML = `
        <td>${u.id}</td>
        <td>${u.username}</td>
        <td>${u.role}</td>
        <td><button class="btn btn-danger btn-sm" onclick="deleteUser(${u.id})">Delete</button></td>
      `;
      tbody.appendChild(tr);
    });
  }

  document.querySelector("#addUserForm").onsubmit = async (e) => {
    e.preventDefault();
    const form = e.target;
    const data = new URLSearchParams(new FormData(form));
    const res = await fetch("api/users/create.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(Object.fromEntries(data.entries()))
    });
    const result = await res.json();
    if (result.success) {
      alert("User added.");
      form.reset();
      loadUsers();
    } else alert(result.error || "Error");
  };

async function deleteUser(id) {
  if (!confirm("Delete user?")) return;
  const res = await fetch("api/users/delete.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id })
  });
  const result = await res.json();
  console.log(result); // to catch any error message
  if (result.success) loadUsers();
  else alert("Delete failed");
}

  // SALES
  async function loadSales() {
    const res = await fetch("api/sales/index.php");
    const data = await res.json();
    console.log(data);
    const tbody = document.querySelector("#salesTable tbody");
    tbody.innerHTML = "";
    data.forEach(s => {
      const tr = document.createElement("tr");
      tr.innerHTML = `
        <td>${s.id}</td>
        <td>${s.product}</td>
        <td>${s.qty}</td>
        <td>${s.total}</td>
        <td>${s.date}</td>
      `;
      tbody.appendChild(tr);
    });
  }


async function logout() {
  const res = await fetch("api/logout.php", {
    method: "POST",
    credentials: "include"
  });

  if (res.ok) {
    localStorage.removeItem("cartItems");// Clear cart on logout
    alert("You have been logged out successfully.");
    window.location.href = "index.html"; // Redirect after logout
  } else {
    alert("Logout failed");
  }
}

  // INIT
  loadProducts();
  loadUsers();
  loadSales();