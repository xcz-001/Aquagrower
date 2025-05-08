  <!-- Navbar -->
  <?php require 'modals.php'; ?>
  <nav class="navbar navbar-expand-lg bg-green px-4 text-white">
  <a class="navbar-brand position-absolute start-50 translate-middle-x text-white" href="index.php">AquaGrower</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto text-white">

        <?php if (isset($_SESSION['user'])): ?>
          <li class="nav-item"><Profile class="nav-link text-white" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">Profile</a></li>
        <?php else: ?>
          <button class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
        <?php endif; ?>

        <li class="nav-item"><a class="nav-link text-white" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="products.php">Products</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="about.php">About Us</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="contact.php">Contact Us</a></li>
      </ul>
      <button class="btn btn-light me-2" data-bs-toggle="modal" data-bs-target="#cartModal">🛒</button>
    </div>
  </nav>
