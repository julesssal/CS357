<html>
<body>

<h1 align='center'>Students List</h1>
<div style="text-align: left">
  <a href="newStudent.php">Add New Student</a>
</div>
<div style="text-align: right">
  <a href="login.php?action=logout">Logout</a>
</div>

</table>
    <table width='100%' border="1">
    <tr><th>ID</th><th>First Name</th><th>Last Name</th>
    <th>Email</th><th>Class Of</th><th>Courses</th></tr>
<?php

  foreach ($students_list as $student) {

    $id = $student['id'];
    if ($id == $logged_in_user_id) {
      echo '<tr><td><a href="student.php?id='. $id . '">' . $student['id'] . '</a></td>';

    } else {
      echo '<tr><td>' . $student['id'] . '</td>';
    }

    echo '<td>' . $student['first_name'] . '</td>';
    echo '<td>' . $student['last_name'] . '</td>';
    echo '<td>' . $student['email'] . '</td>';
    echo '<td>' . $student['classOf'] . '</td>';
    echo '<td><a href="registeredCourses.php">List</a></tr>';

  }
?>
</table>

<td align='right'><a href="courses.php">Courses</a></td><br>
<td align='right'><a href="login.php">Main (Logout)</a></td>
</body>
</hmtl>
