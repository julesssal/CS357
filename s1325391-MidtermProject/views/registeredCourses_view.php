<html>
<body>

<h1 align='center'>Registered Courses</h1>

<div style="text-align: center">
  <?php
  foreach ($registrations_list as $registrations)
    {
      $id = $registrations['students_id'];

  }
  if ($id == $logged_in_user_id) {
  echo "Student: " .$registrations['first_name']." ".  $registrations['last_name'];
  }

  ?>
</div>

<div style="text-align: center">
  <a href="newRegistration.php">Register For Another Course</a>
</div>
<div style="text-align: right">
  <a href="login.php?action=logout">Logout</a>
</div>


    <table width='100%' border="1">
    <tr><th>Course ID</th><th>Number</th><th>Description</th></tr>
<?php

  foreach ($registrations_list as $registrations) {
    

     $id = $registrations['students_id'];
     if ($id == $logged_in_user_id) {


       echo '<tr><td>' . $registrations['courses_id'] . '</td>';
       echo '<td>' . $registrations['course_number'] . '</td>';
       echo '<td>' . $registrations['course_description'] . '</td></tr>';
     }



  }
?>
</table>

<td align='right'><a href="student.php">Students</a></td><br>
<td align='right'><a href="courses.php">Courses</a></td><br>
<td align='right'><a href="login.php">Main (Logout)</a></td>
</body>
</hmtl>
