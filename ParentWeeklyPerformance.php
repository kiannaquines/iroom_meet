<?php
session_start();
include './backend/conn.php';
include './backend/logic/auth_check.php';
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
    <a href="AdviserDashboard.php" class="text-decoration-none text-dark me-3">
      <i class="bi bi-arrow-left" style="font-size: 1.5rem;"></i>
    </a>
    <img src="Pictures/person_icon.png" alt="person_icon" class="me-2 person_icon" width="30" height="30">
    <h5 class="mb-0" style="text-transform: uppercase;"><?php echo $_SESSION['username']; ?></h5>
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
      <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addperf">Add Performance</button>
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
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = mysqli_query($conn, "SELECT * FROM weekly_performance");
        $counter = 1;
        while ($row = mysqli_fetch_assoc($query)) {
          echo '<tr>
                <td>' . $counter++ . '</td>
                <td>' . htmlspecialchars($row['name']) . '</td>
                <td>' . $row['m01'] . '</td>
                <td>' . $row['m02'] . '</td>
                <td>' . $row['m03'] . '</td>
                <td>' . $row['m04'] . '</td>
                <td>
                  <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#editModal' . $row['id'] . '">
                    <i class="bi bi-pencil-square"></i>
                  </button>
                  <a href="./backend/logic/weekly_perf_delete.php?id=' . $row['id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">
                    <i class="bi bi-trash"></i>
                  </a>
                </td>
              </tr>';

          echo '<div class="modal fade" id="editModal' . $row['id'] . '" tabindex="-1">
                <div class="modal-dialog">
                  <form method="POST" action="./backend/logic/weekly_perf_update.php" class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit Performance</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="id" value="' . $row['id'] . '">
                      <div class="mb-2">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="' . htmlspecialchars($row['name']) . '" required>
                      </div>
                      <div class="mb-2">
                        <label>M01</label>
                        <input type="number" class="form-control" name="m01" value="' . $row['m01'] . '" required>
                      </div>
                      <div class="mb-2">
                        <label>M02</label>
                        <input type="number" class="form-control" name="m02" value="' . $row['m02'] . '" required>
                      </div>
                      <div class="mb-2">
                        <label>M03</label>
                        <input type="number" class="form-control" name="m03" value="' . $row['m03'] . '" required>
                      </div>
                      <div class="mb-2">
                        <label>M04</label>
                        <input type="number" class="form-control" name="m04" value="' . $row['m04'] . '" required>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Save</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                  </form>
                </div>
              </div>';
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Add Modal -->
  <div class="modal fade" id="addperf" tabindex="-1" aria-labelledby="addperf" aria-hidden="true">
    <div class="modal-dialog">
      <form method="POST" action="./backend/logic/weekly_perf_create.php" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Performance</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-2">
            <label>Name</label>
            <input type="text" class="form-control" name="name" required>
          </div>
          <div class="mb-2">
            <label>M01</label>
            <input type="number" class="form-control" name="m01" required>
          </div>
          <div class="mb-2">
            <label>M02</label>
            <input type="number" class="form-control" name="m02" required>
          </div>
          <div class="mb-2">
            <label>M03</label>
            <input type="number" class="form-control" name="m03" required>
          </div>
          <div class="mb-2">
            <label>M04</label>
            <input type="number" class="form-control" name="m04" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Add</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>