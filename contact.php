<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - Aqua Grower</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/style.css" rel="stylesheet">
</head>
<body>

<?php require 'nav.php'; ?>

  <section class="p-5">
    <h2 class="text-center">Contact Us</h2>
    <form class="w-50 mx-auto">
      <input type="text" class="form-control mb-2" placeholder="Name">
      <input type="email" class="form-control mb-2" placeholder="Email">
      <textarea class="form-control mb-2" rows="4" placeholder="Message"></textarea>
      <button class="btn w-100 btn-success">Send</button>
    </form>
  </section>
  <script src="modals.php"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
