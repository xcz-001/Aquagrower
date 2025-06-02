<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-white  bg-green">
        <h5 class="modal-title">Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p><strong>Name:</strong>Cyril Joshua Mariano</p>
        <p><strong>Username:</strong>xcz_01</p>
        <p><strong>Email:</strong> marianojoshuacyril65@gmail.com</p>
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
        <button type="button" class="btn btn-success" onclick="location.href='checkout.php'">Checkout</button>
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
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>