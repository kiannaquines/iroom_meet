<div class="d-flex justify-content-around my-3">
  <a href="ParentGrades.php" class="text-center text-decoration-none text-dark">
    <?php
    $isAttendancePage = (basename($_SERVER['PHP_SELF']) === 'ParentGrades.php');
    if ($isAttendancePage) {
      echo '<img src="Pictures/grades_green.png" width="60" alt="Grades" />';
    } else {
      echo '<img src="Pictures/grade_icon.png" width="60" alt="Grades" />';
    }
    ?><br>Grades
  </a>
  <a href="ParentAttendance.php" class="text-center text-decoration-none text-dark">
    <?php
    $isAttendancePage = (basename($_SERVER['PHP_SELF']) === 'ParentAttendance.php');
    if ($isAttendancePage) {
      echo '<img src="Pictures/attendance_green.png" width="60" alt="Attendance" />';
    } else {
      echo '<img src="Pictures/attendance_icon.png" width="60" alt="Attendance" />';
    }
    ?>
    <br>Attendance
  </a>
  <a href="ParentWeeklyPerformance.php" class="text-center text-decoration-none text-dark">
    <?php
    $isWeeklyPerformancePage = (basename($_SERVER['PHP_SELF']) === 'ParentWeeklyPerformance.php');
    if ($isWeeklyPerformancePage) {
      echo '<img src="Pictures/weeklyperformance_green.png" width="60" alt="Performance" />';
    } else {
      echo '<img src="Pictures/weeklyperformance_icon.png" width="60" alt="Performance" />';
    }
    ?>
    <br>Weekly<br>Performance
  </a>
  <a href="ParentAdviser.php" class="text-center text-decoration-none text-dark">
    <?php
    $isAdviserPage = (basename($_SERVER['PHP_SELF']) === 'ParentAdviser.php');
    if ($isAdviserPage) {
      echo '<img src="Pictures/adviser_green.png" width="60" alt="Adviser" />';
    } else {
      echo '<img src="Pictures/adviser_icon.png" width="60" alt="Adviser" />';
    }
    ?>
    <br>Adviser
  </a>
  <a href="Logout.php" class="text-center text-decoration-none text-dark">
    <img src="Pictures/logout_icon.png" width="60" alt="Log Out" /><br>Log Out
  </a>
</div>