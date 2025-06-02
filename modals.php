<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-white  bg-green">
        <h5 class="modal-title">Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p><strong>Name:</strong> John Doe</p>
        <p><strong>Username:</strong> johndoe123</p>
        <p><strong>Email:</strong> john@example.com</p>
        <p><strong>Phone:</strong> 123-456-7890</p>
        <p><strong>Address:</strong> 123 Greenhouse St, Eco City</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editInfoModal">Edit Info</button>
      </div>
    </div>
  </div>
</div>


<!-- Cart Modal -->
<div class="modal fade" id="cartModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-white  bg-green">
        <h5 class="modal-title">Your Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="d-flex justify-content-between align-items-center">
          <!-- <span>Lettuce</span>
          <div>
            <button class="btn btn-sm btn-outline-success">-</button>
            <span>1</span>
            <button class="btn btn-sm btn-outline-success">+</button>
            <button class="btn btn-sm btn-danger">Remove</button>
          </div> -->
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#checkoutModal">Checkout</button>
      </div>
    </div>
  </div>
</div>


<!-- Edit Info Modal -->
<div class="modal fade" id="editInfoModal" tabindex="-1" aria-labelledby="editInfoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editInfoModalLabel">Edit Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control mb-2" name="username" placeholder="Username" value="johndoe123" required>
        <input type="password" class="form-control mb-2" name="password" placeholder="New Password (leave blank to keep current)">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
    </form>
  </div>
</div>

<!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-white  bg-success">
        <h5 class="modal-title">Checkout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form>
          <input type="text" class="form-control mb-2" placeholder="Full Name" required>
          <input type="text" class="form-control mb-2" placeholder="Shipping Address" required>
          <input type="text" class="form-control mb-2" placeholder="Phone Number" required>
          <input type="email" class="form-control mb-2" placeholder="Email" required>
          <button type="button" class="btn btn-success w-100" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#successModal">Place Order</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-header text-white  bg-success">
        <h5 class="modal-title w-100">Order Successful</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Thank you for your purchase! Your order has been placed successfully.</p>
        <button class="btn btn-success" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>