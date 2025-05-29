<?php
session_start();
include './backend/conn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Adviser Grades</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

  <?php include './backend/includes/_header.php'; ?>

  <div class="card p-3 mb-3">
    <div class="d-flex align-items-center justify-content-between mb-2">
      <h6><strong>GRADES</strong></h6>
      <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addGradeModal">Add Grade</button>
    </div>
    <div class="card p-3 mb-3">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h6 class="mb-0"><strong>Student Grades</strong></h6>
        <div>
          <label for="quarterSelect" class="me-2 fw-bold">Quarter:</label>
          <select id="quarterSelect" class="form-select d-inline-block" style="width: 140px;" onchange="filterByQuarter()">
            <option value="">All Quarters</option>
            <option value="1st Quarter">1st Quarter</option>
            <option value="2nd Quarter">2nd Quarter</option>
            <option value="3rd Quarter">3rd Quarter</option>
            <option value="4th Quarter">4th Quarter</option>
          </select>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered text-center align-middle mb-0" id="gradesTable">
          <thead class="table-light">
            <tr>
              <th>Name</th>
              <th>Subject</th>
              <th>Grade</th>
              <th>Quarter</th>
              <th>Date Encoded</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM grades ORDER BY date DESC");
            while ($row = mysqli_fetch_assoc($query)) {
              echo '<tr data-quarter="' . $row['quarter'] . '">
                      <td>' . htmlspecialchars($row['student']) . '</td>
                      <td>' . htmlspecialchars($row['subject']) . '</td>
                      <td>' . htmlspecialchars($row['grade']) . '</td>
                      <td>' . htmlspecialchars($row['quarter']) . '</td>
                      <td>' . htmlspecialchars($row['date']) . '</td>
                     <td>
                        <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#editGradeModal' . $row['id'] . '">
                          <i class="bi bi-pencil-square"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteGradeModal' . $row['id'] . '">
                          <i class="bi bi-trash"></i>
                        </button>
                      </td>
                    </tr>';

              echo '<div class="modal fade" id="editGradeModal' . $row['id'] . '" tabindex="-1" aria-labelledby="editGradeModalLabel' . $row['id'] . '" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <form action="./backend/logic/grade_update.php" method="POST">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editGradeModalLabel' . $row['id'] . '">Edit Grade</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <input type="hidden" name="id" value="' . $row['id'] . '">
                              <div class="mb-3">
                                <label for="student' . $row['id'] . '" class="form-label">Student Name</label>
                                <input type="text" class="form-control" name="student" id="student' . $row['id'] . '" value="' . htmlspecialchars($row['student']) . '" required>
                              </div>
                              <div class="mb-3">
                                <label for="subject' . $row['id'] . '" class="form-label">Subject</label>
                                <input type="text" class="form-control" name="subject" id="subject' . $row['id'] . '" value="' . htmlspecialchars($row['subject']) . '" required>
                              </div>
                              <div class="mb-3">
                                <label for="grade' . $row['id'] . '" class="form-label">Grade</label>
                                <input type="number" class="form-control" name="grade" id="grade' . $row['id'] . '" value="' . htmlspecialchars($row['grade']) . '" required min="0" max="100">
                              </div>
                              <div class="mb-3">
                                <label for="quarter' . $row['id'] . '" class="form-label">Quarter</label>
                                <select class="form-select" name="quarter" id="quarter' . $row['id'] . '" required>
                                  <option value="1st Quarter"' . ($row['quarter'] == '1st Quarter' ? ' selected' : '') . '>1st Quarter</option>
                                  <option value="2nd Quarter"' . ($row['quarter'] == '2nd Quarter' ? ' selected' : '') . '>2nd Quarter</option>
                                  <option value="3rd Quarter"' . ($row['quarter'] == '3rd Quarter' ? ' selected' : '') . '>3rd Quarter</option>
                                  <option value="4th Quarter"' . ($row['quarter'] == '4th Quarter' ? ' selected' : '') . '>4th Quarter</option>
                                </select>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>';

              echo '<div class="modal fade" id="deleteGradeModal' . $row['id'] . '" tabindex="-1" aria-labelledby="deleteGradeModalLabel' . $row['id'] . '" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <form action="./backend/logic/grade_delete.php" method="POST">
                            <div class="modal-header">
                              <h5 class="modal-title" id="deleteGradeModalLabel' . $row['id'] . '">Delete Grade</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <input type="hidden" name="id" value="' . $row['id'] . '">
                              <p>Are you sure you want to delete this grade record?</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              <button type="submit" class="btn btn-danger">Delete</button>
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
  </div>

  <!-- Add Grade Modal -->
  <div class="modal fade" id="addGradeModal" tabindex="-1" aria-labelledby="addGradeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="./backend/logic/grade_create.php" method="POST">
          <div class="modal-header">
            <h5 class="modal-title" id="addGradeModalLabel">Add Grade</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="student" class="form-label">Student Name</label>
              <input type="text" class="form-control" name="student" id="student" required>
            </div>
            <div class="mb-3">
              <label for="subject" class="form-label">Subject</label>
              <input type="text" class="form-control" name="subject" id="subject" required>
            </div>
            <div class="mb-3">
              <label for="grade" class="form-label">Grade</label>
              <input type="number" class="form-control" name="grade" id="grade" min="0" max="100" required>
            </div>
            <div class="mb-3">
              <label for="quarter" class="form-label">Quarter</label>
              <select class="form-select" name="quarter" id="quarter" required>
                <option value="">Select Quarter</option>
                <option value="1st Quarter">1st Quarter</option>
                <option value="2nd Quarter">2nd Quarter</option>
                <option value="3rd Quarter">3rd Quarter</option>
                <option value="4th Quarter">4th Quarter</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Add Grade</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    function filterByQuarter() {
      const select = document.getElementById('quarterSelect');
      const selectedQuarter = select.value;
      const rows = document.querySelectorAll('#gradesTable tbody tr');

      rows.forEach(row => {
        if (selectedQuarter === '' || row.getAttribute('data-quarter') === selectedQuarter) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    }
  </script>

</body>

</html>