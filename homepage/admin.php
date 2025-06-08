<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/style.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    img.thumb {
      width: 60px;
      height: 60px;
      object-fit: cover;
    }
  </style>
</head>
<body class="p-4">
<div class="container">
<div class="d-flex justify-content-between align-items-center mb-4">
  <h2 class="mb-0">Admin Dashboard</h2>
  <button class="btn btn-danger" onclick="logout()">Logout</button>
</div>

  <!-- PRODUCTS -->
  <hr>
  <h4>Add Product</h4>
  <form id="addProductForm" enctype="multipart/form-data">
    <div class="row g-2 mb-2">
      <div class="col"><input type="text" name="barcode" class="form-control" placeholder="Barcode" disabled></div>
      <div class="col"><input type="text" name="name" class="form-control" placeholder="Name" required></div>
      <div class="col"><input type="text" name="description" class="form-control" placeholder="Description" required></div>
    </div>
    <div class="row g-2 mb-2">
      <div class="col"><input type="number" min="0" name="qty" class="form-control" placeholder="Qty" required></div>
      <div class="col"><input type="number" step="0.01" name="price" class="form-control" placeholder="Price" required></div>
      <div class="col"><input type="file" name="image" class="form-control" accept="image/*" required></div>
    </div>
    <button type="submit" class="btn btn-success mb-3">Add Product</button>
  </form>

  <h5>All Products</h5>
  <table class="table table-bordered" id="productsTable">
    <thead><tr>
      <th>Image</th><th>Barcode</th><th>Name</th><th>Description</th><th>Qty</th><th>Price</th><th>Action</th>
    </tr></thead>
    <tbody></tbody>
  </table>

  <!-- UPDATE PRODUCT modal-->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Edit Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="editProductForm">
          <div class="row g-3">
            <!-- Column 1: Existing values -->
            <div class="col-md-6" id="existingValues"></div>

            <!-- Column 2: Input fields -->
            <div class="col-md-6">
              <input type="hidden" name="id" id="edit-id">
              <div><label>Barcode</label><input type="text" class="form-control" name="barcode" id="edit-barcode"></div>
              <div><label>Name</label><input type="text" class="form-control" name="name" id="edit-name"></div>
              <div><label>Description</label><input type="text" class="form-control" name="description" id="edit-description"></div>
              <div><label>Qty</label><input type="number" class="form-control" name="qty" id="edit-qty"></div>
              <div><label>Price</label><input type="number" step="0.01" class="form-control" name="price" id="edit-price"></div>
              <div><label>Image (optional)</label><input type="file" class="form-control" name="image" id="edit-image"></div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" onclick="saveProduct()">Save</button>
      </div>
    </div>
  </div>
</div>


  <!-- USERS -->
  <hr>
  <h4>Add User</h4>
  <form id="addUserForm">
    <div class="row g-2 mb-2">
      <div class="col"><input type="text" name="username" class="form-control" placeholder="Username" required></div>
      <div class="col"><input type="password" name="password" class="form-control" placeholder="Password" required></div>
      <div class="col">
        <select name="role" class="form-select" required>
          <option value="cashier">Cashier</option>
          <option value="admin">Admin</option>
        </select>
      </div>
    </div>
    <button type="submit" class="btn btn-primary mb-3">Add User</button>
  </form>

  <h5>All Users</h5>
  <table class="table table-bordered" id="usersTable">
    <thead><tr>
      <th>ID</th><th>Username</th><th>Role</th><th>Action</th>
    </tr></thead>
    <tbody></tbody>
  </table>

  <!-- SALES REPORT -->
  <hr>
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Sales Report</h4>
    <button class="btn btn-success" onclick="downloadPDF()">Download PDF</button>
  </div>
    <select id="view">
      <option value="today">Today</option>
      <option value="all">All</option>
    </select>

  <table class="table table-bordered" id="salesTable">
    <thead><tr>
      <th>ID</th><th>Product</th><th>Qty</th><th>Total</th><th>Date</th>
    </tr></thead>
    <tbody></tbody>
  </table>
</div>

<script src="../assets/js/admin.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</body>
</html>
