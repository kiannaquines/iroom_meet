<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Logout</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to bottom right, #e0f7fa, #b2ebf2);
      text-align: center;
      min-height: 100vh;
    }
    .logo {
      margin-top: 20px;
      width: 300px;
    }
  </style>
</head>
<body>

  <div class="container py-4">

    <div class="text-center mb-4">
      <img src="Pictures/logo.png" alt="logo" class="logo" />
      <h6 class="mb-5 text-muted">where rooms and homes meet</h6>
    </div>
   
    <div class="mt-4">
      <h4 class="mb-3">Are you sure to</h4>
      <h1>LOG OUT?</h1>
    </div>

    <div class="mt-4">
       <a href="./backend/logout.php" class="btn btn-outline-success me-5">YES</a>
       <button type="button" onclick="back()" class="btn btn-outline-success">NO</>
    </div>
  </div>
  <script>
    function back() {
      window.history.back()
    }
  </script>
</body>
</html>
