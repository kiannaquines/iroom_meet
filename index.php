<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Screen</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #b2f7ef, #8fd3f4);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: Arial, sans-serif;
    }
    .login-container {
      text-align: center;
      padding: 100px;
      border-radius: 15px;
    }
    .logo {
      width: 280px;
      margin-bottom: 100px;
    }
    .btn-custom {
      background-color: #73f37a;
      color: #000;
      font-weight: bold;
      border: none;
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 30px;
    }
  </style>
</head>

<body>
  <div class="login-container">

    <img src="Pictures/logo.png" alt="Logo" class="mb-2 logo">
    
    <p class="mb-5 text-muted small">where rooms and homes meet</p>
    
    <h3 class="mb-5 fw-bold">WELCOME!</h3>

    <p class="mb-2">Log In as:</p>

    <a href="LoginAdviser.php" class="btn btn-outline-success btn-custom">ADVISER</a>
    <a href="LoginParent.php" class="btn btn-outline-success btn-custom">PARENT</a>
    
  </div>
</body>
</html>
