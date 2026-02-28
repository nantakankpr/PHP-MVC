document.getElementById('login-form').addEventListener('submit', async function(event) {
    event.preventDefault();
  
    const formData = new FormData(this);
  
    try {
      const response = await fetch('/api/login', {
        method: 'POST',
        body: formData
      });
  
      const { status_code, message } = await response.json();
  
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