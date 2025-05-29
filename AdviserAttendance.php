<?php
session_start();

include './backend/conn.php';
include './backend/logic/get_profile.php';
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
    
    .status-present { background-color: #d4edda; }
    .status-absent { background-color: #f8d7da; }
    .status-excused { background-color: #e2e3e5; }
    .status-late { background-color: #fff3cd; }
  </style>
</head>

<body class="container py-4">
  <div class="d-flex align-items-center my-3">
    <a href="AdviserDashboard.php" class="text-decoration-none text-dark me-3">
      <i class="bi bi-arrow-left" style="font-size: 1.5rem;"></i>
    </a>
    <img src="Pictures/person_icon.png" alt="person_icon" class="me-2" width="30" height="30">
    <h5 class="mb-0" style="text-transform: uppercase;"><?php echo htmlspecialchars($username); ?></h5>
  </div>

  <?php include './backend/includes/_header.php'; ?>

  <div class="card p-3 mb-3">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h5 class="mb-0"><strong>ATTENDANCE RECORDS</strong></h5>
      <div>
        <button class="btn btn-outline-success me-2" data-bs-toggle="modal" data-bs-target="#sheet">
          <i class="bi bi-plus-lg"></i> Add New
        </button>
      </div>
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
          $query = mysqli_query($conn, "SELECT attendance.*, student.firstname, student.middlename, student.lastname 
                                       FROM attendance 
                                       INNER JOIN student ON attendance.student = student.id 
                                       ORDER BY date DESC, lastname ASC");
          
          if (mysqli_num_rows($query) === 0) {
            echo '<tr><td colspan="4" class="text-center py-4">No attendance records found</td></tr>';
          } else {
            while ($row = mysqli_fetch_assoc($query)) {
              $id = $row['id'];
              $name = htmlspecialchars($row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname']);
              $status = htmlspecialchars($row['status']);
              $date = htmlspecialchars($row['date']);
              $statusClass = strtolower($status);

              echo "<tr class='status-$statusClass'>
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
              <div class='modal fade' id='editModal$id' tabindex='-1' aria-labelledby='editModalLabel$id' aria-hidden='true'>
                <div class='modal-dialog'>
                  <div class='modal-content'>
                    <form action='./backend/logic/attendance_edit.php' method='POST'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='editModalLabel$id'>Edit Attendance</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                      </div>
                      <div class='modal-body'>
                        <input type='hidden' name='id' value='$id'>
                        <div class='mb-3'>
                          <label class='form-label'>Student</label>
                          <select class='form-select' name='student' required>
                            <option value=''>Select Student</option>";
                            $studentsQuery = mysqli_query($conn, "SELECT * FROM student ORDER BY lastname, firstname");
                            while ($student = mysqli_fetch_assoc($studentsQuery)) {
                              $selected = ($row['student'] == $student['id']) ? 'selected' : '';
                              echo "<option value='" . $student['id'] . "' $selected>" 
                                   . htmlspecialchars($student['firstname'] . ' ' . $student['middlename'] . ' ' . $student['lastname']) 
                                   . "</option>";
                            }
                          echo "</select>
                        </div>
                        <div class='mb-3'>
                          <label class='form-label'>Status</label>
                          <select class='form-select' name='status' required>
                            <option value='Present' " . ($status == 'Present' ? 'selected' : '') . ">Present</option>
                            <option value='Absent' " . ($status == 'Absent' ? 'selected' : '') . ">Absent</option>
                            <option value='Excused' " . ($status == 'Excused' ? 'selected' : '') . ">Excused</option>
                            <option value='Late' " . ($status == 'Late' ? 'selected' : '') . ">Late</option>
                          </select>
                        </div>
                      </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                        <button type='submit' class='btn btn-primary'>Save Changes</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>";

              // Delete Modal
              echo "
              <div class='modal fade' id='deleteModal$id' tabindex='-1' aria-labelledby='deleteModalLabel$id' aria-hidden='true'>
                <div class='modal-dialog'>
                  <div class='modal-content'>
                    <form action='./backend/logic/attendance_delete.php' method='POST'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='deleteModalLabel$id'>Confirm Deletion</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                      </div>
                      <div class='modal-body'>
                        <p>Are you sure you want to delete the attendance record for <strong>$name</strong> on <strong>$date</strong>?</p>
                        <input type='hidden' name='id' value='$id'>
                      </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                        <button type='submit' class='btn btn-danger'>Delete Record</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>";
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Add Modal -->
  <div class="modal fade" id="sheet" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="./backend/logic/attendance_create.php" method="POST">
          <div class="modal-header">
            <h5 class="modal-title" id="addModalLabel">Add Attendance Record</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Student</label>
              <select class="form-select" name="student" required>
                <option value="">Select Student</option>
                <?php
                $studentsQuery = mysqli_query($conn, "SELECT * FROM student ORDER BY lastname, firstname");
                while ($student = mysqli_fetch_assoc($studentsQuery)) {
                  echo "<option value='" . $student['id'] . "'>" 
                       . htmlspecialchars($student['firstname'] . ' ' . $student['middlename'] . ' ' . $student['lastname']) 
                       . "</option>";
                }
                ?>
              </select>
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
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Add Record</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Set today's date as default for date inputs
    document.addEventListener('DOMContentLoaded', function() {
      const today = new Date().toISOString().split('T')[0];
      document.querySelectorAll('input[type="date"]').forEach(input => {
        if (!input.value) input.value = today;
      });
    });
  </script>
</body>
</html>