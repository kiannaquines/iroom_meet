<?php
session_start();
include './backend/conn.php';
include './backend/logic/get_profile.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Adviser Enrollees</title>
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
    <h5 class="mb-0" style="text-transform: uppercase;"><?php echo $username; ?></h5>
  </div>

  <?php include './backend/includes/_header.php'; ?>

  <div class="card p-3 mb-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="card-title mb-0">Enrollees</h5>
      <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addStudentModal">
        <i class="bi bi-plus-circle"></i> Add Student
      </button>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered text-center">
        <thead class="table-light">
          <tr>
            <th style="width: 50px;">No.</th>
            <th>Name</th>
            <th>LRN</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="enrollees-tbody">
          <?php
          $query = mysqli_query($conn, "SELECT * FROM student");
          while ($row = mysqli_fetch_assoc($query)) {
            echo '<tr>
        <td>' . $row['id'] . '</td>
        <td>' . $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'] . '</td>
        <td>' . $row['lrn'] . '</td>
        <td>
          <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editStudentModal' . $row['id'] . '"><i class="bi bi-pencil"></i></button>
          <form action="./backend/logic/student_delete.php" method="POST" class="d-inline">
            <input type="hidden" name="id" value="' . $row['id'] . '">
            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')"><i class="bi bi-trash"></i></button>
          </form>
        </td>
      </tr>';

            echo '<div class="modal fade" id="editStudentModal' . $row['id'] . '" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="./backend/logic/student_update.php" method="POST">
              <div class="modal-header">
                <h5 class="modal-title">Edit Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id" value="' . $row['id'] . '">
                <div class="mb-3">
                  <label class="form-label">First Name</label>
                  <input type="text" class="form-control" name="firstname" value="' . $row['firstname'] . '">
                </div>
                <div class="mb-3">
                  <label class="form-label">Middle Name</label>
                  <input type="text" class="form-control" name="middlename" value="' . $row['middlename'] . '">
                </div>
                <div class="mb-3">
                  <label class="form-label">Last Name</label>
                  <input type="text" class="form-control" name="lastname" value="' . $row['lastname'] . '">
                </div>
                <div class="mb-3">
                  <label class="form-label">Adviser</label>
                  <select name="adviser" class="form-select">
                    <option value="">Select Adviser</option>';
            $adviser_query = mysqli_query($conn, "SELECT * FROM adviser");
            while ($adviser_row = mysqli_fetch_assoc($adviser_query)) {
              $selected = ($adviser_row['id'] == $row['adviser']) ? 'selected' : '';
              echo '<option value="' . $adviser_row['id'] . '" ' . $selected . '>' . $adviser_row['name'] . '</option>';
            }
            echo '</select>
                </div>
                <div class="mb-3">
                  <label class="form-label">LRN</label>
                  <input type="text" class="form-control" name="lrn" value="' . $row['lrn'] . '">
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>';
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>


  <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="./backend/logic/student_create.php" method="POST" id="add-student-form">
          <div class="modal-header">
            <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="student-firstname" class="form-label">First Name</label>
              <input type="text" class="form-control" name="firstname" id="student-firstname" required>
            </div>
            <div class="mb-3">
              <label for="student-middle_initial" class="form-label">Middle Initial</label>
              <input type="text" class="form-control" name="middlename" id="student-middle_initial" optional>
            </div>
            <div class="mb-3">
              <label for="student-lastname" class="form-label">Last Name</label>
              <input type="text" class="form-control" name="lastname" id="student-lastname" required>
            </div>
            <div class="mb-3">
              <label for="student-lastname" class="form-label">Adviser</label>
              <select name="adviser" class="form-select" id="student-adviser" required>
                <option value="">Select Adviser</option>
                <?php
                $adviser_query = mysqli_query($conn, "SELECT * FROM adviser");
                while ($adviser_row = mysqli_fetch_assoc($adviser_query)) {
                  echo '<option value="' . $adviser_row['id'] . '">' . $adviser_row['name'] . '</option>';
                }
                ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="student-lrn" class="form-label">LRN</label>
              <input type="text" class="form-control" name="lrn" id="student-lrn" required>
            </div>
            <div class="mb-3">
              <label for="student-section" class="form-label">Section</label>
              <input type="text" class="form-control" name="section" id="student-section" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>