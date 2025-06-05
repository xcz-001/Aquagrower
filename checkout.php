<!-- checkout.html -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/style.css" rel="stylesheet">
</head>
<?php include 'nav.php'; ?>
<body class="bg-light">

  <div class="container my-5">
    <div class="card shadow">
      <div class="card-header bg-success text-white">
        <h5 class="mb-0">Checkout</h5>
      </div>
      <div class="card-body">
        <div id="receiptContainer" class="mb-3">
          </div>
        </div>
        <hr>
        <div class="d-flex justify-content-end pe-3 mb-3">
          <strong>Total:</strong> ₱<span id="checkoutTotal">0.00</span>
        </div>
        <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#successModal" onclick="placeOrder()">Place Order</button>
      </div>
    </div>
  </div>
  <br>
  <button class="btn btn-success w-100" onclick="location.href='products.php'">Back to Products</button>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/checkout.js"></script>
</body>
</html>
