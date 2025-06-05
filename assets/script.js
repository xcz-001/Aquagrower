document.addEventListener('DOMContentLoaded', () => {
  const loginForm = document.getElementById('loginForm');
  if (loginForm) {
    loginForm.addEventListener('submit', async function (e) {
      e.preventDefault();

      const formData = new FormData(this);
      const data = Object.fromEntries(formData.entries());
      console.log('Data sent to the server:', data);

      try {
        const res = await fetch('http://localhost/AquaGrower/api/login.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(data)
        });

        const result = await res.json();
        console.log(res.status);
        if (res.ok) {
          if (result.user.role === 'admin') {
            window.location.href = 'admin.php';
          } else if (result.user.role === 'cashier') {
            window.location.href = 'home.php';
          }
        } else {
          alert(result.error || 'Login failed');
        }
      } catch (err) {
        console.error('Error:', err);
        alert('Something went wrong.');
      }
    });
  }

  // ✅ Signup form validate
  const signupForm = document.getElementById('signupForm');
  if (signupForm) {
    signupForm.addEventListener('submit', async function (e) {
      e.preventDefault();

      let p1 = document.getElementById("signuppassword");
      let p2 = document.getElementById("signuppassword2");

      if (p1.value !== p2.value) {
        alert("The passwords don't match");
        return;
      }

      const formData = new FormData(this);
      const data = Object.fromEntries(formData.entries());
      console.log('Trying to contact the server...');
      console.log('Data sent to the server:', data);

      try {
        const res = await fetch('http://localhost/AquaGrower/api/users/create.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(data)
        });

      const result = await res.json();

      if (res.status === 200) {
        alert('User created successfully');
      } else if (res.status === 409) {
        alert(result.error || 'Username already exists');
      } else if (res.status === 400) {
        alert(result.error || 'Missing required fields');
      } else {
        alert(result.error || 'An error occurred');
        // console.error('Error:', err);
      }
      } catch (err) {
        alert('Something went wrong. Please try again later.');
        console.error('Error:', err);
      }
    });
  }
});

async function logout() {
  const res = await fetch("api/logout.php", {
    method: "POST",
    credentials: "include"
  });

  if (res.ok) {
    localStorage.removeItem("cartItems");// Clear cart on logout
    alert("You have been logged out successfully.");
    window.location.href = "index.html"; // Redirect after logout
  } else {
    alert("Logout failed");
  }
}
