<?php

session_start();
include './backend/conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adviser Profile Edit</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    body {

      background: linear-gradient(to bottom right, #e0f7fa, #b2ebf2);
      min-height: 100vh;
    }

    .card-section {
      background-color: white;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 20px;
    }

    .btn-save {
      background-color: #b4f7b2;
      color: #000;
      font-weight: bold;
      border: none;
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 30px;
    }

    .btn-save:hover {
      background-color: #1ea004;
      color: #fff;
    }
  </style>
</head>

<body>

  <body class="container py-2">
    <div class="d-flex align-items-center my-3">
      <a href="AdviserDashboard.php" class="text-decoration-none text-dark me-3">
        <i class="bi bi-arrow-left" style="font-size: 1.5rem;"></i>
      </a>
    </div>
    <div class="container py-4">

      <div class="text-center mb-3">
        <img src="Pictures/person_icon.png" alt="person_icon" class="mb-2 person_icon" />
      </div>
      <?php
      $adviser_id = $_SESSION['id'] ?? null;

      if (!$adviser_id) {
        echo "<div class='alert alert-danger'>Adviser ID not found in session.</div>";
        exit;
      }

      $query = mysqli_query($conn, "SELECT * FROM adviser WHERE id = '$adviser_id'");
      $adviserData = mysqli_fetch_assoc($query);
      ?>
      <form action="./backend/logic/profile_update.php" method="POST" class="card-section">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($adviser_id); ?>">
        <label class="form-label">Name:</label>
        <input type="text" class="form-control" name="name" placeholder="Edit name" value="<?php echo htmlspecialchars($adviserData['name']); ?>">

        <label class="form-label">School ID:</label>
        <input type="text" class="form-control" name="school_id" placeholder="Edit School ID" value="<?php echo htmlspecialchars($adviserData['school_id']); ?>">

        <label class="form-label">Section:</label>
        <input type="text" class="form-control" name="section" placeholder="Edit Section" value="<?php echo htmlspecialchars($adviserData['section']); ?>">

        <label class="form-label">Email:</label>
        <input type="email" class="form-control" name="email" placeholder="Edit email" value="<?php echo htmlspecialchars($adviserData['email']); ?>">


        <label class="form-label">Contact No.:</label>
        <input type="text" class="form-control" name="contact_no" placeholder="Edit contact number" value="<?php echo htmlspecialchars($adviserData['contact_no']); ?>">

        <button type="submit" class="btn btn-save">Save Changes</button>
      </form>
    </div>
  </body>

</html>