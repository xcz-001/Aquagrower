<!DOCTYPE php>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products - Aqua Grower</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/style.css" rel="stylesheet">
</head>
<body >

<?php require 'nav.php'; ?>

<!-- cart toast -->
  <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
  <div id="cartToast" class="toast align-items-center text-bg-success border-0" role="alert">
    <div class="d-flex">
      <div class="toast-body">
        Item added to cart!
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>

  <section class="p-5 products">
    <h2 class="text-center mb-4">Our Products</h2>
    <div id="products" class="products-container"></div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/products.js"></script>

</body>
</html>
