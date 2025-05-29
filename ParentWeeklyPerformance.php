<?php
session_start();
include './backend/conn.php';
include './backend/logic/get_profile.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Parent Weekly Performance</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    body {
      background: linear-gradient(to bottom right, #e0f7fa, #b2ebf2);
      min-height: 100vh;
    }
  </style>
</head>

<body class="container py-4">
  <div class="d-flex align-items-center my-3">
    <a href="ParentDashboard.php" class="text-decoration-none text-dark me-3">
      <i class="bi bi-arrow-left" style="font-size: 1.5rem;"></i>
    </a>
    <img src="Pictures/person_icon.png" alt="person_icon" class="me-2 person_icon" width="30" height="30">
    <h5 class="mb-0" style="text-transform: uppercase;"><?php echo $username; ?></h5>
  </div>

  <?php include './backend/includes/_header_parent.php'; ?>

  <div class="card p-3 mb-4">
    <div class="row">
      <!-- Metric Table -->
      <div class="col-md-6 mb-3 mb-md-0">
        <div class="table-responsive">
          <table class="table table-bordered text-center align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th>METRIC CODE</th>
                <th>DESCRIPTION</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>M01</td>
                <td><b>Classroom Engagement</b></td>
              </tr>
              <tr>
                <td>M02</td>
                <td><b>Social Interactions</b></td>
              </tr>
              <tr>
                <td>M03</td>
                <td><b>Behavioral Compliance</b></td>
              </tr>
              <tr>
                <td>M04</td>
                <td><b>Learning Attitudes</b></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- Point Scale Table -->
      <div class="col-md-6" style="padding-top: 20px;">
        <div class="table-responsive">
          <table class="table table-bordered text-center align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th>POINT SCALE</th>
                <th>REMARKS</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1-3</td>
                <td>BAD</td>
              </tr>
              <tr>
                <td>4-6</td>
                <td>GOOD</td>
              </tr>
              <tr>
                <td>7-10</td>
                <td>VERY GOOD</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="card p-3 mb-3">
    <div class="d-flex align-items-center justify-content-between">
      <h6>Weekly Performance</h6>
    </div>
    <table class="table table-bordered">
      <thead class="table-light">
        <tr>
          <th>No</th>
          <th>Name</th>
          <th>M01</th>
          <th>M02</th>
          <th>M03</th>
          <th>M04</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = mysqli_query($conn, "SELECT * FROM weekly_performance INNER JOIN parent ON weekly_performance.student = parent.student INNER JOIN student ON parent.student = student.id WHERE parent.id = '$id' ORDER BY weekly_performance.id DESC");
        $counter = 1;
        while ($row = mysqli_fetch_assoc($query)) {
          echo '<tr>
                <td>' . $counter++ . '</td>
                <td>' . htmlspecialchars($row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname']) . '</td>
                <td>' . $row['m01'] . '</td>
                <td>' . $row['m02'] . '</td>
                <td>' . $row['m03'] . '</td>
                <td>' . $row['m04'] . '</td>
              </tr>';
        }
        ?>
      </tbody>
    </table>
  </div> 

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>