<?php
session_start();
include './backend/conn.php';
include './backend/logic/get_profile.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Parent Adviser</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
  <style>
    body {
      background: linear-gradient(to bottom right, #e0f7fa, #b2ebf2);
      max-height: 100vh;
    }

    .card-section {
      background-color: white;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 20px;
    }
  </style>
</head>

<body class="container py-4">

  <div class="d-flex align-items-center my-3">
    <a href="ParentDashboard.html" class="text-decoration-none text-dark me-3">
      <i class="bi bi-arrow-left" style="font-size: 1.5rem;"></i>
    </a>
    <img src="Pictures/person_icon.png" alt="person_icon" class="me-2 person_icon" width="50" height="50">
    <h5 class="mb-0"><?php echo ucfirst($username); ?></h5>
  </div>

  <div class="d-flex justify-content-around my-3">
    <a href="ParentGrades.php" class="text-center text-decoration-none text-dark">
      <img src="Pictures/grade_icon.png" width="60" alt="Grades" /><br>Grades
    </a>
    <a href="ParentAttendance.php" class="text-center text-decoration-none text-dark">
      <img src="Pictures/attendance_icon.png" width="60" alt="Attendance" /><br>Attendance
    </a>
    <a href="ParentWeeklyPerformance.php" class="text-center text-decoration-none text-dark">
      <img src="Pictures/weeklyperformance_icon.png" width="60" alt="Performance" /><br>Weekly<br>Performance
    </a>
    <a href="ParentAdviser.php" class="text-center text-decoration-none text-dark">
      <img src="Pictures/adviser_green.png" width="60" alt="Adviser" /><br>Adviser
    </a>
    <a href="Logout.php" class="text-center text-decoration-none text-dark">
      <img src="Pictures/logout_icon.png" width="60" alt="Log Out" /><br>Log Out
    </a>
  </div>
  <?php
  $query = "SELECT 
            parent.*, 
            student.*, 
            adviser.*
          FROM parent
          INNER JOIN student ON parent.student = student.id
          INNER JOIN adviser ON adviser.id = student.adviser
          WHERE parent.id = '$id'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  ?>
  <div class="text-center mb-3">
    <img src="Pictures/person_icon.png" alt="person_icon" class="mb-2 person_icon" width="150" height="150" />
    <h5 class="mt-2"><?php echo htmlspecialchars($row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname']); ?></h5>
    <p>Section - <?php echo htmlspecialchars($row['section']); ?></p>
  </div>

  <div class="card-section p-3 mb-3">
    <input class="form-control mb-2" type="text" placeholder="Name:" readonly value="<?php echo htmlspecialchars($row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname']); ?>">
    <input class="form-control mb-2" type="text" placeholder="School ID:" readonly value="<?php echo htmlspecialchars($row['school_id']); ?>">
    <input class="form-control mb-2" type="text" placeholder="Section:" readonly value="<?php echo htmlspecialchars($row['section']); ?>">
    <input class="form-control mb-2" type="email" placeholder="Email:" readonly value="<?php echo htmlspecialchars($row['email']); ?>">
    <input class="form-control mb-2" type="text" placeholder="Contact No.:" readonly value="<?php echo htmlspecialchars($row['contact_no']); ?>">
  </div>

</body>

</html>