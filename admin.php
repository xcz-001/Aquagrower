<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
  <h2 class="mb-4">Admin Dashboard</h2>

  <!-- PRODUCTS -->
  <hr>
  <h4>Add Product</h4>
  <form id="addProductForm" enctype="multipart/form-data">
    <div class="row g-2 mb-2">
      <div class="col"><input type="text" name="barcode" class="form-control" placeholder="Barcode" required></div>
      <div class="col"><input type="text" name="name" class="form-control" placeholder="Name" required></div>
      <div class="col"><input type="text" name="description" class="form-control" placeholder="Description" required></div>
    </div>
    <div class="row g-2 mb-2">
      <div class="col"><input type="number" name="qty" class="form-control" placeholder="Qty" required></div>
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
    <button class="btn btn-primary mb-3">Add User</button>
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
  <h4>Sales Report</h4>
  <table class="table table-bordered" id="salesTable">
    <thead><tr>
      <th>ID</th><th>Product</th><th>Qty</th><th>Total</th><th>Date</th>
    </tr></thead>
    <tbody></tbody>
  </table>
</div>

<script src="assets/admin.js"></script>
</body>
</html>
