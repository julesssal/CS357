<html>
<body>


<table width='100%'><tr>
<td align='left'><a href="newCourse.php">Add Course</a></td>
<td align='right'><a href="login.php?action=logout">Logout</a></td>
</tr></table>
    <table width='100%' border="1">
    <tr><th>ID</th><th>Course Number</th><th>Description</th></tr>
<?php

  foreach ($courses_list as $course) {
   
    echo '<tr><td>' . $course['courses_id'] . '</td>';
    echo '<td>' . $course['course_number'] . '</td>';
    echo '<td>' . $course['course_description'] . '</td></tr>';
  }
?>
</table>

<td align='right'><a href="student.php">Students</a></td><br>
<td align='right'><a href="login.php">Main (Logout)</a></td>

</body>
</hmtl>
