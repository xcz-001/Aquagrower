  <!-- Navbar -->
  <?php include 'modals.php'; ?>
  <nav class="navbar navbar-expand-lg bg-green px-4 text-white">
  <a class="navbar-brand position-absolute start-50 translate-middle-x text-white" href="../homepage/index.php">AquaGrower</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto text-white">

          <li class="nav-item"><Profile class="nav-link text-white" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">Profile</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="../homepage/home.php">Home</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="../homepage/products.php">Products</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="../homepage/about.php">About Us</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="../homepage/contact.php">Contact Us</a></li>
      </ul>
      <button class="btn btn-light me-2" data-bs-toggle="modal" data-bs-target="#cartModal">🛒</button>
      <button class="btn btn-danger me-2" onclick="logout()">Logout</button>
    </div>
  </nav>
  <script src="../assets/js/script.js"></script>
