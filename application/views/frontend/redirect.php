<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Redirecting...</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      background: linear-gradient(135deg,rgb(79, 120, 254),rgb(0, 140, 254));
      color: #fff;
      font-family: Arial, sans-serif;
    }

    .container {
      text-align: center;
    }

    .logo img {
      max-width: 300px;
      margin-bottom: 40px;
      animation: fadeIn 1.5s ease-in-out;
    }

    h1 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    p {
      font-size: 16px;
    }

    .spinner-border {
      width: 3rem;
      height: 3rem;
      margin-top: 20px;
    }

    @keyframes fadeIn {
      0% {
        opacity: 0;
      }
      100% {
        opacity: 1;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo">
      <img src="<?= base_url('gambar/redirect.png') ?>" alt="Logo Banyuwangi">
    </div>
    <p>Redirecting you to the destination website.</p>
    <div class="spinner-border text-light" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>

  <script>
    // Ambil URL tujuan dari variabel PHP
    var redirectUrl = "<?= $redirect_url ?>"; // Variabel dari Controller
    // Redirect setelah 5 detik
    setTimeout(function() {
      window.location.href = redirectUrl;
    }, 5000);
  </script>
  <!-- Bootstrap JS (Optional if needed for other components) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
