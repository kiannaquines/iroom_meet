<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adviser Login</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #b2f7ef, #8fd3f4);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: Arial, sans-serif;
    }
    .login-container {
      text-align: center;
      padding: 120px;
      border-radius: 15px;
    }
    .logo {
      width: 250px;
      margin-bottom: 100px;
    }
    .btn-login {
      background-color: #73f37a;
      color: #000;
      font-weight: bold;
      border: none;
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 30px;
    }

    .btn-login:hover {
      background-color: #1ea004;
      color: #fff;
    }
        .btn-custom {
      background-color: #e9f179;
      color: #000;
      font-weight: bold;
      border: none;
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 30px;
    }

    .btn-custom:hover {
      background-color: #ebe715;
      color: #fff;
    }
    .divider {
      display: flex;
      align-items: center;
      text-align: center;
      margin: 20px 0;
    }
    .divider::before, .divider::after {
      content: '';
      flex: 1;
      border-bottom: 1px solid #ccc;
    }
    .divider:not(:empty)::before {
      margin-right: .5em;
    }
    .divider:not(:empty)::after {
      margin-left: .5em;
    }
    .form-control {
      border-radius: 10px;
    }
    .input-group-text {
      background: none;
      border: none;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <!-- Logo -->
    <img src="Pictures/logo.png" alt="Logo" class="mb-1 logo">

    <!-- Welcome -->
    <h4 class="fw-bold mb-4">WELCOME PARENTS!</h4>

    <form action="./backend/logic/parent_login.php" method="POST">
    <div class="mb-3 text-start">
      <input type="text" class="form-control" name="username" placeholder="Username">
    </div>

    <div class="mb-3 text-start input-group">
      <input type="password" id="password" class="form-control" name="password" placeholder="Password">
    </div>

    <!-- Login Button -->
    <button type="submit" class="btn btn-outline-success btn-login">Log In</button>
    </form>
    <!-- Divider -->
    <div class="divider">or</div>

    <!-- Create Account Button -->
    <a href="CreateAccountParent.php" class="btn btn-outline-warning btn-custom">Create Account</a>
  </div>

</body>
</html>
