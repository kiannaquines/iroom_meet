<?php
session_start();

include './backend/conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Adviser Attendance</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    body {
      background: linear-gradient(to bottom right, #e0f7fa, #b2ebf2);
      min-height: 100vh;
    }

    .name-column {
      width: auto;
      text-align: left;
    }

    .date-input {
      font-size: 1rem;
      min-width: unset;
      width: 100px;
      padding: 2px 2px;
    }
  </style>
</head>

<body class="container py-4">
  <div class="d-flex align-items-center my-3">
    <a href="AdviserDashboard.php" class="text-decoration-none text-dark me-3">
      <i class="bi bi-arrow-left" style="font-size: 1.5rem;"></i>
    </a>
    <img src="Pictures/person_icon.png" alt="person_icon" class="me-2" width="30" height="30">
    <h5 class="mb-0" style="text-transform: uppercase;"><?php echo $_SESSION['username']; ?></h5>
  </div>

  <?php include './backend/includes/_header.php'; ?>

  <div class="card p-3 mb-3">
    <div class="d-flex align-items-center justify-content-between mb-2">
      <h6><strong>ATTENDANCE</strong></h6>
      <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#sheet">Add New Attendance</button>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered text-center">
        <thead class="table-light">
          <tr>
            <th class="name-column">Name</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query = mysqli_query($conn, "SELECT * FROM attendance");
          while ($row = mysqli_fetch_assoc($query)) {
            $id = $row['id'];
            $name = $row['name'];
            $status = $row['status'];
            $date = $row['date'];

            echo "<tr>
              <td>$name</td>
              <td>$status</td>
              <td>$date</td>
              <td>
                <button class='btn btn-sm btn-primary me-1' data-bs-toggle='modal' data-bs-target='#editModal$id'>
                  <i class='bi bi-pencil-square'></i>
                </button>
                <button class='btn btn-sm btn-danger' data-bs-toggle='modal' data-bs-target='#deleteModal$id'>
                  <i class='bi bi-trash'></i>
                </button>
              </td>
            </tr>";

            // Edit Modal
            echo "
            <div class='modal fade' id='editModal$id' tabindex='-1'>
              <div class='modal-dialog'>
                <div class='modal-content'>
                  <form action='./backend/logic/attendance_edit.php' method='POST'>
                    <div class='modal-header'>
                      <h5 class='modal-title'>Edit Attendance</h5>
                      <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                    </div>
                    <div class='modal-body'>
                      <input type='hidden' name='id' value='$id'>
                      <div class='mb-3'>
                        <label class='form-label'>Name</label>
                        <input type='text' class='form-control' name='name' value='$name' required>
                      </div>
                      <div class='mb-3'>
                        <label class='form-label'>Status</label>
                        <select class='form-select' name='status' required>
                          <option " . ($status == 'Present' ? 'selected' : '') . ">Present</option>
                          <option " . ($status == 'Absent' ? 'selected' : '') . ">Absent</option>
                          <option " . ($status == 'Excused' ? 'selected' : '') . ">Excused</option>
                          <option " . ($status == 'Late' ? 'selected' : '') . ">Late</option>
                        </select>
                      </div>
                    </div>
                    <div class='modal-footer'>
                      <button type='submit' class='btn btn-primary'>Save</button>
                      <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>";

            // Delete Modal
            echo "
            <div class='modal fade' id='deleteModal$id' tabindex='-1'>
              <div class='modal-dialog'>
                <div class='modal-content'>
                  <form action='./backend/logic/attendance_delete.php' method='GET'>
                    <div class='modal-header'>
                      <h5 class='modal-title'>Confirm Delete</h5>
                      <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                    </div>
                    <div class='modal-body'>
                      <p>Are you sure you want to delete attendance for <strong>$name</strong>?</p>
                      <input type='hidden' name='id' value='$id'>
                    </div>
                    <div class='modal-footer'>
                      <button type='submit' class='btn btn-danger'>Delete</button>
                      <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Add Modal -->
  <div class="modal fade" id="sheet" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="./backend/logic/attendance_create.php" method="POST">
          <div class="modal-header">
            <h5 class="modal-title">Add Attendance</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" name="name" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Status</label>
              <select class="form-select" name="status" required>
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
                <option value="Excused">Excused</option>
                <option value="Late">Late</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Add</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>