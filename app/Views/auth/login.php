<div class="container d-flex flex-column align-items-center justify-content-center vh-100">
  <div class="text-center">
    <i class="bi bi-shield-exclamation" style="font-size: 5rem;"></i>
    <h2 class="mt-3">NCT AUTO REPORT</h2>
    <h5>Login System</h5>
  </div>
  <form id="login-form" class="w-100 mt-4" style="max-width: 400px;">
    <input type="hidden" id="csrf_token" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" id="username" class="form-control" name="username" placeholder="Enter your username" autocomplete="off" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" id="password" class="form-control" name="password" placeholder="Enter your password" required>
    </div>
    <button type="submit" class="btn btn-dark w-100">Sign in</button>
  </form>
</div>

<script>
  document.getElementById('login-form').addEventListener('submit', async function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    try {
      const response = await fetch('/api/login', {
        method: 'POST',
        body: formData
      });

      const {
        status_code,
        message
      } = await response.json();

      if (status_code === 200) {
        Swal.fire({
          title: 'Success!',
          text: message,
          icon: 'success',
          confirmButtonText: 'OK'
        }).then(() => window.location.href = '/dashboard');
      } else {
        Swal.fire({
          title: 'Error!',
          text: message || 'Login failed',
          icon: 'error',
          confirmButtonText: 'OK'
        }).then(() => window.location.href = '/login');
      }
    } catch (error) {
      Swal.fire({
        title: 'Error!',
        text: error.message || 'An error occurred',
        icon: 'error',
        confirmButtonText: 'OK'
      }).then(() => window.location.href = '/login');
    }
  });
</script>