 // PRODUCTS
  async function loadProducts() {
    const res = await fetch("http://localhost/AquaGrower/api/products/index.php");
    const data = await res.json();
    const tbody = document.querySelector("#productsTable tbody");
    tbody.innerHTML = "";
    data.forEach(p => {
      const tr = document.createElement("tr");
      tr.innerHTML = `
        <td><img src="../${p.filepath}" class="thumb" /></td>
        <td>${p.barcode}</td>
        <td>${p.name}</td>
        <td>${p.description}</td>
        <td>${p.quantity}</td>
        <td>${p.price}</td>
        <td>
        <button class="btn btn-danger btn-sm" onclick="deleteProduct(${p.id})">Delete</button>
        <button class="btn btn-primary btn-sm" id="editProductBtn-${p.id}" onclick="editProduct(${p.id})">Edit</button>
        </td>
      `;
      tbody.appendChild(tr);
    });
  }

    document.querySelector("#addProductForm").onsubmit = async (e) => {
      e.preventDefault();
      const formData = new FormData(e.target);
      console.log("Form data:", formData);
      // alert(formData)
      const res = await fetch("http://localhost/AquaGrower/api/products/create.php", {
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
    const res = await fetch("http://localhost/AquaGrower/api/products/delete.php", {
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
    const res = await fetch("http://localhost/AquaGrower/api/users/index.php");
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
    const res = await fetch("http://localhost/AquaGrower/api/users/create.php", {
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
  const res = await fetch("http://localhost/AquaGrower/api/users/delete.php", {
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
//New sales loader function
async function loadSales() {
  const view = document.getElementById("view").value;
  const res = await fetch(`http://localhost/AquaGrower/api/sales/index.php?view=${view}`);
  const data = await res.json();
  console.log(res.status);
  console.log("fetched data:", data);
  const tbody = document.querySelector("#salesTable tbody");
  tbody.innerHTML = "";

  data.forEach((sale, index) => {
    sale.items.forEach((item, i) => {
      const tr = document.createElement("tr");

      if (i === 0) {
        tr.innerHTML = `
          <td rowspan="${sale.items.length}">${sale.user_id}</td>
          <td>${item.product}</td>
          <td>${item.qty}</td>
          <td rowspan="${sale.items.length}">₱${sale.total.toFixed(2)}</td>
          <td rowspan="${sale.items.length}">${sale.created_at}</td>
        `;
      } else {
        tr.innerHTML = `
          <td>${item.product}</td>
          <td>${item.qty}</td>
        `;
      }

      tbody.appendChild(tr);
    });
  });
}



async function logout() {
  const res = await fetch("http://localhost/AquaGrower/api/logout.php", {
    method: "POST",
    credentials: "include"
  });

  if (res.ok) {
    localStorage.removeItem("cartItems");// Clear cart on logout
    alert("You have been logged out successfully.");
    window.location.href = "../index.html"; // Redirect after logout
  } else {
    alert("Logout failed");
  }
}

function editProduct(id) {
  const row = document.querySelector(`#editProductBtn-${id}`).closest("tr");
  const tds = row.querySelectorAll("td");

  const existing = `
    <div><strong>Barcode:</strong> ${tds[1].textContent}</div>
    <div><strong>Name:</strong> ${tds[2].textContent}</div>
    <div><strong>Description:</strong> ${tds[3].textContent}</div>
    <div><strong>Qty:</strong> ${tds[4].textContent}</div>
    <div><strong>Price:</strong> ${tds[5].textContent}</div>
    `;

    new bootstrap.Modal(document.getElementById("editProductModal")).show();
  document.getElementById("existingValues").innerHTML = existing;
  document.getElementById("edit-id").value = id;
  document.getElementById("edit-barcode").value = tds[1].textContent;
  document.getElementById("edit-name").value = tds[2].textContent;
  document.getElementById("edit-description").value = tds[3].textContent;
  document.getElementById("edit-qty").value = tds[4].textContent;
  document.getElementById("edit-price").value = tds[5].textContent;

}

function saveProduct() {
  const form = document.getElementById("editProductForm");
  const formData = new FormData(form);
  // console.log("Form sent to API:", formData);
  fetch("http://localhost/AquaGrower/api/products/update.php", {
    method: "POST",
    body: formData,
  })
  .then(res => res.json())
  .then(data => {
    // console.log("API response:",data);
    if (data.success) {
      alert("Product updated!");
      bootstrap.Modal.getInstance(document.getElementById("editProductModal")).hide();
      loadProducts();
    } else {
      alert("Failed to update product.");
    }
  })
  .catch(err => {
    console.log(err);
    alert("Error updating product.");
  });
}
async function downloadPDF() {
  const { jsPDF } = window.jspdf;
  const table = document.getElementById("salesTable");

  // Optional: Adjust scale for better quality
  const canvas = await html2canvas(table, { scale: 2 });
  const imgData = canvas.toDataURL("image/png");

  const pdf = new jsPDF("p", "mm", "a4");
  const pageWidth = pdf.internal.pageSize.getWidth();
  const pageHeight = pdf.internal.pageSize.getHeight();
  const imgProps = pdf.getImageProperties(imgData);
  const pdfWidth = pageWidth;
  const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

  pdf.addImage(imgData, "PNG", 0, 10, pdfWidth, pdfHeight);
  pdf.save("sales_report.pdf");
}


  // INIT
  loadProducts();
  loadUsers();
  document.getElementById("view").addEventListener("change", loadSales);
  window.addEventListener("DOMContentLoaded", loadSales);