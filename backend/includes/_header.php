<div class="d-flex justify-content-around my-3">
  <a href="AdviserGrades.php" class="text-center text-decoration-none text-dark">
    <?php
    $isEnrolleesPage = (basename($_SERVER['PHP_SELF']) === 'AdviserGrades.php');
    if ($isEnrolleesPage) {
      echo '<img src="Pictures/grades_green.png" width="60" alt="Grades" />';
    } else {
      echo '<img src="Pictures/grade_icon.png" width="60" alt="Grades" />';
    }
    ?>
    <br>Grades
  </a>
  <a href="AdviserAttendance.php" class="text-center text-decoration-none text-dark">
    <?php
    $isAttendancePage = (basename($_SERVER['PHP_SELF']) === 'AdviserAttendance.php');
    if ($isAttendancePage) {
      echo '<img src="Pictures/attendance_green.png" width="60" alt="Attendance" />';
    } else {
      echo '<img src="Pictures/attendance_icon.png" width="60" alt="Attendance" />';
    }
    ?>
    <br>Attendance
  </a>
  <a href="AdviserWeeklyPerformance.php" class="text-center text-decoration-none text-dark">
    <?php
    $isAttendancePage = (basename($_SERVER['PHP_SELF']) === 'AdviserWeeklyPerformance.php');
    if ($isAttendancePage) {
      echo '<img src="Pictures/weeklyperformance_green.png" width="60" alt="Performance" />';
    } else {
      echo '<img src="Pictures/weeklyperformance_icon.png" width="60" alt="Performance" />';
    }
    ?>
    <br>Weekly<br>Performance
  </a>
  <a href="AdviserEnrollees.php" class="text-center text-decoration-none text-dark">
    <?php
    $isEnrolleesPage = (basename($_SERVER['PHP_SELF']) === 'AdviserEnrollees.php');
    if ($isEnrolleesPage) {
      echo '<img src="Pictures/enrollees_green.png" width="60" alt="Enrollees" />';
    } else {
      echo '<img src="Pictures/enrollees_icon.png" width="60" alt="Enrollees" />';
    }
    ?>
    <br>Enrollees
  </a>
  <a href="Logout.php" class="text-center text-decoration-none text-dark">
    <img src="Pictures/logout_icon.png" width="60" alt="Log Out" /><br>Log Out
  </a>
</div>