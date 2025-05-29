<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Adviser Account</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #b2f7ef, #8fd3f4);
      min-height: 100vh;
      font-family: Arial, sans-serif;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .profile-container {
      padding: 30px 20px;
      border-radius: 15px;
      width: 100%;
      max-width: 420px;
      text-align: center;
    }
    .person_icon {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 10px;
      padding: 5px;

    }
    .form-label {
      font-weight: bold;
      text-align: left;
      display: block;
      margin-top: 10px;
    }
    .form-control {
      border-radius: 10px;
      margin-bottom: 5px;
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
      transition: background 0.2s, color 0.2s;
    }
    .btn-save:hover {
      background-color: #1ea004;
      color: #fff;
    }
    @media (max-width: 500px) {
      .profile-container {
        padding: 18px 5px;
        max-width: 98vw;
      }
      .person_icon {
        width: 70px;
        height: 70px;
      }
    }
  </style>
</head>
<body>
  <div class="profile-container">
    <!-- Profile Image -->
    <img src="Pictures/person_icon.png" alt="person_icon" class="person_icon">

    <!-- Role -->
    <h5 class="fw-bold">ADVISER</h5>

    <!-- Form -->
    <form action="./backend/logic/adviser_create.php" method="POST">
      <label class="form-label">Name:</label>
      <input type="text" class="form-control" name="name" placeholder="Enter name">

      <label class="form-label">School ID:</label>
      <input type="text" class="form-control" name="school_id" placeholder="Enter school ID">

      <label class="form-label">Section:</label>
      <input type="text" class="form-control" name="section" placeholder="Enter section">

      <label class="form-label">Email:</label>
      <input type="email" class="form-control" name="email" placeholder="Enter email">

      <label class="form-label">Contact No.:</label>
      <input type="text" class="form-control" name="contact" placeholder="Enter contact number">

      <div class="mb-3 text-start">
        <label for="password" class="form-label">Password</label>
        <input
          type="password"
          class="form-control"
          id="password"
          name="password"
          placeholder="Enter password"
        />
        <div class="form-text">Must be at least 8 characters</div>
      </div>
      <div class="mb-3 text-start">
        <label for="confirmPassword" class="form-label">Confirm Password</label>
        <input
          type="password"
          class="form-control"
          name="confirm_password"
          id="confirmPassword"
          placeholder="Confirm password"
        />
        <div class="form-text">Both passwords must match</div>
      </div>

      <!-- Save Button -->
      <button type="submit" class="btn btn-outline-success btn-save">Create</button>
    </form>
  </div>
</body>
</html>
